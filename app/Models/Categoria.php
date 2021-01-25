<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Articolo;

class Categoria extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome',
    ];

    public function articolo(){
        //return $this->belongsTo(Articolo::class);
        return $this->belongsToMany(Articolo::class, 'articolo_categoria', 'articolo_id', 'categoria_id');
    }
}
