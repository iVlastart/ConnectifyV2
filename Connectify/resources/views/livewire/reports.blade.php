

<div class="relative overflow-x-auto shadow-md sm:rounded-lg">
    @php
        use App\Http\Controllers\DbController;
        if($_SESSION['username']!=='Connectify') return redirect('/');
    @endphp
    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-black-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">
                    Username
                </th>
                <th scope="col" class="px-6 py-3">
                    Post / Comment ID
                </th>
                <th scope="col" class="px-6 py-3">
                    Content
                </th>
                <th scope="col" class="px-6 py-3">
                    Suspend account
                </th>
                <th scope="col" class="px-6 py-3">
                    Delete post
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach($reports as $report)
            @php
                $post = DbController::query('SELECT * FROM posts WHERE Post_ID=?', $report['Post_ID']);
                $ID = DbController::query('SELECT ID FROM users WHERE Username=?', $report['Username']);
                $comment = DbController::query('SELECT * FROM comments WHERE Post_ID=? AND ID=?', $post[0]['Post_ID'], $ID[0]['ID']);
            @endphp
            <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700 max-h-64 overflow-y-auto">
                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                    {{$report['Username']}}
                </th>
                <td class="px-6 py-4">
                    {{$report['Post_ID']}}
                </td>
                <td class="px-6 py-4">
                    {{$report['isComment'] ? $comment[0]['Content'] : $post[0]['Content']}}
                </td>
                <td class="px-6 py-4">
                    <form action="{{url('suspend')}}" class="susForm" method="post">
                        @csrf
                        <input type="hidden" name="username" value="{{$report['Username']}}">
                        <button type="submit" class="btnSus focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">
                            Suspend
                        </button>
                    </form>
                </td>
                <td class="px-6 py-4">
                    <form action="{{url('/delete')}}" method="post" class="deleteForm">
                        @csrf
                        <input type="hidden" name="postID" value="{{$report['Post_ID']}}">
                        <button type="submit" class="btnDelete focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">
                            Delete
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
        <script type="text/javascript">
            $(document).ready(()=>{
                $('.susForm').on('submit', (e)=>{
                    e.preventDefault();
                    e.stopImmediatePropagation();
                    const data = $(e.target).closest('form').serialize();
                    $.ajax({
                        type: "POST",
                        url: "{{url('suspend')}}",
                        data: data,
                        success: (response)=> {
                            const btnSus = $(e.target).find('.btnSus');
                            btnSus.html("Suspended");
                            btnSus.prop('disabled', true);
                        },
                        beforeSend: ()=>{
                            const btnSus = $(e.target).find('.btnSus');
                            btnSus.html("Suspending...");
                            btnSus.prop('disabled', true);
                        },
                        error: (xhr, status, error)=>{
                            console.log(xhr.responseText);
                        }
                    });
                });
                $('.deleteForm').on('submit', (e)=>{
                    e.preventDefault();
                    e.stopImmediatePropagation();
                    const data = $(e.target).closest('form').serialize();
                    $.ajax({
                        type: "POST",
                        url: "{{url('delete')}}",
                        data: data,
                        success: function (resp) {
                            const btnDelete = $(e.target).find('.btnDelete');
                            btnDelete.html("Deleted");
                            btnDelete.prop('disabled', true);
                            location.reload();
                        },
                        beforeSend: ()=>{
                            const btnDelete = $(e.target).find('.btnDelete');
                            btnDelete.html("Deleting...");
                            btnDelete.prop('disabled', true);
                        },
                        error: function (xhr, status, error) {
                            console.log(xhr.responseText);
                        }
                    });
                });
            });
        </script>
    </table>
</div>