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
                    <label class="col-sm-2 col-form-label">Nome</label>
                    <div class="col-sm-10">

                        <select class="js-example-basic-single col-sm-8 col-form-label" name="client">
                            <option value="{{ $pedido->client_id }}">{{$client->find(($pedido->client_id))->name}}</option>
                            @foreach ($client as $p)
                                <option value="{{ $p->id }}">{{$p->name}}</option>
                            @endforeach

                        </select>
                        <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
                        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/js/select2.min.js"></script>
                        <script>
                            $('.js-example-basic-single').select2({
                                allowClear: true,

                            });
                        </script>
                        <link rel="stylesheet"
                            href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/css/select2.min.css">


                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Pizzas</label>
                    <div class="col-sm-10">

                        <select class="js-states js-example-events form-control" name="pizzas[]" multiple="multiple">
                            @foreach ($pizzaPedido as $item)
                                    <option value="{{$item}}" selected>{{($lista->find($item)->name)}}</option>
                                @endforeach
                            @foreach($lista as $l )
                            <option value="{{$l->id}}">{{$l->name}}</option>
                            @endforeach

                          </select>
                        <script>
                            var $eventLog = $(".js-event-log");
                            var $eventSelect = $(".js-example-events");

                            $.fn.select2.defaults.set("width", "50%");

                            $eventSelect.on("select2:open", function(e) {
                                log("select2:open", e);
                            });
                            $eventSelect.on("select2:close", function(e) {
                                log("select2:close", e);
                            });
                            $eventSelect.on("change", function(e) {
                                log("change");
                            });

                            $eventSelect.on("select2:select", function(e) {
                                log("select2:select", e);
                                $eventSelect.append('<option value="' + e.params.data.text + '">' + e.params.data.text + '</option>');
                            });
                            $eventSelect.on("select2:unselect", function(e) {
                                log("select2:unselect", e);
                                e.params.data.element.remove();
                            });

                            function log(name, evt) {
                                if (!evt) {
                                    var args = "{}";
                                } else {
                                    var args = JSON.stringify(evt.params, function(key, value) {
                                        if (value && value.nodeName) return "[DOM node]";
                                        if (value instanceof $.Event) return "[$.Event]";
                                        return value;
                                    });
                                }
                                var $e = $("<li>" + name + " -> " + args + "</li>");
                                $eventLog.append($e);
                                $e.animate({
                                    opacity: 1
                                }, 50000, 'linear', function() {
                                    $e.animate({
                                        opacity: 0
                                    }, 2000, 'linear', function() {
                                        $e.remove();
                                    });
                                });
                            }

                            function formatResultData(data) {
                                if (!data.id) return data.text;
                                if (data.element.selected) return
                                return data.text;
                            };

                            $eventSelect.select2({
                                templateResult: formatResultData,
                                placeholder: "Pesquise a pizza aqui",
                                allowClear: true,
                            });
                        </script>


                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Borda</label>
                    <div class="col-sm-10">
                            @if($pedido->edge == true)
                                <select name="borda" id="borda">
                                    <option value="op2" selected>Sim</option>
                                    <option value="op1">Não</option>
                                </select>
                            @else
                                <select name="borda" id="borda">
                                    <option value="op2" >Sim</option>
                                    <option value="op1" selected>Não</option>
                                </select>
                            @endif




                    </div>
                </div>

                <div class="form-group row" id="qtborda">
                    <label class="col-sm-2 col-form-label">Quantidade de pizza com borda</label>
                    <div class="col-sm-10">
                        <input type="number" name = 'nborda' value = {{$pedido->qtborda}} class="form-control" style="width:5rem">

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

            if("{{$pedido->edge}}" == false){
                $('#qtborda').hide();
            }
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
