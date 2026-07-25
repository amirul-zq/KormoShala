# KormoShala Database Specification

## 1. Purpose

This document defines the database structure for KormoShala, a local short-term worker marketplace for Bangladesh.

The database must support:

- Hirer, Worker, and Admin accounts
- WhatsApp contact information and address details
- Worker profiles
- Job posting and lifecycle management
- Worker applications and price offers
- Worker selection
- Job completion
- Ratings and reviews
- Admin statistics and monitoring

This document is the database source of truth for implementation.

---

## 2. Database Technology

- Database: MySQL
- Application framework: Laravel 13
- ORM: Eloquent
- Character set: `utf8mb4`
- Collation: `utf8mb4_unicode_ci`

Recommended database name:

```text
kormoshala
```

---

## 3. Core Business Tables

KormoShala uses five core business tables:

1. `users`
2. `worker_profiles`
3. `jobs`
4. `applications`
5. `reviews`

Laravel may also create framework-related tables such as:

- `password_reset_tokens`
- `sessions`
- `cache`
- `cache_locks`
- `jobs`-related queue infrastructure tables, only if Laravel requires them

Framework tables are not part of the marketplace business model.

---

## 4. Relationship Overview

```text
USERS
├── has one WORKER_PROFILE
├── has many JOBS as Hirer
├── has many APPLICATIONS as Worker
├── has many REVIEWS written as Hirer
└── has many REVIEWS received as Worker

JOBS
├── belongs to Hirer
├── belongs to selected Worker, nullable
├── has many APPLICATIONS
└── has one REVIEW, nullable

APPLICATIONS
├── belongs to JOB
└── belongs to Worker

REVIEWS
├── belongs to JOB
├── belongs to Hirer
└── belongs to Worker
```

---

## 5. Table: `users`

### Purpose

Stores shared account, authentication, contact, role, and account-status information for Hirers, Workers, and Admins.

### Columns

| Column | Type | Constraints | Purpose |
|---|---|---|---|
| `id` | BIGINT UNSIGNED | Primary key, auto increment | User identifier |
| `name` | VARCHAR(255) | Not null | User's full name |
| `email` | VARCHAR(255) | Not null, unique | Login email |
| `email_verified_at` | TIMESTAMP | Nullable | Laravel email verification support |
| `password` | VARCHAR(255) | Not null | Hashed password |
| `whatsapp_number` | VARCHAR(30) | Not null | User's WhatsApp contact number |
| `address` | TEXT | Not null | User's address details |
| `role` | ENUM or VARCHAR | Not null, default based on registration | `hirer`, `worker`, or `admin` |
| `status` | ENUM or VARCHAR | Not null, default `active` | `active` or `blocked` |
| `remember_token` | VARCHAR(100) | Nullable | Laravel remember-me token |
| `created_at` | TIMESTAMP | Laravel timestamp | Registration time |
| `updated_at` | TIMESTAMP | Laravel timestamp | Last update time |

### Allowed Role Values

```text
hirer
worker
admin
```

### Allowed Status Values

```text
active
blocked
```

### Business Rules

- Public registration may create only `hirer` or `worker` accounts.
- Admin accounts must be created through a seeder, command, or controlled administrative process.
- `email` must be unique.
- `whatsapp_number` must be validated as a reasonable phone-number format.
- `password` must always be hashed.
- Blocked users must not access normal protected marketplace functions.
- A Worker may have one related Worker Profile.
- Hirers and Workers both store WhatsApp and address information directly in this table.

### Recommended Indexes

- Unique index on `email`
- Index on `role`
- Index on `status`
- Composite index on `role, status`

---

## 6. Table: `worker_profiles`

### Purpose

Stores additional marketplace information for Worker accounts.

### Columns

| Column | Type | Constraints | Purpose |
|---|---|---|---|
| `id` | BIGINT UNSIGNED | Primary key, auto increment | Worker Profile identifier |
| `user_id` | BIGINT UNSIGNED | Not null, foreign key, unique | Related Worker account |
| `category` | VARCHAR(100) | Not null | Work skill/category |
| `area` | VARCHAR(255) | Not null | Worker's service area |
| `description` | TEXT | Not null | Short Worker description |
| `expected_rate` | DECIMAL(12,2) | Not null | Expected service rate |
| `created_at` | TIMESTAMP | Laravel timestamp | Creation time |
| `updated_at` | TIMESTAMP | Laravel timestamp | Last update time |

