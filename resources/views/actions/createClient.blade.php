@extends('adminlte::page')

@section('title', 'Novo Cliente')

@section('content_header')
    <h1>
    Novo Cliente
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

            <form action="{{route('client.store')}}" method="POST" class="form-horizontal">
                @csrf
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Nome</label>
                    <div class="col-sm-10">
                        <input type="text" name="name" value="{{old('name')}}" class="form-control @error('name') is-invalid @enderror">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Endereço</label>
                    <div class="col-sm-10">
                        <textarea name="address" class="form-control" >{{old('address')}}</textarea>

                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Celular</label>
                    <div class="col-sm-10">
                        <input type="tel" name="phoneNumber" value="{{old('phoneNumber"')}}" class="form-control @error('phonenumber') is-invalid @enderror">
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-2 col-form-label"></label>
                    <div class="col-sm-10">
                        <input type="submit" value="Criar" class="btn btn-success">
                        <a href="{{route('client.index')}}" class="btn btn-danger">Voltar</a>
                    </div>
                </div>


            </form>

        </div>

    </div>

@endsection
