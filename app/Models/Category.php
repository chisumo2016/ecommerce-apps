<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory;

    protected $casts = [
        'active' => 'boolean'
    ];

    public function  children():HasMany
    {
       return $this->hasMany(
           related: Category::class,
           foreignKey: 'parent_id'
       );
    }

    public function  parent():BelongsTo
    {
        return $this->belongsTo(
            related: Category::class,
            foreignKey: 'parent_id'
        );
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
