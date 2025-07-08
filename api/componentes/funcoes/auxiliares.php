<?php
	
	/* Funções letra a */
	
	
	/* Funções letra c */
	
	/* Funções letra e */
	
	/* Funções letra f */
	
	/* Funções letra g */
			
	/* Funções letra m */
		
	/* Funções letra n */
	function novo_nome_arq($caminho, $arq){
		
		$aux = explode('.', $arq['name']);
		
		$nome_arq = $aux[0];
		$extensao_arq = end($aux);
		$novo_nome_arq = md5($nome_arq).'.'.$extensao_arq;
		$arquivo_arq = $caminho.'/'.$novo_nome_arq;
		
		$i = 1;
		while(file_exists($arquivo_arq)){
			$novo_nome_arq = md5($nome_arq.$i).'.'.$extensao_arq;
			$arquivo_arq = $caminho.'/'.$novo_nome_arq;
			$i++;
		}
		
		return $novo_nome_arq;	
	}
	
	/* Funções letra p */
		
	/* Funções letra r */
		
	/* Funções letra s */
	
	/* Funções letra t */
		
	/* Funções letra u */
	function upload_arq($arq, $arq_antigo, $tamanho_maximo, $caminho){
		
		$retorno = array('erro' => true, 'msg_erro' => '', 'nome_arq' => '');
		
		if(empty($arq['name']) and empty($arq['type']) and empty($arq['tmp_name'])){
			
			$retorno['erro'] = true;
			$retorno['msg_erro'] = 'As informações do arquivo passado estão vazias.';
			$retorno['nome_arq'] = '';
		}
		else{
			
			if($arq['size'] > $tamanho_maximo){
				
				$retorno['erro'] = true;
				$retorno['msg_erro'] = 'Excedeu o tamanho máximo definido.';
				$retorno['nome_arq'] = '';
			}
			else{
			
				/* Trata o nome do arquivo para não haver duplicatas */
				$novo_nome = novo_nome_arq($caminho, $arq);
				
				/* Remove o arquivo antigo */
				if(!empty($arq_antigo)){
					
					if(file_exists($caminho.'/'.$arq_antigo)){
						
						$removeu = unlink($caminho.'/'.$arq_antigo);
						
						if(!$removeu){
							
							$retorno['erro'] = true;
							$retorno['msg_erro'] = 'Não foi possivel remover o arquivo antigo.';
							$retorno['nome_arq'] = '';
						}
					}
				}
				
				/* Faz o upload do novo arquivo */
				$moveu = move_uploaded_file($arq['tmp_name'], $caminho.'/'.$novo_nome);
				
				if(!$moveu){
							
					$retorno['erro'] = true;
					$retorno['msg_erro'] = 'Não foi possivel mover o arquivo.';
					$retorno['nome_arq'] = '';
				}
				else{
												
					$retorno['erro'] = false;
					$retorno['msg_erro'] = '';
					$retorno['nome_arq'] = $novo_nome;
				}	
			}			
		}
		
		return $retorno;
	}
	
	/* Funções letra v */
		
?>	