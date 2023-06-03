<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CrossingModel extends Model
{
    use CrudTrait;
    use HasFactory;

    protected $table = 'crossing';

    public const TYPE_LEFT = 1;
    public const TYPE_FOUND = 2;
    public const TYPE_TOOK = 3;
    public const TYPES_CROSSING = [
        self::TYPE_LEFT, self::TYPE_FOUND, self::TYPE_TOOK
    ];
    protected $fillable = [
        'id',
        'user_id',
        'author',
        'name',
        'isbn',
        'location',
        'location_description',
        'status',
        'city_id',
        'cover_url'
    ];
    public function crossings(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(CrossingBookModel::class,'crossing_id','id')->orderByDesc('id');
    }
    public function city(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(Cities::class, 'id', 'city_id');
    }

    public function user(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
