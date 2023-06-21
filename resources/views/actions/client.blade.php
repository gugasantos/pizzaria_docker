@extends('adminlte::page')

@section('title', 'Clientes')

@section('content_header')
    <h1>
    Clientes
    <a href="{{route('client.create')}}" class="btn btn-sm btn-success">Adicionar novo cliente a pizzaria</a>
    </h1>
@endsection

@section('content')

<div class="card">
    <div class="card-body">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th width='250'>Nome</th>
                    <th width='530'>Endereço</th>
                    <th width='250'>Telefone</th>
                </tr>
                <tbody>
                @foreach ($clientes as $cliente)
                <tr>
                    <td>{{$cliente->name}}</td>
                    <td>{{$cliente->address}}</td>
                    <td>{{$cliente->phoneNumber}}</td>
                    <td>
                    <a href="{{route('client.edit',[$cliente->id])}}" class="btn btn-sm btn-info">Editar</a>
                        <form class="d-inline" action="{{route('client.destroy',[$cliente->id])}}" method="POST" onsubmit="return confirm('Tem certeza que deseja exluir esse cliente da pizzaria?')">
                            @method('DELETE')
                            @csrf
                            <button class="btn btn-sm btn-danger">Excluir</button>
                        </form>
                    </td>
                </tr>
                @endforeach
                </tbody>
            </thead>
        </table>
    </div>
</div>
@endsection
