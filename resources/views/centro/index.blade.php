@extends('layouts.base')
@section('content')
    <h1>Centro Custos</h1>

    {{-- alerts --}}
    @include('layouts.partials.alerts')
    {{-- /alerts --}}

    <div class="table-responsive">
        <table class="table table-striped  table-hover ">
            <thead>
                <caption>LISTA DE</caption>
                <tr>
                    <th class="col-2">#</th>
                    <th>Centro de Custos
                        -
                        <a class="btn btn-dark"
                        href="{{ route('centro.create')}}">
                        Novo centro de custo
                        </a>
                    </th>
                    <th>Total de Lançamentos</th>
                </tr>
            </thead>

                @foreach ($centroCustos as $centro )
                <tbody class="table-group-divider">

                <tr>
                    <td scope="row">
                        <div class="flex-column">
                            {{-- ver --}}
                            <a class="btn btn-success" href="{{ route('centro.show',['id'=>$centro->id_centro_custo])}}">
                                <i class="bi bi-eye"></i>
                            </a>
                            {{-- editar --}}
                            <a class="btn btn-dark" href="{{ route('centro.edit',
                            ['id' =>$centro->id_centro_custo])}}">
                                <i class="bi bi-pencil-square"></i>
                            </a>
                            {{-- excluir --}}
                            <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                data-bs-target="#modalExcluir" data-identificacao="{{ $centro->centro_custo}}" data-url="{{ route('centro.destroy', ['id'=>$centro->id_centro_custo]) }}">
                                <i class="bi bi-trash"></i>
                            </button>
                        </div>
                    </td>
                    <td>{{$centro->centro_custo}}</td>
                    <td>{{ $centro->lancamentos()->count()}}</td>
                </tr>


                @endforeach
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
