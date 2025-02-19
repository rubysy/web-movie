<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Watchlist extends Model
{
    protected $fillable = [
        'user_id',
        'tmdb_id',
        'title',
        'type',
        'poster'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}