

<div class="relative overflow-x-auto shadow-md sm:rounded-lg">
    @php
        use App\Http\Controllers\DbController;
    @endphp
    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-black-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">
                    Username
                </th>
                <th scope="col" class="px-6 py-3">
                    Post ID
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
                $content = DbController::query('SELECT Content FROM posts WHERE Post_ID=?', $report['Post_ID']);
            @endphp
            <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700 max-h-64 overflow-y-auto">
                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                    {{$report['Username']}}
                </th>
                <td class="px-6 py-4">
                    {{$report['Post_ID']}}
                </td>
                <td class="px-6 py-4">
                    {{$content[0]['Content']}}
                </td>
                <td class="px-6 py-4">
                    <form action="{{url('suspend/'.$report['Username'])}}">
                        @csrf
                        <button type="submit" class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">
                            Suspend
                        </button>
                    </form>
                </td>
                <td class="px-6 py-4">
                    <form action="{{url('/delete/'.$report['Post_ID'])}}" method="post">
                        @csrf
                        <button type="submit" class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">
                            Delete
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>