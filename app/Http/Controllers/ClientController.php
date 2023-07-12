<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $search = request('search');

        if ($search) {
            $data = Client::where(
                'name',
                'like', '%' . $search . '%'
            )->orWhere(
                    'phoneNumber',
                    'like', '%' . $search . '%'
                )->get();
        } else {
            $data = Client::paginate(10);
        }

        return view('actions.client', [
            'clientes' => $data,
            'search' => $search
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('actions.createClient');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->only([
            'name',
            'address',
            'phoneNumber'
        ]);

        $validator = Validator::make($data, [
            'name' => ['required', 'string', 'max:100'],
            'address' => ['required', 'string'],
            'phoneNumber' => ['required']
        ]);

        if ($validator->fails()) {
            return redirect()->route('client.create')
                ->withErrors($validator)
                ->withInput();
        }
        ;

        $cliente = new Client;
        $cliente->name = $data['name'];
        $cliente->address = $data['address'];
        $cliente->phoneNumber = $data['phoneNumber'];

        $validator = 'Cliente já está cadastrado';

        if ($cliente->where('phoneNumber', $data['phoneNumber'])->count() == 0) {
            $cliente->save();
        } else {
            return redirect()->route('client.create')
                ->withErrors($validator)
                ->withInput();
        }
        ;

        return redirect()->route('client.index');
    }

    /**
     * Display the specified resource.
     */

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = Client::find($id);

        return view('actions.editClient', [
            'cliente' => $data
        ]);

        return redirect()->route('client.index');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $clientes = Client::find($id);
        if ($clientes) {
            $data = $request->only([
                'name',
                'address',
                'phoneNumber'
            ]);
            $validator = Validator::make($data, [
                'name' => ['required', 'string', 'max:100'],
                'address' => ['required', 'string'],
                'phoneNumber' => ['required', 'integer']

            ]);
            if ($validator->fails()) {
                return redirect()->route('client.edit', [$clientes->id])
                    ->withErrors($validator)
                    ->withInput();
            }
        }
        $clientes->name = $data['name'];
        $clientes->address = $data['address'];
        $clientes->phoneNumber = $data['phoneNumber'];

        $clientes->save();

        return redirect()->route('client.index');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = Client::find($id);
        $data->delete();

        return redirect()->route('client.index');
    }
}
