<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class AddComment extends Component
{
    public $post;
    public $commentBody;
    public function create(){

        $this->post->comments()->create([
            'body' =>  $this->commentBody,
            'user_id'=>Auth::user()->id,
        ]);
        $this->commentBody='';
        $this->emit('commentCreated');
        // $this->reset();
    }
    public function render()
    {
        return view('livewire.add-comment');
    }
}
