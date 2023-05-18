@extends('adminlte::page')

@section('title', 'Nova Pedido')

@section('content_header')
    <h1>
    Nova Pedido
    </h1>
@endsection


@section('content')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/3.5.3/select2.min.css">
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                <h5>
                    <i class="icon fas fa-ban"></i>
                    Ocorreu um erro
                </h5>
                @foreach ($errors->all() as $error )
                    <li>{{$error}}</li>
                @endforeach
            </ul>
        </div>

    @endif

    <div>
        <select style="width: 200px" id="nameid">
            <option>Selecione o Cliente</option>
            @foreach($client as $c )
            <option>{{$c->name}}</option>
            @endforeach
        </select>
        <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/select2/3.5.3/select2-bootstrap.min.css "></script>
        <script type="text/javascript">
            $('#nameid').selecet2({

            })
        </script>
    </div>

    <div class="card">
        <div class="card-body">

            <form action="{{route('pedido.store')}}" method="POST" class="form-horizontal">
                @csrf
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Nome</label>
                    <div class="col-sm-10">
                        <input type="text" name="client" value="{{old('name')}}" class="form-control @error('name') is-invalid @enderror">
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Pizzas</label>
                    <div class="col-sm-10">
                        <textarea name="pizzas" class="form-control" id='pizza' >{{old('pizza')}}</textarea>
<!--<div>
    <script>
        function chaleira(){
            document.getElementById('pizza')="aloha";
        }
    </script>

    <select onclick="chaleira()">
        @foreach ($lista as $pizza)
            <option value="pizza">{{$pizza}}</option>
        @endforeach
    </select>
</div>-->
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Borda</label>
                    <div class="col-sm-10">
                        <input type="radio" value="op1" name = "borda" checked> Não
                        <input type="radio" value="op2" name = "borda"> Sim
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Descrição</label>
                    <div class="col-sm-10">
                        <textarea name="note" class="form-control" >{{old('description')}}</textarea>

                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Preço Total</label>
                    <div class="col-sm-10">
                        <input type="number" step="0.01" name="price" value="{{old('price')}}" class="form-control @error('price') is-invalid @enderror">
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-2 col-form-label"></label>
                    <div class="col-sm-10">
                        <input type="submit" value="Criar" class="btn btn-success">
                        <a href="{{route('pedido.index')}}" class="btn btn-danger">Voltar</a>
                    </div>
                </div>


            </form>

        </div>

    </div>

@endsection
