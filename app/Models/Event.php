<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

//Model é responsável pela interação entre as requisições do banco
//Basicamente é a entidade que vai fazer a conexão entre o banco e a aplicação por meio da ORM Eloquent 

class Event extends Model
{
    use HasFactory;
    
    //Este trecho de código diz que os itens de infraestrutura da checkbox é um Array, não uma String 
    protected $casts = [
        'items' => 'array'
    ];

    protected $dates = ['date'];

    protected $guarded = [];

    //Trecho responsável por dizer qual evento pertence a (belongsTo) qual usuário (usuário no singular (user))
    public function user() {
        return $this->belongsTo('App\Models\User');
    }

}
