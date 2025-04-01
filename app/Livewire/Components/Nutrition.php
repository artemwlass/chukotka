<?php

namespace App\Livewire\Components;

use App\Models\AboutPage;
use App\Models\Tour;
use Livewire\Attributes\On;
use Livewire\Component;

class Nutrition extends Component
{
    public $data;
    #[On('openPartner')]
    public function getText()
    {
        $this->data = AboutPage::first();
    }

    public function render()
    {
        return view('livewire.components.nutrition');
    }
}
