<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ThemeBooksModel extends Model
{
    use CrudTrait;
    protected $table='themes';
    use HasFactory;
}
