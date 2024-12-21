<div class="max-w-lg mx-auto">
    {{--header--}}
    <header class="flex items-center gap-3">
        <a href="/profile/{{$username}}"><x-avatar class="h-9 w-9"/></a>
        <div class="grid grid-cols-9 w-full gap-2">
            <div class="col-span-5">
                <h5 class="font-semibold truncate text-sm"><a href="/profile/{{$username}}">{{$username}}</a></h5>
            </div>
            <div class="col-span-2 flex text-sm text-center justify-end">
                {{$postDate}}
            </div>
            <div class="col-span-1 flex text-right justify-end">
                <button class="text-gray-500 ml-auto">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-three-dots-vertical" viewBox="0 0 16 16">
                        <path d="M9.5 13a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0m0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0m0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0"/>
                    </svg>
                </button>
            </div>
        </div>
    </header>
    {{--main--}}
    <main>
        <div>
            @if($hasText)
                <span>
                    {{$content}}
                </span>
            @endif
            @if($hasMedia)
                <x-video source="{{$url}}"/>
            @endif
        </div>
    </main>
    {{--footer--}}
    <footer>
        <div class="flex gap-4 items-center my-2">
            <form action="/likePost" method="post" id="like">
                @csrf
                <input type="hidden" name="postID" value="{{$postID}}">
                <input type="hidden" name="isLiked" value="{{$isLiked}}">
                <button type="submit">
                    <span>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.9" stroke="currentColor" class="size-6 text-rose-500">
                            <path stroke-linecap="round" fill="{{$isLiked ? "currentColor": "white"}}" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" />
                        </svg>
                    </span>
                </button>
            </form>

            <span>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.9" stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 20.25c4.97 0 9-3.694 9-8.25s-4.03-8.25-9-8.25S3 7.444 3 12c0 2.104.859 4.023 2.273 5.48.432.447.74 1.04.586 1.641a4.483 4.483 0 0 1-.923 1.785A5.969 5.969 0 0 0 6 21c1.282 0 2.47-.402 3.445-1.087.81.22 1.668.337 2.555.337Z" />
                </svg>
            </span>

            <span>
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-send w-5 h-5" viewBox="0 0 16 16">
                    <path d="M15.854.146a.5.5 0 0 1 .11.54l-5.819 14.547a.75.75 0 0 1-1.329.124l-3.178-4.995L.643 7.184a.75.75 0 0 1 .124-1.33L15.314.037a.5.5 0 0 1 .54.11ZM6.636 10.07l2.761 4.338L14.13 2.576zm6.787-8.201L1.591 6.602l4.339 2.76z"/>
                </svg>
            </span>

            <span class="ml-auto">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17.593 3.322c1.1.128 1.907 1.077 1.907 2.185V21L12 17.25 4.5 21V5.507c0-1.108.806-2.057 1.907-2.185a48.507 48.507 0 0 1 11.186 0Z" />
                </svg>
            </span>
        </div>
    </footer>
    <script type="text/javascript">
        $(document).ready(()=>{
            $('#like').on('submit', function(e){
                e.preventDefault();
                const data = $(event.target).closest('form').serialize();
                $.ajax({
                    type: 'POST',
                    url: '/likePost',
                    data: data,
                    success: (resp)=>{
                        const svg = $(this).find('svg path');
                        if (svg.attr('fill') === 'currentColor') {
                            svg.attr('fill', 'white');
                        } else {
                            svg.attr('fill', 'currentColor');
                        }
                    },
                    error: (xhr, status, error)=>{
                        console.log(xhr.responseText);
                    }
                })
            })
        });
    </script>
</div>
