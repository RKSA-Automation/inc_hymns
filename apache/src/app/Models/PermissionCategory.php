<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PermissionCategory extends Model
{
    use HasFactory;

    protected $table = 'permission_categories'; // Specify the table name

    protected $fillable = ['permission_id', 'category_id', 'name', 'description'];

    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'permission_categories', 'category_id', 'permission_id');
    }

    public function groups()
    {
        return $this->belongsToMany(Group::class, 'permission_groups');
    }
}
