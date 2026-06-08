<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class ReservationController extends Controller
{
    public function index()
    {
        $reservations = Reservation::with('vehicle')
            ->where('user_id', auth()->id())
            ->latest()
            ->paginate(10);

        return view('client.reservations.index', compact('reservations'));
    }

    public function create()
    {
        $vehicles = Vehicle::with('category')
            ->where('availability', 'available')
            ->orderBy('brand')
            ->orderBy('model')
            ->get();

        return view('client.reservations.create', compact('vehicles'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'vehicle_id' => 'required|exists:vehicles,id',
            'start_date' => 'required|date|after_or_equal:today',
            'duration_days' => 'required|integer|min:1|max:365',
        ]);

        $vehicle = Vehicle::findOrFail($validated['vehicle_id']);

        $startDate = Carbon::parse($validated['start_date']);
        $endDate = $startDate->copy()->addDays($validated['duration_days'] - 1);
        $totalPrice = $vehicle->price_per_day * $validated['duration_days'];

        $conflict = Reservation::where('vehicle_id', $vehicle->id)
            ->whereIn('status', ['pending', 'confirmed'])
            ->where(function ($query) use ($startDate, $endDate) {
                $query->whereBetween('start_date', [$startDate, $endDate])
                    ->orWhereBetween('end_date', [$startDate, $endDate])
                    ->orWhere(function ($q) use ($startDate, $endDate) {
                        $q->where('start_date', '<=', $startDate)
                          ->where('end_date', '>=', $endDate);
                    });
            })
            ->exists();

        if ($conflict) {
            return back()->withErrors([
                'start_date' => 'Ce véhicule est déjà réservé sur cette période.',
            ])->withInput();
        }

        $reservation = Reservation::create([
            'user_id' => auth()->id(),
            'vehicle_id' => $vehicle->id,
            'start_date' => $startDate->toDateString(),
            'end_date' => $endDate->toDateString(),
            'total_price' => $totalPrice,
            'status' => 'pending',
        ]);

        return redirect()->route('client.reservations.show', $reservation)
            ->with('success', 'Réservation créée avec succès.');
    }

    public function show(Reservation $reservation)
    {
        abort_unless($reservation->user_id === auth()->id() || auth()->user()->role === 'admin', 403);

        $reservation->load(['vehicle', 'user']);

        return view('client.reservations.show', compact('reservation'));
    }

    public function destroy(Reservation $reservation)
    {
        abort_unless($reservation->user_id === auth()->id() || auth()->user()->role === 'admin', 403);

        $reservation->delete();

        return redirect()->route('client.reservations.index')->with('success', 'Réservation supprimée avec succès.');
    }

    public function adminIndex()
    {
        $reservations = Reservation::with(['user', 'vehicle'])->latest()->paginate(10);

        return view('admin.reservations.index', compact('reservations'));
    }

    public function adminShow(Reservation $reservation)
    {
        $reservation->load(['user', 'vehicle']);

        return view('admin.reservations.show', compact('reservation'));
    }

    public function updateStatus(Request $request, Reservation $reservation)
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,confirmed,cancelled,completed',
        ]);

        $reservation->update([
            'status' => $validated['status'],
        ]);

        return back()->with('success', 'Statut mis à jour avec succès.');
    }
}