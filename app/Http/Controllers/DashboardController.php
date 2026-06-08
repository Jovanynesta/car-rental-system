<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\User;
use App\Models\Vehicle;

class DashboardController extends Controller
{
    public function admin()
    {
        $totalVehicles = Vehicle::count();
        $availableVehicles = Vehicle::where('availability', 'available')->count();
        $totalReservations = Reservation::count();
        $totalUsers = User::count();
        $recentReservations = Reservation::with(['user', 'vehicle'])->latest()->take(5)->get();
        $totalRevenue = Reservation::where('status', 'confirmed')->sum('total_price');

        return view('admin.dashboard', compact(
            'totalVehicles',
            'availableVehicles',
            'totalReservations',
            'totalUsers',
            'recentReservations',
            'totalRevenue'
        ));
    }

    public function client()
    {
        $user = auth()->user();

        $reservations = Reservation::with('vehicle')
            ->where('user_id', $user->id)
            ->latest()
            ->paginate(10);

        return view('client.dashboard', compact('user', 'reservations'));
    }
}
