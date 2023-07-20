<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PDF</title>
    <style>
        thead {color:green;}
        tbody {color:red;}

        table, th, td {
        border: 1px solid black;
        }
    </style>
</head>

<body>
    <table class="table table-hover">
        <thead>
            <tr>
                <th>Nome</th>
                <td>{{ $cliente->name }}</td>
            </tr>
            <tr>
                <th>Endereço</th>
                <td>{{ $cliente->address }}</td>
            </tr>
            <tr>
                <th>Telefone</th>
                <td>{{ $cliente->phoneNumber }}</td>
            </tr>
            <tr>
                <th>Pizzas</th>
                <td style="max-width: 100px;">{{$pizzasPedido}}</td>
            </tr>
            <tr>
                <th>Borda</th>
                @if ($pedido->edge == true)
                    <td>Sim</td>
                @else
                    <td>Não</td>
                @endif

            </tr>
            <tr>
                <th>Descrição</th>
                <td>{{ $pedido->note }}</td>
            </tr>
            <tr>
                <th>Valor total</th>
                <td>R$ {{ number_format((float) $pedido->price, 2, ',', '') }}</td>
            </tr>
        </thead>
    </table>



</body>

</html>
