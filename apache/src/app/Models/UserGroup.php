<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserGroup extends Model
{
    use HasFactory;

    // Define the table associated with the model
    protected $table = 'users_groups';

    // Define the fillable attributes if needed
    protected $fillable = [
        'user_id',
        'group_id',
    ];

    // Define any relationships if needed
}
