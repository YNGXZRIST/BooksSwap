<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Swap extends Model
{
    use CrudTrait;
    use HasFactory;

    public const STATUS_CREATED = 1;
    public const STATUS_DELETED = 2;
    protected $table = 'swap';
    protected $fillable = [
        'id',
        'user_id',
        'given_book_author',
        'given_book_name',
        'given_book_description',
        'desired_book_author',
        'desired_book_name',
        'city_id',
        'status'
    ];

    public function city(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(Cities::class, 'id', 'city_id');
    }

    public function user(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
