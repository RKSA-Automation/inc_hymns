<?php
// app/Models/ApiDocumentation.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApiDocumentation extends Model
{
    use HasFactory;

    protected $table = 'api_documentations';
    protected $fillable = ['endpoint', 'description'];
}
