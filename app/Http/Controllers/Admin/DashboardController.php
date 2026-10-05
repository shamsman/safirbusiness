<?php

namespace App\Http\Controllers\Admin;

use App\Enums\UserRole;
use App\Http\Controllers\Controller;
use App\Models\Bulletin;
use App\Models\Inquiry;
use App\Models\Report;
use App\Models\Setting;
use App\Models\Subscriber;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardController extends Controller
{
    /**
     * Display the admin dashboard.
     */
    public function index(Request $request): View
    {
        $currentUser = $request->user();

        // High-level statistics
        $stats = [
            'total_users'       => User::count(),
            'active_users'      => User::where('is_active', true)->count(),
            'superadmins_count' => User::where('role', UserRole::Superadmin->value)->count(),
            'admins_count'      => User::where('role', UserRole::Admin->value)->count(),
            'editors_count'     => User::where('role', UserRole::Editor->value)->count(),
            'guests_count'      => User::where('role', UserRole::Guest->value)->count(),
            'total_inquiries'   => Inquiry::count(),
            'new_inquiries'     => Inquiry::where('status', 'new')->count(),
            'total_reports'     => Report::count(),
            'total_bulletins'   => Bulletin::count(),
            'total_subscribers' => Subscriber::count(),
        ];

        // Recent items
        $recentUsers = User::latest()->take(6)->get();
        $recentInquiries = Inquiry::latest()->take(5)->get();

        return view('admin.dashboard', compact('currentUser', 'stats', 'recentUsers', 'recentInquiries'));
    }
}
