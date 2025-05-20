<?php

namespace App\Providers;

use App\Models\Setting;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Config;

class MailConfigServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        try {
            // Get mail settings from database
            $settings = Setting::where('group', 'smtp')->get()->keyBy('key');

            if ($settings->isNotEmpty()) {
                // Override mail configuration
                Config::set('mail.default', $settings['mail_mailer']->value);
                Config::set('mail.mailers.smtp.host', $settings['mail_host']->value);
                Config::set('mail.mailers.smtp.port', $settings['mail_port']->value);
                Config::set('mail.mailers.smtp.username', $settings['mail_username']->value);
                Config::set('mail.mailers.smtp.password', $settings['mail_password']->value);
                Config::set('mail.mailers.smtp.encryption', $settings['mail_encryption']->value);
                Config::set('mail.from.address', $settings['mail_from_address']->value);
                Config::set('mail.from.name', $settings['mail_from_name']->value);
            }
        } catch (\Exception $e) {
            // Log error but don't throw exception
            \Illuminate\Support\Facades\Log::error("Failed to load mail settings from database: " . $e->getMessage());
        }
    }
}
