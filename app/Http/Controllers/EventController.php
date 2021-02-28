<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Event;

//Geralmente os controllers concentram a maior parte da lógica da aplicação.

class EventController extends Controller
{

    public function index()
    {
        $events = Event::all();

        return view('welcome', ['events' => $events]);
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

        $event = new Event;

        $event->title = $request->title;
        $event->city = $request->city;
        $event->private = $request->private;
        $event->description = $request->description;

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
