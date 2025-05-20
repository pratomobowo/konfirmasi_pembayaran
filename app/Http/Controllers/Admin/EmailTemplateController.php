<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\EmailTemplate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EmailTemplateController extends Controller
{
    public function index()
    {
        $templates = EmailTemplate::all();
        return view('admin.email_templates.index', compact('templates'));
    }

    public function create()
    {
        return view('admin.email_templates.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'subject' => 'required|string|max:255',
            'body' => 'required|string',
            'trigger_type' => 'required|string|in:payment_uploaded,payment_verified,payment_rejected',
            'variables' => 'nullable|array',
            'is_active' => 'boolean'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        EmailTemplate::create($request->all());

        return redirect()->route('admin.email-templates.index')
            ->with('success', 'Template email berhasil dibuat.');
    }

    public function edit(EmailTemplate $emailTemplate)
    {
        return view('admin.email_templates.edit', compact('emailTemplate'));
    }

    public function update(Request $request, EmailTemplate $emailTemplate)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'subject' => 'required|string|max:255',
            'body' => 'required|string',
            'trigger_type' => 'required|string|in:payment_uploaded,payment_verified,payment_rejected',
            'variables' => 'nullable|array',
            'is_active' => 'boolean'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $emailTemplate->update($request->all());

        return redirect()->route('admin.email-templates.index')
            ->with('success', 'Template email berhasil diperbarui.');
    }

    public function destroy(EmailTemplate $emailTemplate)
    {
        $emailTemplate->delete();

        return redirect()->route('admin.email-templates.index')
            ->with('success', 'Template email berhasil dihapus.');
    }

    public function toggleStatus(EmailTemplate $emailTemplate)
    {
        $emailTemplate->update(['is_active' => !$emailTemplate->is_active]);

        return redirect()->route('admin.email-templates.index')
            ->with('success', 'Status template email berhasil diperbarui.');
    }
}
