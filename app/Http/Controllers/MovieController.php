<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Comment;

class MovieController extends Controller
{

    
    public function index(){
        $baseURL = env('MOVIE_DB_BASE_URL');
        $imageBaseURL = env('MOVIE_DB_IMAGE_BASE_URL');
        $apiKey = env('MOVIE_DB_API_KEY');
        $MAX_BANNER = 3;
        $MAX_MOVIE_ITEM = 10;
        $MAX_TV_SHOWS_ITEM = 10; 

        //Hit API Banner
        $bannerResponse = Http::get("{$baseURL}/trending/movie/week",  [
            'api_key' => $apiKey,
        ]);

        //Prepare variabel
        $bannerArray = [];

        //Check API response
        if ($bannerResponse->successful()) {
            //Check data is null or not
            $resultArray = $bannerResponse->object()->results;

            if (isset($resultArray)){
                //Looping response data
                foreach ($resultArray as $item){
                    //save response data to new variable
                    array_push ($bannerArray, $item);

                    //Max 3 item
                    if (count($bannerArray) == $MAX_BANNER){
                        break;
                    }
                }
            }
        }

         //Hit API top10
         $topMoviesResponse = Http::get("{$baseURL}/movie/top_rated",  [
            'api_key' => $apiKey,
        ]);

        // prepare variabel
        $topMoviesArray = [];

        // cek api response
        if ($topMoviesResponse->successful()) {
            // cek data is null or not
            $resultArray = $topMoviesResponse->object()->results;
            if (isset($resultArray)){
                // looping response data
                foreach ($resultArray as $item){
                    // save response data to new variable
                    array_push ($topMoviesArray, $item);

                    // max 10 item
                    if (count($topMoviesArray) == $MAX_MOVIE_ITEM){
                        break;
                    }
                }
            }
        }

         //Hit API top10 tv show
         $topTVShowResponse = Http::get("{$baseURL}/tv/top_rated",  [
            'api_key' => $apiKey,
        ]);

        // prepare variabel
        $topTVShowsArray = [];

        // cek api response
        if ($topTVShowResponse->successful()) {
            // cek data is null or not
            $resultArray = $topTVShowResponse->object()->results;
            if (isset($resultArray)){
                // looping response data
                foreach ($resultArray as $item){
                    // save response data to new variable
                    array_push ($topTVShowsArray, $item);

                    // max 10 item
                    if (count($topTVShowsArray) == $MAX_TV_SHOWS_ITEM){
                        break;
                    }
                }
            }
        }



        return view('home', [
            'baseURL' => $baseURL,
            'imageBaseURL' => $imageBaseURL,
            'apiKey' => $apiKey,
            'banner' => $bannerArray,
            'topMovies' => $topMoviesArray,
            'topTVShows' => $topTVShowsArray,
        ]);
    }

    public function movies(){
        $baseURL = env('MOVIE_DB_BASE_URL');
        $imageBaseURL = env('MOVIE_DB_IMAGE_BASE_URL');
        $apiKey = env('MOVIE_DB_API_KEY');
        $sortBy ="popularity.desc";
        $page = 1;
        $minimalVoter = 100;

        $movieResponse = Http::get("{$baseURL}/discover/movie", [
            'api_key'=> $apiKey,
            'sort_by' => $sortBy,
            'vote_count.gte' => $minimalVoter,
            'page' => $page
        ]);

        $movieArray = [];

        if ($movieResponse->successful()) {
            // cek data is null or not
            $resultArray = $movieResponse->object()->results;
            if (isset($resultArray)){
                // looping response data
                foreach ($resultArray as $item){
                    // save response data to new variable
                    array_push ($movieArray, $item);
                }
            }
        }

        return view('movie', [
            'baseURL' => $baseURL,
            'imageBaseURL' => $imageBaseURL,
            'apiKey' => $apiKey,
            'movies' => $movieArray,
            'sortBy' => $sortBy,
            'page' => $page,
            'minimalVoter' => $minimalVoter
        ]);
    }
    
