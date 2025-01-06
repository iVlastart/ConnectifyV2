<div class="drawer-side" x-data="{
        shrink:false,
        showSearch: false,
        showCreate:false
    }">
        <label for="my-drawer-2" aria-label="close sidebar" class="drawer-overlay"></label>
        <ul x-cloak class="menu bg-base-200 text-base-content min-h-full w-80 p-4" :class="shrink ? 'w-40' : 'w-80'">
            <!-- Sidebar content here -->
                <li><a href="/">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-house-door-fill w-7 h-7" viewBox="0 0 16 16">
                        <path d="M6.5 14.5v-3.505c0-.245.25-.495.5-.495h2c.25 0 .5.25.5.5v3.5a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 .5-.5v-7a.5.5 0 0 0-.146-.354L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293L8.354 1.146a.5.5 0 0 0-.708 0l-6 6A.5.5 0 0 0 1.5 7.5v7a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 .5-.5"/>
                    </svg>
                    <div x-show="!shrink">
                        <span class="text-lg font-bold">Home</span>
                    </div>
                </a></li>
                <li><a @click="shrink=true;showSearch=!showSearch">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 w-7 h-7">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                    </svg>
                    <div x-show="!shrink">
                        <span class="text-lg font-bold">Search</span>
                    </div>
                </a></li>
                <li><a @click="shrink=true;showCreate=!showCreate">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 w-7 h-7">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                    </svg>
                    <div x-show="!shrink">
                        <span class="text-lg font-bold">Create</span>
                    </div>
                </a></li>
                <li><a>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 w-7 h-7">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" />
                    </svg>
                    <div x-show="!shrink">
                        <span class="text-lg font-bold">Notifications</span>
                    </div>
                </a></li>
                <li><a href="/profile/{{$_SESSION['username']}}" class="{{request()->is('profile/'.$_SESSION['username']) ? 'pointer-events-none': ''}}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person w-7 h-7" viewBox="0 0 16 16">
                        <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6m2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0m4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4m-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10s-3.516.68-4.168 1.332c-.678.678-.83 1.418-.832 1.664z"/>
                    </svg>
                    <div x-show="!shrink">
                        <span class="text-lg font-bold">Profile</span>
                    </div>
                </a></li>
                @if($_SESSION['username']==='Connectify')
                    <li>
                        <a href="/reports">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 3v1.5M3 21v-6m0 0 2.77-.693a9 9 0 0 1 6.208.682l.108.054a9 9 0 0 0 6.086.71l3.114-.732a48.524 48.524 0 0 1-.005-10.499l-3.11.732a9 9 0 0 1-6.085-.711l-.108-.054a9 9 0 0 0-6.208-.682L3 4.5M3 15V4.5" />
                            </svg>

                            <div x-show="!shrink">
                                <span class="text-lg font-bold">Reports</span>
                            </div>
                        </a>
                    </li>
                @endif
        </ul>
        <div x-show="showSearch" @click.outside="shrink=false;showSearch=false;" x-cloak x-transition.origin.left class="fixed inset-y-0 left-[70px] w-96 overflow-y-scroll
            overflow-x-scroll shadow bg-white border rounded-r-2xl z-[5]">
            <template x-if="showSearch">
                <div x-cloak class="h-full">
                    <header class="sticky top-0 w-full bg-white py-2">
                        <h5 class="text-4xl font-bold my-4">Search</h5>
                        <input type="search" autocomplete="off" id="search" class="input input-bordered join-item border-0 outline-none w-full focus:outline-none bg-gray-100 rounded-lg hover:ring-0 focus:ring-0" placeholder="Search" />
                    </header>
                    <main>
                        <ul id="results" class="space-y-2 overflow-x-hidden"></ul>
                    </main>
                </div>
            </template>
        </div>
        <div x-show="showCreate" x-cloak x-transition.origin.left @click.outside="shrink=false;showCreate=false;" class="fixed inset-y-0 left-[70px] w-96 overflow-y-scroll overflow-x-scroll shadow bg-white border rounder-r-2xl z-[5]">
            <header class="top-0 w-full bg-white py-2">
                <h5 class="text-4xl font-bold my-4">Create</h5>
            </header>
            <main>
                <form action="/" method="post" enctype="multipart/form-data">
                    @csrf
                    <center>
                        <div id="counter">
                            0/100
                        </div>
                    </center>
                    <textarea name="content" id="txtInput" placeholder="What is happening?" maxlength="100" class="border outline-none w-full focus:outline-none bg-white-100 rounded-lg hover:ring-0 focus:ring-0 resize-none"></textarea>                    
                    <div class="flex items-center justify-center w-full pl-2">
                        <label for="dropzone-file" class="flex flex-col items-center justify-center w-full h-64 border-2 border-white-300 border-dashed rounded-lg cursor-pointer bg-white-50 dark:hover:bg-white-800 dark:bg-white-700 hover:bg-gray-100 dark:border-white-600 dark:hover:border-white-500 dark:hover:bg-white-600">
                            <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                <svg class="w-8 h-8 mb-4 text-white-500 dark:text-white-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2"/>
                                </svg>
                                <p class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span class="font-semibold">Click to upload</span> or drag and drop</p>
                                <p class="text-xs text-gray-500 dark:text-gray-400">SVG, PNG, JPG or GIF (MAX. 800x400px)</p>
                            </div>
                            <input id="dropzone-file" type="file" class="hidden" />
                        </label>
                    </div>
                    <center>
                        <button type="submit">Post</button>
                    </center>
                </form>
            </main>
        </div>
        <script>
            document.getElementById('txtInput').addEventListener('input', function(){
                const counter =document.getElementById('counter');
                counter.innerText = this.value.length+"/100";
            });

            $(document).on('input', '#search', function (e) {
                let searchText = e.target.value.trim();
                document.getElementById('results').innerHTML = '';
                let names = [];
                if(document.getElementById('results').innerHTML = '') names = [];
                $.ajax({
                    type: "GET",
                    url: `/search/${encodeURIComponent(searchText)}`,
                    success: function (resp) {
                        const users = resp.users;
                        users.forEach(function (user) {
                            if (!names.includes(user.Username))
                            {
                                names.push(user.Username)
                                document.getElementById('results').innerHTML += `
                                                                <li>
                                            <a href="/profile/${user.Username}">
                                                <div class="flex items-center gap-2">
                                                    <x-avatar class="w-10 h-10"/>
                                                    <div class="flex flex-col">
                                                        <span class="font-bold text-sm">
                                                            ${user.Username}
                                                        </span>
                                                    </div>
                                                </div>
                                            </a>
                                        </li>`;
                            }
                        });
                    },
                    error: function (xhr, status, error) {
                        console.error('Error:', error);
                    }
                });
            });
        </script>
    </div>