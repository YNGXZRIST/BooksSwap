<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SafeShelves extends Model
{
    use CrudTrait;
    use HasFactory;
    protected $table='safe_shelves';
}
