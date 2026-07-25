# KormoShala Changelog

All notable project scope, architecture, and implementation changes should be recorded here.

## [Unreleased]

### Added

- Laravel 13 project foundation
- Blade + Tailwind CSS + MySQL architecture
- Git and GitHub repository configuration
- Three-feature-branch workflow
- Claude Code development workflow
- Project specification documentation
- WhatsApp contact information for Hirers and Workers
- Address information for Hirers and Workers
- Worker category-wise statistics for the Admin Dashboard
- Ratings and reviews system requirement
- Professional responsive UI/UX design requirements
- Development plan and progress-tracking documents
- Database specification document (`docs/DATABASE.md`)

### Changed

- Replaced the original React + Laravel REST API architecture with a single Laravel + Blade application
- Expanded the original four business tables to five by adding `reviews`
- Expanded the Admin Dashboard requirements
- Expanded Worker profile and applicant information with contact, address, rating, and review data
- Updated Claude instructions to permit ratings/reviews while continuing to prohibit out-of-scope features
- Merged the finalized project documentation into `main`

### Removed

- React frontend requirement
- Separate Laravel REST API frontend architecture
- Ratings/reviews from the restricted-feature list

## Initial Project Setup

### Added

- Initial Laravel 13 project
- Initial Git commit
- GitHub remote repository
- `main` branch
- `feature/core-marketplace`
- `feature/admin-panel`
- `feature/ui-testing`
- `CLAUDE.md`
- `docs/PROJECT_SPEC.md`
