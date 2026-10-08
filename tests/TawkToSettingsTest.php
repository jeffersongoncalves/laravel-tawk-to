<?php

use JeffersonGoncalves\TawkTo\Facades\TawkTo;
use JeffersonGoncalves\TawkTo\Settings\TawkToSettings;

it('can resolve TawkToSettings from the container', function () {
    expect(app(TawkToSettings::class))->toBeInstanceOf(TawkToSettings::class);
});

it('is not configured by default', function () {
    expect(app(TawkToSettings::class)->isConfigured())->toBeFalse();
});

it('can update and persist settings', function () {
    tawk_to(['property_id' => '0123456789abcdef01234567', 'widget_id' => 'default']);

    expect(app(TawkToSettings::class)->isConfigured())->toBeTrue()
        ->and(app(TawkToSettings::class)->property_id)->toBe('0123456789abcdef01234567')
        ->and(app(TawkToSettings::class)->widget_id)->toBe('default');
});

it('belongs to the tawk_to group', function () {
    expect(TawkToSettings::group())->toBe('tawk_to');
});

it('can be accessed via the helper function', function () {
    expect(tawk_to_settings())->toBeInstanceOf(TawkToSettings::class);
});

it('reads a persisted value through the Facade', function () {
    tawk_to(['property_id' => '0123456789abcdef01234567', 'widget_id' => 'default']);

    expect(TawkTo::getFacadeRoot()->property_id)->toBe('0123456789abcdef01234567');
});
