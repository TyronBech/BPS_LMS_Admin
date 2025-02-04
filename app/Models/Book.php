<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Book extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'book';
    protected $primaryKey = 'book_id';
    protected $fillable = [
        'book_id',
        'accession',
        'call_number',
        'title',
        'authors',
        'edition',
        'place_of_publication',
        'publisher',
        'copyrights',
        'remarks',
        'category_id',
        'cover_image',
        'digital_copy_url',
        'created_at',
        'updated_at'
    ];
}
