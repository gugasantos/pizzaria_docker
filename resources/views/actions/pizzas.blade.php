@extends('adminlte::page')

@section('content_header')
    <h1>
    Cardapio
    <a href="{{route('cardapio.create')}}" class="btn btn-sm btn-success">Adicionar nova pizza ao cardapio</a>
    </h1>
@endsection

@section('content')

<div class="card">
    <div class="table-responsive-sm card-body">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th width='250'>Nome</th>
                    <th width='530'>Descrição</th>
                    <th style="text-align:center" width='200'>Valor</th>
                </tr>
            </thead>
           <tbody>
            @foreach ($pizzas as $pizza)
                <tr>
                    <td>{{$pizza->name}}</td>
                    <td>{{$pizza->description}}</td>

                    <td style="text-align:center">R$ {{number_format((float)$pizza->price, 2, ',', '')}}</td>
                    <td>
                        <a href="{{route('cardapio.edit',[$pizza->id])}}" class="btn btn-sm btn-info">Editar</a>
                        <form class="d-inline" action="{{route('cardapio.destroy',[$pizza->id])}}" method="POST" onsubmit="return confirm('Tem certeza que deseja exluir essa pizza do cardápio?')">
                            @method('DELETE')
                            @csrf
                            <button class="btn btn-sm btn-danger">Excluir</button>
                        </form>
                    </td>
                </tr>
            @endforeach
           </tbody>


        </table>
    </div>
</div>
    {{$pizzas->links('pagination::bootstrap-4') }}
@endsection