### Foreign Key

```text
worker_profiles.user_id
    → users.id
```

### Suggested Delete Behaviour

```text
ON DELETE CASCADE
```

If a Worker account is deleted, the related Worker Profile should also be deleted.

### Business Rules

- Only users with `role = worker` may have a Worker Profile.
- A Worker can have at most one Worker Profile.
- `user_id` must therefore be unique.
- `expected_rate` must be zero or greater.
- The profile's `area` is the Worker's service area and may differ from the user's personal address.
- Average rating and review count must not be stored manually in this table; they should be calculated from `reviews`.

### Recommended Indexes

- Unique index on `user_id`
- Index on `category`
- Index on `area`
- Composite index on `category, area`

---

## 7. Table: `jobs`

### Purpose

Stores jobs created by Hirers.

### Columns

| Column | Type | Constraints | Purpose |
|---|---|---|---|
| `id` | BIGINT UNSIGNED | Primary key, auto increment | Job identifier |
| `hirer_id` | BIGINT UNSIGNED | Not null, foreign key | User who created the job |
| `title` | VARCHAR(255) | Not null | Job title |
| `category` | VARCHAR(100) | Not null | Job category |
| `description` | TEXT | Not null | Full job details |
| `area` | VARCHAR(255) | Not null | Work location/area |
| `work_date` | DATE | Not null | Required work date |
| `budget` | DECIMAL(12,2) | Not null | Hirer's budget |
| `status` | ENUM or VARCHAR | Not null, default `open` | `open`, `assigned`, or `completed` |
| `selected_worker_id` | BIGINT UNSIGNED | Nullable, foreign key | Selected Worker |
| `created_at` | TIMESTAMP | Laravel timestamp | Creation time |
| `updated_at` | TIMESTAMP | Laravel timestamp | Last update time |

### Foreign Keys

```text
jobs.hirer_id
    → users.id

jobs.selected_worker_id
    → users.id
```

### Suggested Delete Behaviour

For `hirer_id`:

```text
ON DELETE CASCADE
```

For `selected_worker_id`:

```text
ON DELETE SET NULL
```

### Allowed Status Values

```text
open
assigned
completed
```

### Business Rules

- Only users with `role = hirer` may create jobs.
- A new job must begin with `status = open`.
- Only the owning Hirer may update or manage the job.
- A Worker may be selected only if they submitted an Application for that job.
- Selecting a Worker sets:
  - `status = assigned`
  - `selected_worker_id = selected Worker user ID`
- Only an Assigned job may move to Completed.
- Status changes must follow:

```text
open → assigned → completed
```

- Status must not move backwards.
- `selected_worker_id` must remain null while the job is Open.
- A Completed job may receive one Review.
- `budget` must be zero or greater.

### Recommended Indexes

- Index on `hirer_id`
- Index on `selected_worker_id`
- Index on `status`
- Index on `category`
- Index on `area`
- Index on `work_date`
- Composite index on `status, category`
- Composite index on `hirer_id, status`

---

## 8. Table: `applications`

### Purpose

Stores Worker applications and price offers for jobs.

### Columns

| Column | Type | Constraints | Purpose |
|---|---|---|---|
| `id` | BIGINT UNSIGNED | Primary key, auto increment | Application identifier |
| `job_id` | BIGINT UNSIGNED | Not null, foreign key | Related job |
| `worker_id` | BIGINT UNSIGNED | Not null, foreign key | Worker who applied |
| `offered_price` | DECIMAL(12,2) | Not null | Worker's price offer |
| `message` | TEXT | Not null | Short application message |
| `created_at` | TIMESTAMP | Laravel timestamp | Application time |
| `updated_at` | TIMESTAMP | Laravel timestamp | Last update time |

### Foreign Keys

```text
applications.job_id
    → jobs.id

applications.worker_id
    → users.id
```

### Suggested Delete Behaviour

```text
applications.job_id
    ON DELETE CASCADE

applications.worker_id
    ON DELETE CASCADE
```

### Business Rules

- Only users with `role = worker` may apply.
- Applications may be submitted only while the Job status is `open`.
- A Worker cannot apply to their own job.
- A Worker cannot submit multiple Applications for the same Job.
- `offered_price` must be zero or greater.
- The selected Worker for a Job must come from this table.
- An Application must not be created for a missing or non-open Job.

