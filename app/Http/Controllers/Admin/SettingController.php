<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Mail;

class SettingController extends Controller
{
    public function index()
    {
        // Get SMTP settings from database
        $smtpSettings = Setting::where('group', 'smtp')->get()->keyBy('key');

        return view('admin.settings.index', compact('smtpSettings'));
    }

    public function updateSmtp(Request $request)
    {
        try {
            $validated = $request->validate([
                'mail_mailer' => 'required|string',
                'mail_host' => 'required|string',
                'mail_port' => 'required|string',
                'mail_username' => 'required|string',
                'mail_password' => 'nullable|string',
                'mail_encryption' => 'required|string',
                'mail_from_address' => 'required|email',
                'mail_from_name' => 'required|string',
            ]);

            // Update each setting in database
            foreach ($validated as $key => $value) {
                if ($key === 'mail_password' && empty($value)) {
                    continue; // Skip empty password
                }
                Setting::setValueByKey($key, $value, 'smtp');
            }

            // Update mail configuration
            config([
                'mail.default' => $validated['mail_mailer'],
                'mail.mailers.smtp.host' => $validated['mail_host'],
                'mail.mailers.smtp.port' => $validated['mail_port'],
                'mail.mailers.smtp.username' => $validated['mail_username'],
                'mail.mailers.smtp.password' => $validated['mail_password'],
                'mail.mailers.smtp.encryption' => $validated['mail_encryption'],
                'mail.from.address' => $validated['mail_from_address'],
                'mail.from.name' => $validated['mail_from_name'],
            ]);

            return redirect()->route('admin.settings.index')
                ->with('success', 'SMTP settings updated successfully.');
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error("Failed to update SMTP settings: " . $e->getMessage());
            return redirect()->route('admin.settings.index')
                ->with('error', 'Failed to update SMTP settings: ' . $e->getMessage());
        }
    }

    public function testSmtp(Request $request)
    {
        $request->validate([
            'test_email' => 'required|email',
        ]);

        try {
            // Get SMTP settings from database
            $settings = Setting::where('group', 'smtp')->get()->keyBy('key');
            
            // Update mail configuration
            config([
                'mail.default' => $settings['mail_mailer']->value,
                'mail.mailers.smtp.host' => $settings['mail_host']->value,
                'mail.mailers.smtp.port' => $settings['mail_port']->value,
                'mail.mailers.smtp.username' => $settings['mail_username']->value,
                'mail.mailers.smtp.password' => $settings['mail_password']->value,
                'mail.mailers.smtp.encryption' => $settings['mail_encryption']->value,
                'mail.from.address' => $settings['mail_from_address']->value,
                'mail.from.name' => $settings['mail_from_name']->value,
            ]);

            Mail::raw('This is a test email from USBYPKP Admin Panel.', function($message) use ($request) {
                $message->to($request->test_email)
                    ->subject('SMTP Test Email');
            });

            return response()->json([
                'success' => true,
                'message' => 'Test email sent successfully.'
            ]);
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error("Failed to send test email: " . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Failed to send test email: ' . $e->getMessage()
            ], 500);
        }
    }
} 