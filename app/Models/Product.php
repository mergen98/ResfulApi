<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use function Symfony\Component\Translation\t;

class Product extends Model
{

    use SoftDeletes;
    protected $dates = ['deleted_at'];
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
    protected $hidden = [
        'pivot'
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