### Required Unique Constraint

```text
UNIQUE(job_id, worker_id)
```

This prevents duplicate applications.

### Recommended Indexes

- Index on `job_id`
- Index on `worker_id`
- Composite unique index on `job_id, worker_id`

---

## 9. Table: `reviews`

### Purpose

Stores Hirer-to-Worker ratings and written reviews after completed jobs.

### Columns

| Column | Type | Constraints | Purpose |
|---|---|---|---|
| `id` | BIGINT UNSIGNED | Primary key, auto increment | Review identifier |
| `job_id` | BIGINT UNSIGNED | Not null, foreign key, unique | Reviewed completed job |
| `hirer_id` | BIGINT UNSIGNED | Not null, foreign key | Hirer who wrote the review |
| `worker_id` | BIGINT UNSIGNED | Not null, foreign key | Worker who received the review |
| `rating` | TINYINT UNSIGNED | Not null | Rating from 1 to 5 |
| `review` | TEXT | Nullable | Written review |
| `created_at` | TIMESTAMP | Laravel timestamp | Review creation time |
| `updated_at` | TIMESTAMP | Laravel timestamp | Last update time |

### Foreign Keys

```text
reviews.job_id
    → jobs.id

reviews.hirer_id
    → users.id

reviews.worker_id
    → users.id
```

### Suggested Delete Behaviour

```text
reviews.job_id
    ON DELETE CASCADE

reviews.hirer_id
    ON DELETE CASCADE

reviews.worker_id
    ON DELETE CASCADE
```

### Business Rules

- Reviews may be created only after the related Job is `completed`.
- Only the Hirer who owns the Job may write the Review.
- Only the selected Worker may receive the Review.
- A Job may have at most one Review.
- `rating` must be between 1 and 5.
- Written review text is optional.
- A Hirer cannot review themselves.
- A Hirer cannot review a Worker who was not selected for the Job.
- Worker average rating must be calculated from Review records.
- Worker total review count must be calculated from Review records.

### Required Constraints

```text
UNIQUE(job_id)
CHECK(rating >= 1 AND rating <= 5)
```

If database-level check constraints are not reliably supported by the target MySQL version, enforce the rating rule through Laravel validation and application logic as well.

### Recommended Indexes

- Unique index on `job_id`
- Index on `hirer_id`
- Index on `worker_id`
- Index on `rating`
- Composite index on `worker_id, rating`

---

## 10. Entity Relationship Diagram

```text
┌────────────────────┐
│       users        │
├────────────────────┤
│ id                 │
│ name               │
│ email              │
│ password           │
│ whatsapp_number    │
│ address            │
│ role               │
│ status             │
└─────────┬──────────┘
          │
          │ 1
          │
          │ 0..1
┌─────────▼──────────┐
│  worker_profiles   │
├────────────────────┤
│ id                 │
│ user_id            │
│ category           │
│ area               │
│ description        │
│ expected_rate      │
└────────────────────┘


┌────────────────────┐
│       users        │
│     as Hirer       │
└─────────┬──────────┘
          │ 1
          │
          │ many
┌─────────▼──────────┐
│        jobs        │
├────────────────────┤
│ id                 │
│ hirer_id           │
│ selected_worker_id │
│ title              │
│ category           │
│ description        │
│ area               │
│ work_date          │
│ budget             │
│ status             │
└──────┬────────┬────┘
       │        │
       │ many   │ 0..1
       │        │
┌──────▼──────┐ ┌────▼───────────┐
│applications │ │    reviews     │
├─────────────┤ ├────────────────┤
│ id          │ │ id             │
│ job_id      │ │ job_id         │
│ worker_id   │ │ hirer_id       │
│ offered_    │ │ worker_id      │
│ price       │ │ rating         │
│ message     │ │ review         │
└─────────────┘ └────────────────┘
```

---

## 11. Laravel Model Relationships

### `User`

Recommended Eloquent relationships:

```php
public function workerProfile()
{
    return $this->hasOne(WorkerProfile::class);
}

public function postedJobs()
{
    return $this->hasMany(Job::class, 'hirer_id');
}

public function selectedJobs()
{
    return $this->hasMany(Job::class, 'selected_worker_id');
}

public function applications()
{
    return $this->hasMany(Application::class, 'worker_id');
}

public function writtenReviews()
{
    return $this->hasMany(Review::class, 'hirer_id');
}

public function receivedReviews()
{
    return $this->hasMany(Review::class, 'worker_id');
}
```

