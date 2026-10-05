<?php

namespace App\Models;

use App\Models\Traits\HasMultilingualFields;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bulletin extends Model
{
    use HasFactory, HasMultilingualFields;

    protected $fillable = [
        'issue_number',
        'published_date',
        'title',
        'summary',
        'highlights',
        'pdf_file',
        'is_published',
    ];

    protected $casts = [
        'title' => 'array',
        'summary' => 'array',
        'highlights' => 'array',
        'published_date' => 'date',
        'is_published' => 'boolean',
    ];
}
