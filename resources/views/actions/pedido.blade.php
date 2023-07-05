@extends('adminlte::page')

@section('title', 'Marinara Pizzaria')

@section('content_header')
    <h1>
        Pedidos
        <a href="{{ route('pedido.create') }}" class="btn btn-sm btn-success">Adicionar novo pedido</a>
    </h1>
@endsection


@section('content')

    <div class="card">
        <div class="card-body">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Endereço</th>
                        <th>Telefone</th>
                        <th>Pizzas</th>
                        <th>Borda</th>
                        <th>Descrição</th>
                        <th>Valor total</th>
                        <th width='200'>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pedidos as $pedido)

                        @if (($pedido->finalizado) == true)

                            <tr>
                                <td>{{$cliente->find(($pedido->client_id))->name}}</td>
                                <td>{{$cliente->find(($pedido->client_id))->address}}</td>
                                <td>{{$cliente->find(($pedido->client_id))->phoneNumber}}</td>
                                <td>{{$pizzasPedido->find(($pedido->pizzas_id))->namePizzas}}</td>
                                @if ($pedido->edge == true)
                                    <td>Sim</td>
                                @else
                                    <td>Não</td>
                                @endif

                                <td>{{ $pedido->note }}</td>
                                <td>R$ {{ number_format((float) $pedido->price, 2, ',', '') }}</td>
                                <td>
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

                    @endforeach
                </tbody>


            </table>
        </div>
    </div>

    <script>
        document.getElementById('botao-copiar').addEventListener('click', function() {
            var texto = document.getElementById('texto');

            texto.select();
            texto.setSelectionRange(0, 99999); // Para dispositivos móveis
            document.execCommand('copy');

            alert('Texto copiado com sucesso!');
        });
    </script>
@endsection
