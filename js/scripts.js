// Inicia o jQuery
$(function(){

	function cpfConfig(){
		$('#nomePessoa').html('Nome:');
		$('#docPessoa').html('CPF:');

		$('#documento').attr({placeholder:"000.000.000-00",maxlength:"14", minlength:"14"});
		$("#documento").mask("999.999.999-99");
	}

	function cnpjConfig (){
		$('#nomePessoa').html('Razão social:');
		$('#docPessoa').html('CNPJ:');

		$('#documento').attr({placeholder:"00.000.000/0000-00",maxlength:"18", minlength:"18"});
		$("#documento").mask("99.999.999/9999-99");
	}

	// CAMPOS DO FORMULÁRIO e VALIDAÇOES
	$(document).ready(function(e) {

		//seta os cofigs do tipo de pessoa carregado
		if($('#pessoa').val() == 'Fisica'){
			cpfConfig();
		}else{
			cnpjConfig();
		}
		  
		//verifica o tipo de pessoa
		$('#pessoa').change(function(){
			var valorEscolhido 	= $('#pessoa option:selected').val();
			if (valorEscolhido == 'Fisica'){
				cpfConfig();

				$('#nome').val('');
				$('#documento').val('');

			}else{
				cnpjConfig();

				$('#nome').val('');
				$('#documento').val('');
				
			}
		
		});
		
	});

	// validaçoes
	$('#form_clientes').validate({

		rules:{
			pessoa:{
				required: true
			},
			nome:{
				required: true,
				minlength: 3,
				maxlength: 40
			},
			documento:{
				required: true
			},
			email:{
				required: true,	
				maxlength: 40

			},
			telefone:{
				required: true,	
				minlength: 14,
				maxlength: 15

			},
		},
		messages: {
			pessoa: "Campo obrigatório",
			nome: {
				required: "Campo obrigatório",
				minlength: "Digite ao menos 3 carácteres"
			},
			documento: "Campo obrigatório",
			email: "Campo obrigatório",
			telefone: "Campo obrigatório",
		
		}
	
	});
		
	// Cria uma variável que vamos utilizar para verificar se o
	// formulário está sendo enviado
	var enviando_formulario = false;

	
	$('#form_clientes').submit(function(e){
		e.preventDefault();

		var v_id = $('#id').val();
		var v_pessoa = $('#pessoa').val();
		var v_nome = $('#nome').val();
		var v_documento = $('#documento').val();
		var v_email = $('#email').val();
		var v_telefone = $('#telefone').val();

		//valida email
		var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
		if (!filter.test(v_email)) {

			$('#email').focus();
			$("#email-error").show()
			.text('Por favor, informe um email válido.');
			return false;
		}
		
  		var form = $(this);
		var submit_btn = $('#form_clientes :submit');

		// O valor do botão de submit
		var submit_btn_text = submit_btn.val();

		// Retorna o botão de submit ao seu estado natural
		function volta_submit() {
			// Remove o atributo desabilitado
			submit_btn.removeAttr('disabled');
			
			// Retorna o texto padrão do botão
			submit_btn.val(submit_btn_text);
			
			// Retorna o valor original (não estamos mais enviando)
			enviando_formulario = false;
			submit_btn.val('Enviar');
		}

		// Não envia o formulário se já tiver algum envio
		if ( ! enviando_formulario  ) {	
			//Configura a variável enviando
			enviando_formulario = true;	
			$.ajax({
				beforeSend: function() {
					// Adiciona o atributo desabilitado no botão
					submit_btn.attr('disabled', true);
					
					// Modifica o texto do botão
					submit_btn.val('Enviando...');
				
				}, 
				url: form.attr('action'),
				method: form.attr('method'),
				data: {id: v_id, pessoa: v_pessoa, nome: v_nome, documento: v_documento, email: v_email, telefone: v_telefone},
				dataType: 'json',
				// Se enviado com sucesso
				success: function( data ) {	
    				console.log('data :', data);
					volta_submit();

					// Se os dados forem enviados com sucesso
					if ( data == 'salvo' ) {
						alert('Dado enviado com sucesso');
						location.reload();
						return false;

					}else if ( data == 'editado' ) {
						alert('Dado editado com sucesso!');
						location.replace('consulta.php');
						return false;
						
					} 
					else if (data == 'email cadastrado'){
						alert('Erro -> ' + 'Email já cadastrado! Tente outro email.');

					}else {
						alert('Erro ao enviar dados');
						return false;
					}
				},
				// Se der algum problema
				error: function (error) {
    				console.log('error :', error);
					// Volta o botão de submit
					volta_submit();
					
					alert('Erro -> ' + error);
				
					return;
				}
				
			});
			
		};
		return false;
	});

	$('.btnExcluir').click(function(e){
		var idCliente = this.id;
		var r = confirm("Relamente deseja excluir?");

		if (r == true){
			e.preventDefault(); 
			$.ajax({ 
				type: "POST", 
				data: {},
				url: "bd/deletebd.php?id=" + idCliente,

				success: function(msg){ 
					location.reload();
					alert(msg);
				},
				error: function(msg){ 
					alert('Erro -> ' + msg);

				}
			})
		}
	
	});
});






