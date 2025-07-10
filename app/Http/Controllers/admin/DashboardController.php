<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\CaseManagement;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    // public function dashboard()
    // {
    //     $user = Auth::user();

    //     $isSuperAdmin = $user->roles()->where('name', 'superadmin')->exists();

    //     $cases = CaseManagement::with('product', 'company')
    //         ->when(!$isSuperAdmin, function ($query) use ($user) {
    //             $query->where('company_id', $user->company_id); // Filter by user_id
    //         })
    //         ->orderBy('id', 'desc')
    //         ->paginate(2);


    //     $statuses = [
    //         ['label' => 'Submitted', 'color' => '#08e012d7'],
    //         ['label' => 'Pending Approval', 'color' => '#d113e2da'],
    //         ['label' => 'In Progress', 'color' => '#3608dae3'],
    //         ['label' => 'Approved', 'color' => '#e99b26e5'],
    //         ['label' => 'Rejected', 'color' => '#f11a1a'],
    //         ['label' => 'Waiting', 'color' => '#dd0000'],
    //     ];

    //     $today = Carbon::today();
    //     $yesterday = Carbon::yesterday();

    //     $user = auth()->user();
    //     $isSuperAdmin = $user->hasRole('superadmin');

    //     // ✅ Total Cases Count (with company filter)
    //     $totalCasesQuery = CaseManagement::query();
    //     if (!$isSuperAdmin) {
    //         $totalCasesQuery->where('company_id', $user->company_id);
    //     }
    //     $totalCasesCount = $totalCasesQuery->count();

    //     // ✅ Loop for Status counts
    //     foreach ($statuses as &$status) {
    //         $query = CaseManagement::where('status', $status['label']);

    //         if (!$isSuperAdmin) {
    //             $query->where('company_id', $user->company_id);
    //         }

    //         // Total count for this status
    //         $status['count'] = $query->count();

    //         // Today's count
    //         $todayQuery = clone $query;
    //         $todayCount = $todayQuery->whereDate('created_at', $today)->count();

    //         // Yesterday's count
    //         $yesterdayQuery = clone $query;
    //         $yesterdayCount = $yesterdayQuery->whereDate('created_at', $yesterday)->count();

    //         // Calculate % change
    //         if ($yesterdayCount == 0) {
    //             $status['change'] = $todayCount > 0 ? '+100%' : '0%';
    //         } else {
    //             $change = (($todayCount - $yesterdayCount) / $yesterdayCount) * 100;
    //             $status['change'] = ($change >= 0 ? '+' : '') . round($change, 1) . '%';
    //         }
    //     }

    //     return view('dashboard', compact('statuses', 'totalCasesCount', 'cases'));
    // }

    public function dashboard()
    {
        // Get the authenticated user
        $user = Auth::user();
        // Check if the user is a superadmin
        $isSuperAdmin = $user->hasRole('superadmin');

        // Define the statuses to display on the dashboard
        $statuses = [
            ['label' => 'Submitted', 'color' => '#08e012d7'],
            ['label' => 'Pending Approval', 'color' => '#d113e2da'],
            ['label' => 'Approved', 'color' => '#e99b26e5'],
            ['label' => 'Reopened Cases', 'color' => '#2196F3'],
            ['label' => 'High-Risk-case', 'color' => '#FF5722'],
            ['label' => 'Rejected', 'color' => '#f11a1a'],
            ['label' => 'In Progress', 'color' => '#3608dae3'],
            ['label' => 'Waiting', 'color' => '#dd0000'],
            ['label' => 'Closed(Completed)', 'color' => '#607D8B'],
        ];

        // Get today's and yesterday's dates
        $today = Carbon::today();
        $yesterday = Carbon::yesterday();

        // Build the base query for cases, filtered by company if not superadmin
        $baseQuery = CaseManagement::query();

        $totalCasesCount = $baseQuery->count();

        if (!$isSuperAdmin) {
            $baseQuery->where('company_id', $user->company_id);
        }

        // Get the paginated list of cases for the dashboard table
        $cases = (clone $baseQuery)
            ->with('product', 'company')
            ->orderBy('id', 'desc')
            ->paginate(2);

        // Pre-calculate 'Waiting' and 'Closed(Completed)' cases for use in 'Submitted' logic
        $waitingCountQuery = (clone $baseQuery)->where('status', 'Waiting');
        $waitingCount = $waitingCountQuery->count();
        $waitingToday = (clone $waitingCountQuery)->whereDate('created_at', $today)->count();
        $waitingYesterday = (clone $waitingCountQuery)->whereDate('created_at', $yesterday)->count();

        $closedCountQuery = (clone $baseQuery)->where('status', 'Closed(Completed)');
        $closedCount = $closedCountQuery->count();
        $closedToday = (clone $closedCountQuery)->whereDate('created_at', $today)->count();
        $closedYesterday = (clone $closedCountQuery)->whereDate('created_at', $yesterday)->count();

        // Loop through each status to calculate counts and % change
        foreach ($statuses as &$status) {
            $label = $status['label'];

            if ($label === 'Submitted') {
                // 'Submitted' is defined as total cases minus 'Waiting' and minus 'Closed(Completed)' cases
                $submittedCount = (clone $baseQuery)->count() - ($waitingCount + $closedCount);
                $submittedToday = (clone $baseQuery)->whereDate('created_at', $today)->count() - $waitingToday - $closedToday;
                $submittedYesterday = (clone $baseQuery)->whereDate('created_at', $yesterday)->count() - $waitingYesterday - $closedYesterday;
                $status['count'] = max(0, $submittedCount);
            } else {
                // For all other statuses, count cases with that status
                $query = (clone $baseQuery)->where('status', $label);
                $status['count'] = $query->count();
                $submittedToday = $query->whereDate('created_at', $today)->count();
                $submittedYesterday = $query->whereDate('created_at', $yesterday)->count();
            }

            // Calculate percentage change from yesterday to today
            if ($submittedYesterday == 0) {
                $status['change'] = $submittedToday > 0 ? '+100%' : '0%';
            } else {
                $change = (($submittedToday - $submittedYesterday) / $submittedYesterday) * 100;
                $status['change'] = ($change >= 0 ? '+' : '') . round($change, 1) . '%';
            }
        }

        // Pass the statuses and cases to the dashboard view
        return view('dashboard', compact('statuses', 'cases', 'totalCasesCount'));
    }
}
