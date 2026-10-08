<?php

use JeffersonGoncalves\TawkTo\Settings\TawkToSettings;

if (! function_exists('tawk_to_settings')) {
    function tawk_to_settings(): TawkToSettings
    {
        return app(TawkToSettings::class);
    }
}
