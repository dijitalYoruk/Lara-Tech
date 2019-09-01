<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Main_Category extends Model
{
    protected $table = "main_categories";
    protected $fillable = ["name"];

    public function sub_categories() {
        return $this->hasMany(Sub_Category::class, "main_category_id");
    }
}