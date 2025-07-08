<?php
	
	class modelo_usuario extends modelo{
		
		public $cod_us;
		public $foto_us;
		public $nome_us;
		public $idade_us;
		public $endereco_us;
		public $bairro_us;
		public $estado_us;
		public $biografia_us;
		
		function __construct(){
					
		}
		
		function set_cod_us($val){
			
			$this->cod_us = $val;
		}
		
		function set_foto_us($val){
			
			$this->foto_us = $val;
		}
		
		function set_nome_us($val){
			
			$this->nome_us = $val;
		}
		
		function set_idade_us($val){
			
			$this->idade_us = $val;
		}
		
		function set_endereco_us($val){
			
			$this->endereco_us = $val;
		}
		
		function set_bairro_us($val){
			
			$this->bairro_us = $val;
		}
		
		function set_estado_us($val){
			
			$this->estado_us = $val;
		}
		
		function set_biografia_us($val){
			
			$this->biografia_us = $val;
		}
		
		function cadastrar(){
			
			$sql = "insert into ts_usuarios(
						foto_us,
						nome_us,
						idade_us,
						endereco_us,
						bairro_us,
						estado_us,
						biografia_us
					) 
					values(
						'".$this->foto_us."',
						'".addslashes($this->nome_us)."',
						 ".$this->idade_us.",
						'".addslashes($this->endereco_us)."',
						'".addslashes($this->bairro_us)."',
						'".$this->estado_us."',
						'".addslashes($this->biografia_us)."'	
					)";
					
			$res = $this->insert($sql);

			return $res;	
		}
		
		function editar(){
			
			if(!empty($this->foto_us)){
				
				$foto_us = "foto_us = '".$this->foto_us."',";	
			}
			else{
				
				$foto_us = "";	
			}
			
			$sql = "update ts_usuarios 
						set 
							".$foto_us."
							nome_us = '".addslashes($this->nome_us)."',
							idade_us = ".$this->idade_us.",
							endereco_us = '".addslashes($this->endereco_us)."',
							bairro_us = '".addslashes($this->bairro_us)."',
							estado_us = '".$this->estado_us."',
							biografia_us = '".addslashes($this->biografia_us)."'	   
					where cod_us = ".$this->cod_us;
					
			$res = $this->update($sql);		
			
			return $res;
		}
		
		function excluir(){
			
			$sql = "delete from ts_usuarios where cod_us = ".$this->cod_us;
			$res = $this->delete($sql);
			
			return $res;
		}
				
		function listar($where = ''){
			
			$sql = "select * from ts_usuarios ".$where." order by nome_us";
			$res = $this->select($sql);
			$num_reg = $this->num_rows($res);
			
			$lista_usuarios = [];
			if($num_reg > 0){
				
				while($reg = $this->row($res)){
					
					$lista_usuarios[] = $reg;
				}	
			}
			
			return $lista_usuarios;
		}
		
		function recuperar(){
			
			$sql = "select * from ts_usuarios where cod_us = ".$this->cod_us;
			$res = $this->select($sql);
			$num_reg = $this->num_rows($res);
			
			if($num_reg > 0){
				
				$reg = $this->row($res);
			}
			else{
				$reg = '';
			}
			
			return $reg;
		}
	}	
			
?>