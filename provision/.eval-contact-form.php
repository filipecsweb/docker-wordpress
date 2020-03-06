<style>
    .form-wrapper label {
        font-size: 1rem;
        margin-bottom: .25rem;
        width: 100%;
    }

    .form-wrapper label > b {
        color: red;
        display: inline;
        font-size: 1rem;
        line-height: 1;
        vertical-align: top;
    }

    .form-wrapper ~ .wpcf7-response-output {
        margin: 1.5rem 0 0 0;
        text-transform: uppercase;
        transition: none !important;
    }

    .form-wrapper ~ .wpcf7-response-output.wpcf7-validation-errors {
        border: 1px solid red;
    }

    .form-wrapper ~ .wpcf7-response-output.wpcf7-mail-sent-ok {
        border: 1px solid #398f14;
    }
</style>
<div class="form-wrapper">
    <p class="lead">Envie-nos uma mensagem através do formulário abaixo.</p>
    <div class="form-group">
        <label for="input-your-name">Seu nome <b>*</b></label>
        [text* your-name class:form-control id:input-your-name]
    </div>
    <div class="form-group">
        <label for="input-your-email">Seu e-mail <b>*</b></label>
        [email* your-email class:form-control id:input-your-email]
        <small class="form-text text-muted">Você pode receber uma resposta nesse e-mail.</small>
    </div>
    <div class="form-group">
        <label for="input-your-subject">Assunto <b>*</b></label>
        [select* your-subject id:input-your-subject class:custom-select include_blank "Reportar Erro" "Dúvidas e Reclamações" "Elogios" "Outros"]
        <small class="form-text text-muted">Sobre qual assunto você quer falar?</small>
    </div>
    <div class="form-group">
        <label for="input-your-phone">Telefone (opcional)</label>
        [text your-phone class:form-control class:js-phone-pt_BR id:input-your-phone]
        <small class="form-text text-muted lh-1">Insira seu número para permitir a resposta por ligação.</small>
    </div>
    <div class="form-group">
        <label for="input-your-file">Anexo (opcional)</label>
        [file your-file limit:6291456 filetypes:jpg|jpeg|pdf|png|webp|gif id:input-your-file class:file]
        <small class="form-text text-muted">Quer enviar alguma imagem para ilustrar o que você quer dizer?</small>
    </div>
    <div class="form-group">
        <label for="input-your-message">Mensagem <b>*</b></label>
        [textarea* your-message class:form-control id:input-your-message rows:5]
    </div>
    <div>
        [submit class:btn class:btn-primary "Enviar"]
    </div>
</div>

[_remote_ip], [_user_agent]
<hr/>
<p><strong>De: </strong>[your-name]</p>
<p><strong>E-mail: </strong>[your-email]</p>
<p><strong>Assunto: </strong>[your-subject]</p>
<p><strong>Telefone: </strong>[your-phone]</p>
<p><strong>Mensagem:</strong><br/>[your-message]</p>
<hr/>
Essa mensagem foi enviada através do formulário presente em [_url].