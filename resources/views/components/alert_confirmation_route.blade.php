<style>
    p {
        font-weight: normal;
        margin-bottom: 0.6rem !important;
    }
</style>

<div class="modal fade" tabindex="-1" role="dialog" data-backdrop="static" id="dlgModalconfirm" style="min-width:30rem"
    taaria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div role="document" style="min-width:30rem">
        <div class="modal-content" style="min-width:30rem">

            <div class="modal-header">
                <h5 class="modal-title">Atenção</h5>
            </div>

            <div class="modal-body">
                <label style="text-align: center" id="textomensagem"></label>
            </div>

            <div class="modal-footer">

                <a href="#" id="link" onclick="fechatela();" class="btn btn-primary"
                    data-toggle="popover" data-trigger="hover" data-placement="bottom" title=""
                    data-content=""> Sim
                </a>

                <button type="submit" class="btn btn-secondary" data-dismiss="modal"> Não </button>
            </div>
        </div>
    </div>
</div>
<!-- Confirmação -->

<Script>
    /**
     * @param {string} mensagem - Mensagem a ser exibida pro usuário.
     * @param {string} titulo - Titulo da mensagem.
     * @param {string} rota - Rota para onde deverá ser redirecionado ao confirmar.
     * */
    function confirmaRota(mensagem, rota, titulo){
        console.log(titulo);
        $('#textomensagem').text(mensagem);
        $('#link').attr('href', rota);
        $('#link').attr('data-content', titulo);
        $('#dlgModalconfirm').modal('show');         
    }

    /**
     * @param {string} mensagem - Mensagem a ser exibida pro usuário.
     * @param {string} rota - Rota para onde deverá ser redirecionado ao confirmar.
     * */
    function confirm_delete(mensagem, rota){
        $('#textomensagem').text(mensagem);
        $('#link').attr('href', rota);
        $('#dlgModalconfirm').modal('show');         
    } 

    function fechatela(){    
        $('#dlgModalconfirm').modal('hide');  
    } 

    

</Script>
