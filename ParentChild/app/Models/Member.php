<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;

    public $fillable = ['name', 'parent_id'];

    public function  childs()
    {
        return $this->hasMany(Member::class, 'parent_id');
    }

    public function scopeParent($query)
    {
        return $query->where('parent_id', '0');
    }
}
