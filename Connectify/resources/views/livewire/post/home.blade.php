<div class="w-full h-full">
    @php
        use App\Http\Controllers\DbController;
        $isVerified=DbController::query('SELECT isVerified FROM users WHERE ID=?', $user[0]['ID']);
        $isLiked=DbController::query('SELECT isLiked FROM isliked WHERE Username=? AND Post_ID=?', $_SESSION['username'], $post[0]['Post_ID']);
        $date = DateTime::createFromFormat('Y-m-d',$post[0]['PostDate'])->format('d/m/Y');
        $isLiked = !empty($isLiked) && count($isLiked) > 0 ? $isLiked[0]['isLiked'] : 0;
        $isSaved = DbController::query('SELECT isSaved FROM issaved WHERE Saver=? AND Post_ID=?', $_SESSION['username'], $post[0]['Post_ID']);
        $isSaved = !empty($isSaved) && count($isSaved) > 0 ? $isSaved[0]['isSaved'] : 0;
    @endphp
    <div class="pt-3">
        <livewire:post.item content="{{$post[0]['Content']}}" hasText="{{$post[0]['hasText']}}" username="{{$user[0]['Username']}}"
            postDate="{{$date}}" hasMedia="{{$post[0]['hasMedia']}}" url="{{$post[0]['url']}}" postID="{{$post[0]['Post_ID']}}" isLiked="{{$isLiked}}"
            isVerified="{{$isVerified[0]['isVerified']}}" isSaved="{{$isSaved}}"/>
    </div>
    <div>
        <form method="post" class="max-w-2xl bg-white rounded-lg border p-2 mx-auto mt-20">
            <div class="px-3 mb-2 mt-2">
                <textarea placeholder="{{'Comment as '.$_SESSION['username']}}" class="w-full bg-gray-100 rounded border border-gray-400 leading-normal resize-none h-20 py-2 px-3 font-medium placeholder-gray-700 focus:outline-none focus:bg-white"></textarea>
            </div>
            <div class="flex justify-end px-4">
                <input type="submit" class="px-2.5 py-1.5 rounded-md text-white text-sm bg-indigo-500" value="Comment">
            </div>
        </form>
    </div>
</div>
