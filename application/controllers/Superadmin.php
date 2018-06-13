<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Superadmin extends CI_Controller {

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
                'Super_administrador_model',
            )
        );
	}

	public function index(){
		if ( estaLogueadoCasa() ) {
			$dataHeader['titlePage'] = "Dashboard";
			$dataContent = array();
			$dataFooter = array();
			$dataMenu = array();

			// Se cargan las vistas
	        $data['header'] = $this->load->view('superadmin/blocks/header', $dataHeader);
	        $data['menu'] = $this->load->view('superadmin/blocks/menu', $dataMenu );
	        $data['content'] = $this->load->view('superadmin/templates/index', $dataContent );
	        $data['footer'] = $this->load->view('superadmin/blocks/footer', $dataFooter );
		}else{
			redirect('superadmin/logout','refresh');
		}
	}

	public function login(){
		$dataHeader['titlePage'] = "Login";
		$dataContent = array();
		$dataFooter = array();

		$this->form_validation->set_rules('sa-username', 'Usuario', 'required|min_length[5]|max_length[30]');
		$this->form_validation->set_rules('sa-password', 'Contraseña', 'required');
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');

		if ($this->form_validation->run() == FALSE){
	        $data['header'] = $this->load->view('superadmin/blocks/header', $dataHeader);
	        $data['content'] = $this->load->view('superadmin/templates/login', $dataContent );
	        $data['footer'] = $this->load->view('superadmin/blocks/footer', $dataFooter );
		}else{
			$usuarioSuperAdmin = Super_administrador_model::getSuperAdministradorPorUserPorPassword($this->input->post("sa-username" , TRUE), $this->input->post("sa-password" , TRUE));
			if( $usuarioSuperAdmin ){
			    $dataUser = array(
			        "id" => $usuarioSuperAdmin->getID(),
			        "username" => $usuarioSuperAdmin->getUser(),
			        "nombre" => $usuarioSuperAdmin->getNombre(),
			        "email" => $usuarioSuperAdmin->getEmail(),
			        "rol" => ROL_CASA,
			    ); 
			    $this->session->set_userdata($dataUser);
				redirect('superadmin/index','refresh');
			}else{
				redirect('superadmin/logout','refresh');
			}
		}

	}

	public function logout(){
		$this->session->sess_destroy();
		redirect("superadmin/login");
	}
}
