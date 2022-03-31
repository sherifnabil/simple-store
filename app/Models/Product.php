<?php

namespace App\Models;

use App\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'price',
        'active',
        'stock'
    ];

    protected $casts = [
        'price' =>  'integer',
        'active'=>  'boolean',
        'stock' =>  'integer',
    ];

    public function scopeActive($query)
    {
        $query->where('active', true);
    }

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(
            related: Category::class,
            table: 'category_products'
        )->withTimestamps();
    }
}
