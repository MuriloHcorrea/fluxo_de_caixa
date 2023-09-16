@extends('layouts.base')
@section('content')
    <h1>
        <i class="bi bi-wallet2"></i>
        - LANCAMENTOS
        |
        <a class="btn btn-primary"
           href="{{ route('lancamento.create') }}">
            Novo Lançamento
        </a>
    </h1>

    {{-- alerts --}}
    @include('layouts.partials.alerts')
    {{-- /alerts --}}
    {{-- paginação --}}
        {!! $lancamentos->appends(['search' =>request()->get('search','')])->links() !!}
    {{-- /paginação --}}

    {{-- pesquisa    --}}
<div class="row">

    <form  action="{{ route('lancamento.index')}}" method="get">
    <input class="form-control col-md-4" type="search" name="search" id="search"
    placeholder="Pesquise algo" value="{{ old('search',request()->get('search'))}}">


    {{-- data inicio --}}
  <div class="col-md-3">
    <label class="form-label"for="dt_inicial">
      Data inicial


    </label>
    <input class="from-control" type ="date" name="dt_inicial" id="dt_inical">
  </div>

    {{-- /data inicio --}}

    {{-- ultima data --}}
    <div class="col-md-3">
        <label class="form-label"for="dt_fim">
          Data Final


        </label>
        <input class="from-control" type ="date" name="dt_fim" id="dt_fim">
      </div>
    {{-- /ultima data --}}


    <input class="btn btn-dark col-md-1"type="submit" value="Pesquisar">

    @if (request()->get('search') !='')


    <a class="btn btn-primary col-md-1"href="{{ route('lancamento.index')}}">
        <i class="bi bi-recycle"></i>
    </a>
    @endif
</form>

</div>
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
                    <th>Usuário</th>
                    <th>Data do lançamento</th>
                </tr>
            </thead>
            <tbody class="table-group-divider">
                @forelse ($lancamentos as $lancamento )
                <tr>
                    <td scope="row" class="col-2">
                        <div class="flex-column">
                            {{-- ver --}}
                            <a class="btn btn-success" href="{{ url('storage/anexos/'.$lancamento->anexo)}}" target="_blank">
                                <i class="bi bi-send-fill"></i>
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
                    <td>{{ $lancamento->tipo->tipo }}</td>
                    <td>{{ $lancamento->valor }}</td>
                    <td>{{ $lancamento->centroCusto->centro_custo }}</td>
                    <td>{{ $lancamento->descricao }}</td>
                    <td>{{ $lancamento->usuario->name }}</td>
                    <td>
                        {{ $lancamento->created_at->format('d/m/Y \a\s H:i') }}h
                    </td>
                </tr>
                @empty
                 <tr>
                    <td colspan="8">
                        Nenhum registro retornado
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
