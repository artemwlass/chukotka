<?php

namespace App\Livewire\Components;

use App\Models\Tour;
use Carbon\Carbon;
use Livewire\Attributes\On;
use Livewire\Component;

class VideoModal extends Component
{
    public $video;
//    #[On('openVideo')]
    public function getVideo($video)
    {
        dd($video);
        $this->video = $video;
    }
    public function render()
    {
        return view('livewire.components.video-modal');
    }
}
