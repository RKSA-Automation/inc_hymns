<?php

// app/Models/GroupPermission.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GroupPermission extends Model
{
    use HasFactory;

    protected $fillable = [
        'group_id',
        'permission_id',
        'category_id',
        'accessrights',
    ];


    public function group()
    {
        return $this->belongsTo(Group::class);
    }

    public function permission()
    {
        return $this->belongsTo(Permission::class);
    }

    public function category()
    {
        return $this->belongsTo(PermissionCategory::class);
    }
}
