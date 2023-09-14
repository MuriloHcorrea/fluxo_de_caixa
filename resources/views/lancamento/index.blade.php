@extends('layouts.base')
@section('content')
    <h1>
        <i class="bi bi-wallet2 "></i>
        INDEX - LANCAMENTOS
       <a class="btn btn-primary"
       href="{{route ('lancamento.create')}}"></a>
          Novo Lancamento
    </h1>
    <h2> {{ Auth::user()->name }}</h2>

    {{-- alerts --}}
    @include('layouts.partials.alerts')
    {{-- /alerts --}}
      {{-- Paginação --}}
               {!!$lancamentos->links() !!}
      {{-- /Paginação --}}
    <div class="table-responsive">

        <table class="table table-striped  table-hover ">
            <thead>
                <caption>LISTA DE</caption>
                <tr>
                    <th>#</th>
                    <th>Vencimento</th>
                    <th>Tipo</th>
                    <th>Valor</th>
                    <th>Centro de Custo</th>
                    <th>Descrição</th>
                    <th>Usuario</th>
                    <th>Data de Lanca</th>

                </tr>
            </thead>
            <tbody class="table-group-divider">
                @forelse ($lancamentos as $lancamento)

                <tr>
                    <td scope="row" class="col-2">
                        <div class="flex-column">
                            {{-- ver --}}
                            <a class="btn btn-success" href="#">
                                <i class="bi bi-eye"></i>
                            </a>
                            {{-- editar --}}
                            <a class="btn btn-dark" href="#">
                                <i class="bi bi-pencil-square"></i>
                            </a>
                            {{-- excluir --}}
                            <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                data-bs-target="#modalExcluir" data-identificacao="" data-url="">
                                <i class="bi bi-trash"></i>
                            </button>
                        </div>
                    </td>
                    <td>{{ $lancamento->vencimento->format('d/m/Y') }}</td>
                    <td>{{ $lancamento->tipo->tipo}}</td>
                    <td>{{ $lancamento->valor}}</td>
                    <td>{{ $lancamento->centroCusto->centro_custo}} </td>
                    <td>{{ $lancamento->descricao}}</td>
                    <td>{{ $lancamento->usuario->name}}</td>
                    <td>{{ $lancamento->created_at->format('d/m/Y H:i')}}h
                         /
                         {{ $lancamento->created_at->age}} Anos

                    </td>


                </tr>

                @empty
                 <tr>
                    <td colspan="8">
                        Nenhum Registro Registrado por aqui
                    </td>
                 </tr>
                @endforelse
            </tbody>
        </table>
    </div>

{{-- Modal Excluir --}}
@include('layouts.partials.modalExcluir')
{{-- /Modal Excluir --}}
@endsection
@section('scripts')
@parent

@endsection
