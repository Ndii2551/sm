<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SelectionRegist extends Model
{
    use HasFactory;
    public function tests()
    {
        return $this->hasMany(Test::class, 'selection_id');
    }
}
