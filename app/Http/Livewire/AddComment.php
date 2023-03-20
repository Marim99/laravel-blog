<?php

namespace App\Http\Livewire;

use Livewire\Component;

class AddComment extends Component
{
    public $post;
    public $commentBody;
    public function create(){
        $this->post->comments()->create([
            'body' =>  $this->commentBody
        ]);
        $this->commentBody='';
        $this->emit('commentCreated');
    }
    public function render()
    {
        return view('livewire.add-comment');
    }
}
