<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = ['name', 'date', 'category_id','image'];

    public function Category(){
        return $this->belongsTo(Category::class);
    }
}