    public function tvShows(){
        $baseURL = env('MOVIE_DB_BASE_URL');
        $imageBaseURL = env('MOVIE_DB_IMAGE_BASE_URL');
        $apiKey = env('MOVIE_DB_API_KEY');
        $sortBy ="popularity.desc";
        $page = 1;
        $minimalVoter = 100;

        $tvResponse = Http::get("{$baseURL}/discover/tv", [
            'api_key'=> $apiKey,
            'sort_by' => $sortBy,
            'vote_count.gte' => $minimalVoter,
            'page' => $page
        ]);

        $tvArray = [];

        if ($tvResponse->successful()) {
            // cek data is null or not
            $resultArray = $tvResponse->object()->results;
            if (isset($resultArray)){
                // looping response data
                foreach ($resultArray as $item){
                    // save response data to new variable
                    array_push ($tvArray, $item);
                }
            }
        }

        return view('tv', [
            'baseURL' => $baseURL,
            'imageBaseURL' => $imageBaseURL,
            'apiKey' => $apiKey,
            'tvShows' => $tvArray,
            'sortBy' => $sortBy,
            'page' => $page,
            'minimalVoter' => $minimalVoter
        ]);
    }
    
    
    public function search() {
        $baseURL = env('MOVIE_DB_BASE_URL');
        $imageBaseURL = env('MOVIE_DB_IMAGE_BASE_URL');
        $apiKey = env('MOVIE_DB_API_KEY');
    
        return view('search', [
            'baseURL' => $baseURL,
            'imageBaseURL' => $imageBaseURL,
            'apiKey' => $apiKey,
        ]);
    }

    
    public function movieDetails($id){
        $baseURL = env('MOVIE_DB_BASE_URL');
        $imageBaseURL = env('MOVIE_DB_IMAGE_BASE_URL');
        $apiKey = env('MOVIE_DB_API_KEY');

        $response = Http::get("{$baseURL}/movie/{$id}", [
            'api_key' => $apiKey,
            'append_to_response' => 'videos,credits'
        ]);

        $movieData = null;

        if ($response->successful()){
            $movieData = $response->object();
        }

        // Ambil komentar yang terkait dengan movie (berdasarkan TMDB id)
        $comments = Comment::with('user')
        ->where('commentable_type', 'movie')
        ->where('commentable_id', $id)
        ->orderBy('created_at', 'desc')
        ->get();

        return view('movie_details', [
            'baseURL' => $baseURL,
            'imageBaseURL' => $imageBaseURL,
            'apiKey' => $apiKey,
            'movieData' => $movieData,
            'comments' => $comments,
        ]);
    }

    public function tvDetails($id){
        $baseURL = env('MOVIE_DB_BASE_URL');
        $imageBaseURL = env('MOVIE_DB_IMAGE_BASE_URL');
        $apiKey = env('MOVIE_DB_API_KEY');

        $response = Http::get("{$baseURL}/tv/{$id}", [
            'api_key' => $apiKey,
            'append_to_response' => 'videos,credits'
        ]);

        $tvData = null;

        if ($response->successful()){
            $tvData = $response->object();
        }

         // Ambil komentar untuk TV
        $comments = Comment::with('user')
        ->where('commentable_type', 'tv')
        ->where('commentable_id', $id)
        ->orderBy('created_at', 'desc')
        ->get();

        return view('tv_details', [
            'baseURL' => $baseURL,
            'imageBaseURL' => $imageBaseURL,
            'apiKey' => $apiKey,
            'tvData' => $tvData,
            'comments' => $comments,
        ]);
    }

    public function storeMovieComment(Request $request, $id)
{
    $request->validate([
        'content' => 'required|string'
    ]);

    Comment::create([
        'user_id'         => auth()->id(),
        'commentable_id'  => $id,           // TMDB movie id
        'commentable_type'=> 'movie',
        'content'         => $request->content,
    ]);

    return redirect()->back()->with('success', 'Komentar berhasil ditambahkan.');
}

    public function storeTVComment(Request $request, $id)
{
    $request->validate([
        'content' => 'required|string'
    ]);

    Comment::create([
        'user_id'         => auth()->id(),
        'commentable_id'  => $id,           // TMDB tv id
        'commentable_type'=> 'tv',
        'content'         => $request->content,
    ]);

    return redirect()->back()->with('success', 'Komentar berhasil ditambahkan.');
}

    public function deleteComment($id)
{
    $comment = Comment::findOrFail($id);

    // Pastikan hanya pemilik komentar atau admin yang bisa menghapus komentar
    if (auth()->id() == $comment->user_id) {
        $comment->delete();
        return response()->json(['success' => true]);
    }

    return response()->json(['success' => false], 403);
}

    public function getTVStreamingLink($id, $season, $episode)
{
    $vidsrcURL = "https://vidsrc.me/embed/tv?tmdb=$id&season=$season&episode=$episode";
    return response()->json(['streaming_url' => $vidsrcURL]);
}

    public function getStreamingLink($id)
{
    $vidsrcURL = "https://vidsrc.me/embed/movie/$id"; // ID diambil dari TMDB
    return response()->json(['streaming_url' => $vidsrcURL]);
}

}
