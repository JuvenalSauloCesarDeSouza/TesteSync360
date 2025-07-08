<?php
	
	include('app_modelos/modelo.php');
	include('app_modelos/modelo_usuario.php');
		
	class controle_usuario{
		
		function __construct(){
					
		}
		
		function cadastrar(){
			
			if(isset($_POST)){
				
				//var_dump($_POST);
				//var_dump($_FILES);
				//die();
				
				$retorno = [];
				
				/* Antes de cadastrar verifica se já existe um usuário com esses dados */
				$mu = new modelo_usuario();
				$where = "where nome_us = '".addslashes($_POST['nome_us'])."'";
				$lista_u = $mu->listar($where);

				if(count($lista_u) > 0){
					
					$retorno[0] = 'erro';
					$retorno[1] = 'Já existe no sistema um usuário com esse nome.';
				}
				else{	
				
					/* Foto do usuario */
					if(empty($_FILES['foto_us']['name']) or empty($_FILES['foto_us']['type'])){
						
						$retorno[0] = 'erro';
						$retorno[1] = 'Erro ao carregar a foto.';
					}
					else{
						
						$caminho_arq = 'publico/fotos'; 
						
						$upload = upload_arq($_FILES['foto_us'], '', 5000000, $caminho_arq);
						
						if($upload['erro']){
							
							$retorno[0] = 'erro';
							$retorno[1] = $upload['msg_erro'];
						}
						else{
							
							$mu->set_foto_us($upload['nome_arq']);
							$mu->set_nome_us($_POST['nome_us']);
							$mu->set_idade_us($_POST['idade_us']);
							$mu->set_endereco_us($_POST['endereco_us']);
							$mu->set_bairro_us($_POST['bairro_us']);
							$mu->set_estado_us($_POST['estado_us']);
							$mu->set_biografia_us($_POST['biografia_us']);	
							$cod_usuario = $mu->cadastrar();
				
							$retorno[0] = 'sucesso';
							$retorno[1] = 'Dados do usuário cadastrados com sucesso.';
						}
					}
				}

				header('Content-Type: application/json');
				echo json_encode($retorno);
				die();
			}
		}
		
		function editar(){
			
			if(isset($_POST)){
				
				//var_dump($_POST);
				//var_dump($_FILES);
				//die();
				
				$retorno = [];
				
				/* Antes de alterar verifica se já existe um usuário com o mesmos dados */
				$mu = new modelo_usuario();
				$where = "where cod_us <> ".$_POST['cod_us']." and nome_us = '".addslashes($_POST['nome_us'])."'";
				$lista_u = $mu->listar($where);

				if(count($lista_u) > 0){
					
					$retorno[0] = 'erro';
					$retorno[1] = "Já existe no sistema um usuário com esse nome.";
				}
				else{	
					
					/* Foto do usuario */
					if(empty($_FILES['foto_us']['name']) or empty($_FILES['foto_us']['type'])){
						
						/* Não alterou a foto */
						$mu->set_cod_us($_POST['cod_us']);
						$mu->set_nome_us($_POST['nome_us']);
						$mu->set_idade_us($_POST['idade_us']);
						$mu->set_endereco_us($_POST['endereco_us']);
						$mu->set_bairro_us($_POST['bairro_us']);
						$mu->set_estado_us($_POST['estado_us']);
						$mu->set_biografia_us($_POST['biografia_us']);	
						$mu->editar();
						
						$retorno[0] = 'sucesso';
						$retorno[1] = "Dados do usuário atualizados com sucesso.";
					}
					else{
						
						/* Alterou a foto */
						$caminho_arq = 'publico/fotos'; 
						
						$upload = upload_arq($_FILES['foto_us'], $_POST['foto_us_old'], 5000000, $caminho_arq);
						
						if($upload['erro']){
							
							$retorno[0] = 'erro';
							$retorno[1] = $upload['msg_erro'];
						}
						else{
							
							$mu->set_cod_us($_POST['cod_us']);
							$mu->set_foto_us($upload['nome_arq']);
							$mu->set_nome_us($_POST['nome_us']);
							$mu->set_idade_us($_POST['idade_us']);
							$mu->set_endereco_us($_POST['endereco_us']);
							$mu->set_bairro_us($_POST['bairro_us']);
							$mu->set_estado_us($_POST['estado_us']);
							$mu->set_biografia_us($_POST['biografia_us']);	
							$mu->editar();
				
							$retorno[0] = 'sucesso';
							$retorno[1] = "Dados do usuário atualizados com sucesso.";
						}
					}
				}	
			
				header('Content-Type: application/json');
				echo json_encode($retorno);
				die();
			}
		}
		
		function excluir(){
			
			if(isset($_POST)){
				
				//var_dump($_POST);
				//die();
				
				$retorno = [];
					
				$mu = new modelo_usuario();
				$mu->set_cod_us($_POST['cod_us']);
				$du = $mu->recuperar();
				
				/* Remove a foto */
				$caminho_arq = 'publico/fotos'; 
				if(file_exists($caminho_arq.'/'.$du['foto_us'])){
					unlink($caminho_arq.'/'.$du['foto_us']);
				}	
				
				/* Remove o usuario */
				$mu->excluir();
				
				$retorno[0] = 'sucesso';
				$retorno[1] = 'Dados do usuário excluidos com sucesso.';
				
				header('Content-Type: application/json');
				echo json_encode($retorno);
				die();
			}	
		}
		
		function listar(){
			
			if(isset($_POST['pesquisar'])){
				
				$fp = filtro_fp_usuario_li($_POST);
			}
			else{
				
				$fp = filtro_fp_usuario_li();
			}
			
			$mu = new modelo_usuario();
			$lista_u = $mu->listar($fp['where']);
						
			if(count($lista_u) > 0){
				
				$listagem = '<table class="tb_li" cellpadding="5" cellspacing="0">
								<tr>
									<td><b>Foto</b></td>
									<td><b>Nome</b></td>
									<td><b>Ações</b></td>
								</tr>';

				foreach($lista_u as $pos => $du){
						
					$foto_us = $du['foto_us'];
					$nome_us = $du['nome_us'];
														
					$confirmar_ex = 'onclick="return confirm(\'Tem certeza que deseja excluir este usuário?\')"';
											
					$listagem .= '<tr>
									<td><img style="width:50px;" src="../api/publico/fotos/'.$du['foto_us'].'" border="0" /></td>
									<td>'.$du['nome_us'].'</td>
									<td>
										<a href="usuario_editar.php?cod_us='.$du['cod_us'].'">
											<img src="../api/publico/img/icone_editar.png" border="0" />&nbsp; Editar
										</a>
										<br>
										<a href="usuario_excluir.php?cod_us='.$du['cod_us'].'" '.$confirmar_ex.'>
											<img src="../api/publico/img/icone_excluir.png" border="0" />&nbsp; Excluir
										</a>
									</td>
								</tr>';
				}

				$listagem .= '</table>';	
			}
			else{
				
				$listagem = '';
			}
			
			die(json_encode($listagem));
		}
		
		function recuperar(){
			
			if(isset($_GET['cod_us'])){
					
				$mu = new modelo_usuario();
				$mu->set_cod_us($_GET['cod_us']);
				$du = $mu->recuperar();
			}
			else{
					
				$du = '';
			}
			
			die(json_encode($du));
		}
	}			
?>