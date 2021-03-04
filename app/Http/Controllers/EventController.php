<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Event;

//Geralmente os controllers concentram a maior parte da lógica da aplicação.
//Tem o papel de enviar e esperar resposta do BD.
//Controllers Também recebem e enviam alguma resposta para as views

class EventController extends Controller
{

    public function index()
    {
        $search = request('search');

        if($search){

            $events = Event::where([
                ['title', 'like', '%'.$search.'%']
            ])->get();

            } else {
            $events = Event::all();            
        }

        return view('welcome', ['events' => $events, 'search' => $search]);
    }

    public function create()
    {
        return view('events.create');
    }


    public function open()
    {
        return view('contact');
    }

    public function store(Request $request)
    {

        $event = new Event; // Nesta linha, foi instanciada a classe "Event" do nosso Model 

        $event->title = $request->title;
        $event->date = $request->date;
        $event->city = $request->city;
        $event->private = $request->private;
        $event->description = $request->description;
        $event->items = $request->items;

        //Image Upload (trecho de código responsável por receber as imagens do formulário e enviar pro BD).
        //As imagens são salvas no BD com um nome diferente do nome original delas.
        if ($request->hasFile('image') && $request->file('image')->isValid()) {

            $requestImage = $request->image;

            $extension = $requestImage->extension();

            $ImageName = md5($requestImage->getClientOriginalName() . strtotime("now")) . "." . $extension;

            $requestImage->move(public_path('img/events'), $ImageName);

            $event->image = $ImageName;
        }

        $event->save();

        //Este comando é responsavel por, após o envio dos dados do formulário pro BD,
        //exibir a mensagem de "Evento criado com sucesso!" na home pro usuário.
        return redirect('/')->with('msg', 'Evento criado com sucesso!');
    }

    public function show($id)
    {

        $event = Event::findOrFail($id);

        return view('events.show', ['event' => $event]);
    }
}
