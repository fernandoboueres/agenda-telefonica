<?php

namespace App\Http\Controllers;

use App\Models\Contato;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ContatoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Contato::create(
            [
                'nome' => $request->all()['nome'],
                'telefone' => $request->all()['telefone'],
                'user_id' => Auth::id(),
            ]
        );

        return \redirect()->route('home');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        Contato::find($id)
        ->update(
            [
                'nome' => $request->all()['nome'],
                'telefone' => $request->all()['telefone'],
                'user_id' => Auth::id(),
            ]
        );
        
        return \redirect()->route('home');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Contato::find($id)->delete();
        
        return \redirect()->route('home');
    }

    public function search(Request $request){
        $searchQuery = \str_replace(['(', ')', '-', ' '], '', $request->input('contato-search-query'));

        $contatos = Contato::
                    where('telefone', 'like', $searchQuery . '%')->
                    where('user_id', 'like', Auth::id())->
                    select('id', 'nome', 'telefone')->
                    get();
        
        return response()->json($contatos);
    }
    
}
