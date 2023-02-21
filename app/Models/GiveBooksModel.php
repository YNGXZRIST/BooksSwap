<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GiveBooksModel extends Model
{
    protected $table='give_books';
    use HasFactory;
    public function giveBooks_genre()
    {
        return $this->hasMany(GiveBooksGenre::class,'book_id','id');
    }
    public function images(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(GiveBooksImages::class, 'give_book_id');
    }
    public function mainImage()
    {
        return $this->hasOne(GiveBooksImages::class, 'give_book_id');
    }
}
