<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CrossingBookModel extends Model
{
    use CrudTrait;

    protected  $table='crossing_book';

    use HasFactory;
    public function crossing()
    {
        return $this->belongsTo(CrossingModel::class,'crossing_id','id');
    }
}
