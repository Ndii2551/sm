<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Test extends Model
{
    use HasFactory;
    public function selection_regists()
    {
        return $this->belongsTo(SelectionRegist::class, 'selection_id');
    }
}
