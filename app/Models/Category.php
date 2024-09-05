<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['plan_id','name'];

public function plan() : BelongsTo 
{
    return $this->belongsTo(Plan::class);
}

public function subcategories() : HasMany 
{
    return $this->hasMany(Subcategory::class);
}



}
