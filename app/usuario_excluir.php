<?php include('_cabecalho.php'); ?>

<script type="text/javascript">
	
	$(document).ready(function(){
		
		recuperar_usuario();
	});
	
	function envia_dados_form(){
		
		var formData = new FormData(document.getElementById("form_du"));
		
		$.ajax({
                url: '../api/?controle=usuario&acao=excluir', 
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
                    alert('Houve um problema ao excluir o usuario.');
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
					$('#nome_us').html(retorno.nome_us);
					$('#idade_us').html(retorno.idade_us);
					$('#endereco_us').html(retorno.endereco_us);
					$('#bairro_us').html(retorno.bairro_us);
					$('select[name="estado_us"]').val(retorno.estado_us);
					$('#biografia_us').html(retorno.biografia_us);
                },
                error: function(xhr, status, error) {
                    console.error('Error fetching data:', error);
                    alert('Houve um problema ao tentar recuperar os dados do usuario.');
                }
        });
	}
	
	function voltar(){
		
		location.href = 'usuario_listar.php';
	}
			
</script>

<fieldset>
	
	<legend>Dados do usuário:</legend>
		
	<form id="form_du" action="" enctype="multipart/form-data" method="post" name="form_du">
		
		<input type="hidden" name="cod_us" value="<?php echo $_GET['cod_us']; ?>" />
		
		<table cellpadding="5" cellspacing="0">
			<tr>
				<td>Foto atual:</td>
				<td><img style="width:50px;" src="" border="0" id="foto_atual" /></td>
			</tr>
			<tr>
				<td>Nome:</td>
				<td id="nome_us"></td>
			</tr>
			<tr>	
				<td>Idade:</td>
				<td id="idade_us"></td>
			</tr>
			<tr>	
				<td>Endereço:</td>
				<td id="endereco_us"></td>
			</tr>
			<tr>	
				<td>Bairro:</td>
				<td id="bairro_us"></td>
			</tr>
			<tr>	
				<td>Estado:</td>
				<td><select class="select_1" name="estado_us" disabled="disabled"><option value="1">Acre</option><option value="2">Alagoas</option><option value="3">Amazonas</option><option value="4">Amapá</option><option value="5">Bahia</option><option value="6">Ceará</option><option value="7">Distrito Federal</option><option value="8">Espírito Santo</option><option value="9">Goiás</option><option value="10">Maranhão</option><option value="11">Minas Gerais</option><option value="12">Mato Grosso do Sul</option><option value="13">Mato Grosso</option><option value="14">Pará</option><option value="15">Paraíba</option><option value="16">Pernambuco</option><option value="17">Piauí</option><option value="18">Paraná</option><option value="19">Rio de Janeiro</option><option value="20">Rio Grande do Norte</option><option value="21">Rondônia</option><option value="22">Roraima</option><option value="23">Rio Grande do Sul</option><option value="24">Santa Catarina</option><option value="25">Sergipe</option><option value="26">São Paulo</option><option value="27">Tocantins</option></select></td>
			</tr>
			<tr>	
				<td>Biografia:</td>
				<td id="biografia_us"></td>
			</tr>
			<tr>	
				<td colspan="2"> 
					<h2>Você deseja excluir esse usuário?</h2> 
					<input type="button" value="Sim" onclick="envia_dados_form();" /> 
					<input type="button" value="Não" onclick="voltar();" />
				</td>
			</tr>
		</table>
		
	</form>
	
</fieldset>

<?php include('_rodape.php'); ?>		