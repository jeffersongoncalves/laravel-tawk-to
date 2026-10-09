# Changelog

All notable changes to `laravel-tawk-to` will be documented in this file.

## 1.1.0 - 2026-10-09

- Every `<script>` rendered by the package carries Laravel's Vite CSP nonce when the app sets one (e.g. via laravel-security-headers), so nonce-based `script-src` policies work without `'unsafe-inline'`.

## 1.0.0 - 2026-10-08

First release.

- `@include('tawk-to::script')` renders the Tawk.to chat widget once the settings are complete
- `TawkToSettings` stored with spatie/laravel-settings, validated before rendering
- `identify_users`: sends the signed-in user's name and email to the chat
- `only_when_open`: hides the chat outside the jeffersongoncalves/laravel-open-hours schedule
- `TawkTo` facade and `tawk_to_settings()` helper

Requires PHP 8.2+ and Laravel 12.61+ or 13.
