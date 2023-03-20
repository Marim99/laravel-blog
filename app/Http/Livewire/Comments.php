<?php

namespace App\Http\Livewire;

use App\Models\Comment;
use Illuminate\Http\Request;
use App\Models\Post;
use Livewire\Component;


class Comments extends Component
{
    public $post;

    protected $listeners = [
        'commentCreated' => '$refresh',
    ];
    public function render()
    {
        return view('livewire.comments');
    }
}
