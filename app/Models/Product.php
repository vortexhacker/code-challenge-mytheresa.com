<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Author: Ruphin Lobanga
 * Date: July 04, 2023
 * Email: ruphiny2j@gmail.com
 */

class Product extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function applyDiscount($discountPercentage)
    {
        $discountedPrice = $this->price - ($this->price * ($discountPercentage / 100));
        $this->price = $discountedPrice;
    }
}
