<?php

namespace App\Models;

use App\Casts\PurifyHtml;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Product extends Model
{
    use HasFactory;

    protected $casts = [
        'active' => 'boolean',
        'featured' => 'boolean',
        'show_on_slider' => 'boolean',
        'description'=>PurifyHtml::class
    ];

    public  function  categories():BelongsToMany
    {
        return $this->belongsToMany(Category::class);
    }

    public  function  scopeRoot($builder)
    {
        return $builder->whereNull('parent_id');
    }

    public  function  scopeActive($builder)
    {
        return $builder->where('active', true);
    }

    public  function  scopeInActive($builder)
    {
        return $builder->where('active', false);
    }
}
