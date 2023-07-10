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


        $search = request('search');

        if($search){
            $data = Pizzas::where(
                'name', 'like', '%'.$search.'%'
            )->get();
        }
        else{
            $data = Pizzas::paginate(10);
        }



        return view('actions.pizzas',[
            'pizzas' => $data, 'search' => $search
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
         ]);


        if($validator->fails()){
            return redirect()->route('cardapio.create')
                            ->withErrors($validator)
                            ->withInput();
        }

        $data['price'] = number_format($data['price'], 2 , ",", ".");

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
    public function edit($id)
    {
        $data = Pizzas::find($id);

        if($data){
            return view('actions.edit',[
                'pizza' => $data
            ]);
        }
        return redirect()->route('index');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $pedido = Pizzas::find($id);
        if($pedido){
            $data = $request->only([
                'name',
                'description',
                'price'
            ]);
            $validator = Validator::make($data,[
                'name' => ['required', 'string', 'max:100'],
                'price' => ['required', 'string' , 'max:100']

            ]);
            if($validator->fails()){
                return redirect()->route('cardapio.edit')
                                ->withErrors($validator)
                                ->withInput();
            }
        }
        $pedido->name = $data['name'];
        $pedido->price = $data['price'];
        $pedido->description = $data['description'];
        $pedido->update();

        return redirect()->route('cardapio.index');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = Pizzas::find($id);
        $data->delete();

        return redirect()->route('cardapio.index');
    }
}
