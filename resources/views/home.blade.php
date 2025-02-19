<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cineflix</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <div class="w-full h-auto min-h-screen flex flex-col bg-develobe-800">
        <!--manggil header dan sidebar pake include-->

        @include('sidebar')
       @include('header')
       
    
       <!-- banner-->
        <div class="banner-responsive">
        <!--banner data-->
        @foreach($banner as $bannerItem)

        @php
        $bannerImage = "{$imageBaseURL}/original{$bannerItem->backdrop_path}";
        @endphp

        <div class="flex flex-row items-center w-full h-full relative slide">
            <!--image-->
        <img src="{{$bannerImage}}" class="absolute w-full h-full object-cover"/>
        <!--overlay-->
        <div class="w-full h-full absolute bg-black bg-opacity-40"></div>

        <div class="banner-content">
                <span class="banner-title">{{  $bannerItem->title }}</span>
                <span class="banner-description">{{  $bannerItem->overview }}</span>
                <a href="/movie/{{ $bannerItem->id }}" class="w-fit bg-develobe-400 text-white pl-3 pr-4 py-2 mt-5 font-inter text-sm flex flex-row rounded-full items-center hover:drop-shadow-lg duration-200">
                <svg class="mr-2" width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M8 5V19L19 12L8 5Z" fill="white" />
                </svg>
                <span>Detail</span>
            </a>
        </div>
    </div>

        @endforeach
        <!--Prev button-->
        <div class="absolute left-0 top-1/2 -translate-y-1/2 w-1/12 flex justify-center" onclick="moveSlide(-1)">
            <button class="bg-white p-3 rounded-full opacity-20 hover:opacity-100 duration-200">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M15 18L9 12L15 6" stroke="#1E1E1E" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>

            </button>
        </div>

        <!--Next button-->
        <div class="absolute right-0 top-1/2 -translate-y-1/2 w-1/12 flex justify-center" onclick="moveSlide(1)">
            <button class="bg-white p-3 rounded-full opacity-20 hover:opacity-100 duration-200 rotate-180">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M15 18L9 12L15 6" stroke="#1E1E1E" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>

            </button>
        </div>

        <!--Indikator-->
        <div class="absolute bottom-0 w-full mb-8">
            <div class="flex flex-row items-center justify-center">
                @for($pos = 1; $pos <= count($banner); $pos++)
                <div class="w-2.5 h-2.5 rounded-full mx-1 cursor-pointer dot" onclick="currentSlide({{$pos}})"></div>
                @endfor
            </div>
        </div>
    </div>

        <!-- Top 10 movie sectionnya -->
         <div class="content-section">
            <span class="section-title">Top 10 Movies</span>

            <div class="content-slider">
                @foreach ($topMovies as $movieItem)

                @php
                $original_date = $movieItem->release_date;
                $timestamp = strtotime($original_date);
                $movieYear = date("Y", $timestamp);

                $movieID = $movieItem->id;
                $movieTitle = $movieItem->title;
                $movieRating = $movieItem->vote_average * 10;
                $movieImage = "{$imageBaseURL}/w500{$movieItem->poster_path}";
                @endphp

            <a href="movie/{{$movieID}}" class="group">
                <div class="min-w-[232px] min-h-[428px] bg-develobe-700 drop-shadow-[0_0px_8px_rgba(0,0,0,0.25)] group-hover:drop-shadow-[0_0px_8px_rgba(0,0,0,0.5)] p-5 flex flex-col mr-8 duration-200">
                    <div class="overflow-hidden">
                        <img class="w-full h-[300px] group-hover:scale-125 duration-200" src="{{$movieImage}}" />
                    </div>

                    <span class="font-inter font-bold text-xl text-develobe-600 mt-4 line-clamp-1 group-hover:line-clamp-none">{{$movieTitle}}</span>
                    <span class="font-inter text-sm mt-1">{{$movieYear}}</span>

                    <div class="flex flex-row mt-1 items-center">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M18 21H8V8L15 1L16.25 2.25C16.3667 2.36667 16.4627 2.525 16.538 2.7C16.6127 2.925 16.65 3.11667 16.65 3.3V3.65L15.55 8H21C21.5333 8 22 8.2 22.4 8.6C22.8 9 23 9.46667 23 10V12C23 12.1167 22.9873 12.2417 22.962 12.375C22.9373 12.5083 22.9 12.6333 22.85 12.75L19.85 19.8C19.7 20.1333 19.45 20.4167 19.1 20.6C18.75 20.8833 18.3833 21 18 21ZM6 8V21H2V12H6Z" fill="#C7A66B"/>
                    </svg>
                    <span class="font-inter text-sm ml-1">{{$movieRating}}%</span>
                    </div>
                </div>
            </a>
            @endforeach
         </div>
    </div>

    <!-- Top 10 tv show -->
    <div class="content-section">
            <span class="section-title">Top 10 TV Shows</span>

            <div class="content-slider">
            @foreach($topTVShows as $tvShowsItem)

            @php
                $original_date = $tvShowsItem->first_air_date;
                $timestamp = strtotime($original_date);
                $tvShowsYear = date("Y", $timestamp);

                $tvShowsID = $tvShowsItem->id;
                $tvShowsTitle = $tvShowsItem->name;
                $tvShowsRating = $tvShowsItem->vote_average * 10;
                $tvShowsImage = "{$imageBaseURL}/w500{$tvShowsItem->poster_path}";
                @endphp
            
         


            <a href="/tv/{{$tvShowsID}}" class="group">
                <div class="min-w-[232px] min-h-[428px] bg-develobe-700 drop-shadow-[0_0px_8px_rgba(0,0,0,0.25)] group-hover:drop-shadow-[0_0px_8px_rgba(0,0,0,0.5)] p-5 flex flex-col mr-8 duration-200">
                    <div class="overflow-hidden">
                        <img class="w-full h-[300px] group-hover:scale-125 duration-200" src="{{$tvShowsImage}}" />
                    </div>

                    <span class="font-inter font-bold text-xl text-develobe-600 mt-4 line-clamp-1 group-hover:line-clamp-none">{{$tvShowsTitle}}</span>
                    <span class="font-inter text-sm mt-1">{{$tvShowsYear}}</span>

                    <div class="flex flex-row mt-1 items-center">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M18 21H8V8L15 1L16.25 2.25C16.3667 2.36667 16.4627 2.525 16.538 2.7C16.6127 2.925 16.65 3.11667 16.65 3.3V3.65L15.55 8H21C21.5333 8 22 8.2 22.4 8.6C22.8 9 23 9.46667 23 10V12C23 12.1167 22.9873 12.2417 22.962 12.375C22.9373 12.5083 22.9 12.6333 22.85 12.75L19.85 19.8C19.7 20.1333 19.45 20.4167 19.1 20.6C18.75 20.8833 18.3833 21 18 21ZM6 8V21H2V12H6Z" fill="#C7A66B"/>
                    </svg>
                    <span class="font-inter text-sm ml-1 text-develobe-600">{{$tvShowsRating}}%</span>
                    </div>
                </div>
            </a>
            @endforeach
         </div>
    </div>
    @include('footer')
</div>

    <script>
        let slideIndex = 1;
        showSlide(slideIndex);

        function showSlide(position){
            let index;
            const slidesArray = document.getElementsByClassName("slide");
            const dotsArray = document.getElementsByClassName("dot");

            //looping effect
            if(position > slidesArray.length){
                slideIndex = 1;
            }

            if (position < 1){
                slideIndex = slidesArray.length;
            }

            for (index = 0; index < slidesArray.length; index++){
                slidesArray[index].classList.add('hidden');
            }
            
            //show active slide
            slidesArray[slideIndex - 1].classList.remove('hidden');


            //buat remove acive status
            for (index = 0; index < dotsArray.length; index++){
                dotsArray[index].classList.remove('bg-develobe-400');
                dotsArray[index].classList.add('bg-white');
            }

            //set aktif stat
            dotsArray[slideIndex -1].classList.remove('bg-white');
            dotsArray[slideIndex -1].classList.add('bg-develobe-400');
        }

        function moveSlide(moveStep){
            showSlide(slideIndex += moveStep)
        }

        function currentSlide(position){
            showSlide(slideIndex = position);
        }
    </script>

</body>
</html>