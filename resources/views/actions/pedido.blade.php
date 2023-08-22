@extends('adminlte::page')

@section('title', 'Marinara Pizzaria')

@section('content_header')
    <h1>
        Pedidos
        <a href="{{ route('pedido.create') }}" class="btn btn-sm btn-success">Adicionar novo pedido</a>
    </h1>
@endsection


@section('content')

@if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                <h5>
                    <i class="icon fas fa-ban"></i>
                    Ocorreu um erro
                </h5>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>

    @endif



<div class="card">
    <form action="pedido" method="GET">
        <input type="text" id="search" name="search" class="form-control" placeholder="Procurar Pedido (digite exatamente o nome do cliente)">
    </form>
</div>


    <div class="card">
        <div class="table-responsive-sm card-body">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th >Nome</th>
                        <th>Endereço</th>
                        <th>Telefone</th>
                        <th>Pizzas</th>
                        <th>Borda</th>
                        <th>Descrição</th>
                        <th>Valor total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pedidos as $pedido)
                        @if($search)
                            <tr>
                                <td>{{$cliente->find(($pedido->client_id))->name}}</td>
                                <td>{{$cliente->find(($pedido->client_id))->address}}</td>
                                <td>{{$cliente->find(($pedido->client_id))->phoneNumber}}</td>
                                <td>{{$pizzasPedido->find(($pedido->pizzas_pedido_id))->namePizzas}}</td>
                                @if ($pedido->edge == true)
                                    <td>Sim</td>
                                @else
                                    <td>Não</td>
                                @endif
                                <td>{{ $pedido->note }}</td>
                                <td>R$ {{ number_format((float) $pedido->price, 2, ',', '') }}</td>
                                <td>
                                    @if($pedido->finalizado == true)
                                    <a href="{{ route('pedido.show', [$pedido->id]) }}"
                                        class="btn btn-sm btn-success">Feita</a>
                                    @else
                                    <a href="{{ route('pedido.show', [$pedido->id]) }}"
                                        onsubmit="return confirm('Tem certeza que deseja cancelar esse pedido?')"
                                        class="btn btn-sm btn-warning">Desfazer</a>
                                    @endif
                                    <a href="{{ route('pedido.edit', [$pedido->id]) }}" class="btn btn-sm btn-info">Editar</a>
                                    <form class="d-inline" action="{{ route('pedido.destroy', [$pedido->id]) }}"
                                        method="POST"
                                        onsubmit="return confirm('Tem certeza que deseja cancelar esse pedido?')">
                                        @method('DELETE')
                                        @csrf
                                        <button class="btn btn-sm btn-danger">Cancelar</button>
                                    </form>
                                </td>
                            </tr>
                        @else
                            @if (($pedido->finalizado) == true)

                                <tr>
                                    <td>{{$cliente->find(($pedido->client_id))->name}}</td>
                                    <td>{{$cliente->find(($pedido->client_id))->address}}</td>
                                    <td>{{$cliente->find(($pedido->client_id))->phoneNumber}}</td>
                                    <td>{{$pizzasPedido->find(($pedido->pizzas_pedido_id))->namePizzas}}</td>
                                    @if ($pedido->edge == true)
                                        <td>Sim</td>
                                    @else
                                        <td>Não</td>
                                    @endif
                                    <td style="max-width: 100px;">{{ $pedido->note }}</td>
                                    <td>R$ {{ number_format((float) $pedido->price, 2, ',', '') }}</td>
                                    <td>
                                        <a href="{{route('gerapdf', [$pedido->id])}}" class="btn btn-sm btn-warning">Imprimir</a>
                                        <a href="{{ route('pedido.show', [$pedido->id]) }}"
                                            class="btn btn-sm btn-success">Feita</a>
                                        <a href="{{ route('pedido.edit', [$pedido->id]) }}" class="btn btn-sm btn-info">Editar</a>
                                        <form class="d-inline" action="{{ route('pedido.destroy', [$pedido->id]) }}"
                                            method="POST"
                                            onsubmit="return confirm('Tem certeza que deseja cancelar esse pedido?')">
                                            @method('DELETE')
                                            @csrf
                                            <button class="btn btn-sm btn-danger">Cancelar</button>
                                        </form>
                                    </td>
                                </tr>
                            @endif
                        @endif
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    {{$pedidos->links('pagination::bootstrap-5') }}
@endsection
