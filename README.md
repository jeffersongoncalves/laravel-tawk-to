<div class="filament-hidden">

![Laravel Tawk.to](https://raw.githubusercontent.com/jeffersongoncalves/laravel-tawk-to/main/art/jeffersongoncalves-laravel-tawk-to.png)

</div>

# Laravel Tawk.to

[![Latest Version on Packagist](https://img.shields.io/packagist/v/jeffersongoncalves/laravel-tawk-to.svg?style=flat-square)](https://packagist.org/packages/jeffersongoncalves/laravel-tawk-to)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/jeffersongoncalves/laravel-tawk-to/fix-php-code-style-issues.yml?branch=main&label=code%20style&style=flat-square)](https://github.com/jeffersongoncalves/laravel-tawk-to/actions?query=workflow%3A"Fix+PHP+code+styling"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/jeffersongoncalves/laravel-tawk-to.svg?style=flat-square)](https://packagist.org/packages/jeffersongoncalves/laravel-tawk-to)

Add [Tawk.to](https://www.tawk.to) — free live chat widget for customer support — to your Laravel app. The settings are stored in the database with [spatie/laravel-settings](https://github.com/spatie/laravel-settings), so you can change them at runtime (e.g. from an admin panel) instead of in `.env`.

For a Filament settings page, use [jeffersongoncalves/filament-tawk-to](https://github.com/jeffersongoncalves/filament-tawk-to).

## Installation

```bash
composer require jeffersongoncalves/laravel-tawk-to
```

Publish and run the settings migration:

```bash
php artisan vendor:publish --tag=tawk-to-settings-migrations
php artisan migrate
```

## Configuration

```php
$settings = tawk_to_settings();
$settings->property_id = '0123456789abcdef01234567';
$settings->widget_id = 'default';
$settings->save();
```

Or through the settings class or the Facade:

```php
use JeffersonGoncalves\TawkTo\Facades\TawkTo;
use JeffersonGoncalves\TawkTo\Settings\TawkToSettings;

$settings = app(TawkToSettings::class);
$value = TawkTo::getFacadeRoot()->property_id;
```

### Available settings

| Setting | Type | Default | Description |
|---------|------|---------|-------------|
| `property_id` | `?string` | `null` | Your Tawk.to property id. The script only renders when it is valid. |
| `widget_id` | `string` | `'default'` | Widget ID from the embed code. |
| `identify_users` | `bool` | `false` | Send the signed-in user's name and email to the chat. |
| `only_when_open` | `bool` | `false` | Hide the chat while [laravel-open-hours](https://github.com/jeffersongoncalves/laravel-open-hours) says you're closed (ignored when it isn't installed). |

### Identify users and opening hours

- `identify_users`: sends the signed-in user's name and email to Tawk.to, so your agents see who they're talking to. Leave it off on pages served from a shared full-page cache.
- `only_when_open`: with [jeffersongoncalves/laravel-open-hours](https://github.com/jeffersongoncalves/laravel-open-hours) installed, the widget is only rendered while you're open.

```bash
composer require jeffersongoncalves/laravel-open-hours
```

## Usage

Add the script to your Blade layout, right before `</body>`:

```blade
@include('tawk-to::script')
```

Nothing is rendered until the settings are complete, so you can ship the include everywhere and turn Tawk.to on later.

## Content Security Policy

When your app sets a CSP nonce through Laravel's Vite (`Vite::useCspNonce()`, as [laravel-security-headers](https://github.com/jeffersongoncalves/laravel-security-headers) does), every `<script>` this package renders carries it, so a `script-src 'self' 'nonce-{nonce}'` policy works without `'unsafe-inline'`. Scripts loaded afterwards from the vendor's own CDN still need that host in `script-src` (and its API in `connect-src`).

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](.github/CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Jefferson Gonçalves](https://github.com/jeffersongoncalves)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
