<div>
    @php
        use App\Http\Controllers\DbController;
    @endphp
    @foreach ($posts as $post)
        @php
            
            $username=DbController::query('SELECT Username FROM users WHERE ID=?', $post['ID']);
            $isVerified=DbController::query('SELECT isVerified FROM users WHERE ID=?', $post['ID']);
            $isLiked=DbController::query('SELECT isLiked FROM isliked WHERE Username=? AND Post_ID=?', $_SESSION['username'], $post['Post_ID']);
            $date = DateTime::createFromFormat('Y-m-d',$post['PostDate'])->format('d/m/Y');
            $isLiked = !empty($isLiked) && count($isLiked) > 0 ? $isLiked[0]['isLiked'] : 0;
        @endphp
        <livewire:post.item content="{{$post['Content']}}" hasText="{{$post['hasText']}}" username="{{$username[0]['Username']}}"
            postDate="{{$date}}" hasMedia="{{$post['hasMedia']}}" url="{{$post['url']}}" postID="{{$post['Post_ID']}}" isLiked="{{$isLiked}}"
            isVerified="{{$isVerified[0]['isVerified']}}"/>
    @endforeach
</div>
