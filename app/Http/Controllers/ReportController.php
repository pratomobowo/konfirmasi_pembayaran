<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    /**
     * Display the reports dashboard.
     */
    public function index()
    {
        // Get summary data for dashboard
        $totalPayments = Payment::count();
        $verifiedPayments = Payment::where('status', 'verified')->count();
        $pendingPayments = Payment::where('status', 'pending')->count();
        $rejectedPayments = Payment::where('status', 'rejected')->count();
        
        // Calculate total amount
        $totalAmount = Payment::where('status', 'verified')->sum('amount');
        
        // Get recent payments for quick view
        $recentPayments = Payment::latest()->take(5)->get();
        
        return view('admin.reports.index', compact(
            'totalPayments', 
            'verifiedPayments', 
            'pendingPayments', 
            'rejectedPayments',
            'totalAmount',
            'recentPayments'
        ));
    }
    
    /**
     * Display daily payment report.
     */
    public function daily(Request $request)
    {
        // Get the selected date or default to today
        $selectedDate = $request->date ? $request->date : Carbon::today()->format('Y-m-d');
        $date = Carbon::parse($selectedDate);
        
        // Get payments for selected date
        $payments = Payment::whereDate('created_at', $date)
            ->orderBy('created_at')
            ->paginate(20);
            
        // Calculate statistics
        $totalPayments = Payment::whereDate('created_at', $date)->count();
        $verifiedPayments = Payment::whereDate('created_at', $date)->where('status', 'verified')->count();
        $totalAmount = Payment::whereDate('created_at', $date)->where('status', 'verified')->sum('amount');
        
        return view('admin.reports.daily', compact(
            'payments', 
            'selectedDate', 
            'totalAmount', 
            'totalPayments',
            'verifiedPayments'
        ));
    }
    
    /**
     * Display monthly payment report.
     */
    public function monthly(Request $request)
    {
        // Get the selected month or default to current month
        $selectedMonth = $request->month ? $request->month : Carbon::today()->format('Y-m');
        $month = Carbon::parse($selectedMonth . '-01');
        
        // Get payments for the month
        $payments = Payment::whereYear('created_at', $month->year)
            ->whereMonth('created_at', $month->month)
            ->orderBy('created_at')
            ->paginate(20);
            
        // Calculate statistics
        $totalPayments = Payment::whereYear('created_at', $month->year)
            ->whereMonth('created_at', $month->month)
            ->count();
        $verifiedPayments = Payment::whereYear('created_at', $month->year)
            ->whereMonth('created_at', $month->month)
            ->where('status', 'verified')
            ->count();
        $totalAmount = Payment::whereYear('created_at', $month->year)
            ->whereMonth('created_at', $month->month)
            ->where('status', 'verified')
            ->sum('amount');
        
        // Get daily breakdown - using MySQL compatible functions
        $dailyBreakdown = DB::table('payments')
            ->select(
                DB::raw('DATE(created_at) as date'),
                DB::raw('COUNT(*) as total_payments'),
                DB::raw("SUM(CASE WHEN status = 'verified' THEN 1 ELSE 0 END) as verified_payments"),
                DB::raw("SUM(CASE WHEN status = 'pending' THEN 1 ELSE 0 END) as pending_payments"),
                DB::raw("SUM(CASE WHEN status = 'rejected' THEN 1 ELSE 0 END) as rejected_payments"),
                DB::raw("SUM(CASE WHEN status = 'verified' THEN amount ELSE 0 END) as total_amount")
            )
            ->whereYear('created_at', $month->year)
            ->whereMonth('created_at', $month->month)
            ->groupBy(DB::raw('DATE(created_at)'))
            ->orderBy('date')
            ->get();
        
        return view('admin.reports.monthly', compact(
            'payments', 
            'selectedMonth', 
            'totalAmount', 
            'totalPayments',
            'verifiedPayments',
            'dailyBreakdown'
        ));
    }
    
    /**
     * Display yearly payment report.
     */
    public function yearly(Request $request)
    {
        // Get the selected year or default to current year
        $selectedYear = $request->year ? intval($request->year) : Carbon::today()->year;
        
        // Get payments for the year
        $payments = Payment::whereYear('created_at', $selectedYear)
            ->orderBy('created_at')
            ->paginate(20);
            
        // Calculate statistics
        $totalPayments = Payment::whereYear('created_at', $selectedYear)->count();
        $verifiedPayments = Payment::whereYear('created_at', $selectedYear)->where('status', 'verified')->count();
        $pendingPayments = Payment::whereYear('created_at', $selectedYear)->where('status', 'pending')->count();
        $rejectedPayments = Payment::whereYear('created_at', $selectedYear)->where('status', 'rejected')->count();
        $totalAmount = Payment::whereYear('created_at', $selectedYear)->where('status', 'verified')->sum('amount');
        
        // Status data for pie chart
        $statusData = [
            'verified' => $verifiedPayments,
            'pending' => $pendingPayments,
            'rejected' => $rejectedPayments
        ];
        
        // Get monthly breakdown - Using MySQL compatible functions
        $monthlyBreakdown = DB::table('payments')
            ->select(
                DB::raw('MONTH(created_at) as month'),
                DB::raw('COUNT(*) as total_payments'),
                DB::raw("SUM(CASE WHEN status = 'verified' THEN 1 ELSE 0 END) as verified_payments"),
                DB::raw("SUM(CASE WHEN status = 'pending' THEN 1 ELSE 0 END) as pending_payments"),
                DB::raw("SUM(CASE WHEN status = 'rejected' THEN 1 ELSE 0 END) as rejected_payments"),
                DB::raw("SUM(CASE WHEN status = 'verified' THEN amount ELSE 0 END) as total_amount")
            )
            ->whereYear('created_at', $selectedYear)
            ->groupBy(DB::raw('MONTH(created_at)'))
            ->orderBy('month')
            ->get();
            
        // Generate data for chart.js
        $chartData = [
            'labels' => [],
            'verified' => [],
            'pending' => [],
            'rejected' => []
        ];
        
        foreach ($monthlyBreakdown as $data) {
            $monthName = date('F', mktime(0, 0, 0, $data->month, 1));
            $chartData['labels'][] = $monthName;
            $chartData['verified'][] = $data->verified_payments;
            $chartData['pending'][] = $data->pending_payments;
            $chartData['rejected'][] = $data->rejected_payments;
        }
        
        return view('admin.reports.yearly', compact(
            'payments', 
            'selectedYear', 
            'totalAmount', 
            'totalPayments',
            'verifiedPayments',
            'monthlyBreakdown',
            'statusData',
            'chartData'
        ));
    }
    
    /**
     * Generate custom date range report.
     */
    public function custom(Request $request)
    {
        // Default values
        $startDate = $request->start_date ? $request->start_date : Carbon::today()->subDays(30)->format('Y-m-d');
        $endDate = $request->end_date ? $request->end_date : Carbon::today()->format('Y-m-d');
        $dateRangeSelected = false;
        $payments = collect();
        $totalPayments = 0;
        $verifiedPayments = 0;
        $totalAmount = 0;
        
        // If dates are provided
        if ($request->has('start_date') && $request->has('end_date')) {
            // Validate dates
            $request->validate([
                'start_date' => 'required|date',
                'end_date' => 'required|date|after_or_equal:start_date',
            ]);
            
            $startDateObj = Carbon::parse($startDate)->startOfDay();
            $endDateObj = Carbon::parse($endDate)->endOfDay();
            
            // Get payments for the date range
            $payments = Payment::whereBetween('created_at', [$startDateObj, $endDateObj])
                ->orderBy('created_at')
                ->paginate(20);
                
            // Calculate statistics
            $totalPayments = Payment::whereBetween('created_at', [$startDateObj, $endDateObj])->count();
            $verifiedPayments = Payment::whereBetween('created_at', [$startDateObj, $endDateObj])->where('status', 'verified')->count();
            $totalAmount = Payment::whereBetween('created_at', [$startDateObj, $endDateObj])->where('status', 'verified')->sum('amount');
            
            $dateRangeSelected = true;
        }
        
        return view('admin.reports.custom', compact(
            'payments', 
            'startDate', 
            'endDate', 
            'totalAmount', 
            'totalPayments',
            'verifiedPayments',
            'dateRangeSelected'
        ));
    }
    
    /**
     * Export report to Excel/CSV.
     */
    public function export(Request $request)
    {
        // This will be implemented later with a package like Laravel Excel
        return back()->with('info', 'Fitur ekspor laporan akan segera tersedia.');
    }
}
