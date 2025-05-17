<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Default SMTP settings for Gmail
        $smtpSettings = [
            [
                'key' => 'mail_mailer',
                'value' => 'smtp',
                'group' => 'smtp',
                'description' => 'Mail driver (smtp, sendmail, mailgun, etc)'
            ],
            [
                'key' => 'mail_host',
                'value' => 'smtp.gmail.com',
                'group' => 'smtp',
                'description' => 'SMTP host address'
            ],
            [
                'key' => 'mail_port',
                'value' => '587',
                'group' => 'smtp',
                'description' => 'SMTP port'
            ],
            [
                'key' => 'mail_username',
                'value' => '',
                'group' => 'smtp',
                'description' => 'SMTP username/email'
            ],
            [
                'key' => 'mail_password',
                'value' => '',
                'group' => 'smtp',
                'description' => 'SMTP password/app password'
            ],
            [
                'key' => 'mail_encryption',
                'value' => 'tls',
                'group' => 'smtp',
                'description' => 'SMTP encryption (tls, ssl, null)'
            ],
            [
                'key' => 'mail_from_address',
                'value' => 'noreply@usbypkp.test',
                'group' => 'smtp',
                'description' => 'Default from email address'
            ],
            [
                'key' => 'mail_from_name',
                'value' => 'USBYPKP',
                'group' => 'smtp',
                'description' => 'Default from name'
            ]
        ];

        foreach ($smtpSettings as $setting) {
            Setting::updateOrCreate(
                ['key' => $setting['key']],
                $setting
            );
        }
    }
}
