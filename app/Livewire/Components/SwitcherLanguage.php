<?php

namespace App\Livewire\Components;

use Livewire\Component;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class SwitcherLanguage extends Component
{
    public $currentLang;

    public function mount()
    {
        $this->currentLang = Session::get('locale', 'ru');
    }

    public function render()
    {
        return view('livewire.components.switcher-language');
    }
}
