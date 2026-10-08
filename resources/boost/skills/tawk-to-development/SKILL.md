---
name: tawk-to-development
description: Add Tawk.to to a Laravel app with jeffersongoncalves/laravel-tawk-to — Blade include, settings stored in the database via spatie/laravel-settings.
---

# Laravel Tawk.to Development

## When to use this skill

- Adding Tawk.to to a Laravel / Blade app
- Changing the Tawk.to settings at runtime (admin panel, seeder, tinker)
- Debugging why the Tawk.to script doesn't show up

## Setup

```bash
composer require jeffersongoncalves/laravel-tawk-to
php artisan vendor:publish --tag=tawk-to-settings-migrations
php artisan migrate
```

```blade
@include('tawk-to::script')
```

```php
$settings = tawk_to_settings();
$settings->property_id = '0123456789abcdef01234567';
$settings->widget_id = 'default';
$settings->save();
```

## Settings

| Setting | Type | Default |
|---------|------|---------|
| `property_id` | `?string` | `null` |
| `widget_id` | `string` | `'default'` |
| `identify_users` | `bool` | `false` |
| `only_when_open` | `bool` | `false` |

## Troubleshooting

- **No script in the HTML**: the settings are incomplete or invalid — check `tawk_to_settings()->isConfigured()`.
- **Settings not found**: run the settings migration (`php artisan migrate` after publishing).
- **Filament panel**: use `jeffersongoncalves/filament-tawk-to`, which injects the same view into panels and adds a settings page.
