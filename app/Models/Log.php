<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Log extends Model
{
    use HasFactory;
    protected $table = 'userlogs';
    protected $primaryKey = 'log_id';
    protected $fillable = [
        'user_id',
        'visitor_id',
        'timestamp',
        'actions',
        'created_at',
        'updated_at'
    ];
}
