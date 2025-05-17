<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Mail;

class SettingController extends Controller
{
    /**
     * Display the settings page.
     */
    public function index()
    {
        // Only allow super admin to access
        if (auth()->user()->role !== 'super_admin') {
            abort(403, 'Unauthorized action.');
        }

        // Get all SMTP settings
        $smtpSettings = Setting::where('group', 'smtp')->get()->keyBy('key');
        
        return view('admin.settings.index', compact('smtpSettings'));
    }

    /**
     * Update the SMTP settings.
     */
    public function updateSmtp(Request $request)
    {
        // Only allow super admin to access
        if (auth()->user()->role !== 'super_admin') {
            abort(403, 'Unauthorized action.');
        }

        $request->validate([
            'mail_mailer' => 'required|string',
            'mail_host' => 'required|string',
            'mail_port' => 'required|numeric',
            'mail_username' => 'required|email',
            'mail_password' => 'nullable|string',
            'mail_encryption' => 'required|string|in:tls,ssl,null',
            'mail_from_address' => 'required|email',
            'mail_from_name' => 'required|string',
        ]);

        // Update each SMTP setting
        $smtpKeys = [
            'mail_mailer', 'mail_host', 'mail_port', 'mail_username',
            'mail_encryption', 'mail_from_address', 'mail_from_name'
        ];

        foreach ($smtpKeys as $key) {
            Setting::setValueByKey($key, $request->input($key), 'smtp');
        }

        // Only update password if provided
        if ($request->filled('mail_password')) {
            Setting::setValueByKey('mail_password', $request->input('mail_password'), 'smtp');
        }

        // Clear config cache to apply changes
        Artisan::call('config:clear');

        return redirect()->route('admin.settings.index')
            ->with('success', 'Pengaturan SMTP berhasil diperbarui.');
    }

    /**
     * Test the SMTP connection.
     */
    public function testSmtp(Request $request)
    {
        // Only allow super admin to access
        if (auth()->user()->role !== 'super_admin') {
            abort(403, 'Unauthorized action.');
        }

        $request->validate([
            'test_email' => 'required|email',
        ]);

        try {
            $testEmail = $request->input('test_email');
            
            // Get SMTP settings
            $config = [
                'transport' => Setting::getValueByKey('mail_mailer', 'smtp'),
                'host' => Setting::getValueByKey('mail_host', 'smtp.gmail.com'),
                'port' => Setting::getValueByKey('mail_port', '587'),
                'encryption' => Setting::getValueByKey('mail_encryption', 'tls'),
                'username' => Setting::getValueByKey('mail_username', ''),
                'password' => Setting::getValueByKey('mail_password', ''),
                'from' => [
                    'address' => Setting::getValueByKey('mail_from_address', 'noreply@usbypkp.test'),
                    'name' => Setting::getValueByKey('mail_from_name', 'USBYPKP'),
                ],
            ];
            
            // Send test email
            Mail::config($config)->raw('Test email from USBYPKP application.', function($message) use ($testEmail) {
                $message->to($testEmail)
                    ->subject('USBYPKP - Test Email');
            });
            
            return redirect()->route('admin.settings.index')
                ->with('success', 'Email pengujian berhasil dikirim ke ' . $testEmail);
        } catch (\Exception $e) {
            return redirect()->route('admin.settings.index')
                ->with('error', 'Gagal mengirim email pengujian: ' . $e->getMessage());
        }
    }
}
