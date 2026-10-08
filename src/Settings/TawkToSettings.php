<?php

namespace JeffersonGoncalves\TawkTo\Settings;

use JeffersonGoncalves\OpenHours\OpenHours;
use Spatie\LaravelSettings\Settings;

class TawkToSettings extends Settings
{
    /** Tawk.to property id. Empty = no script. */
    public ?string $property_id;

    /** Widget ID from the embed code, usually "default". */
    public string $widget_id;

    /** Send the signed-in user's name and email to the chat. */
    public bool $identify_users;

    /** Render only while laravel-open-hours says the business is open. */
    public bool $only_when_open;

    public static function group(): string
    {
        return 'tawk_to';
    }

    /** Whether the settings are complete enough to render the script. */
    public function isConfigured(): bool
    {
        return preg_match('/^[a-f0-9]{24}$/i', (string) $this->property_id) === 1 && preg_match('/^[a-z0-9]+$/i', $this->widget_id) === 1;
    }

    /** Configured, and — with only_when_open and jeffersongoncalves/laravel-open-hours installed — open right now. */
    public function shouldRender(): bool
    {
        if (! $this->isConfigured()) {
            return false;
        }

        if ($this->only_when_open && class_exists(OpenHours::class)) {
            return app(OpenHours::class)->isOpen();
        }

        return true;
    }
}
