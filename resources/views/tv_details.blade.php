<html>
<head>
    <title>Cineflix</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
    <div class="w-full h-screen flex flex-col relative">
        @php
            $backdropPath = $tvData ? "{$imageBaseURL}/original{$tvData->backdrop_path}" : "";
        @endphp
        <!-- Background Image -->
        <img class="w-full h-screen absolute object-cover lg:object-fill" src="{{$backdropPath}}" />
        <div class="w-full h-screen absolute bg-black bg-opacity-60 z-10"></div>

        <!-- Header / Navigation -->
        <div class="w-full bg-transparent h-[96px] drop-shadow-lg flex flex-row items-center z-10">
            <div class="w-1/3 pl-5">
                <a href="/movies" class="uppercase text-base mx-5 text-white hover:text-develobe-400 transition-colors duration-100 font-inter">Movies</a>
                <a href="/tv-shows" class="uppercase text-base mx-5 text-white hover:text-develobe-400 duration-100 font-inter">TV Shows</a>
            </div>
            <div class="w-1/3 flex items-center justify-center">
                <a href="/" class="font-bold text-5xl font-quicksand text-white hover:text-develobe-400 duration-100">CINEFLIX</a>
            </div>
            <div class="w-1/3 flex flex-row justify-end pr-10">
                <a href="/search" class="group">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24px" height="24px">
                        <path d="M 13.261719 14.867188 L 15.742188 17.347656 C 15.363281 18.070313 15.324219 18.789063 15.722656 19.1875 L 20.25 23.714844 C 20.820313 24.285156 22.0625 23.972656 23.015625 23.015625 C 23.972656 22.058594 24.285156 20.820313 23.714844 20.25 L 19.191406 15.722656 C 18.789063 15.324219 18.070313 15.363281 17.347656 15.738281 L 14.867188 13.261719 Z M 8.5 0 C 3.804688 0 0 3.804688 0 8.5 C 0 13.195313 3.804688 17 8.5 17 C 13.195313 17 17 13.195313 17 8.5 C 17 3.804688 13.195313 0 8.5 0 Z M 8.5 15 C 4.910156 15 2 12.089844 2 8.5 C 2 4.910156 4.910156 2 8.5 2 C 12.089844 2 15 4.910156 15 8.5 C 15 12.089844 12.089844 15 8.5 15 Z"
                            class="fill-black group-hover:fill-develobe-400 duration-100"/>
                    </svg>
                </a>
            </div>
        </div>

        @php
            $title = "";
            $tagline = "";
            $year = "";
            $duration = "";
            $rating = 0;

            if ($tvData){
                $original_date = $tvData->first_air_date;
                $timestamp = strtotime($original_date);
                $year = date("Y", $timestamp);
                $rating = (int)($tvData->vote_average * 10);
                $title = $tvData->name;

                if ($tvData->tagline){
                    $tagline = $tvData->tagline;
                } else {
                    $tagline = $tvData->overview;
                }

                if ($tvData->episode_run_time){
                    $runtime = $tvData->episode_run_time[0];
                    $duration = "{$runtime}m / episode";
                }
            }

            // Rumus lingkaran: 2 * phi * r  (r = 32)
            $circumference = 2 * (22/7) * 32;
            $progressRating = $circumference - ($rating/100) * $circumference; 

            $trailerID = "";
            if (isset($tvData->videos->results)){
                foreach($tvData->videos->results as $item){
                    if (strtolower($item->type) == 'trailer'){
                        $trailerID = $item->key;
                    }
                }
            }
        @endphp

        <!-- Konten TV Details -->
        <div class="w-full h-full z-10 flex flex-col justify-center px-20">
            <span class="font-quicksand font-bold text-6xl mt-4 text-white">{{$title}}</span>
            <span class="font-inter italic text-2xl mt-4 text-white max-w-3xl line-clamp-5">{{$tagline}}</span>

            <div class="flex flex-row mt-4 items-center">
                <!-- Rating -->
                <div class="w-20 h-20 rounded-full flex items-center justify-center mr-4" style="background: #181A1B;">
                    <svg class="-rotate-90 w-20 h-20">
                        <circle style="color: #666666;" stroke-width="8" stroke="currentColor" fill="transparent" r="32" cx="40" cy="40"/>
                        <circle style="color: #C7A66B;" stroke-width="8" stroke-dasharray="{{$circumference}}" stroke-dashoffset="{{$progressRating}}" stroke-linecap="round" stroke="currentColor" fill="transparent" r="32" cx="40" cy="40"/>
                    </svg>
                    <span class="absolute font-inter font-bold text-xl text-white">{{$rating}}%</span>
                </div>
                <!-- Tahun -->
                <span class="font-inter text-xl text-white bg-transparent rounded-md border border-white p-2 mr-4">{{$year}}</span>
                <!-- Durasi -->
                @if ($duration)
                    <span class="font-inter text-xl text-white bg-transparent rounded-md border border-white p-2">{{$duration}}</span>
                @endif
            </div>

            <!-- Button Trailer -->
            @if ($trailerID)
                <button class="w-fit bg-develobe-700 text-white pl-4 pr-6 py-3 mt-5 font-inter text-xl flex flex-row rounded-lg items-center hover:drop-shadow-lg duration-200" onclick="showTrailer(true)">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M7 4.5C7 4.10218 7.214 3.72064 7.55279 3.55279C7.89157 3.38495 8.29779 3.42064 8.58579 3.64645L17.5858 10.6464C17.841 10.8335 18 11.1482 18 11.5C18 11.8518 17.841 12.1665 17.5858 12.3536L8.58579 19.3536C8.29779 19.5794 7.89157 19.615 7.55279 19.4472C7.214 19.2794 7 18.8978 7 18.5V4.5Z" fill="white"/>
                    </svg>
                    <span>Play Trailer</span>
                </button>
            @endif

            <button class="w-fit bg-develobe-700 text-white pl-4 pr-6 py-3 mt-5 font-inter text-xl flex flex-row rounded-lg items-center hover:drop-shadow-lg duration-200" onclick="showTVPlayer(true)">
                Watch Now
            </button>

            <button onclick="toggleWatchlist('{{ $tvData->id }}', '{{ $tvData->name }}', 'tv', '{{ $imageBaseURL }}/w500{{ $tvData->poster_path }}')" class="watchlist-btn w-fit bg-develobe-700 text-white pl-4 pr-6 py-3 mt-5 font-inter text-xl rounded-lg hover:drop-shadow-lg duration-200" data-id="{{ $tvData->id }}">
                Tambah Watchlist
            </button>
        </div>

        <!-- Trailer Section -->
        <div id="trailerWrapper" class="absolute z-10 w-full h-screen p-20 bg-black flex flex-col">
            <button class="ml-auto group mb-4" onclick="showTrailer(false)">
                <svg xmlns="http://www.w3.org/2000/svg" height="48" width="48" viewBox="0 0 48 48">
                    <path d="M12 12L36 36M36 12L12 36" stroke="white" stroke-width="4" stroke-linecap="round" stroke-linejoin="round" class="group-hover:stroke-develobe-400 duration-200"/>
                </svg>
            </button>
            <iframe id="youtubeVideo" class="w-full h-full" src="https://www.youtube.com/embed/{{$trailerID}}?enablejsapi=1" title="{{$tvData->name}}" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; webshare" allowfullscreen></iframe>
        </div>
    </div>

    <!-- Video Player Wrapper -->
    <div id="tvPlayerWrapper" class="absolute inset-0 z-50 w-full h-screen p-20 bg-black flex flex-col" style="display:none;">
        <button class="ml-auto group mb-4" onclick="showTVPlayer(false)">
            <svg xmlns="http://www.w3.org/2000/svg" height="48" width="48" viewBox="0 0 48 48">
                <path d="M12 12L36 36M36 12L12 36" stroke="white" stroke-width="4" stroke-linecap="round" stroke-linejoin="round" class="group-hover:stroke-develobe-400 duration-200"/>
            </svg>
        </button>
        <!-- Video Player -->
        <iframe id="tvIframe" class="w-full h-full" src="" title="TV Show Player" frameborder="0" allowfullscreen></iframe>
    </div>

    <!-- New Section for Episode Selection -->
    <div id="episodeSection" class="w-full p-5 bg-develobe-800 text-white" style="display:none;">
        <h2 class="text-2xl font-bold mb-4">Episodes</h2>
        @foreach($tvData->seasons as $season)
            <div class="mb-6">
                <h3 class="text-xl font-semibold mb-3">Season {{$season->season_number}}</h3>
                <div class="flex flex-wrap gap-3">
                    @for($i = 1; $i <= $season->episode_count; $i++)
                        <button 
                            onclick="changeEpisode({{$tvData->id}}, {{$season->season_number}}, {{$i}})"
                            class="px-4 py-2 bg-develobe-400 text-white rounded hover:bg-develobe-500 transition-colors">
                            Ep {{$i}}
                        </button>
                    @endfor
                </div>
            </div>
        @endforeach
    </div>

    <!-- Synopsis and Cast Section -->
    <div class="w-full p-5 bg-develobe-800 text-white">
        <!-- Synopsis -->
        <h2 class="text-2xl font-bold mb-4">Synopsis</h2>
        <p class="text-lg leading-relaxed">
            {{$tvData->overview}}
        </p>
        
        <!-- Cast Section -->
        <h2 class="text-2xl font-bold mb-4 mt-8">Cast</h2>
        <div class="flex overflow-x-auto space-x-4 pb-6">
            @foreach($tvData->credits->cast as $cast)
                @if($loop->index < 25)
                    <div class="flex-none w-48">
                        <div class="bg-develobe-900 rounded-lg overflow-hidden shadow-lg hover:shadow-develobe-400 transition duration-300">
                            <img class="w-full h-64 object-cover object-top" src="{{$imageBaseURL}}/w500{{$cast->profile_path}}" alt="{{$cast->name}}">
                            <div class="p-4">
                                <h3 class="font-bold text-lg mb-1">{{$cast->name}}</h3>
                                <p class="text-develobe-400">{{$cast->character}}</p>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>

        <!-- Komentar Section -->
