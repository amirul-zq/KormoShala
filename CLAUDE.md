# KormoShala

KormoShala is a local short-term Worker marketplace for Bangladesh.

## Stack

- Laravel 13
- Blade
- Tailwind CSS
- MySQL
- Git/GitHub

Use server-rendered Laravel Blade.

Do not introduce React, Vue, Livewire, Inertia, or a separate frontend/API architecture.

## Roles

Exactly three roles:

- hirer
- worker
- admin

## Core Business Tables

- users
- worker_profiles
- jobs
- applications
- reviews

Laravel/framework infrastructure tables are allowed where required.

## Important Domain Rules

Job lifecycle:

open -> assigned -> completed

Users contain common contact information:

- WhatsApp number
- address

Workers additionally have Worker Profiles.

A completed Job may receive one Hirer-to-Worker review.

Ratings are 1-5.

Worker average rating must be derived from reviews.

## Project Specification

Complete requirements:

docs/PROJECT_SPEC.md

Read only sections relevant to the current implementation task unless explicitly instructed to read the complete specification.

## Project Documentation

Use only the document relevant to the current task:

- `docs/PROJECT_SPEC.md` — features, workflows, and UI/UX requirements
- `docs/DATABASE.md` — tables, columns, relationships, and database rules
- `docs/DEVELOPMENT_PLAN.md` — implementation sequence
- `docs/PROGRESS.md` — completed work and next task
- `docs/CHANGELOG.md` — major completed changes

Do not reread all documentation for every task.
## UI

Use Blade + Tailwind.

The interface must be:

- professional
- attractive
- responsive
- mobile friendly
- easy to navigate
- visually consistent
- accessible

Follow the colour, layout, component, responsive, and interaction rules defined in the UI/UX section of PROJECT_SPEC.md.

Important information must have clear visual hierarchy.


## Development Rules

- Implement only requested/specification features.
- Do not expand scope.
- Inspect relevant files before editing.
- Follow Laravel conventions.
- Prefer simple Laravel solutions.
- Enforce validation and authorization server-side.
- Never trust IDs, roles, ownership, prices, ratings, or statuses submitted by forms.
- Reuse Blade components where useful.
- Avoid unnecessary packages and abstraction.
- Do not commit or push unless explicitly instructed.

## Restricted Features

Do not add:

- payments
- chat
- notifications
- KYC
- maps
- GPS
- subscriptions
- real-time functionality
- additional user roles

## Verification

After implementation:

1. Run relevant tests/checks.
2. Fix implementation errors.
3. Report files changed.
4. Report checks/tests performed.
5. Report remaining issues.

Never claim functionality works without verification.