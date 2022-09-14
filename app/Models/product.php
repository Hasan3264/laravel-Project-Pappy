<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class product extends Model
{

    use HasFactory;
    protected $guarded = ['id'];

    function to_inventoryes(){
        return $this->hasmany(Inventory::class, 'product_id');
    }
}
