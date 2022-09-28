<?php

namespace App\Models;

use App\Enums\PersonTitle;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    use HasFactory;

    /**
     * @var array<string>
     */
    protected $fillable = [
        'title',
        'first_name',
        'initial',
        'last_name',
    ];

    protected $casts = [
        'title' => PersonTitle::class,
    ];
}
