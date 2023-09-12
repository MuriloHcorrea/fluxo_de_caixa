@extends('layouts.base')
@section('content')
<h1>Show
</h1>
<h2>
    Itens
</h2>
<h2>
    Lista de lancamento -
    {{ $centro->lancamentos()->count()}}
    Itens
</h2>
<p>
Total Saidas: R$ -
{{ $centro->lancamentos()->where('id_tipo',1)->sum('valor')

}}
<br>
Total Entradas: R$
{{ $centro->lancamentos()->where('id_tipo',2)->sum('valor')

}}
<br>
Saldo R$
{{ $centro->lancamentos()->where('id_tipo',1)->sum('valor')
   -
    $centro->lancamentos()->where('id_tipo',2)->sum('valor')
}}

</p>
<table class="table table-striped table-houver">
  <thead>
    <caption>Lista de lançamentos - {{ $centro->lancamentos()->count()}}</caption>
    <tr>
    <th class="col-md-1">#</th>
    <th class="col-md-1">ID</th>

    <th>Tipo</th>
    <th>Usuario</th>
    <th>Descricao</th>
    <th>Valor</th>
    <th></th>


</tr>
</thead>
<tbody class="table-group-divider">
@foreach($centro->lancamentos()->get() as $lancamento)
<tr
 @if ($lancamento->id_tipo == 2)
     class= "table-danger"

 @endif
 >
 <td scope="row">{{ $loop->iteration}}</td>
 <td scope="row">{{$lancamento->id_lancamento}}</td>
 <td>{{$lancamento->tipo->tipo}}</td>
 <td>{{!! $lancamento->usuario->name !!}}</td>
 <td>{{$lancamento->descricao}}</td>
 <td>{{$lancamento->valor }}</td>

</tr>

@endforeach
</tbody>
</table>
@endsection
@section('scripts')
@parent

@endsection
