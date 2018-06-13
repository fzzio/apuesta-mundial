<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('estaLogueadoSuperAdmin')){
	function estaLogueadoCasa() {
		$instanciaCI =& get_instance();
		if ( $instanciaCI->session->userdata('rol') == ROL_CASA ) {
			return true;
		} else {
			return false;
		}
	}
}
if ( ! function_exists('estaLogueadoAdmin')){
	function estaLogueadoApostador() {
		$instanciaCI =& get_instance();
		if ( $instanciaCI->session->userdata('rol') == ROL_APOSTADOR ) {
			return true;
		} else {
			return false;
		}
	}
}

// Función para recortar caracteres
if ( ! function_exists('recortarCaracteres')){
	function recortarCaracteres($stringTotal, $limiteTexto){
		if (strlen( $stringTotal ) <= $limiteTexto) {
			return strip_tags($stringTotal);
		}else{
			return mb_substr( strip_tags($stringTotal), 0, $limiteTexto - 3) . "...";
		}
	}
}

// Función para imprimir en <pre>
if ( ! function_exists('print_debug')){
	function print_debug($object){
		echo "<pre>";
		print_r($object);
		echo "</pre>";
	}
}

// Función para convertir arreglo Objeto a PHP
if ( ! function_exists('convert_object_to_array')){
	function convert_object_to_array($data) {
	    if (is_object($data)) {
	        $data = get_object_vars($data);
	    }
	    if (is_array($data)) {
	        return array_map(__FUNCTION__, $data);
	    }
	    else {
	        return $data;
	    }
	}
}