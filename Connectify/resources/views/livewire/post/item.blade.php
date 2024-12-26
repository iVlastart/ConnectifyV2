<div class="max-w-lg mx-auto pt-2">
    {{--header--}}
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
                {{$postDate}}
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
                        <a class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Delete</a>
                    </li>
                    @endif
                </ul>
            </div>
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
            <form action="{{url('likePost')}}" method="post" class="likeForm">
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

            <form action="{{url('save')}}" method="post" class="saveForm ml-auto">
                @csrf
                <input type="hidden" name="postID" value="{{$postID}}">
                <input type="hidden" name="saver" value="{{$_SESSION['username']}}">
                <input type="hidden" name="isSaved" value="{{$isSaved}}">
                <button type="submit">
                    <span>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="black" class="size-6">
                            <path stroke-linecap="round" fill="{{$isSaved ? "black": "white"}}" stroke-linejoin="round" d="M17.593 3.322c1.1.128 1.907 1.077 1.907 2.185V21L12 17.25 4.5 21V5.507c0-1.108.806-2.057 1.907-2.185a48.507 48.507 0 0 1 11.186 0Z" />
                        </svg>
                    </span>
                </button>
            </form>
        </div>
        <hr>
    </footer>
    <script type="text/javascript">
        $(document).ready(() => {
        $('.likeForm').on('submit', function(e) {
            e.preventDefault();
            e.stopImmediatePropagation();
            const data = $(e.target).closest('form').serialize();
            $.ajax({
                type: 'POST',
                url: '{{url("likePost")}}',
                data: data,
                success: (resp) => {
                    const svg = $(this).find('svg path');
                    svg.attr('fill', svg.attr('fill') === 'currentColor' ? 'white' : 'currentColor');
                },
                error: (xhr, status, error) => {
                    console.log(xhr.responseText);
                }
            });
        });
        $('.saveForm').on('submit', function(e){
            e.preventDefault();
            e.stopImmediatePropagation();
            const data = $(e.target).closest('form').serialize();
            $.ajax({
                type: "POST",
                url: "{{url('save')}}",
                data: data,
                success: (resp) => {
                    const svg = $(this).find('svg path');
                    svg.attr('fill', svg.attr('fill')=== 'black' ? 'white' : 'black');
                },
                error: (xhr, status, error)=>{
                    console.log(xhr.responseText);
                }
            });
        });
    });
    $('.reportForm').on('submit', function(e){
        e.preventDefault();
        e.stopImmediatePropagation();
        const data = $(e.target).closest('form').serialize();
        $.ajax({
            type: 'POST',
            url: '{{url("report")}}',
            data: data,
            success: (resp)=>{
                const btnReport = $(e.target).find('.btnReport');
                btnReport.html('Reported');
                btnReport.prop('disabled', true);
            },
            beforeSend: ()=>{
                const btnReport = $(e.target).find('.btnReport');
                btnReport.html("Reporting...");
                btnReport.prop('disabled', true);
            },
            error: (xhr, status, error)=>{
                console.log(xhr.responseText);
            }
        });
    });

    $('.blockForm').on('submit', (e)=>{
        e.preventDefault();
        e.stopImmediatePropagation();
        const data = $(e.target).closest('form').serialize();
        $.ajax({
            type: "POST",
            url: "{{url('block')}}",
            data: data,
            success: function (resp) {
                const btnReport = $(e.target).find('.btnBlock');
                btnReport.html("Blocked");
                btnReport.prop('disabled', true);
            },
            beforeSend: ()=>{
                const btnReport = $(e.target).find('.btnBlock');
                btnReport.html("Blocking...");
                btnReport.prop('disabled', true);
            },
            error: function (xhr, status, error) {
                console.log(xhr.responseText);
            }
        });
    });
    $(document).off('click', '.dropdownDefaultButton').on('click', '.dropdownDefaultButton', function() {
        const dropdownMenu = $(this).next('.dropdown');
        $('.dropdown').not(dropdownMenu).addClass('hidden');
        dropdownMenu.toggleClass('hidden');
    });

    $(document).on('click', function(e) {
        if (!$(e.target).closest('.dropdown, .dropdownDefaultButton').length) {
            $('.dropdown').addClass('hidden');
        }
    });
    </script>
</div>
