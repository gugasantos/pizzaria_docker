@extends('adminlte::page')

@section('title', 'Editar Pedido')

@section('content_header')
    <h1>
    Editar Pedido
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
                @foreach ($errors->all() as $error )
                    <li>{{$error}}</li>
                @endforeach
            </ul>
        </div>

    @endif


    <div class="card">
        <div class="card-body">

            <form action="{{route('pedido.update',[$pedido->id])}}" method="POST" class="form-horizontal">
                @method('PUT')
                @csrf
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Nome TESTE</label>
                    <div class="col-sm-10">

                    <select style="width: 1000px" class="js-example-basic-single col-sm-10 col-form-label" name="client">

                            <option></option>
                            @foreach($client as $p )
                            <option value="{{$p->id}}">{{$p->name}}</option>
                            @endforeach

                        </select>
                    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
                    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/select2/3.5.3/select2.min.js"></script>
                    <script>
                        $('.js-example-basic-single').select2({
                            placeholder:{"Pesquise o cliente aqui"},
                            allowClear:true,
                            matcher: function(term, text) { return text.toUpperCase().indexOf(term.toUpperCase())==0;}
                        });
                    </script>
                    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/3.5.3/select2.min.css">



                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Pizzas</label>
                    <div class="col-sm-10">

                        <select class="js-example-basic-multiple col-sm-10 col-form-label" name="pizzas[]"  multiple="multiple">
                                @foreach($lista as $p)
                                <option value="{{$p->id}}">{{$p->name}}</option>
                                @endforeach

                        </select>
                        <script>
                            $('.js-example-basic-multiple').select2({
                                placeholder:"Pesquise a pizza aqui",
                                matcher: function(term, text) { return text.toUpperCase().indexOf(term.toUpperCase())==0;}
                            });
                        </script>


                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Borda</label>
                    <div class="col-sm-10">
                        <select name="borda" id="borda">
                            <option value="op1">Não</option>
                            <option value="op2">Sim</option>
                        </select>
                    </div>
                </div>

                <div class="form-group row" id="qtborda">
                    <label class="col-sm-2 col-form-label">Quantidade de pizza com borda</label>
                    <div class="col-sm-10">
                        <input type="number" name = 'nborda' value = '1' class="form-control" style="width:5rem">

                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Descrição</label>
                    <div class="col-sm-10">
                        <textarea name="note" class="form-control" >{{$pedido->note}}</textarea>

                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-2 col-form-label"></label>
                    <div class="col-sm-10">
                        <input type="submit" value="Salvar" class="btn btn-success">
                        <a href="{{route('pedido.index')}}" class="btn btn-danger">Voltar</a>
                    </div>
                </div>


            </form>

        </div>

    </div>

    <script type="text/javascript">
        $(document).ready(function() {
            $('#qtborda').hide();
            $('#borda').change(function() {
                 if ($('#borda').val() == 'op2') {
                    $('#qtborda').show();
                } else {
                    $('#qtborda').hide();
                }
            });
        });
    </script>

@endsection
