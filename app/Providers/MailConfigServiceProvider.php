<?php

namespace App\Providers;

use App\Models\Setting;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

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
        // Check if the settings table exists
        if (Schema::hasTable('settings')) {
            // Load mail settings from database
            $mail_mailer = Setting::getValueByKey('mail_mailer', 'smtp');
            $mail_host = Setting::getValueByKey('mail_host', 'smtp.gmail.com');
            $mail_port = Setting::getValueByKey('mail_port', '587');
            $mail_username = Setting::getValueByKey('mail_username', '');
            $mail_password = Setting::getValueByKey('mail_password', '');
            $mail_encryption = Setting::getValueByKey('mail_encryption', 'tls');
            $mail_from_address = Setting::getValueByKey('mail_from_address', 'noreply@usbypkp.test');
            $mail_from_name = Setting::getValueByKey('mail_from_name', 'USBYPKP');

            // Check if we have mail settings
            if (!empty($mail_host) && !empty($mail_port)) {
                // Override mail configuration
                Config::set('mail.default', $mail_mailer);
                Config::set('mail.mailers.smtp.host', $mail_host);
                Config::set('mail.mailers.smtp.port', $mail_port);
                Config::set('mail.mailers.smtp.username', $mail_username);
                Config::set('mail.mailers.smtp.password', $mail_password);
                Config::set('mail.mailers.smtp.encryption', $mail_encryption !== 'null' ? $mail_encryption : null);
                Config::set('mail.from.address', $mail_from_address);
                Config::set('mail.from.name', $mail_from_name);
            }
        }
    }
}
