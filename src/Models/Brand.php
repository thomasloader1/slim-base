<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Brand extends Model{

    protected $table = 'brands';
    protected $fillable = ['name','image','created_at','updated_at'];
    

}