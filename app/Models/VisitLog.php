<?php

// app/Models/VisitLog.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VisitLog extends Model
{
    public $timestamps = false;

    protected $fillable = ['page', 'ip_address', 'visited_at'];
}
