<?php
	
	error_reporting(true);
	
	/***************************** Configura a sessуo ************************************/
	/* Define o limitador de cache para 'private' */
	//session_cache_limiter('private');
	//$cache_limiter = session_cache_limiter();

	/* Define o limite de tempo do cache em 240 minutos */
	//session_cache_expire(240);
	//$cache_expire = session_cache_expire();

	/* Inicia a sessуo */
	session_start();
	//echo "O limitador de cache esta definido agora como ".$cache_limiter."<br />";
	//echo "As sessѕes em cache irуo expirar em ".$cache_expire." minutos";
	
	/*************************** Inclui os componentes php ******************************/
	include('componentes/funcoes/auxiliares.php');
	include('componentes/funcoes/filtros_form_pesquisa.php');
		
	/************************* Verifica o controle e a aчуo *****************************/
	if(isset($_GET['controle']) and !empty($_GET['controle'])){
		
		$controle = 'controle_'.$_GET['controle'];
	}
	else{
		
		$controle = 'controle_acesso';
	}
	
	if(isset($_GET['acao']) and !empty($_GET['acao'])){
		
		$acao = $_GET['acao'];
	}
	else{
		
		$acao = 'index';
	}
	
	$caminho = 'app_controles/'.$controle.'.php';
	
	//echo 'caminho: '.$caminho.'  aчуo: '.$acao; die(); 	

	include($caminho);	
			
	$c = new $controle();
	$c->$acao();
			
?>