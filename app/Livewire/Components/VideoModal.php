<?php

namespace App\Livewire\Components;

use App\Models\Tour;
use Carbon\Carbon;
use Livewire\Attributes\On;
use Livewire\Component;

class VideoModal extends Component
{
    public $data;
    #[On('openVideo')]
    public function getVideo($tourId)
    {
        $this->data = Tour::find($tourId);
    }
    public function render()
    {
        return view('livewire.components.video-modal');
    }
}