<div class="w-full p-5 bg-develobe-800 text-white">
    <h2 class="text-2xl font-bold mt-8 mb-4">Komentar</h2>
    <!-- Tampilkan Daftar Komentar -->
    <div id="comments-section" class="mb-5">
        @if($comments->count())
            @foreach ($comments as $comment)
                <div id="comment-{{ $comment->id }}" class="mb-3 border-b border-gray-600 pb-2 flex justify-between items-center">
                    <div>
                        <span class="font-bold">{{ $comment->user->name }}</span>
                        <p>{{ $comment->content }}</p>
                        <small class="text-gray-400">{{ $comment->created_at->diffForHumans() }}</small>
                    </div>
                    @if(auth()->id() == $comment->user->id)
                        <button onclick="deleteComment({{ $comment->id }})" class="ml-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-red-500 hover:text-red-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5-4h4a1 1 0 011 1v1H9V4a1 1 0 011-1z" />
                            </svg>
                        </button>
                    @endif
                </div>
            @endforeach
        @else
            <p class="text-gray-300">Belum ada komentar.</p>
        @endif
    </div>
    <!-- Form Input Komentar -->
    <form method="POST" action="{{ route('tv.comment', $tvData->id) }}">
        @csrf
        <textarea name="content" rows="3" class="w-full p-2 mt-3 rounded bg-gray-700 text-white" placeholder="Tulis komentar..." required></textarea>
        <button type="submit" class="mt-2 px-4 py-2 bg-blue-500 text-white rounded">Kirim Komentar</button>
    </form>
