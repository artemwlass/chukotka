<?php

namespace App\Livewire;

use App\Models\ContactPage;
use App\Models\Home;
use App\Traits\HandlesSeo;
use Livewire\Component;

class Index extends Component
{
    use HandlesSeo;

    public $data;

    public $posts;

    public function mount()
    {
        $this->data = Home::first();
        $this->setSeo($this->data);

        $this->posts = \App\Models\Post::latest('created_at')->take(5)->get();

    }
    public function render()
    {
        return view('livewire.index');
    }
}
