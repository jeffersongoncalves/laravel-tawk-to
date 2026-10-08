## Laravel Tawk.to

### Overview
Renders the Tawk.to script in Blade layouts. The settings are stored in the database with `spatie/laravel-settings` (`TawkToSettings`, group `tawk_to`) — no config file, no `.env`.

### Usage

@verbatim
<code-snippet name="blade-include" lang="blade">
@include('tawk-to::script')
</code-snippet>
@endverbatim

@verbatim
<code-snippet name="configure" lang="php">
$settings = tawk_to_settings();
$settings->property_id = '0123456789abcdef01234567';
$settings->widget_id = 'default';
$settings->save();
</code-snippet>
@endverbatim

### Conventions
- Namespace: `JeffersonGoncalves\TawkTo`; view namespace `tawk-to` (`tawk-to::script`)
- The script renders only when `TawkToSettings::shouldRender()` is true
- Publish migrations with `php artisan vendor:publish --tag=tawk-to-settings-migrations`
