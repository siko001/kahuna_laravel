<?php

namespace App\Models;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Technician extends Model implements Authenticatable {
    use Notifiable;


    protected $fillable = [
        'fullname',
        'email',
        'phone',
        'password',
    ];
    // Implement the required methods from Authenticatable
    public function getAuthIdentifierName() {
        return 'id';
    }

    public function getAuthIdentifier() {
        return $this->getKey();
    }

    public function getAuthPassword() {
        // Return the password field of the technician model
        return $this->password;
    }

    public function getRememberToken() {
        return null; // Not using remember token
    }

    public function setRememberToken($value) {
        // Not using remember token
    }

    public function getRememberTokenName() {
        return null; // Not using remember token
    }

    // Define the relationship with products
    public function products() {
        return $this->belongsToMany(Product::class, 'product_technician');
    }
}
