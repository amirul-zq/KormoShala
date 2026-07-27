# KormoShala Development Plan

## 1. Purpose

This document defines the implementation sequence for KormoShala, a Laravel 13 + Blade + Tailwind CSS + MySQL marketplace connecting Hirers with local Workers in Bangladesh.

Development must proceed one controlled step at a time. Each step should be implemented, verified, committed, and pushed before moving to the next step.

## 2. Fixed Technology Stack

- Laravel 13
- Blade
- Tailwind CSS
- MySQL
- Git and GitHub
- Claude Code

Do not introduce React, Vue, Livewire, Inertia, a separate frontend, or an unnecessary REST API architecture.

## 3. Branch Strategy

### `main`
Stable integration branch. No direct feature development.

### `feature/core-marketplace`
Implements the main Hirer and Worker marketplace.

### `feature/admin-panel`
Implements the complete Admin Panel after the core marketplace is merged into `main`.

### `feature/ui-testing`
Implements final UI consistency, responsive behaviour, accessibility, testing, bug fixes, documentation, and final cleanup.

## 4. Implementation Phases

### Phase 1 — Database Foundation

Implement and verify:

- `users` fields: name, email, password, WhatsApp number, address, role, status
- `worker_profiles`
- `jobs`
- `applications`
- `reviews`
- Foreign keys
- Unique constraints
- Job status rules
- Eloquent relationships
- Model fillable/casts where required
- Development seed data where useful

Required checks:

- `php artisan migrate:fresh`
- Migration status
- Relationship tests
- Database constraints

### Phase 2 — Authentication and Access Control

Implement:

- Hirer/Worker registration
- Login and logout
- Public registration role restriction
- Admin account seeding
- Role middleware
- Blocked-user middleware
- Role-based redirects
- Server-side authorisation

Required checks:

- Hirer cannot access Worker/Admin routes
- Worker cannot access Hirer/Admin routes
- Blocked users cannot use protected platform features
- Admin cannot be created from the public registration form

### Phase 3 — Worker Profile

Implement:

- Create profile
- Update profile
- Category
- Service area
- Description
- Expected rate
- Display WhatsApp number and address from the user account
- Average rating and review count display

Required checks:

- Only Workers can manage Worker Profiles
- One profile per Worker
- Users cannot edit another Worker’s profile

### Phase 4 — Hirer Job Management

Implement:

- Create Job
- View My Jobs
- View Job Details
- Applicant count
- Open/Assigned/Completed status display
- Ownership restrictions

Required checks:

- Only Hirers can create jobs
- New jobs are `open`
- Hirers cannot manage another Hirer’s jobs

### Phase 5 — Worker Job Feed

Implement:

- Browse open jobs
- View job cards
- View job details
- Responsive filters only where defined by the specification

Required checks:

- Workers see only open jobs in the available job feed
- Job details display correct information

### Phase 6 — Applications and Price Offers

Implement:

- Submit offered price
- Submit application message
- My Applications
- Duplicate-application prevention
- Application status through related job status

Required checks:

- Only Workers can apply
- Workers can apply only to open jobs
- One application per Worker per Job
- Workers cannot apply to their own Hirer job account context

### Phase 7 — Applicant Management and Worker Selection

Implement:

- Hirer applicant list
- Worker profile details
- WhatsApp contact and address display
- Rating and review summary
- Offered price and application message
- Select one Worker

Required checks:

- Only job owner can view applicants
- Selected Worker must have applied
- Selection is allowed only while Job is open
- Job becomes `assigned`
- `selected_worker_id` is saved correctly

### Phase 8 — Assigned Work and Completion

Implement:

- Hirer Assigned Jobs
- Worker Assigned Jobs
- Mark Assigned Job Completed
- Final lifecycle enforcement

Required checks:

- Only owning Hirer can complete the job
- Only assigned jobs can become completed
- Status cannot move backwards

### Phase 9 — Ratings and Reviews

Implement:

- Hirer review form after completion
- Rating from 1 to 5
- Optional review text
- Worker average rating
- Worker review count
- Worker review list

Required checks:

- Only owning Hirer can review
- Only selected Worker can receive review
- Only completed jobs can be reviewed
- One review per job
- Worker cannot review themselves

### Phase 10 — Hirer Dashboard

Implement:

- Total/open/assigned/completed job summaries
- Applicant totals
- Quick access to Create Job and My Jobs
- Important information hierarchy

### Phase 11 — Worker Dashboard

Implement:

- Available Jobs
- My Applications
- Assigned Jobs
- Worker Profile
- Rating summary

### Phase 12 — Core Marketplace Verification

Before merging `feature/core-marketplace` into `main`:

- Run all tests
- Test complete Hirer/Worker workflow manually
- Check authorisation
- Check validation
- Check database constraints
- Fix regressions
- Update `PROGRESS.md`
- Update `CHANGELOG.md`
- Merge only after a clean working tree

### Phase 13 — Admin Dashboard

On `feature/admin-panel`, after merging latest `main`, implement:

- Total users
- Total Hirers
- Total Workers
- Total Admins
- Active users
- Blocked users
- Total jobs
- Open/Assigned/Completed jobs
- Total applications
- Total reviews
- Worker counts by category

### Phase 14 — Admin User Management

Implement:

- User list
- User details
- WhatsApp number
- Address
- Role/status filters
- Worker category display
- Block/unblock actions

### Phase 15 — Admin Job Management

Implement:

- All jobs list
- Job details
- Status filters
- Remove inappropriate jobs

### Phase 16 — Admin Application and Review Monitoring

Implement:

- Application list/details
- Review list/details
- Relevant marketplace relationship information

### Phase 17 — Admin Verification

Before merging `feature/admin-panel` into `main`:

- Verify all statistics
- Verify all filters
- Verify block/unblock behaviour
- Verify removed jobs behave safely with related records
- Run tests
- Update progress and changelog

### Phase 18 — UI/UX and Responsive Design

On `feature/ui-testing`, after merging latest `main`, implement:

- Shared layout
- Role-based navigation
- Professional emerald/slate palette
- Cards, badges, forms, buttons, alerts, and empty states
- Desktop, tablet, and mobile layouts
- Responsive tables/cards
- Consistent spacing and typography
- Accessible focus states and contrast
- Clear success/error feedback

### Phase 19 — Final Testing and Security Review

Test:

- Registration/login/logout
- Role access
- Blocked accounts
- Worker profile ownership
- Job ownership
- Duplicate applications
- Invalid worker selection
- Status transitions
- Duplicate reviews
- Admin permissions
- Validation messages
- Mobile responsiveness
- Desktop responsiveness

Run:

- `php artisan test`
- `php artisan route:list`
- `php artisan migrate:fresh --seed`
- `npm run build`

### Phase 20 — Final Documentation and Merge

Complete:

- README installation instructions
- Environment setup instructions
- Database creation instructions
- Admin login/seed information
- Feature summary
- Test instructions
- Final progress update
- Final changelog update

Then merge `feature/ui-testing` into `main` and verify the final GitHub repository.

## 5. Standard Task Workflow

For every feature:

1. Confirm the correct branch.
2. Ensure the working tree is clean.
3. Inspect changed files.
4. Run relevant tests.
5. Fix errors.
6. Manually verify the feature.
7. Update `PROGRESS.md` when appropriate.
8. Commit with a clear message.
9. Push the branch.

