<style>
	.form-wrapper label {
		cursor: pointer;
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

	.form-wrapper textarea {
		height: 150px;
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
	<div class="alert alert-warning alert-dismissible fade show" role="alert">
		Campos marcados com <b style="color: red;">*</b> são obrigatórios.
		<button type="button" class="close" data-dismiss="alert" aria-label="Fechar">
			<span aria-hidden="true">&times;</span>
		</button>
	</div>
	<div class="form-group">
		<label for="input-your-name">Seu nome <b>*</b></label>
		[text* your-name default:user_first_name class:form-control id:input-your-name]
	</div>
	<div class="form-group">
		<label for="input-your-email">Seu email <b>*</b></label>
		[email* your-email default:user_email class:form-control id:input-your-email]
		<small id="input-your-email-desc" class="form-text text-muted">Você receberá uma resposta nesse email.</small>
	</div>
	<div class="form-group">
		<label for="input-your-subject">Assunto <b>*</b></label>
		[select* your-subject id:input-your-subject class:custom-select default:get include_blank "Reportar Erro" "Dúvidas e Reclamações" "Elogios" "Outros"]
		<small id="input-your-subject-desc" class="form-text text-muted">Sobre qual assunto você quer falar?</small>
	</div>
	<div class="form-group">
		<label for="input-your-phone">Telefone (opcional)</label>
		[text your-phone class:form-control class:js-phone-pt_BR id:input-your-phone]
		<small id="input-your-phone-desc" class="form-text text-muted lh-1">Insira seu número para permitir a resposta por ligação.</small>
	</div>
	<div class="form-group">
		<label for="input-your-file">Anexo (opcional)</label>
		[file your-file limit:6291456 filetypes:jpg|jpeg|pdf|png|docx|txt|webp id:input-your-file class:file]
		<small id="input-your-file-desc" class="form-text text-muted">Anexos ajudam nossa equipe a entender melhor a situação.</small>
	</div>
	<div class="form-group">
		<label for="input-your-message">Mensagem <b>*</b></label>
		[textarea* your-message class:form-control id:input-your-message]
	</div>
	<div>
		[submit class:btn class:btn-primary "Enviar"]
	</div>
</div>