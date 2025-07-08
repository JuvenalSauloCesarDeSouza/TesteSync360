<?php include('_cabecalho.php'); ?>

<script type="text/javascript">
	
	$(document).ready(function(){
		
		listar_usuarios();	
	});
	
	function limpar_pesquisa(){
		
		location.href = 'usuario_listar.php';
	}
		
	function listar_usuarios(){
		
		$.ajax({
                url: '../api/?controle=usuario&acao=listar', 
                type: 'POST', 
                dataType: 'json',
                success: function(retorno){
                    $('#listagem').html(retorno);
                },
                error: function(xhr, status, error) {
                    console.error('Error fetching data:', error);
                    $('#listagem').html('<p>Houve um problema ao listar os usuarios.</p>');
                }
        });
	}

	function pesquisar_usuarios(){
		
		var pesquisar = true;
		var nome_us_p = $('input[name="nome_us_p"]').val();
		
		$.ajax({
                url: '../api/?controle=usuario&acao=listar', 
                type: 'POST', 
				data: { pesquisar: pesquisar, nome_us_p: nome_us_p},
                dataType: 'json',
                success: function(retorno){
                    $('#listagem').html(retorno);
                },
                error: function(xhr, status, error) {
                    console.error('Error fetching data:', error);
                    $('#listagem').html('<p>Houve um problema ao listar os usuarios.</p>');
                }
        });
	}	
	
</script>

<fieldset>
		
	<legend>Novo usuário:</legend>
		
	<table cellpadding="5" cellspacing="0">
		<tr>
			<td>
				<a href="usuario_cadastrar.php">
					<img src="app_img/icone_adicionar.png" border="0" />&nbsp; Inserir usuário
				</a>
			</td>
		</tr>
	</table>
	
</fieldset>

<fieldset>
					
	<legend>Filtros:</legend>
	
	<form action="" method="post" name="form_fi_usuario">
				
		<table cellpadding="0" cellspacing="0" style="">
			<tr>
				<td>Nome do usuário: <br> <input name="nome_us_p" value="" /></td>
				<td>
					&nbsp; <br> &nbsp; <input type="button" value="Pesquisar" onclick="pesquisar_usuarios();" />
					&nbsp; <input type="button" value="Limpar Pesquisa" onclick="limpar_pesquisa();" />
				</td>
			</tr>	
		</table>
		
	</form>
	
</fieldset>	
	
<fieldset>
		
	<legend>Usuários:</legend>
					
	<div id="listagem"></div>
				
</fieldset>		

<?php include('_rodape.php'); ?>