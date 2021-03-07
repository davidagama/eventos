<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Event;
use App\Models\User;

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

        $user = auth()->user();
        $event->user_id = $user->id;

        $event->save();

        //Este comando é responsavel por, após o envio dos dados do formulário pro BD,
        //exibir a mensagem de "Evento criado com sucesso!" na home pro usuário.
        return redirect('/')->with('msg', 'Evento criado com sucesso!');
    }

    public function show($id)
    {

        $event = Event::findOrFail($id);

        $eventOwner = User::where('id', $event->user_id)->first()->toArray();

        return view('events.show', ['event' => $event, 'eventOwner' => $eventOwner]);
    }

    public function dashboard() {

        $user = auth()->user();

        $events = $user->events;

        return view('events.dashboard', ['events' => $events]);
    }

    public function destroy($id) {

        Event::findOrFail($id)->delete();

        return redirect('/dashboard')->with('msg', 'Evento excluído com sucesso!');
        
    }
    
    //Nesta function, basicamente resgatamos dados do banco e enviamos para a view chamada edit para os dados serem atualizados
    public function edit($id) {

        $event = Event::findOrFail($id);

        return view('events.edit', ['event' => $event]);

    }

    //Nesta function, os dados de um reg. são de fato atualizados no BD
    public function update(Request $request) {

        $data = $request->all();

        if ($request->hasFile('image') && $request->file('image')->isValid()) {

            $requestImage = $request->image;

            $extension = $requestImage->extension();

            $ImageName = md5($requestImage->getClientOriginalName() . strtotime("now")) . "." . $extension;

            $requestImage->move(public_path('img/events'), $ImageName);

            $data['image'] = $ImageName;
        }

        Event::findOrFail($request->id)->update($data);
        
        return redirect('/dashboard')->with('msg', 'Evento editado com sucesso!');

    }

}
