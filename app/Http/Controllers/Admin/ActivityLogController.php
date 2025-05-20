<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use Illuminate\Http\Request;

class ActivityLogController extends Controller
{
    /**
     * Display a listing of activity logs.
     */
    public function index(Request $request)
    {
        // Only allow admin and super_admin to access
        if (!in_array(auth()->user()->role, ['admin', 'super_admin'])) {
            abort(403, 'Unauthorized action.');
        }

        $query = ActivityLog::query()->with('user');

        // Filter by action
        if ($request->filled('action')) {
            $query->where('action', $request->action);
        }

        // Filter by module
        if ($request->filled('module')) {
            $query->where('module', $request->module);
        }

        // Filter by user
        if ($request->filled('user_id')) {
            $query->where('user_id', $request->user_id);
        }

        // Filter by date range
        if ($request->filled('date_from')) {
            $query->whereDate('created_at', '>=', $request->date_from);
        }

        if ($request->filled('date_to')) {
            $query->whereDate('created_at', '<=', $request->date_to);
        }

        // Get unique values for filters
        $actions = ActivityLog::distinct()->pluck('action');
        $modules = ActivityLog::distinct()->pluck('module');
        
        // Get logs with pagination
        $perPage = $request->input('per_page', 20);
        $logs = $query->orderBy('created_at', 'desc')->paginate($perPage)->withQueryString();

        return view('admin.activity_logs.index', compact('logs', 'actions', 'modules'));
    }

    /**
     * Display the specified activity log.
     */
    public function show(ActivityLog $activityLog)
    {
        // Only allow admin and super_admin to access
        if (!in_array(auth()->user()->role, ['admin', 'super_admin'])) {
            abort(403, 'Unauthorized action.');
        }

        return view('admin.activity_logs.show', compact('activityLog'));
    }

    /**
     * Remove the specified activity log.
     */
    public function destroy(ActivityLog $activityLog)
    {
        // Only allow super_admin to delete logs
        if (auth()->user()->role !== 'super_admin') {
            abort(403, 'Unauthorized action.');
        }

        $activityLog->delete();

        return redirect()->route('admin.activity-logs.index')
            ->with('success', 'Log aktivitas berhasil dihapus.');
    }

    /**
     * Clear all activity logs.
     */
    public function clearAll()
    {
        // Only allow super_admin to clear logs
        if (auth()->user()->role !== 'super_admin') {
            abort(403, 'Unauthorized action.');
        }

        ActivityLog::truncate();

        return redirect()->route('admin.activity-logs.index')
            ->with('success', 'Semua log aktivitas berhasil dihapus.');
    }
}
