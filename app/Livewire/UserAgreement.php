<?php

namespace App\Livewire;

use App\Traits\HandlesSeo;
use Livewire\Component;

class UserAgreement extends Component
{
    use HandlesSeo;

    public $data;
    public function mount()
    {
        $this->data = \App\Models\UserAgreement::first();
        $this->setSeo($this->data);
    }
    public function render()
    {
        return view('livewire.user-agreement');
    }
}
