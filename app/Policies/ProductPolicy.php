<?php

namespace App\Policies;

use App\Models\Product;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ProductPolicy
{

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Product $product): bool
    {
        if ($user->id != $product->creator_id){
            return  false;
        }
        if ($user->can('edit product')){
            return  true;
        }
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Product $product): bool
    {
        if ($user->id != $product->creator_id){
            return  false;
        }
        if ($user->can('delete product')){
            return  true;
        }
    }

}
