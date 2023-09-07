<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'tagline', 'overview', 'release_date'];
    protected $appends = ['average_rating', 'reviews_count'];

    public function moviesLists()
    {
        return $this->belongsToMany(MovieList::class, 'lists_movies', 'movie_id', 'list_id');
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function getAverageRatingAttribute()
    {
        return round($this->reviews()->avg('rating'),1);
    }

    public function getReviewsCountAttribute()
    {
        return $this->reviews()->count();
    }
}
