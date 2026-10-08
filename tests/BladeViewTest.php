<?php

use Illuminate\Foundation\Auth\User;
use JeffersonGoncalves\OpenHours\OpenHours;

it('renders the Tawk.to script once configured', function () {
    tawk_to(['property_id' => '0123456789abcdef01234567', 'widget_id' => 'default']);

    $this->blade('@include("tawk-to::script")')
        ->assertSee('https://embed.tawk.to/', false)
        ->assertSee('\'0123456789abcdef01234567\'', false);
});

it('renders nothing while it is not configured', function () {
    tawk_to(['property_id' => null]);

    $this->blade('@include("tawk-to::script")')->assertDontSee('embed.tawk.to', false);
});

it('does not render an invalid value into the page', function () {
    tawk_to(['property_id' => 'x\'); alert(1); (\'', 'widget_id' => 'default']);

    $this->blade('@include("tawk-to::script")')
        ->assertDontSee('embed.tawk.to', false)
        ->assertDontSee('alert(1)', false);
});

it('identifies the signed-in user when enabled', function () {
    tawk_to([...['property_id' => '0123456789abcdef01234567', 'widget_id' => 'default'], 'identify_users' => true]);
    $this->actingAs((new User)->forceFill(['id' => 1, 'name' => 'Ada Lovelace', 'email' => 'ada@example.com']));

    $this->blade('@include("tawk-to::script")')
        ->assertSee("'ada@example.com'", false)
        ->assertSee("'Ada Lovelace'", false);
});

it('does not send the user when identification is off', function () {
    tawk_to(['property_id' => '0123456789abcdef01234567', 'widget_id' => 'default']);
    $this->actingAs((new User)->forceFill(['id' => 1, 'name' => 'Ada Lovelace', 'email' => 'ada@example.com']));

    $this->blade('@include("tawk-to::script")')->assertDontSee('ada@example.com', false);
});

it('hides the chat outside opening hours when only_when_open is on', function () {
    tawk_to([...['property_id' => '0123456789abcdef01234567', 'widget_id' => 'default'], 'only_when_open' => true]);
    $this->mock(OpenHours::class, fn ($mock) => $mock->shouldReceive('isOpen')->andReturn(false));

    $this->blade('@include("tawk-to::script")')->assertDontSee('embed.tawk.to', false);
});

it('shows the chat during opening hours when only_when_open is on', function () {
    tawk_to([...['property_id' => '0123456789abcdef01234567', 'widget_id' => 'default'], 'only_when_open' => true]);
    $this->mock(OpenHours::class, fn ($mock) => $mock->shouldReceive('isOpen')->andReturn(true));

    $this->blade('@include("tawk-to::script")')->assertSee('embed.tawk.to', false);
});
