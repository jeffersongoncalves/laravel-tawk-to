<?php

use JeffersonGoncalves\TawkTo\Settings\TawkToSettings;
use JeffersonGoncalves\TawkTo\Tests\TestCase;

uses(TestCase::class)->in(__DIR__);

/**
 * Saves the given values on top of the stored Tawk.to settings.
 *
 * @param  array<string, mixed>  $values
 */
function tawk_to(array $values): TawkToSettings
{
    $settings = app(TawkToSettings::class);
    foreach ($values as $name => $value) {
        $settings->{$name} = $value;
    }
    $settings->save();

    return $settings;
}
