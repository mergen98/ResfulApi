<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use function Symfony\Component\Translation\t;

class Product extends Model
{

    const AVAILABLE_PRODUCT = 'available';
    const UNAVAILABLE_PRODUCT = 'unavailable';

   protected $fillable = [
       'name',
       'description',
       'quantity',
       'status',
       'image',
       'seller_id',
       'slug'
    ];

   public function isavailable(){
       return $this->status == Product::AVAILABLE_PRODUCT;
   }

   public function seller(){
       return $this->belongsTo(Seller::class);
   }
   public function transactions(){
       return $this->hasMany(Transaction::class);
   }
   public function categories(){
       return $this->belongsToMany(Category::class);
   }
}
