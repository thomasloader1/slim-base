<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model{

    protected $table = 'product_images';
    protected $fillable = ['path','product_id','created_at','updated_at','size','img_order'];

}