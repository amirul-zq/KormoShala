# KormoShala Project Specification

## 1. Project Context

KormoShala is a responsive web-based marketplace connecting people who need short-term local work completed with skilled or unskilled workers available to perform those tasks.

The platform focuses on temporary and task-based work rather than permanent employment.

Example work categories include:

- Electrical
- Plumbing
- Cleaning
- Painting
- Carpentry
- Furniture moving
- Loading and unloading
- Gardening
- Event assistance
- General temporary labour

The marketplace workflow is:

Hirer posts job
-> Workers browse jobs
-> Worker applies with price offer
-> Hirer reviews applicants
-> Hirer selects one Worker
-> Job becomes Assigned
-> Hirer marks completed work as Completed


## 2. User Roles

### Hirer

Can:

- Register
- Login/logout
- Create jobs
- View own jobs
- View job details
- View applicants
- Compare applications
- Select one Worker
- View job statuses
- Mark assigned jobs Completed

### Worker

Can:

- Register
- Login/logout
- Create Worker profile
- Update Worker profile
- Browse Open jobs
- View job details
- Apply to jobs
- Submit offered price
- Submit application message
- View own applications
- View assigned jobs

### Admin

Admin uses a dedicated Admin Panel.

Can:

- Login
- View system statistics
- View users
- View user details
- Block users
- Unblock users
- View jobs
- Filter jobs
- View job details
- Remove inappropriate jobs
- View applications
- View ratings and reviews


## 3. Authentication and User Account Information

Public users can register as:

- hirer
- worker

Registration/account information includes:

- name
- email
- password
- role
- WhatsApp contact number
- address

Admin accounts must not be created through normal public registration.

Users can login and logout.

Protected functionality requires authentication.

Blocked users must not be allowed to use normal protected platform functionality.

WhatsApp contact information and address details must be available for both Hirers and Workers.

The WhatsApp contact number is used as the primary contact information between marketplace users after appropriate marketplace interaction.

Sensitive account information such as passwords must never be displayed to other users.


## 4. Users

The users table stores common account information for Hirers, Workers, and Admins.

Required fields:

- id
- name
- email
- password
- whatsapp_number
- address
- role
- status
- created_at
- updated_at

Allowed roles:

- hirer
- worker
- admin

Allowed statuses:

- active
- blocked

Default status:

active

### Contact Information

Both Hirers and Workers must have:

- WhatsApp contact number
- Address

The WhatsApp number must be validated as a reasonable phone-number format.

The address field stores the user's general address/location details.

Worker work area remains separately stored in the Worker Profile because a Worker's service area may differ from their personal address.


## 5. Worker Profiles

Each Worker can have one Worker Profile.

Fields:

- id
- user_id
- category
- area
- description
- expected_rate
- created_at
- updated_at

Profile information displayed to relevant users includes:

- Worker name
- Skill/category
- Service area
- Short description
- Expected rate
- WhatsApp contact number
- Address
- Average rating
- Total number of reviews

Name, WhatsApp number, and address come from the related users record.

Worker category, service area, description, and expected rate come from worker_profiles.


## 6. Jobs

Hirers create jobs.

Required fields:

- id
- hirer_id
- title
- category
- description
- area
- work_date
- budget
- status
- selected_worker_id
- created_at
- updated_at

selected_worker_id is nullable.

Allowed statuses:

- open
- assigned
- completed

New jobs receive:

open

Only the Hirer who owns a job can manage that job.

A Hirer can have multiple jobs.


## 7. Hirer Job List

The Hirer can view jobs they created.

Display:

- title
- category
- work date
- budget
- applicant count
- status


## 8. Worker Job Feed

Workers can browse jobs where:

status = open

Job cards display:

- title
- category
- area
- work date
- budget
- status

Workers can open individual job details.


## 9. Job Details

Display:

- job title
- category
- description
- area
- required date
- budget
- status

Eligible Workers can apply from this page.


## 10. Applications

Applications fields:

- id
- job_id
- worker_id
- offered_price
- message
- created_at
- updated_at

Workers may apply only to Open jobs.

Application submission contains:

- proposed/offered price
- short message

A Worker cannot submit more than one application to the same job.


## 11. Worker My Applications

Workers can view submitted applications.

Display:

- job title
- offered price
- job status
- application message


## 12. Applicant Management

The Hirer who owns the job can view applicants.

Display:

- Worker name
- Worker skill/category
- Worker service area
- Average Worker rating
- Total Worker reviews
- Offered price
- Application message

The Hirer can open the Worker's profile before making a selection.

The Worker profile may display:

- Name
- Category
- Service area
- Description
- Expected rate
- WhatsApp contact
- Address
- Average rating
- Review count
- Previous reviews



