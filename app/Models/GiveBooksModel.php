<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GiveBooksModel extends Model
{
    use CrudTrait;
    protected $table='give_books';
    use HasFactory;
    public function giveBooks_genre(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(GiveBooksGenre::class,'book_id','id');
    }
    public function user(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(User::class,'id','user_id');
    }
    public function city(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(Cities::class,'id','city_id');
    }
    public function images(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(GiveBooksImages::class, 'give_book_id');
    }
    public function mainImage(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(GiveBooksImages::class, 'give_book_id');
    }
}
