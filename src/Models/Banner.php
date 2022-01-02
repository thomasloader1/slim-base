<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\BannerType;

class Banner extends Model{

    protected $table = 'banners';
    protected $fillable = ['name','type','mobile','path_background','banner_title','banner_description','button_text','button_link','button_target','active','order'];

    protected $appends = ['type_details'];
    
    public function getTypeDetailsAttribute()
    {
        $detail = BannerType::where('id',$this->type)->first();
        return $detail;
    }
}