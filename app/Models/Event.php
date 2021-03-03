<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

//Model é responsável pela interação entre as requisições do banco
//Basicamente é a entidade que vai fazer a conexão entre o banco e a aplicação por meio da ORM Eloquent 

class Event extends Model
{
    use HasFactory;
}
