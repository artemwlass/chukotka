<?php

namespace App\Livewire\Components;

use App\Models\Tour;
use Carbon\Carbon;
use Livewire\Attributes\On;
use Livewire\Component;

class DateModal extends Component
{
    public $id;
    public $tour;
    public $groupedBookings = [];

    public function mount($id = null)
    {
        $this->tour = Tour::with('bookings')->find($id);
        if ($this->tour instanceof Tour && $this->tour->bookings->isNotEmpty()) {
            // Группируем бронирования вручную
            $grouped = [];
            foreach ($this->tour->bookings as $booking) {
                $monthKey = Carbon::parse($booking->date_from)->translatedFormat('F Y'); // "Июль 2024"
                if (!isset($grouped[$monthKey])) {
                    $grouped[$monthKey] = [];
                }
                $grouped[$monthKey][] = $booking;
            }
            $this->groupedBookings = $grouped;
        } else {
            $this->groupedBookings = [];
        }
    }

    #[On('openDateModal')]
    public function getTourDates($id)
    {
        $this->tour = Tour::with('bookings')->find($id);
        if ($this->tour instanceof Tour && $this->tour->bookings->isNotEmpty()) {
            // Группируем бронирования вручную
            $grouped = [];
            foreach ($this->tour->bookings as $booking) {
                $monthKey = Carbon::parse($booking->date_from)->translatedFormat('F Y'); // "Июль 2024"
                if (!isset($grouped[$monthKey])) {
                    $grouped[$monthKey] = [];
                }
                $grouped[$monthKey][] = $booking;
            }
            $this->groupedBookings = $grouped;
        } else {
            $this->groupedBookings = [];
        }
    }

    public function render()
    {
        return view('livewire.components.date-modal');
    }
}
