<?php

namespace App\Http\Controllers;

use App\Models\Pizzas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CardapioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Pizzas::paginate(10);

        return view('actions.pizzas',[
            'pizzas' => $data
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('actions.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->only([
            'name',
            'price',
            'description'
        ]);
        $validator = Validator::make($data,[
            'name' => ['required', 'string', 'max:100'],
            'price' => ['required', 'string'],
            'description' => ['required', 'string' , 'max:100']
         ]);


        if($validator->fails()){
            return redirect()->route('cardapio.create')
                            ->withErrors($validator)
                            ->withInput();
        }

        $pizza = new Pizzas;
        $pizza->name = $data['name'];
        $pizza->price = $data['price'];
        $pizza->description = $data['description'];
        $pizza->save();

        return redirect()->route('cardapio.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
