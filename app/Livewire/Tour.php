<?php

namespace App\Livewire;

use App\Traits\HandlesSeo;
use Carbon\Carbon;
use Livewire\Component;

class Tour extends Component
{
    use HandlesSeo;

    public $data;
    public $nearestBooking;

    public $bookings;

    public $tours;

    public function mount($slug)
    {
        $this->data = \App\Models\Tour::where('slug->' . app()->getLocale(), $slug)
            ->with('bookings')
            ->with('days')
            ->first();

        $this->nearestBooking = $this->data->bookings
            ->where('date_from', '>', Carbon::today())
            ->sortBy('date_from')
            ->first();

        $this->bookings = $this->data->bookings
            ->where('date_from', '>', Carbon::today())
            ->sortBy('date_from');

        $this->tours = \App\Models\Tour::whereIn('id', array_values($this->data->recommend))->get();

        $this->setSeo($this->data);
    }
    public function render()
    {
        return view('livewire.tour');
    }
}