</div>

    @include('footer')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" 
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" 
        crossorigin="anonymous">
    </script>
    <script>
        function deleteComment(commentId) {
    Swal.fire({
        title: 'Yakin mau hapus komentar?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d20000',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Ya, hapus!',
        cancelButtonText: 'Batal',
        background: '#1a1a1a',
        color: '#fff'
    }).then((result) => {
        if(result.isConfirmed) {
            fetch(`/comment/${commentId}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    document.getElementById(`comment-${commentId}`).remove();
                    Swal.fire({
                        title: 'Komentar dihapus!',
                        icon: 'success',
                        background: '#1a1a1a',
                        color: '#fff',
                        timer: 1500,
                        showConfirmButton: false
                    });
                } else {
                    Swal.fire({
                        title: 'Gagal menghapus komentar.',
                        icon: 'error',
                        background: '#1a1a1a',
                        color: '#fff'
                    });
                }
            });
        }
    });
}

        function toggleWatchlist(tmdbId, title, type, poster) {
            const button = document.querySelector(`.watchlist-btn[data-id="${tmdbId}"]`);
            const isSaved = button.textContent.trim() === 'Hapus dari Watchlist';

            if (isSaved) {
                // Remove from watchlist
                fetch(`/watchlist/${tmdbId}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'Content-Type': 'application/json',
                        'Accept': 'application/json'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        button.textContent = 'Tambah Watchlist';
                    }
                });
            } else {
                // Add to watchlist
                fetch('/watchlist', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'Content-Type': 'application/json',
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({
                        tmdb_id: tmdbId,
                        title: title,
                        type: type,
                        poster: poster
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        button.textContent = 'Hapus dari Watchlist';
                    }
                });
            }
        }

        function checkWatchlistStatus(tmdbId) {
            fetch(`/watchlist/check/${tmdbId}`)
                .then(response => response.json())
                .then(data => {
                    const button = document.querySelector(`.watchlist-btn[data-id="${tmdbId}"]`);
                    if (data.inWatchlist) {
                        button.textContent = 'Hapus dari Watchlist';
                    }
                });
        }

        // Initialize when page loads
        document.addEventListener('DOMContentLoaded', function() {
            checkWatchlistStatus('{{ $tvData->id }}');
        });

        function showTrailer(isVisible){
            if(isVisible){
                $("#trailerWrapper").show();
                $("#tvPlayerWrapper").hide();
            } else {
                $("#youtubeVideo")[0].contentWindow.postMessage('{"event":"command", "func":"' + 'stopVideo' + '","args":""}', '*');
                $("#trailerWrapper").hide();
            }
        }

        function showTVPlayer(isVisible){
            if(isVisible){
                $("#tvPlayerWrapper").show();
                $("#episodeSection").show();
                $("#trailerWrapper").hide();
                // Load first episode by default
                changeEpisode({{$tvData->id}}, 1, 1);
            } else {
                $("#tvIframe").attr('src', ''); // Clear the iframe source
                $("#tvPlayerWrapper").hide();
                $("#episodeSection").hide();
            }
        }

        function changeEpisode(tvId, season, episode) {
            $("#tvIframe").attr('src', `https://vidsrc.me/embed/tv?tmdb=${tvId}&season=${season}&episode=${episode}`);
        }

        // Hide elements on page load
        $(document).ready(function() {
            $("#trailerWrapper").hide();
            $("#tvPlayerWrapper").hide();
        });
    </script>
</body>
</html>