<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegisteredProduct extends Model {
    use HasFactory;
    protected $table = 'registered_products';

    protected $fillable = [
        'user_id',
        'product_id',
        'serialNumber',
        'type',
        'description',
        'imgURL',
    ];
    // Define the relationships with other models
    public function user() {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function product() {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }
}
