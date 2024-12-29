<div class="max-w-lg mx-auto pt-2">
    <header class="flex items-center gap-3">
        <a href="/profile/{{$username}}"><x-avatar class="h-9 w-9"/></a>
        <div class="grid grid-cols-9 w-full gap-2">
            <div class="col-span-5">
                <h5 class="font-semibold truncate text-sm">
                    <a href="/profile/{{$username}}" class="flex items-center gap-2">
                        {{$username}}
                        @if($isVerified)    
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="blue" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12c0 1.268-.63 2.39-1.593 3.068a3.745 3.745 0 0 1-1.043 3.296 3.745 3.745 0 0 1-3.296 1.043A3.745 3.745 0 0 1 12 21c-1.268 0-2.39-.63-3.068-1.593a3.746 3.746 0 0 1-3.296-1.043 3.745 3.745 0 0 1-1.043-3.296A3.745 3.745 0 0 1 3 12c0-1.268.63-2.39 1.593-3.068a3.745 3.745 0 0 1 1.043-3.296 3.746 3.746 0 0 1 3.296-1.043A3.746 3.746 0 0 1 12 3c1.268 0 2.39.63 3.068 1.593a3.746 3.746 0 0 1 3.296 1.043 3.746 3.746 0 0 1 1.043 3.296A3.745 3.745 0 0 1 21 12Z" />
                            </svg>
                        @endif
                    </a>
                </h5>
            </div>
            <div class="col-span-2 flex text-sm text-center justify-end">
                {{$commentDate}}
            </div>
            <div class="col-span-1 flex text-right justify-end">
                
            <button data-dropdown-toggle="dropdown" data-dropdown-trigger="click" class="dropdownDefaultButton text-gray-500 ml-auto" type="button">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-three-dots-vertical" viewBox="0 0 16 16">
                    <path d="M9.5 13a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0m0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0m0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0"/>
                </svg>
            </button>

            <div id="dropdown" class="dropdown z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">

                <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownDefaultButton">
                    <li>
                        <a class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                            <form action="{{url('report')}}" method="post" class="reportForm">
                                @csrf
                                <input type="hidden" name="username" value="{{$username}}">
                                <input type="hidden" name="postID" value="{{$postID}}">
                                <input type="hidden" name="isComment" value="{{true}}">
                                <button type="submit" class="btnReport flex items-center gap-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="red" class="bi bi-flag-fill" viewBox="0 0 16 16">
                                        <path d="M14.778.085A.5.5 0 0 1 15 .5V8a.5.5 0 0 1-.314.464L14.5 8l.186.464-.003.001-.006.003-.023.009a12 12 0 0 1-.397.15c-.264.095-.631.223-1.047.35-.816.252-1.879.523-2.71.523-.847 0-1.548-.28-2.158-.525l-.028-.01C7.68 8.71 7.14 8.5 6.5 8.5c-.7 0-1.638.23-2.437.477A20 20 0 0 0 3 9.342V15.5a.5.5 0 0 1-1 0V.5a.5.5 0 0 1 1 0v.282c.226-.079.496-.17.79-.26C4.606.272 5.67 0 6.5 0c.84 0 1.524.277 2.121.519l.043.018C9.286.788 9.828 1 10.5 1c.7 0 1.638-.23 2.437-.477a20 20 0 0 0 1.349-.476l.019-.007.004-.002h.001"/>
                                    </svg>
                                    <strong class="text-red-600">Report</strong>
                                </button>
                            </form>
                        </a>
                    </li>
                    @if($username!==$_SESSION['username'])
                    <li>
                        <a class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                            <form action="{{url('block')}}" method="post" class="blockForm">
                                @csrf
                                <input type="hidden" name="blocker" value="{{$_SESSION['username']}}">
                                <input type="hidden" name="blocking" value="{{$username}}">
                                <button type="submit" class="btnBlock flex items-center gap-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="red" class="size-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                    </svg>
                                    <strong class="text-red-600">Block</strong>
                                </button>
                            </form>
                        </a>
                    </li>
                    @endif
                    @if (($_SESSION['username'] === 'Connectify') || ($username === $_SESSION['username'] && !request()->is('/profile/*') && $postID !== 0))
                    <li>
                        <a class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                            <form action="{{url('delete')}}" class="deleteForm" method="post">
                                @csrf
                                <input type="hidden" name="postID" value="{{$postID}}">
                                <button type="submit" class="btnDelete flex items-center gap-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="red" class="size-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                    </svg>
                                    <strong class="text-red-600">Delete</strong>
                                </button>
                            </form>
                        </a>
                    </li>
                    @endif
                </ul>
            </div>
            </div>
        </div>
    </header>
</div>
