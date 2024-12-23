<div class="max-w-3xl mx-auto">
    @php
        use App\Http\Controllers\DbController;
    @endphp
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

                <button class="col-span-1 hidden lg:flex">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M9.594 3.94c.09-.542.56-.94 1.11-.94h2.593c.55 0 1.02.398 1.11.94l.213 1.281c.063.374.313.686.645.87.074.04.147.083.22.127.324.196.72.257 1.075.124l1.217-.456a1.125 1.125 0 011.37.49l1.296 2.247a1.125 1.125 0 01-.26 1.431l-1.003.827c-.293.24-.438.613-.431.992a6.759 6.759 0 010 .255c-.007.378.138.75.43.99l1.005.828c.424.35.534.954.26 1.43l-1.298 2.247a1.125 1.125 0 01-1.369.491l-1.217-.456c-.355-.133-.75-.072-1.076.124a6.57 6.57 0 01-.22.128c-.331.183-.581.495-.644.869l-.213 1.28c-.09.543-.56.941-1.11.941h-2.594c-.55 0-1.02-.398-1.11-.94l-.213-1.281c-.062-.374-.312-.686-.644-.87a6.52 6.52 0 01-.22-.127c-.325-.196-.72-.257-1.076-.124l-1.217.456a1.125 1.125 0 01-1.369-.49l-1.297-2.247a1.125 1.125 0 01.26-1.431l1.004-.827c.292-.24.437-.613.43-.992a6.932 6.932 0 010-.255c.007-.378-.138-.75-.43-.99l-1.004-.828a1.125 1.125 0 01-.26-1.43l1.297-2.247a1.125 1.125 0 011.37-.491l1.216.456c.356.133.751.072 1.076-.124.072-.044.146-.087.22-.128.332-.183.582-.495.644-.869l.214-1.281z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>

                </button>
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
        <ul class="grid grid-cols-3 gap-4 max-w-sm mx-auto pb-3 ">
            {{-- Posts --}}
            <li class="flex items-center gap-2 py-2 cursor-pointer">
                {{-- border icon from bootsrap icons --}}
                <a wire:navigate  class="flex items-center gap-2 py-2 cursor-pointer"
                href="{{url('profile/'.$username)}}">

                <h4 class="font-bold capitalize">Posts</h4>

                </a>

            </li>
        </ul>


    </section>


    <main class="my-7">
        @if($isBlocked)
            <livewire:profile.blocked/>
        @else
            <livewire:profile.posts username="{{$username}}"/>
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
