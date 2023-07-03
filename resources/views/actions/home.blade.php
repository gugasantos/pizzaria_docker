@extends('adminlte::page')

@section('title', 'Painel')

@section('content_header')
    <h1>Dashboard</h1>

@endsection


@section('content')
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
                    <h3 class="card-title">teste</h3>
                </div>
                <div class="card-body">
                    ...
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Sobre a pizzaria</h3>
                </div>
                <div class="card-body">
                    ...
                </div>
            </div>
        </div>
    </div>

@endsection
