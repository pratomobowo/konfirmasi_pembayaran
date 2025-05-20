<?php

namespace App\Http\Controllers;

use App\Models\EmailTemplate;
use Illuminate\Http\Request;

class EmailTemplateController extends Controller
{
    public function index()
    {
        $templates = EmailTemplate::latest()->paginate(10);
        return view('admin.email_templates.index', compact('templates'));
    }

    public function create()
    {
        return view('admin.email_templates.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'subject' => 'required|string|max:255',
            'body' => 'required|string',
            'trigger_type' => 'required|string|max:50|unique:email_templates,trigger_type',
            'is_active' => 'boolean'
        ]);

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
        $request->validate([
            'name' => 'required|string|max:255',
            'subject' => 'required|string|max:255',
            'body' => 'required|string',
            'trigger_type' => 'required|string|max:50|unique:email_templates,trigger_type,' . $emailTemplate->id,
            'is_active' => 'boolean'
        ]);

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
        $emailTemplate->update([
            'is_active' => !$emailTemplate->is_active
        ]);

        return redirect()->route('admin.email-templates.index')
            ->with('success', 'Status template email berhasil diubah.');
    }
} 