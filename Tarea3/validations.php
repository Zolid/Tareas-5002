<?php
function checkName($post){
	if(isset($post['nombre'])){
		$regexp = "/^[A-Za-záéíóú\ ]+$/";
		if(preg_match($regexp, $post['nombre'])){
			return true;
		}
	}
	return false;
}

function checkEmail($post) {
      return filter_var($post['email'], FILTER_VALIDATE_EMAIL);
   }
?>