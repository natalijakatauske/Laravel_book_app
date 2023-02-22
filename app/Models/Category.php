<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory, SoftDeletes; // HasUuids - mano modelis generuos ID kaip stringus, o ne intus

    protected $fillable = [
        'name',
        'category_id',
        'enabled'
    ];
    
    protected $attributes = [
        'enabled' => false
    ];

    // One To Many sąryšis, kuris pagal category_id prie knygos sugebės išrišti informaciją
    public function books(): HasMany
    {
        return $this->hasMany(Book::class);
    }

    public function parentCategory(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function categories(): HasMany
    {
        return $this->hasMany(Category::class);
    }

    public function childrenCategories(): HasMany
    {
        return $this->hasMany(Category::class)->with('categories');
    }
}
