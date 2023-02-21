<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GiveBooksGenre extends Model
{
    protected $table='give_books_genre';
    use HasFactory;
    public function genres(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(GenreModel::class,'id','genre_id');
    }
}
