<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Product extends Model{

    protected $table = 'products';
    protected $fillable = ['name','price','currency','description','weight','dimention','bonus','image','created_at','updated_at','category_id','brand_id','shipping_height','shipping_width','shipping_weight','shipping_length'];
    
    protected $appends = ['images','category','brand'];
    
    public function getImagesAttribute()
    {
        $detail = ProductImage::where('product_id',$this->id)->orderBy('img_order','asc')->get();
        return $detail;
    }

    public function getCategoryAttribute()
    {
        $detail = Category::where('id',$this->category_id)->first();
        return $detail;
    }

    public function getBrandAttribute()
    {
        $detail = Brand::where('id',$this->brand_id)->first();
        return $detail;
    }

}