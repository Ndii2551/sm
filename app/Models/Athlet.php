<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Athlet extends Model
{
    use HasFactory;
    protected $table = 'athletes';
    public function submissions()
    {
        return $this->hasMany(Submission::class, 'athlet_id');
    }
    public function scores()
    {
        return $this->hasMany(Submission::class, 'athlet_id');
    }
    public function branches()
    {
        return $this->belongsTo(Branch::class, 'branch_id');
    }
}
