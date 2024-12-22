<div class="w-full h-full">
    @php
        use App\Http\Controllers\DbController;
        $posts = DbController::queryAll('SELECT * FROM posts ORDER BY RAND() LIMIT 10');
    @endphp
    {{--Header--}}
    <header class="md:hidden sticky top-0 bg-white">
        <div class="grid grid-cols-12 gap-2 items-center">
            <div class="col-span-3 pl-5">
                𝕮
            </div>
            <div class="col-span-8 flex justify-center px-2">
                <input type="text" placeholder="search" class="border-0 outline-none w-full focus:outline-none
                    bg-gray-100 rounded-lg focus:ring-0 hover:ring-0">
            </div>
            <div class="col-span-1 flex justify-center">
                <a href="#">
                    <span>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.9" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" />
                    </svg>
                    </span>
                </a>
            </div>
        </div>
    </header>
    {{--main--}}
    <main class="grid lg:grid-cols-12 gap-8 md:mt-10">
        <aside class="lg:col-span-8 overflow-hidden">
            {{--posts--}}
            <section class="mt-5 space-y-4 p-2">
                @foreach($posts as $post)
                    @php
                        $username=DbController::query('SELECT Username FROM users WHERE ID=?', $post['ID']);
                        $isLiked=DbController::query('SELECT isLiked FROM isliked WHERE Username=? AND Post_ID=?', $_SESSION['username'], $post['Post_ID']);
                        $date = DateTime::createFromFormat('Y-m-d',$post['PostDate'])->format('d/m/Y');
                        $isLiked = !empty($isLiked) && count($isLiked) > 0 ? $isLiked[0]['isLiked'] : 0;
                    @endphp
                    <livewire:post.item content="{{$post['Content']}}" hasText="{{$post['hasText']}}" username="{{$username[0]['Username']}}"
                        postDate="{{$date}}" hasMedia="{{$post['hasMedia']}}" url="{{$post['url']}}" postID="{{$post['Post_ID']}}" isLiked="{{$isLiked}}"/>
                @endforeach
            </section>
        </aside>

        {{--suggestions--}}
        <aside class="lg:col-span-4 hidden lg:block p-4">
            <div class="flex items-center gap-2">
                <a href="profile/{{$_SESSION['username']}}">
                    <x-avatar class="w-12 h-12" src="{{$pfp}}"/>
                </a>
                <a href="profile/{{$_SESSION['username']}}">
                    <h4 class="font-medium">{{$_SESSION['username']}}</h4>
                </a>
            </div>

            <section class="mt-4">
                <h4 class="font-bold text-gray-700/95">Suggestions for you</h4>
                <ul class="my-2 space-y-3">
                    @for($i=0;$i<5;$i++)
                        <li class="flex items-center gap-3">
                            <x-avatar src="https://picsum.photos/536/354?random={{ rand() }}" class="w-12 h-12"/>
                            <div class="grid grid-cols-7 w-full gap-2">
                                <div class="col-span-5">
                                    <h5 class="font-semibold truncate text-sm">
                                        {{fake()->name}}
                                    </h5>
                                    <p class="text-xs truncate">Followed by {{fake()->name}}</p>
                                </div>
                                <div class="col-span-2 flex text-right justify-end">
                                    <button class="font-bold text-blue-500 ml-auto text-sm">Follow</button>
                                </div>
                            </div>
                        </li>
                    @endfor
                </ul>
            </section>
        </aside>
    </main>
</div>
