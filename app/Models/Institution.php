<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Institution extends Model
{
    use HasFactory;
    protected $fillable = ['sector_id','name','code'];
    
    public function sector() : BelongsTo {
        return $this->belongsTo(Sector::class);
    }
}
