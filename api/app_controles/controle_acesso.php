<?php
	
	include('controle.php');
	include('app_modelos/modelo.php');
	include('app_modelos/modelo_usuario.php');
		
	class controle_acesso extends controle{
		
		function __construct(){
			
		}
		
		function index(){
			
			$this->inicio();
		}
		
		function entrar(){
			
			if($_SERVER['REQUEST_METHOD'] == 'POST'){
				
			}
			
			include('app_visualizacoes/cabecalho.php');
			include('app_visualizacoes/acesso/entrar.php');
			include('app_visualizacoes/rodape.php');
		}
		
		function inicio(){
			
			include('app_visualizacoes/cabecalho.php');
			include('app_visualizacoes/acesso/inicio.php');
			include('app_visualizacoes/rodape.php');
		}
		
		function sair(){
			
			setcookie("LOGADO_SI_TS", "", time() - 3600);
			unset($_SESSION['LOGADO_SI_TS']);
			
			echo '<script type="text/javascript"> location.href="?controle=acesso&acao=entrar"; </script>'; 
		}
	}	
			
?>