## 13. Worker Selection

A Hirer selects exactly one applicant.

The selected Worker must have submitted an application for that job.

After selection:

job.status = assigned

and:

job.selected_worker_id = selected Worker user ID

Selection must not be allowed after the job is no longer Open.


## 14. Completion

Only the Hirer who owns an Assigned job may mark it Completed.

Lifecycle:

open -> assigned -> completed

The lifecycle must not move backwards.

## 15. Ratings and Reviews

After a job reaches:

completed

the Hirer who created the job may submit a rating and review for the Worker who was selected for that job.

Only the Hirer who owns the completed job can create the review.

Only the selected Worker can receive the review.

A job can receive only one Worker review.

A review contains:

- rating
- written review

Rating values are:

1 to 5

where:

- 1 = Very Poor
- 2 = Poor
- 3 = Average
- 4 = Good
- 5 = Excellent

Written review text is optional but should be supported.

A review cannot be submitted before the job is Completed.

A Worker cannot review themselves.

A Hirer cannot review a Worker who was not selected for that job.

Worker profile/job applicant displays may show:

- Average rating
- Total reviews

Example:

Average Rating: 4.6 / 5
Reviews: 12

The average rating should be calculated from existing reviews rather than manually entered by a Worker.

### Reviews Table

Required fields:

- id
- job_id
- hirer_id
- worker_id
- rating
- review
- created_at
- updated_at

Relationships:

Review:
- belongs to Job
- belongs to Hirer
- belongs to Worker

Each Job can have at most one Worker review.

Each Worker can receive many reviews from completed jobs.

## 16. Hirer Dashboard

Provide access/statistics for:

- Create Job
- My Jobs
- applicant counts
- Open jobs
- Assigned jobs
- Completed jobs


## 17. Worker Dashboard

Provide access to:

- Available Jobs
- My Applications
- Assigned Jobs
- Worker Profile


## 18. Admin Dashboard

The Admin Dashboard provides an overview of platform activity.

Display:

- Total users
- Total Hirers
- Total Workers
- Total Admins
- Active users
- Blocked users
- Total jobs
- Open jobs
- Assigned jobs
- Completed jobs
- Total applications
- Total reviews

### Worker Category Statistics

The Admin Dashboard must also show Worker counts grouped by skill/category.

Example:

- Electricians: 24
- Plumbers: 18
- Cleaners: 31
- Painters: 12
- Carpenters: 9
- General Labour: 27

Category statistics should be generated from worker_profiles.category.

The dashboard should present important statistics using clear cards and simple visual grouping.


## 19. Admin User Management

Admin can view registered users.

Display:

- name
- email
- WhatsApp contact
- address
- role
- Worker category when applicable
- account status
- registration date

Actions:

- View user
- Block user
- Unblock user

Admin should be able to filter or identify users according to:

- Hirer
- Worker
- Admin
- Active
- Blocked

Workers should also be identifiable according to their Worker category.


## 20. Admin Job Management

Display:

- job title
- Hirer
- category
- area
- budget
- status
- created date

Actions:

- View job
- Remove inappropriate job

Filters:

- Open
- Assigned
- Completed


## 21. Admin Application Management

Display:

- Job
- Worker
- Offered price
- Application message
- Application date

## Admin Review Monitoring

Admin can view ratings and reviews submitted through completed jobs.

Display:

- Job
- Hirer
- Worker
- Rating
- Review
- Review date

This allows the Admin to monitor marketplace review activity.

## Database Relationships

### User

A User:

- may have one WorkerProfile when role = worker
- may have many Jobs as Hirer
- may have many Applications as Worker
- may write many Reviews as Hirer
- may receive many Reviews as Worker

### WorkerProfile

- belongs to User

### Job

- belongs to Hirer
- has many Applications
- may belong to one selected Worker
- may have one Review after completion

### Application

- belongs to Job
- belongs to Worker

### Review

- belongs to Job
- belongs to Hirer
- belongs to Worker


## 22. Authorization Requirements

Server-side authorization is mandatory.

A Hirer must not access Worker/Admin operations.

A Worker must not access Hirer/Admin operations.

Only job owners can manage their jobs.

Workers can manage only their own Worker profile and applications.

Admins can access Admin functionality.

Blocked users cannot continue normal protected platform operations.


## 23. UI/UX Design System

KormoShala must have a clean, modern, professional, and trustworthy marketplace interface.

The interface must be easy to understand for users with different levels of technical experience.

The same visual design language must be maintained throughout public pages, Hirer pages, Worker pages, and the Admin Panel.

### Design Principles

The UI must be:

- Professional
- Modern
- Clean
- Visually consistent
- Easy to navigate
- Mobile responsive
- Desktop responsive
- Accessible
- Comfortable for long viewing
- Focused on important information
- Interactive without unnecessary animation

