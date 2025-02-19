<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Watchlist - Cineflix</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <div class="w-full h-auto min-h-screen flex flex-col bg-develobe-800">
        @include('sidebar')
        @include('header')

        <!-- kategori -->
        <div class="w-full px-5 mt-6">
            <div class="flex space-x-4">
                <button id="all-tab" class="px-6 py-2 text-white rounded-lg bg-develobe-400 hover:bg-develobe-500 transition-colors">
                    All
                </button>
                <button id="movies-tab" class="px-6 py-2 text-white rounded-lg hover:bg-develobe-400 transition-colors">
                    Movies
                </button>
                <button id="tv-tab" class="px-6 py-2 text-white rounded-lg hover:bg-develobe-400 transition-colors">
                    TV Shows
                </button>
            </div>
        </div>

        <!-- Content Grid -->
        <div class="w-auto pl-5 pr-5 pt-6 pb-10 grid grid-cols-3 lg:grid-cols-5 gap-5" id="watchlistContent">
            @foreach($watchlist as $item)
                <div class="watchlist-item" data-type="{{ $item->type }}">
                    <div class="relative group">
                        <a href="/{{ $item->type }}/{{ $item->tmdb_id }}">
                            <div class="min-w-[232px] min-h-[428px] bg-develobe-700 drop-shadow-[0_0px_8px_rgba(0,0,0,0.25)] group-hover:drop-shadow-[0_0px_8px_rgba(0,0,0,0.5)] p-5 flex flex-col duration-200">
                                <div class="overflow-hidden">
                                    <img class="w-full h-[300px] group-hover:scale-125 duration-200" src="{{ $item->poster }}" />
                                </div>
                                <span class="font-inter font-bold text-xl text-white mt-4 line-clamp-1 group-hover:line-clamp-none">{{ $item->title }}</span>
                                <span class="font-inter text-sm text-white mt-1">{{ $item->type }}</span>
                            </div>
                        </a>
                        
                        <button 
                            class="absolute top-2 right-2 p-2 bg-black bg-opacity-50 rounded-full hover:bg-red-500 transition-colors group/tooltip"
                            onclick="removeFromWatchlist({{ $item->id }}, this)">
                            <span class="invisible group-hover/tooltip:visible absolute -top-8 left-1/2 -translate-x-1/2 w-28 bg-black bg-opacity-75 text-white text-xs rounded py-1 px-2">
                                Hapus Watchlist
                            </span>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                            </svg>
                        </button>
                    </div>
                </div>
            @endforeach
        </div>
        
        @include('footer')
    </div>

    <script>
        // Tab functionality
        const tabs = ['all-tab', 'movies-tab', 'tv-tab'];
        tabs.forEach(tabId => {
            document.getElementById(tabId).addEventListener('click', () => {
                // Reset all tabs
                tabs.forEach(id => document.getElementById(id).classList.remove('bg-develobe-400'));
                // Highlight selected tab
                document.getElementById(tabId).classList.add('bg-develobe-400');
                
                // Filter content
                const type = tabId.replace('-tab', '');
                filterContent(type);
            });
        });

        function filterContent(type) {
            const items = document.querySelectorAll('.watchlist-item');
            items.forEach(item => {
                if (type === 'all') {
            item.style.display = 'block';
        } else if (type === 'movies' && item.dataset.type === 'movie') {
            item.style.display = 'block';
        } else if (type === 'tv' && item.dataset.type === 'tv') {
            item.style.display = 'block';
        } else {
            item.style.display = 'none';
        }
    });
}

        function removeFromWatchlist(id, button) {
            fetch(`/watchlist/${id}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    button.closest('.watchlist-item').remove();
                }
            });
        }
    </script>
</body>
</html>