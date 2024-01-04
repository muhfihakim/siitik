<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vm extends Model
{
    use HasFactory;
    protected $table = 'vm';
    protected $guarded = [];
}