Avoid overcrowded screens, excessive colours, excessive shadows, and unnecessary decorative elements.

### Colour System

Use a calm professional colour palette.

Primary:

- Emerald / Green

Use primarily for:

- Main buttons
- Active navigation
- Important positive actions
- Brand elements

Recommended Tailwind range:

- emerald-600
- emerald-700

Primary backgrounds should generally remain light rather than filling entire pages with strong green.

Neutral colours:

- slate-50 for page backgrounds
- white for cards
- slate-100 / slate-200 for borders and secondary surfaces
- slate-600 for secondary text
- slate-900 for primary text

Information:

- sky/blue tones

Warning:

- amber tones

Danger/destructive actions:

- red/rose tones

Success:

- emerald/green tones

Important information may use stronger contrast, badges, icons, font weight, or carefully selected accent colours.

Do not highlight everything. Visual emphasis must indicate information hierarchy.

### Typography

Typography must be:

- highly readable
- consistent
- professionally sized
- responsive

Use clear hierarchy for:

- page titles
- section headings
- card headings
- body text
- labels
- helper text

Important values such as:

- price
- offered price
- job status
- rating
- applicant count
- dashboard totals

should have stronger visual emphasis.

### Layout

Desktop pages should use a centered content container with appropriate spacing.

Use:

- cards
- structured grids
- consistent spacing
- clear sections
- responsive tables where appropriate

Dashboard pages may use a sidebar on larger screens.

Mobile dashboards should use a responsive navigation pattern rather than forcing the desktop sidebar into a narrow screen.

### Navigation

Navigation must clearly adapt to the logged-in role.

Hirer navigation should prioritize:

- Dashboard
- Create Job
- My Jobs

Worker navigation should prioritize:

- Dashboard
- Available Jobs
- My Applications
- Assigned Jobs
- Profile

Admin navigation should prioritize:

- Dashboard
- Users
- Jobs
- Applications
- Reviews

Users should always understand:

- where they currently are
- what actions are available
- how to return to their dashboard

### Job Cards

Job cards should clearly emphasize:

- Job title
- Category
- Area
- Work date
- Budget
- Status

The primary action such as View Details must be clearly visible.

### Applicant Cards

Applicant information should be easy to compare.

Highlight:

- Worker name
- Skill
- Rating
- Review count
- Offered price
- Area

The Select Worker action must be clearly distinguishable from secondary actions.

### Status Badges

Use consistent status badges.

Open:
- positive/available visual treatment

Assigned:
- informational visual treatment

Completed:
- success/completed visual treatment

Blocked:
- danger visual treatment

### Forms

Forms must have:

- visible labels
- understandable placeholder/help text when needed
- clear validation messages
- adequate input spacing
- obvious primary submit button

Validation errors must be visually connected to the corresponding field.

### Feedback

Actions should provide clear feedback.

Examples:

- Job created successfully
- Application submitted
- Worker selected
- Job marked completed
- Review submitted
- Account blocked

Errors must explain what went wrong without exposing technical details.

### Empty States

Provide useful empty states rather than blank pages.

Examples:

- No jobs posted yet
- No applications received
- No available jobs
- No reviews yet

Where appropriate, include a relevant action button.

### Responsive Behaviour

The application must work correctly on:

- desktop
- laptop
- tablet
- mobile

On smaller screens:

- grids collapse naturally
- tables may become responsive cards or scroll safely
- navigation adapts
- buttons remain easy to tap
- forms use available width
- text must not overflow
- important actions remain visible

### Interaction

Use subtle interactive states:

- hover
- focus
- active
- disabled

Transitions should be short and professional.

Avoid unnecessary animation.

### Accessibility

Maintain good text/background contrast.

Interactive elements must have visible focus states.

Buttons and links must be visually distinguishable.

Do not communicate important status using colour alone; use text labels or icons together with colour.

### Consistency

Reuse shared Blade components where appropriate for:

- buttons
- badges
- form inputs
- alerts
- cards
- navigation
- pagination
- empty states

Do not create visually different versions of the same UI element without a reason.


## 24. Project Scope

The implementation includes:

- Authentication
- Hirer accounts
- Worker accounts
- WhatsApp contact information
- Address information
- Worker profiles
- Job posting
- Job browsing
- Job applications
- Price offers
- Applicant management
- Worker selection
- Job assignment
- Job completion
- Ratings and reviews
- Hirer dashboard
- Worker dashboard
- Admin dashboard
- User management
- Worker category statistics
- Job management
- Application monitoring
- Review monitoring
- Responsive professional UI/UX

Do not introduce additional marketplace functionality beyond this specification unless explicitly requested.