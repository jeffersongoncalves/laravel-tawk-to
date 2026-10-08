<?php

namespace JeffersonGoncalves\TawkTo\Facades;

use Illuminate\Support\Facades\Facade;
use JeffersonGoncalves\TawkTo\Settings\TawkToSettings;

/**
 * @property ?string $property_id
 * @property string $widget_id
 * @property bool $identify_users
 * @property bool $only_when_open
 *
 * @see TawkToSettings
 */
class TawkTo extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return TawkToSettings::class;
    }
}
