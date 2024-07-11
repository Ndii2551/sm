<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Submission extends Model
{
    use HasFactory;
    public function athletes()
    {
        return $this->belongsTo(Athlet::class, 'athlet_id');
    }
    public function branches()
    {
        return $this->belongsTo(Branch::class, 'branch_id');
    }
}
