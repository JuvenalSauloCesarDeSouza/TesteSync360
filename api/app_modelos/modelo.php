<?php
	
	class modelo{
		
		public $host;
		public $user;
		public $pass;
		public $dbname;
		public $host_dbname;
			
		function __construct(){
						
		}
				
		function open_connection(){
			
			$this->host = "localhost";
			$this->user = "root";
			$this->pass = "";
			$this->dbname = "teste_sync360";
			$this->host_dbname = 'mysql:host='.$this->host.'; dbname='.$this->dbname;
			
			try {
				$connection = new PDO($this->host_dbname, $this->user, $this->pass, array(PDO::ATTR_PERSISTENT => true));
				$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			} 
			catch (PDOException $e) {
								
				$error = 'Não foi possível estabelecer uma conexão';
				$sql = 'n/a';
				$msg = $e->getMessage();
				
				$this->write_arq_log($error, $sql, $msg);
				
				echo '<p>Não foi possível estabelecer uma conexão</p>';
				die();	
			}	
				
			return $connection;
		}
		
		function close_connection($connection){
			
			/* Caso a conexão não seja persistente a mesma é fechada automaticamente após a execução do script */
		}
				      
		function select($sql){
			
			$connection = $this->open_connection();
			
			try {
				$res = $connection->query($sql);
			} 
			catch (PDOException $e) {
				
				$error = 'Não foi possível executar a consulta';
				$msg = $e->getMessage();
				
				$this->write_arq_log($error, $sql, $msg);
				
				echo '<p>Não foi possível executar a consulta</p>';
				die();	
			}
			
			return $res;
		}
		
		function insert($sql){
			
			$connection = $this->open_connection();
			
			try {
				$res = $connection->query($sql);
			} 
			catch (PDOException $e) {
				
				$error = 'Não foi possível executar a consulta';
				$msg = $e->getMessage();
				
				$this->write_arq_log($error, $sql, $msg);
				
				echo '<p>Não foi possível executar a consulta</p>';
				die();	
			}
			
			$id = $connection->lastInsertId();
				
			return $id;
				
		}
		
		function update($sql){
			
			$connection = $this->open_connection();
			
			try {	
				$res = $connection->query($sql);
			} 
			catch (PDOException $e) {
				
				$error = 'Não foi possível executar a consulta';
				$msg = $e->getMessage();
				
				$this->write_arq_log($error, $sql, $msg);
				
				echo '<p>Não foi possível executar a consulta</p>';
				die();	
			}
			
			return $res;
		}
		
		function delete($sql){
			
			$connection = $this->open_connection();
			
			try {
				$res = $connection->query($sql);
			} 
			catch (PDOException $e) {
				
				$error = 'Não foi possível executar a consulta';
				$msg = $e->getMessage();
				
				$this->write_arq_log($error, $sql, $msg);
				
				echo '<p>Não foi possível executar a consulta</p>';
				die();	
			}
			
			return $res;
		}
				
		function row($res){
			
			try {
				$row = $res->fetch(PDO::FETCH_ASSOC);
			}	
			catch (PDOException $e) {
				
				$error = 'Não foi possível recuperar os registros';
				$sql = 'n/a';
				$msg = $e->getMessage();
				
				$this->write_arq_log($error, $sql, $msg);
				
				echo '<p>Não foi possível recuperar os registros</p>';
				die();	
			}
			
			return $row;
		}
		
		function num_rows($res){
			
			try {
				$num_reg = $res->rowCount();
			}	
			catch (PDOException $e) {
				
				$error = 'Não foi possível contar os registros';
				$sql = 'n/a';
				$msg = $e->getMessage();
				
				$this->write_arq_log($error, $sql, $msg);
				
				echo '<p>Não foi possível contar os registros</p>';
				die();	
			}
			
			return $num_reg;
		}
		
		/* Metodos auxiliares */
		function write_arq_log($error, $sql, $msg){
			
			/* Inicializa as variaveis */
			date_default_timezone_set('America/Sao_Paulo');

			$data = date('d/m/Y');
			$hora = date('H:i:s');
			$endereco = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
			$break = chr(13).chr(10);				
						
			/* Verifica o caminho para a pasta de relatorios */
			if(is_dir('temporario')){
				$path = 'temporario/arq_log_erros_sql.txt';	
			}
			else if(is_dir('../temporario')){
				$path = '../temporario/arq_log_erros_sql.txt';	
			}
			else if(is_dir('../../temporario')){
				$path = '../../temporario/arq_log_erros_sql.txt';	
			}
			else{
				$path = '../../../temporario/arq_log_erros_sql.txt';
			}
			
			/* Grava o log no arquivo */
			$arq_log = fopen($path, "a");
			
			$write = fwrite($arq_log, 'Em '.$data.' as '.$hora.$break.$break);
			$write = fwrite($arq_log, 'Endereço: '.$break.$break.$endereco.$break.$break);
			$write = fwrite($arq_log, 'Erro: '.$break.$break.$error.$break.$break);
			$write = fwrite($arq_log, 'Sql: '.$break.$break.$sql.$break.$break);
			$write = fwrite($arq_log, 'Mensagem: '.$break.$break.$msg.$break.$break);
			$write = fwrite($arq_log, '------------------------------------------------------------------------------------------------------------------------------------------------'.$break.$break);
							
			fclose($arq_log);		
		}
	}
		
?>

