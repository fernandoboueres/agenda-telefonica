$(window).on('load', () => {
    $('#contato-search-query').mask('(99) 99999-9999');

    $('#form-search-contato').on('submit', (event) => {
        event.preventDefault();
        $.ajax({
            url: '/contato/search',
            method: 'POST',
            data: $(event.target).serialize(),
            success: (contatos) => {
                let modal = $('#modal-mostrar-contato');

                let modalBody = modal.find('.modal-body');

                modalBody.html('');
                for (let contato of contatos) {
                    modalBody.append(`
                        <div class="card my-2">
                            <div class="card-header"><strong>${contato['nome']}</strong></div>
                            <div class="card-body">
                                <div class="row d-flex align-items-center">
                                    <div class="col-sm-9">
                                        <div style="margin-left: 1rem;" id="telefone-${contato['nome']}">${contato['telefone']}</div>
                                    </div>
                                    <div class="col-sm-3">
                                        <a class="btn btn-primary" onclick="$('#modal-mostrar-contato').hide()" 
                                            data-bs-toggle="modal"
                                            data-bs-target="#modal-editar-contato-${contato['id']}">
                                            <i class="fa fa-info-circle"></i>
                                        </a>
                                        <a onclick="event.preventDefault(); document.getElementById('deletar-contato-${contato['id']}').submit();" class="btn btn-danger">
                                            <i class="fa fa-trash"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    `);
                    $(`#telefone-${contato['nome']}`).mask('(99) 99999-9999');
                }

                modal.show();
            },
            error: (error) => {
                console.log(error);
            }
        });
    });

    $('#close-modal-mostrar-contato').on('click', (event) => {
        $('#modal-mostrar-contato').hide();
    });

});