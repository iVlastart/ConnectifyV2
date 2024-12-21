    <div class="drawer-side" x-data="{
        shrink:false,
        showSearch: false
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
                <li><a @click="shrink=!shrink;showSearch=!showSearch">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 w-7 h-7">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                    </svg>
                    <div x-show="!shrink">
                        <span class="text-lg font-bold">Search</span>
                    </div>
                </a></li>
                <li><a>
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
                <li><a>
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person w-7 h-7" viewBox="0 0 16 16">
                        <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6m2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0m4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4m-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10s-3.516.68-4.168 1.332c-.678.678-.83 1.418-.832 1.664z"/>
                    </svg>
                    <div x-show="!shrink">
                        <span class="text-lg font-bold">Profile</span>
                    </div>
                </a></li>
        </ul>
        <div x-show="shrink" @click.outside="shrink=false;showSearch=false;" x-cloak x-transition.origin.left class="fixed inset-y-0 left-[70px] w-96 overflow-y-scroll
            overflow-x-scroll shadow bg-white border rounded-r-2xl z-[5]">
            <template x-if="showSearch">
                <div x-cloak class="h-full">
                    <header class="sticky top-0 w-full bg-white py-2">
                        <h5 class="text-4xl font-bold my-4">Search</h5>
                        <form action="/" method="post">
                            @csrf
                            <div class="join w-full">
                                <input type="search" name="search" class="input input-bordered join-item border-0 outline-none w-full focus:outline-none bg-gray-100 rounded-lg hover:ring-0 focus:ring-0" placeholder="Search" />
                                <button type="submit" class="btn join-item rounded-r-full">Search</button>
                            </div>
                        </form>
                    </header>
                    <main>
                        
                    </main>
                </div>
            </template>
        </div>
    </div>
