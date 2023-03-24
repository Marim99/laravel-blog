<?php use app\Models\User;?>
<div class="comments-section mt-5">
<h1 class="m-3">comments</h1>
<div class="card mb-3">
@livewire('add-comment' , ['post'=>$post])   
  <div class="row g-0">
 
        
            <div class="card-body">
                  @if(isset($post->comments))
                  <table class="table mt-4">
                  @foreach($post->comments as $comment)
                    <tr>              
                      <div class="d-flex justify-content-end mb-2">
                          <div class="card card-body me-2">
                            <p class="card-text">{{$comment['body']}}</p> 
                            <small>Commented By: {{User::find($comment->user_id)->name}}</small>
                          </div>
                              
                              <form method="POST" action="{{ route('comments.delete',[$post['id'],$comment['id']]) }}" > 
                                @csrf
                                @method('delete')
                            <button type="submit" class="btn btn-danger ">Delete</button>
                            </form>
                          </div>
                      </div>
                    </tr>
                  @endforeach
                  </table>
                      @else
                      <div class="text-center p-5">No comments</div> 
                      @endif
           
      
            </div>
            
  </div>
</div>
</div>
