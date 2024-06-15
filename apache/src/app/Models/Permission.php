<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description'];

    public function categories()
    {
        return $this->belongsToMany(PermissionCategory::class, 'permission_categories', 'permission_id', 'category_id');
    }
    
    

    public function groups()
    {
        return $this->belongsToMany(Group::class, 'permission_groups');
    }
}