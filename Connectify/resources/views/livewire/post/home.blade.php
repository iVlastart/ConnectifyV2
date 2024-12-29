<div class="w-full h-full">
    @php
        use App\Http\Controllers\DbController;
        $isVerified=DbController::query('SELECT isVerified FROM users WHERE ID=?', $user[0]['ID'])[0]['isVerified'];
        $isLiked=DbController::query('SELECT isLiked FROM isliked WHERE Username=? AND Post_ID=?', $_SESSION['username'], $post[0]['Post_ID']);
        $date = DateTime::createFromFormat('Y-m-d',$post[0]['PostDate'])->format('d/m/Y');
        $isLiked = !empty($isLiked) && count($isLiked) > 0 ? $isLiked[0]['isLiked'] : 0;
        $isSaved = DbController::query('SELECT isSaved FROM issaved WHERE Saver=? AND Post_ID=?', $_SESSION['username'], $post[0]['Post_ID']);
        $isSaved = !empty($isSaved) && count($isSaved) > 0 ? $isSaved[0]['isSaved'] : 0;
        $comments = DbController::query('SELECT * FROM comments WHERE ID=? AND Post_ID=?', $user[0]['ID'], $post[0]['Post_ID']);
        $commenter = $comments ? DbController::query('SELECT * FROM users WHERE ID=?', $comments[0]['ID']) : "";
        
    @endphp
    <div class="pt-3">
        <livewire:post.item content="{{$post[0]['Content']}}" hasText="{{$post[0]['hasText']}}" username="{{$user[0]['Username']}}"
            postDate="{{$date}}" hasMedia="{{$post[0]['hasMedia']}}" url="{{$post[0]['url']}}" postID="{{$post[0]['Post_ID']}}" isLiked="{{$isLiked}}"
            isVerified="{{$isVerified}}" isSaved="{{$isSaved}}"/>
    </div>
    <div>
        <form method="post" action="{{url('comment')}}" id="commentForm" class="max-w-2xl bg-white rounded-lg border p-2 mx-auto mt-20">
            @csrf
            <input type="hidden" name="postID" value="{{$post[0]['Post_ID']}}">
            <input type="hidden" name="ID" value="{{$user[0]['ID']}}">
            <div class="px-3 mb-2 mt-2">
                <textarea placeholder="{{'Comment as '.$_SESSION['username']}}" name="comment"
                     class="w-full bg-gray-100 rounded border border-gray-400 leading-normal resize-none h-20 py-2 px-3 font-medium placeholder-gray-700 focus:outline-none focus:bg-white"></textarea>
            </div>
            <div class="flex justify-end px-4">
                <input type="submit" class="px-2.5 py-1.5 rounded-md text-white text-sm bg-indigo-500" value="Comment">
            </div>
        </form>
    </div>
    <div>
        @if($comments)
        @foreach ($comments as $comment)
            <livewire:post.comment username="{{$commenter[0]['Username']}}"
                commentDate="{{DateTime::createFromFormat('Y-m-d',$comment['CommentDate'])->format('d/m/Y')}}" commentID="{{$comment['Comment_ID']}}"
                postID="{{$post[0]['Post_ID']}}" isVerified="{{$isVerified}}" content="{{$comment['Content']}}"/>
        @endforeach
        @endif
    </div>
    <script>
        $(document).ready(()=>{
            $('#commentForm').submit((e)=>{
                e.preventDefault();
                e.stopImmediatePropagation();
                const data = $(e.target).closest('form').serialize();
                $.ajax({
                    type: "POST",
                    url: "{{url('comment')}}",
                    data: data,
                    success: function (resp) {
                        location.reload();
                    },
                    error: function (xhr, status, error) {
                        console.log(xhr.responseText);
                    }
                });
            });
        });
    </script>
</div>
