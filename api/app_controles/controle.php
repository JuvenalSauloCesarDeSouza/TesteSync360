<?php
	
	class controle{
		
		function __construct(){
					
		}
		
		function verifica_acesso($acao){
			
			if(!isset($_SESSION['LOGADO_SI_CJB'])){ 
				
				if($acao != 'entrar' and $acao != 'sair'){
					
					echo "<script type='text/javascript'> location.href='?controle=acesso&acao=entrar'; </script>";
					
					die();
				}	
			}
			else{
				
				/*$paginas_usuario = array();
				
				if(!in_array($nome_pagina, $paginas_usuario)){
					
					echo "<script type='text/javascript'> location.href='?controle=acesso&acao=inicio'; </script>";
					
					die();
				}*/
			}				
		}
	}	
			
?>