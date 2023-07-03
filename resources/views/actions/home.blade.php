@extends('adminlte::page')

@section('plugins.Chartjs', true)

@section('title', 'Painel')

@section('content')
<div class="row">
    <div class="col-md-6 ">
        <h1>Dashboard</h1>
    </div>

    <div class="col-md-6">
        <form action="{{route('dashboard.index')}}" method="GET" class="form-horizontal">
            <div class="float-md-right" style="display: flex">
                <h5>Intervalo de dias:</h5>
                <input type="number" name="interval" value="{{$days}}" class="form-control" style="margin: 0 15px; width:5rem">
                <input type="submit" value="Calcular" class="btn btn-danger">
            </div>
        </form>

    </div>


</div>
    <div class="row">
        <div class="col-md-3">
            <div class="small-box bg-info">
                <div class='inner'>
                    <h3>{{$pizzas}}</h3>
                    <p>Pizzas</p>
                </div>
                <div class='icon'>
                    <i class="far fa-fw fa-eye"></i>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="small-box bg-success">
                <div class='inner'>
                    <h3>{{$clientes}}</h3>
                    <p>Clientes</p>
                </div>
                <div class='icon'>
                    <i class="far fa-fw fa-eye"></i>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="small-box bg-warning">
                <div class='inner'>
                    <h3>{{$pedidos}}</h3>
                    <p>Pizzas Vendidas</p>
                </div>
                <div class='icon'>
                    <i class="far fa-fw fa-eye"></i>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="small-box bg-danger">
                <div class='inner'>
                    <h3>{{$price}}</h3>
                    <p>Lucro</p>
                </div>
                <div class='icon'>
                    <i class="far fa-fw fa-eye"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h2 class="card-title">Pizzas mais compradas</h2>
                </div>
                <div class="card-body">
                    <canvas id="pagePie">teste</canvas>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h2 class="card-title">Clientes mais fiéis</h2>
                </div>
                <div class="card-body">
                    ...
                </div>
            </div>
        </div>
    </div>

<script>
    window.onload = function(){
        let ctx = document.getElementById('pagePie').getContext('2d');
        window.pagePie = new Chart(ctx, {
            type:'pie',
            data:{
                datasets:[{
                    data:{{$pageValues}},
                    backgroundColor: '#0000FF'
                }],
                labels:{!!$pageLabels!!}
            },
            options:{
                responsive:true,
                legend:{
                    display:false
                }
            }
        });
    }
</script>

@endsection
