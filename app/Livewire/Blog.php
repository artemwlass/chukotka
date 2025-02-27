<?php

namespace App\Livewire;

use App\Models\BlogPage;
use App\Traits\HandlesSeo;
use Livewire\Component;
use Livewire\WithPagination;

class Blog extends Component
{
    use HandlesSeo;
    use WithPagination;

    public $data;

    public function mount()
    {
        $this->data = BlogPage::first();
        $this->setSeo($this->data);
    }

    public function render()
    {
        return view('livewire.blog', [
            'posts' => \App\Models\Post::paginate(8),
        ]);
    }
}
