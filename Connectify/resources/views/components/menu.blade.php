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
        @if($_SESSION['username']==='Connectify' || $username===$_SESSION['username'])
        <li>
            <a class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Delete</a>
        </li>
        @endif
    </ul>
</div>
<script type="text/javascript">
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