<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    use HasFactory;
    protected $guarded = [
        'id',
    ];
    public function submissions()
    {
        return $this->hasMany(Submission::class, 'branch_id');
    }
    public function athletes()
    {
        return $this->hasMany(Athlet::class, 'branch_id');
    }
}
