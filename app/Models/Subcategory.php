<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;

class Subcategory extends Model
{
    use HasFactory;
    protected $fillable = [
        'sub_category_name','first_hour','additional_hour','category_id','category_name'
        ];
       
        // public function getCategory(){
        //     return $this->belongsTo(Category::class);
        // }
}