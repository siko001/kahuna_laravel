<?php

namespace App\Models;

use App\Models\Tag;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model {
    use HasFactory;

    protected $fillable = [
        'serialNumber',
        'type',
        'description',
        'imgURL'
    ];
    public function tags() {
        return $this->belongsToMany(Tag::class, 'assigns_tags');
    }


    public function technicians() {
        return $this->belongsToMany(Technician::class, 'product_technician');
    }
}
