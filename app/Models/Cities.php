<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cities extends Model
{
    use CrudTrait;
    protected $table='cities';
    protected $fillable=['name','id'];
    use HasFactory;
}
