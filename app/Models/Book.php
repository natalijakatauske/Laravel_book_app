<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Book extends Model
{

    use HasFactory;

    // protected $table = 'books';

    protected $fillable = [
        'name',
        'page_count',
        // 'author_id',
        'category_id',
    ];

    protected $with = [
        'category',
        'authors',
    ];


    public function authors(): BelongsToMany
    {
        return $this->belongsToMany(Author::class);
    }

    // Sąryšis su categorija, per category_id
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}

