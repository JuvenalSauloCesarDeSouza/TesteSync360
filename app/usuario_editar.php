<?php include('_cabecalho.php'); ?>

<script type="text/javascript">
	
	$(document).ready(function(){
		
		recuperar_usuario();
	});
	
	function envia_dados_form(){
		
		var formData = new FormData(document.getElementById("form_du"));
		
		$.ajax({
                url: '../api/?controle=usuario&acao=editar', 
                type: 'POST',
				data: formData,
				contentType: false, 
				processData: false, 
                success: function(retorno){
                    
					var r = retorno;
					if(r[0] == 'erro'){
						alert(retorno[1]);
					}
					else{
						alert(retorno[1]);	
						location.href = 'usuario_listar.php';
					}	
				},
                error: function(xhr, status, error) {
                    console.error('Error fetching data:', error);
                    alert('Houve um problema ao editar o usuario.');
                }
        });
		
	}
	
	function recuperar_usuario(){
		
		$.ajax({
                url: '../api/?controle=usuario&acao=recuperar&cod_us=<?php echo $_GET['cod_us']; ?>', 
                type: 'GET', 
                dataType: 'json',
                success: function(retorno){
                    
					$('#foto_atual').attr("src", "../api/publico/fotos/"+retorno.foto_us);
					$('input[name="foto_us_old"]').val(retorno.foto_us);
					$('input[name="nome_us"]').val(retorno.nome_us);
					$('input[name="idade_us"]').val(retorno.idade_us);
					$('input[name="endereco_us"]').val(retorno.endereco_us);
					$('input[name="bairro_us"]').val(retorno.bairro_us);
					$('select[name="estado_us"]').val(retorno.estado_us);
					$('textarea[name="biografia_us"]').val(retorno.biografia_us);
                },
                error: function(xhr, status, error) {
                    console.error('Error fetching data:', error);
                    alert('Houve um problema ao tentar recuperar os dados do usuario.');
                }
        });
	}
	
	function valida_form_du_ca(){
		
		var mensagem = ""; 
		var erro = false; 
				
		mensagem = mensagem + "Foram encontrados os seguintes erros na validação: \n"; 
		
		if($('input[name="nome_us"]').val() == ""){ 
			mensagem = mensagem + "- O campo nome é obrigatório. \n"; 
			erro = true; 
		}
		
		if($('input[name="idade_us"]').val() == ""){ 
			mensagem = mensagem + "- O campo idade é obrigatório. \n"; 
			erro = true; 
		}
		else{
			
			if($('input[name="idade_us"]').val() < 1 || $('input[name="idade_us"]').val() > 120){
				mensagem = mensagem + "- O campo idade possui um valor inválido. \n"; 
				erro = true; 
			}
		}
		
		if($('input[name="endereco_us"]').val() == ""){ 
			mensagem = mensagem + "- O campo endereço é obrigatório. \n"; 
			erro = true; 
		}
		
		if($('input[name="bairro_us"]').val() == ""){ 
			mensagem = mensagem + "- O campo bairro é obrigatório. \n"; 
			erro = true; 
		}
		
		if($('select[name="estado_us"]').val() == ""){ 
			mensagem = mensagem + "- O campo estado é obrigatório. \n"; 
			erro = true; 
		}
		
		if($('textarea[name="biografia_us"]').val() == ""){ 
			mensagem = mensagem + "- O campo biografia é obrigatório. \n"; 
			erro = true; 
		}
		
		mensagem = mensagem + "Por favor corrija estes campos.";
				
		if(erro){
			alert(mensagem);
		}
		else{
			envia_dados_form();
		}		
	}
	
	function voltar(){
		
		location.href = 'usuario_listar.php';
	}
		
</script>

<fieldset>
	
	<legend>Dados do usuário:</legend>
		
	<form id="form_du" action="" enctype="multipart/form-data" method="post" name="form_du">
		
		<input type="hidden" name="cod_us" value="<?php echo $_GET['cod_us']; ?>" />
		
		<input type="hidden" name="foto_us_old" value="" />
		
		<table cellpadding="5" cellspacing="0">
			<tr>
				<td>Foto atual:</td>
				<td><img style="width:50px;" src="" border="0" id="foto_atual" /></td>
			</tr>
			<tr>
				<td>Nova foto:</td>
				<td><input type="file" class="input_text_1" name="foto_us" accept="image/png, image/gif, image/jpeg" value="" /></td>
			</tr>
			<tr>
				<td>Nome:</td>
				<td><input type="text" class="input_text_1" name="nome_us" value="" /></td>
			</tr>
			<tr>	
				<td>Idade:</td>
				<td><input type="number" class="input_text_1" name="idade_us" min="1" max="120" value="" /></td>
			</tr>
			<tr>	
				<td>Endereço:</td>
				<td><input type="text" class="input_text_1" name="endereco_us" value="" /></td>
			</tr>
			<tr>	
				<td>Bairro:</td>
				<td><input type="text" class="input_text_1" name="bairro_us" value="" /></td>
			</tr>
			<tr>	
				<td>Estado:</td>
				<td><select class="select_1" name="estado_us"><option value="1">Acre</option><option value="2">Alagoas</option><option value="3">Amazonas</option><option value="4">Amapá</option><option value="5">Bahia</option><option value="6">Ceará</option><option value="7">Distrito Federal</option><option value="8">Espírito Santo</option><option value="9">Goiás</option><option value="10">Maranhão</option><option value="11">Minas Gerais</option><option value="12">Mato Grosso do Sul</option><option value="13">Mato Grosso</option><option value="14">Pará</option><option value="15">Paraíba</option><option value="16">Pernambuco</option><option value="17">Piauí</option><option value="18">Paraná</option><option value="19">Rio de Janeiro</option><option value="20">Rio Grande do Norte</option><option value="21">Rondônia</option><option value="22">Roraima</option><option value="23">Rio Grande do Sul</option><option value="24">Santa Catarina</option><option value="25">Sergipe</option><option value="26">São Paulo</option><option value="27">Tocantins</option></select></td>
			</tr>
			<tr>	
				<td>Biografia:</td>
				<td><textarea class="text_area_1" name="biografia_us"></textarea></td>
			</tr>
			<tr>	
				<td colspan="2"> 
					<input type="button" value="Editar" onclick="valida_form_du_ca();" /> 
					<input type="button" value="Voltar" onclick="voltar();" />
				</td>
			</tr>
		</table>
		
	</form>
	
</fieldset>

<?php include('_rodape.php'); ?>		