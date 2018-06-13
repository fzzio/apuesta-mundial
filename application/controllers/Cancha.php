<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cancha extends CI_Controller {

	public function __construct() {
		parent::__construct();
        $this->load->helper(
        	array(
	        	'form',
	        	'url',
	        	'funciones'
	        )
        );
        $this->load->library(
            array(
                'session',
                'form_validation',
            )
        );
        $this->load->model(
            array(
                'Pais_model',
                'Apostador_model',
            )
        );
	}

	public function index(){
		if ( estaLogueadoApostador() ) {
			$dataHeader['titlePage'] = "Cancha";
			$dataContent['paisesObj'] = Pais_model::getTodos();
			$dataFooter = array();
			$dataMenu = array();

			// Se cargan las vistas
	        $data['header'] = $this->load->view('cancha/blocks/header', $dataHeader);
	        $data['menu'] = $this->load->view('cancha/blocks/menu', $dataMenu );
	        $data['content'] = $this->load->view('cancha/templates/index', $dataContent );
	        $data['footer'] = $this->load->view('cancha/blocks/footer', $dataFooter );
		}else{
			redirect('cancha/logout','refresh');
		}
	}

	public function login(){
		$dataHeader['titlePage'] = "Acceder a la Cancha";
		$dataContent = array();
		$dataFooter = array();

		$this->form_validation->set_rules('cedula', 'Cédula', 'required|min_length[5]|max_length[30]');
		$this->form_validation->set_rules('password', 'Contraseña', 'required');
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');

		if ($this->form_validation->run() == FALSE){
	        $data['header'] = $this->load->view('cancha/blocks/header', $dataHeader);
	        $data['content'] = $this->load->view('cancha/templates/login', $dataContent );
	        $data['footer'] = $this->load->view('cancha/blocks/footer', $dataFooter );
		}else{
			$apostadorObj = Apostador_model::getApostadorPorCedulaPorPassword($this->input->post("cedula" , TRUE), $this->input->post("password" , TRUE));
			if( $apostadorObj ){
			    $dataUser = array(
			        "id" => $apostadorObj->getID(),
			        "cedula" => $apostadorObj->getCedula(),
			        "nombre" => $apostadorObj->getNombre(),
			        "email" => $apostadorObj->getEmail(),
			        "rol" => ROL_APOSTADOR,
			    ); 
			    $this->session->set_userdata($dataUser);
				redirect('cancha/index','refresh');
			}else{
				redirect('cancha/logout','refresh');
			}
		}

	}

	public function logout(){
		$this->session->sess_destroy();
		redirect("cancha/login");
	}
}
