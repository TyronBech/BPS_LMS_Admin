<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Visitor extends Model
{
    protected $table = 'visitor';
    protected $primaryKey = 'visitor_id';
    protected $fillable = [
        'visitor_id',
        'email',
        'first_name',
        'middle_name',
        'last_name',
        'suffix',
        'school_org',
        'gender',
        'purpose',
        'created_at',
        'updated_at',
        'deleted_at'
    ];
}
