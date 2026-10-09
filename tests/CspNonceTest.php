<?php

use Illuminate\Support\Facades\Vite;

it('stamps the CSP nonce on every script tag', function () {
    Vite::useCspNonce('test-nonce');
    tawk_to(['property_id' => '0123456789abcdef01234567', 'widget_id' => 'default']);
    $html = (string) $this->blade('@include("tawk-to::script")');

    preg_match_all('/<script\b[^>]*>/', $html, $tags);

    expect($tags[0])->not->toBeEmpty()->each->toContain('nonce="test-nonce"');
});

it('renders no nonce attribute when the app uses none', function () {
    tawk_to(['property_id' => '0123456789abcdef01234567', 'widget_id' => 'default']);
    $html = (string) $this->blade('@include("tawk-to::script")');

    expect($html)->toContain('<script')->not->toContain('nonce=');
});
