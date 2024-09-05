<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Register extends Model
{
    use HasFactory;

    protected $fillable = ['area','sector_id','institution_id','type','media','campaign','version','coverage','input_document','date_document','code','anio',];

    protected $casts = [

        'coverage' => 'array',    

    ];

    public function sector() : BelongsTo {
        return $this->belongsTo(Sector::class);
    }
    
    public function institution() : BelongsTo {
        return $this->belongsTo(Institution::class);
    }
}
