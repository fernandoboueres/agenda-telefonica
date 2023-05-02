@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <div class="row d-flex align-items-center">
                            <div class="col-sm-4">Sua agenda telefônica {{ Auth::user()->name }}</div>
                            <div class="col-sm-7">
                                <!-- Form Search Contato -->
                                <form id="form-search-contato" class="form-inline" method="POST">
                                    @csrf
                                    <div class="input-group">
                                        <input type="text" name="contato-search-query" id="contato-search-query"
                                            class="form-control rounded" placeholder="Procurar por telefone">
                                        <div class="input-group-append px-sm-2">
                                            <button type="submit" class="btn btn-secondary" form="form-search-contato">
                                                <i class="fa fa-search"></i></button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="col-sm-1">
                                <a href="#" class="btn btn-success" data-bs-toggle="modal"
                                    data-bs-target="#modal-adicionar-contato"><i class="fa fa-plus"></i></a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        @foreach ($contatos as $contato)
                            <div class="card my-2">
                                <div class="card-header"><strong>{{ $contato->nome }}</strong></div>
                                <div class="card-body">
                                    <div class="row d-flex align-items-center">
                                        <div class="col-sm-10">
                                            <div style="margin-left: 1rem;" class="telefone">{{ $contato->telefone }}</div>
                                        </div>
                                        <div class="col-sm-2">
                                            <a class="btn btn-primary" data-bs-toggle="modal"
                                                data-bs-target="#modal-editar-contato-{{ $contato->id }}"><i
                                                    class="fa fa-info-circle"></i></a>
                                            <a onclick="
                                                    event.preventDefault();
                                                    document.getElementById('deletar-contato-{{ $contato->id }}').submit();
                                            "
                                                class="btn btn-danger"><i class="fa fa-trash"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Deletar Contato -->
                            <form action="{{ route('contato.destroy', $contato->id) }}"
                                id="deletar-contato-{{ $contato->id }}" method="POST" style="display: none;">
                                @method('DELETE')
                                @csrf
                            </form>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Adicionar Contato -->
        <div class="modal" tabindex="-1" role="dialog" id="modal-adicionar-contato">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Adicionar novo contato</h5>
                        <button type="button" class="close btn btn-danger" data-bs-dismiss="modal" aria-label="Close">
                            <i class="fa fa-times"></i>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('contato.store') }}" method="POST" id="form-adicionar-contato">
                            @csrf
                            <div class="form-group row">
                                <label for="nome" class="col-form-label col-sm-4">Nome</label>
                                <div class="col-sm-8"><input type="text" name="nome" id="nome" required
                                        maxlength="255" class="form-control">
                                </div>
                            </div>
                            <br>
                            <div class="form-group row">
                                <label for="telefone" class="col-form-label col-sm-4">Telefone</label>
                                <div class="col-sm-8"><input type="text" name="telefone" id="telefone" required
                                        maxlength="255" class="form-control telefone"></div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" form="form-adicionar-contato">Adicionar
                            contato</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Editar Contato-->
        @foreach ($contatos as $contato)
            <div class="modal" tabindex="-1" role="dialog" id="modal-editar-contato-{{ $contato->id }}">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Editar contato, {{ $contato->nome }}</h5>
                            <button type="button" class="close btn btn-danger" data-bs-dismiss="modal" aria-label="Close">
                                <i class="fa fa-times"></i>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('contato.update', $contato->id) }}" method="POST"
                                id="form-editar-contato-{{ $contato->id }}">
                                @method('PUT')
                                @csrf
                                <div class="form-group row">
                                    <label for="nome" class="col-form-label col-sm-4">Nome</label>
                                    <div class="col-sm-8"><input type="text" name="nome" id="nome" required
                                            maxlength="255" class="form-control" value="{{ $contato->nome }}">
                                    </div>
                                </div>
                                <br>
                                <div class="form-group row">
                                    <label for="telefone" class="col-form-label col-sm-4">Telefone</label>
                                    <div class="col-sm-8"><input type="text" name="telefone" id="telefone" required
                                            maxlength="255" class="form-control telefone"
                                            value="{{ $contato->telefone }}"></div>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary"
                                form="form-editar-contato-{{ $contato->id }}">Salvar</button>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

        <!-- Modal Mostrar Contato -->
        <div class="modal" tabindex="-1" role="dialog" id="modal-mostrar-contato">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Contatos</h5>
                        <button type="button" class="close btn btn-danger" id="close-modal-mostrar-contato"
                            aria-label="Close">
                            <i class="fa fa-times"></i>
                        </button>
                    </div>
                    <div class="modal-body">
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection