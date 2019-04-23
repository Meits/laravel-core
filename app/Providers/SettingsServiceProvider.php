<?php

namespace App\Providers;

use App\Models\Setting;
use Illuminate\Support\ServiceProvider;

class SettingsServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot(Setting $setting)
    {

        /** @var Array $settings */
        $settings = Setting::all()->map(function ($ref) {
            return [$ref->field => $ref->value];
        })->collapse();

        // Set config settings
        config()->set('mail', array_merge(config('mail'), [
            'driver' => 'smtp',
            'host' => $settings['system_host'],
            "port" => $settings['system_email_port'],
            "encryption" => $settings['system_email_encryption'],
            "username" => $settings['system_email_username'],
            "password" => $settings['system_email_password'],
            'from' => [
                'address' => $settings['system_email'],
                'name' => $settings['system_email_name']
            ]
        ]));

    }
}
