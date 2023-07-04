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
                    <i class="fas fa-pizza-slice"></i>
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
                    <i class="far fa-fw fa-user"></i>
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
                    <i class="fas fa-shopping-cart"></i>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="small-box bg-danger">
                <div class='inner'>
                    <h3>R$ {{number_format((float) $price, 2, ',', '')}}</h3>
                    <p>Receita</p>
                </div>
                <div class='icon'>
                    <i class="fas fa-money-bill-alt"></i>
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
                    backgroundColor: [
                    'rgb(255, 0, 80)',
                    'rgb(54, 162, 235)',
                    'rgb(255, 205, 86)',
                    'rgb(25, 205, 86)',
                    'rgb(153, 51, 153)'

                    ],
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
