<?php

namespace App\Http\Livewire;

use App\Models\Post;
use Livewire\Component;

class DeleteComment extends Component
{
    public $post;
    public $comment;
    public function delete()
    {
        $this->post->comments()->where('id', $this->comment->id)->delete();
        $this->emit('commentDeleted');
    }
    public function render()
    {
        return view('livewire.delete-comment');
    }
}
