<div class="max-w-3xl mx-auto">
    @php
        use App\Http\Controllers\DbController;
    @endphp
    @if($type !== "edit")
    {{-- Mobile only header --}}
    <header class="items-center py-2 px-2 border-b lg:hidden grid grid-cols-12">
        {{-- cheveron from heroicons --}}
        <button onclick="history.back()" class="col-span-2">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.9"
                stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" />
            </svg>

        </button>

        {{--profile username --}}
        <div class="col-span-8 ">
            <h2 class="font-bold mx-auto truncate">
                {{$username}}
            </h2>
        </div>

    </header>


    {{-- Details --}}
    <section class="grid grid-cols-12 p-2 my-5 lg:my-12 ">

        {{-- Avatar --}}
        <div class="col-span-4 flex items-center">
            <x-avatar src="" class=" w-20 h-20 lg:h-44 lg:w-44 m-auto" />
        </div>


        <aside class="col-span-8 lg:max-w-2xl lg:mx-auto flex flex-col gap-5">

            {{-- Actions --}}
            <section class="grid grid-cols-12 gap-3">
                <span class="col-span-11 text-lg lg:col-span-5 truncate font-medium flex items-center gap-2">
                    {{$username}}
                     @if($user[0]['isVerified'])
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="blue" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12c0 1.268-.63 2.39-1.593 3.068a3.745 3.745 0 0 1-1.043 3.296 3.745 3.745 0 0 1-3.296 1.043A3.745 3.745 0 0 1 12 21c-1.268 0-2.39-.63-3.068-1.593a3.746 3.746 0 0 1-3.296-1.043 3.745 3.745 0 0 1-1.043-3.296A3.745 3.745 0 0 1 3 12c0-1.268.63-2.39 1.593-3.068a3.745 3.745 0 0 1 1.043-3.296 3.746 3.746 0 0 1 3.296-1.043A3.746 3.746 0 0 1 12 3c1.268 0 2.39.63 3.068 1.593a3.746 3.746 0 0 1 3.296 1.043 3.746 3.746 0 0 1 1.043 3.296A3.745 3.745 0 0 1 21 12Z" />
                        </svg>
                     @endif
                </span>

                {{-- Check if user owns profile or not --}}

                @if ($_SESSION['username']===$username)

                <div class="col-span-12 lg:col-span-6 grid grid-cols-2 gap-3 ">

                    {{-- Send message button --}}
                    <a href="{{url('profile/'.$_SESSION['username']).'/edit'}}" type="button"
                        class=" inline-flex justify-center font-bold items-center  rounded-lg  text-sm p-1.5 px-2 transition  bg-gray-200 hover:bg-slate-100 ">
                        Edit profile
                    </a>

                </div>

                
                @else
                <div class="col-span-12 lg:col-span-6 grid grid-cols-2 gap-3 ">
                    {{-- check following status --}}
                    <form action="{{url('follow')}}" method="post" id="followForm">
                        @csrf
                        <input type="hidden" name="isFollowed" value="{{$isFollowed}}">
                        <input type="hidden" name="following" value="{{$username}}">
                        <button type="submit"
                            class=" inline-flex justify-center font-bold items-center  rounded-lg  text-sm p-1.5 px-2 transition  {{$isFollowed ? 'bg-gray-200 hover:bg-slate-100'
                                : 'bg-blue-500 text-white'}} ">
                            {{$isFollowed ? 'Following' : 'Follow'}}
                        </button>
                    </form>

                </div>

                <button class="col-span-1 hidden lg:flex">
                    {{-- horizontal dots from bootstrap icons--}}
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-three-dots" viewBox="0 0 16 16">
                        <path
                            d="M3 9.5a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3z" />
                    </svg>
                </button>

                @endif
            </section>

            {{-- following details --}}
            <div class="grid grid-cols-3 w-full gap-2">
                <span class="font-bold">
                    @php
                        $count = DbController::query('SELECT COUNT(*) FROM posts WHERE ID=?', $user[0]['ID']);
                    @endphp
                    {{ $count[0]['COUNT(*)'] }} posts
                </span>
                <span class="font-bold">{{$user[0]['Followers']}} Followers</span>
                <span class="font-bold">{{$user[0]['Following']}} following</span>
            </div>

            {{-- profile user's bio --}}

            <h4>
                {{$user[0]['Bio']}}
            </h4>




        </aside>

    </section>


    {{-- Tabs --}}
    <section class="border-t">
        <ul class="grid {{$username===$_SESSION['username'] ? 'grid-cols-5' : 'grid-cols-3'}} gap-4 max-w-sm mx-auto pb-3 ">
            {{-- Posts --}}
            <li class="flex items-center gap-2 py-2 cursor-pointer">
                {{-- border icon from bootsrap icons --}}
                <a wire:navigate  class="flex items-center gap-2 py-2 cursor-pointer"
                href="{{url('profile/'.$username)}}">

                <h4 class="font-bold capitalize">Posts</h4>

                </a>
            </li>
            <li class="flex items-center gap-2 py-2 cursor-pointer">
                <a wire:navigate class="flex items-center gap-2 py-2 cursor-pointer" href="/profile/{{$username}}/with_replies">
                    <h4 class="font-bold capitalize">Replies</h4>
                </a>
            </li>
            <li class="flex items-center gap-2 py-2 cursor-pointer">
                <a wire:navigate class="flex items-center gap-2 py-2 cursor-pointer" href="/profile/{{$username}}/media">
                    <h4 class="font-bold capitalize">Media</h4>
                </a>
            </li>
            @if($username===$_SESSION['username'])
                <li class="flex items-center gap-2 py-2 cursor-pointer">
                    <a wire:navigate class="flex items-center gap-2 py-2 cursor-pointer" href="/profile/{{$username}}/saved">
                        <h4 class="font-bold capitalize">Saved</h4>
                    </a>
                </li>
            @endif
        </ul>
    </section>
    @endif

    <main class="my-7">
        @if($isBlocked)
            <livewire:profile.blocked/>
        @else
            @switch($type)
                @case('posts')
                <livewire:profile.posts username="{{$username}}"/>
                @break
                @case('media')
                <livewire:profile.media username="{{$username}}"/>
                @break
                @case('saved')
                    @if($username!==$_SESSION['username'])
                        @php
                            return redirect('/profile/'.$username);
                        @endphp
                    @else
                    <livewire:profile.saved username="{{$username}}"/>
                    @endif
                @break
                @case('edit')
                <livewire:profile.edit username="{{$username}}"/>
                @break
            @endswitch
        @endif
    </main>
    <script type="text/javascript">
        $(document).ready(function(){
            $('#followForm').on('submit', (e)=>{
                e.preventDefault();
                e.stopImmediatePropagation();
                const data = $(e.target).closest('form').serialize();
                $.ajax({
                    type: "POST",
                    url: "{{url('follow')}}",
                    data: data,
                    success: function (response) {
                        location.reload();
                    },
                    error: (xhr, status, error)=>{
                        console.log(xhr.responseText);
                    }
                });
            });
        });
    </script>
</div>
