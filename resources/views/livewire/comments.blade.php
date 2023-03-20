<div class="comments-section mt-5">
            <div class="container">
                <h1>comments</h1>
              @if(isset($post->comments))
                <table class="table mt-4">
                @foreach($post->comments as $comment)
                
                <tr>              
                        <div class="d-flex justify-content-end mb-2">
                        <div class="card card-body me-2">{{$comment['body']}}</div>
                        
                        @livewire('delete-comment', ['post' => $post, 'comment' => $comment] )
                        </div>
                </tr>
                @endforeach
                </table>
                @else
                <div class="text-center p-5">No comments</div> 
                @endif
            </div>
            
                <livewire:add-comment  :post="$post">
          

            </div>
            </div>
    </div>
