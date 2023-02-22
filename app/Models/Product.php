<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory, HasUuids;

    // const CREATED_AT = 'create_date';

    // protected $table = 'category';
    // protected $primaryKey = 'category_id';
    // public $incrementing = false;
    // protected $keyType = 'string';

    protected $primaryKey = 'category_id';
    protected $keyType = 'string';
    // public $timestamps = false; // neveda tuomet informcijos prie šitų langų, veda NULL
    protected $connection = 'sqlite'; // įrašys į kitą duomenų bazę - SQLITE
}
