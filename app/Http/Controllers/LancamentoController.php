<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\{
    CentroCusto,
    Lancamento,
    Tipo,
    User
};



class LancamentoController extends Controller
{
    /**
     * Listar todos os lançamentos
     * @date 04-09-2023
     *
     */
    public function index(Request $request )
    {
        $search_tipo =$request->get('search_tipo')??null;;
        $search_centroCusto =$request->get('search_centroCusto')??null;;
        $search = $request->get('search');
        $dt_inicial = $request->get('dt_inicial')??null;
        $dt_fim = $request->get('dt_fim')??null;
        $tipos = Tipo::class;
        $centrosDeCusto = CentroCusto::class;
        //dd($search);


        $lancamentos = Lancamento::where('id_user',Auth::user()->id)

        ->where(function ($query) use($search,$dt_inicial,$dt_fim,$search_centroCusto,$search_tipo){



            if($search_tipo){

                $query->where('id_tipo','=',$search_tipo);
            }
            if($search){
              $query->where('descricao','like',"%$search%");



            }
            if ($search_centroCusto){
            $query->where('id_centro_custo','=',$search_centroCusto);

          }

           if ($dt_inicial) {
            $query->where('vencimento','>=',$dt_inicial);

           }
           if ($dt_fim) {
            $query->where('vencimento','<=',$dt_fim);

           }

        } )

        ->orderBy('id_lancamento','desc')
            ->paginate(10);

        return view('lancamento.index')
            ->with(compact('lancamentos','tipos','centrosDeCusto'));
    }

    /**
     * Formulário de novo lançamento
     * @date 11-09-2023
     */
    public function create()
    {
        $lancamento = null;
        $centrosDeCusto = CentroCusto::class;
        $tipos = Tipo::class;

        return view('lancamento.form')
            ->with(
                compact(
                    'lancamento',
                    'centrosDeCusto',
                    'tipos'
                )
            );
    }

    /**
     * Cadastrar um novo lançamento
     * @date 13-09-2023
     */
    public function store(Request $request)
    {
        $lancamento = new Lancamento();
        $lancamento->fill($request->all());
        // capturar o id do usuario logado
        $lancamento->id_user = Auth::user()->id;
        // subir o anexo
         if($request->anexo){
            $extension = $request->anexo->getClientOriginalExtension();
            $nomeAnexo = date('YmdHis').'.'.$extension;
            $request->anexo->storeAs('anexos',$nomeAnexo);
            $lancamento->anexo = $nomeAnexo;

            //$lancamento->anexo = $request->anexo->store('anexos');
         }
        $lancamento->save();
        return redirect()
            ->route('lancamento.index');

    }

    /**
     * Display the specified resource.
     */
    public function show(Lancamento $lancamento)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Lancamento $lancamento)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Lancamento $lancamento)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Lancamento $lancamento)
    {
        //
    }
}
