<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\user;
use App\Models\Categoria;


class Articolo extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome',
        'descrizione',
        'prezzo',
        'immagine',
    ];



    public function user(){
        return $this->belongsTo('App\User');
    }

    public function categoria(){

        //return $this->hasMany(Categoria::class);
        return $this->belongsToMany(Categoria::class, 'articolo_categoria', 'categoria_id', 'articolo_id', );
    }
}