### `WorkerProfile`

```php
public function user()
{
    return $this->belongsTo(User::class);
}
```

### `Job`

```php
public function hirer()
{
    return $this->belongsTo(User::class, 'hirer_id');
}

public function selectedWorker()
{
    return $this->belongsTo(User::class, 'selected_worker_id');
}

public function applications()
{
    return $this->hasMany(Application::class);
}

public function review()
{
    return $this->hasOne(Review::class);
}
```

### `Application`

```php
public function job()
{
    return $this->belongsTo(Job::class);
}

public function worker()
{
    return $this->belongsTo(User::class, 'worker_id');
}
```

### `Review`

```php
public function job()
{
    return $this->belongsTo(Job::class);
}

public function hirer()
{
    return $this->belongsTo(User::class, 'hirer_id');
}

public function worker()
{
    return $this->belongsTo(User::class, 'worker_id');
}
```

---

## 12. Recommended Migration Order

Create or modify migrations in this order:

1. `users`
2. `worker_profiles`
3. `jobs`
4. `applications`
5. `reviews`

Reason:

- `worker_profiles` depends on `users`
- `jobs` depends on `users`
- `applications` depends on `jobs` and `users`
- `reviews` depends on `jobs` and `users`

---

## 13. Data Integrity Rules

The application must enforce the following through both database constraints and Laravel validation/authorization where appropriate:

- Unique user email
- One Worker Profile per Worker
- One Application per Worker per Job
- One Review per Job
- Valid roles only
- Valid account statuses only
- Valid job statuses only
- Valid review rating from 1 to 5
- Job selection only from existing applicants
- Reviews only for completed jobs
- Review Worker must match selected Worker
- Review Hirer must match job owner
- No negative budget, offered price, or expected rate
- No unauthorized ownership changes
- No invalid status transitions

---

## 14. Admin Reporting Queries

The Admin Dashboard requires the following database statistics.

### User Totals

- Total users
- Total Hirers
- Total Workers
- Total Admins
- Active users
- Blocked users

Example logic:

```php
User::count();
User::where('role', 'hirer')->count();
User::where('role', 'worker')->count();
User::where('role', 'admin')->count();
User::where('status', 'active')->count();
User::where('status', 'blocked')->count();
```

### Worker Category Totals

Group users by Worker Profile category:

```php
WorkerProfile::query()
    ->select('category')
    ->selectRaw('COUNT(*) as total')
    ->groupBy('category')
    ->orderByDesc('total')
    ->get();
```

### Job Totals

- Total jobs
- Open jobs
- Assigned jobs
- Completed jobs

### Activity Totals

- Total applications
- Total reviews

---

## 15. Worker Rating Queries

Average rating:

```php
$worker->receivedReviews()->avg('rating');
```

Review count:

```php
$worker->receivedReviews()->count();
```

Recommended optimized loading:

```php
User::query()
    ->where('role', 'worker')
    ->withCount('receivedReviews')
    ->withAvg('receivedReviews', 'rating')
    ->get();
```

Do not store manually editable average-rating values in `users` or `worker_profiles`.

---

## 16. Seeder Requirements

The project should eventually include:

- One Admin account
- Sample Hirer accounts
- Sample Worker accounts
- Worker Profiles across several categories
- Sample Open, Assigned, and Completed Jobs
- Sample Applications
- Sample Reviews for Completed Jobs

Seeder passwords must be hashed.

Production credentials must never be hard-coded into public source control.

---

## 17. Security Considerations

- Never expose password hashes.
- Do not show private account details beyond the intended marketplace flow.
- WhatsApp contact and address display must follow the application's access rules.
- Use CSRF protection for all state-changing Blade forms.
- Use Laravel authorization for ownership and role checks.
- Validate all foreign IDs against current authenticated-user permissions.
- Do not trust hidden form inputs for ownership, role, status, rating, or selected Worker.
- Use transactions for Worker selection and other multi-step state changes where appropriate.

---

## 18. Scope Restrictions

Do not add additional business tables for:

- payments
- chat
- notifications
- subscriptions
- KYC
- GPS/maps
- real-time tracking
- additional user roles

New domain tables must not be introduced unless the project specification is intentionally updated.
