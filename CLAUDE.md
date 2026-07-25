# KormoShala

KormoShala is a local short-term worker marketplace for Bangladesh.

## Stack

- Laravel 13
- Blade
- Tailwind CSS
- MySQL
- Git/GitHub

Use Laravel server-rendered Blade views.
Do not introduce React, Vue, Livewire, Inertia, or a separate REST frontend.

## Roles

Exactly three roles exist:

- hirer
- worker
- admin

## Core Business Tables

The business domain uses:

- users
- worker_profiles
- jobs
- applications

Laravel/framework infrastructure tables are allowed where required.

## Job Lifecycle

open -> assigned -> completed

## Project Specification

Detailed requirements are stored in:

docs/PROJECT_SPEC.md

Read only the relevant sections of that specification for the current task unless explicitly instructed otherwise.

## Development Rules

- Implement only requested features.
- Do not expand project scope.
- Inspect relevant existing files before editing.
- Follow Laravel conventions.
- Use Blade and Tailwind CSS for views.
- Enforce validation and authorization on the server.
- Do not trust IDs, roles, ownership, prices, or statuses sent from forms.
- Do not create unnecessary abstractions or packages.
- Keep implementation simple and maintainable.
- Do not commit or push Git changes unless explicitly instructed.

## Restricted Features

Do not add:

- payments
- chat
- ratings
- reviews
- notifications
- KYC
- maps
- GPS
- subscriptions
- real-time functionality
- additional user roles

## After Every Implementation Task

1. Run relevant tests.
2. Check for errors.
3. Report files changed.
4. Report tests/checks performed.
5. Report remaining issues.

Never claim a feature works without verifying it.