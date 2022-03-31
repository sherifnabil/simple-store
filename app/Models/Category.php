<?php

namespace App\Models;

use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['title'];

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(
            related: Product::class,
            table: 'category_products'
        )->withTimestamps();
    }
}
