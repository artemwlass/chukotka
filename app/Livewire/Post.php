<?php

namespace App\Livewire;

use App\Models\Tour;
use App\Traits\HandlesSeo;
use Livewire\Component;

class Post extends Component
{
    use HandlesSeo;

    public $data;
    public $recommend;

    public $tours;

    public function mount($slug)
    {
        $this->data = \App\Models\Post::where('slug->' . app()->getLocale(), $slug)
            ->first();

        $this->recommend = Tour::find($this->data->recommendation_tour_id);

        if ($this->data) {
            $this->data->increment('views');
            $this->data->save();
        }

        $this->tours = Tour::whereIn('id', array_values($this->data->recommend))->get();

        $this->setSeo($this->data);
    }

    public function render()
    {
        return view('livewire.post');
    }
}
