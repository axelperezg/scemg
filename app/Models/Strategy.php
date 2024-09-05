<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Strategy extends Model
{
    use HasFactory;

    protected $fillable = [
        'anio',
        'partidaPresupuestal',
        'mision',
        'vision',
        'sector_id',
        'institution_id',
        'objetivoInstitucional',
        'objetivoEstrategiaComunicacion',
        'plan_id',
        'category_id',
        'subcategory_id',
    ];


    public function sector()
    {
        return $this->belongsTo(Sector::class);
    }

    public function institution()
    {
        return $this->belongsTo(Institution::class);
    }

    public function plan()
    {
        return $this->belongsTo(Plan::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function subcategory()
    {
        return $this->belongsTo(Subcategory::class);
    }
}
