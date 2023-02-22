<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Author extends Model
{
    use HasFactory;

    // protected $table = 'author'; //jeigu nenoriu per migraciją rename pavadinimq į authors

    protected $dates = ['birth_date'];

    protected $fillable = [
        'name',
        'last_name',
        'birth_date',
        'country',
    ];

    // public $name;
    // public $last_name;

    public function books(): HasMany
    {
        return $this->hasMany(Book::class);
        // return $this->belongsToMany(Book::class);
    }

    public function getFullNameAttribute(): string
    {
        return sprintf('%s %s (%s)', $this->name, $this->last_name, $this->country);
    }
}
