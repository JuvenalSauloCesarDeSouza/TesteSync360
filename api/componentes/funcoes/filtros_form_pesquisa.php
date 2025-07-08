<?php
	
	function filtro_fp_usuario_li($val_fp = ''){
		
		$fp = array();
		$cw = '';
		
		if(!empty($val_fp)){
						
			if(!empty($val_fp['nome_us_p'])){
					
				$cw .= "nome_us like '%".addslashes($val_fp['nome_us_p'])."%' and ";
			}	
		}
					
		if(!empty($cw)){
					
			$where = "where ".substr($cw, 0, -4);
			$fp['exec_sql'] = true;
		}
		else{
					
			$where = "";
			$fp['exec_sql'] = false;
		}
			
		$fp['where'] = $where;
		
		return $fp;	
	}
		
?>	