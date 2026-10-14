<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

/**
 * DashboardController
 *
 * Handles the main dashboard page.
 * Will be expanded in Phase 10 to include statistics, charts, etc.
 * For now it just shows the dashboard view with placeholder data.
 */
class DashboardController extends Controller
{
    /**
     * Show the dashboard.
     * GET /dashboard
     *
     * Both admin and staff can access the dashboard,
     * but they see different things (handled in the view).
     */
    public function index()
    {
        $user = auth()->user();

        // These will be replaced with real database queries in Phase 10
        $stats = [
            'total_customers'   => 0,
            'active_orders'     => 0,
            'ready_orders'      => 0,
            'today_deliveries'  => 0,
            'overdue_orders'    => 0,
            'pending_payments'  => 0,
            'total_revenue'     => 0,
        ];

        return view('dashboard.index', compact('user', 'stats'));
    }
}
