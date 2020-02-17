<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Fruit;

class FruitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $frutta = Fruit::all();
        return view('fruits.index', ["fruits" => $frutta]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('fruits.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $form_data = $request->all();
         $fruit= new Fruit();
         // $fruit->name=$form_data['name'];
         // $fruit->peso=$form_data['peso'];
         // $fruit->varieta=$form_data['varieta'];
         $fruit->fill($form_data);
         $fruit->save();
         return redirect()->route('fruits.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Fruit $fruit)
    {
        // invece di mettere $id tra parentesi gli diciamo cosa vogliamo tipizzando..lui capisce che vogliamo un Fruit prchè abbiamo messo la classe Fruit, poi vede un numero al posto di $fruit che è l id è lui capisce...
        // ->get() avrebbe restituito una collection con dentro una cosa sola, invece first restituisce l oggetto richiesto
        // $frutto = Fruit::where('id', $id)->first();
        // ma il migliore da usare per trovare qualcosa con l id è find che fa tutto lui
        // $frutto = Fruit::find($id);
        return view('fruits.show', ['fruit'=> $fruit]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Fruit $fruit)
    {
        return view('fruits.edit', ['fruit'=> $fruit]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Fruit $fruit /* oppure $id */)
    {
        // $fruit = Fruit::find($id);
        $form_data = $request->all();
        $fruit->update($form_data);
        return redirect()->route('fruits.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Fruit $fruit)
    {
        $fruit->delete();
        return redirect()->route('fruits.index');
    }
}
