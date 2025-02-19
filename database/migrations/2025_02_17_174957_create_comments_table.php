<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentsTable extends Migration
{
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            // Karena movie/tv tidak ada di database, gunakan tmdb_id dan tipe (movie/tv)
            $table->unsignedBigInteger('commentable_id'); // Simpan TMDB id
            $table->string('commentable_type'); // "movie" atau "tv"
            $table->text('content');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    } 

    public function down()
    {
        Schema::dropIfExists('comments');
    }
}