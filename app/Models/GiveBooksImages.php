<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GiveBooksImages extends Model
{
    use CrudTrait;
    protected $table='give_books_images';
    use HasFactory;
}
