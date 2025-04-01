<?php

namespace App\Livewire;

use App\Models\ContactPage;
use App\Traits\HandlesSeo;
use Livewire\Component;

class Contact extends Component
{
    use HandlesSeo;

    public $data;
    public function mount()
    {
        $this->data = ContactPage::first();
        $this->setSeo($this->data);
    }

    public function render()
    {
        return view('livewire.contact');
    }
}
