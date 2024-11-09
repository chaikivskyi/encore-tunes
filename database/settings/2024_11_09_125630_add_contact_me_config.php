<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('contact-me.email', null);
        $this->migrator->add('contact-me.instagram', null);
        $this->migrator->add('contact-me.telegram', null);
    }
};
