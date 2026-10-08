<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('tawk_to.property_id', null);
        $this->migrator->add('tawk_to.widget_id', 'default');
        $this->migrator->add('tawk_to.identify_users', false);
        $this->migrator->add('tawk_to.only_when_open', false);
    }
};
