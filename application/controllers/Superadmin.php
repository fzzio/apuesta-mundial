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
                'grocery_CRUD',
            )
        );
        $this->load->model(
            array(
                'Super_administrador_model',
                'Pais_model',
            )
        );
	}

	public function index(){
		if ( estaLogueadoCasa() ) {
			$dataHeader['titlePage'] = "Dashboard";
			$dataContent['paisesObj'] = Pais_model::getTodos(PAIS_ACTIVO);
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

	public function agregar_partido(){
		if ( estaLogueadoCasa() ) {
			$dataHeader['titlePage'] = "Partido";
			$dataContent = array();
			$dataMenu = array();


			try{
				$crud = new grocery_CRUD();
				//$crud->set_theme('datatables');

				$crud->set_table("partido");
				$crud->set_subject( $dataHeader['titlePage'] );

				$crud->display_as('id_pais_local', 'País Local');
				$crud->display_as('id_pais_visitante', 'País Visitante');
				$crud->display_as('fecha', 'Fecha y Hora');
				$crud->display_as('goles_local', 'Goles local');
				$crud->display_as('goles_visitante', 'Goles Visitante');
				$crud->display_as('incidencias_local', 'Incidencias Local');
				$crud->display_as('incidencias_visitante', 'Incidencias Visitante');
				$crud->display_as('fase', 'Fase');
				$crud->display_as('grupo', 'Grupo');
				$crud->display_as('estado', 'Estado');

				$crud->field_type('fase', 'dropdown', array(
					FASE_GRUPOS => 'Grupos',
					FASE_OCTAVOS => 'Octavos de Final',
					FASE_CUARTOS => 'Cuartos de Final',
					FASE_SEMIFINAL => 'Semifinal',
					FASE_FINAL => 'Final',
					FASE_TERCERO => 'Tercer Puesto',
					FASE_INACTIVO => 'Inactivo',
				));
				$crud->field_type('grupo', 'dropdown', array(
					'A' => 'Grupo A',
					'B' => 'Grupo B',
					'C' => 'Grupo C',
					'D' => 'Grupo D',
					'E' => 'Grupo E',
					'F' => 'Grupo F',
					'G' => 'Grupo G',
					'H' => 'Grupo H',
					'' => 'Ninguno',
				));
				$crud->field_type('estado', 'dropdown', array(
					PARTIDO_INACTIVO => 'Inactivo',
					PARTIDO_POR_JUGAR => 'Por jugar',
					PARTIDO_JUGANDO => 'Jugando',
					PARTIDO_FINALIZADO => 'Finalizado'
				));

				$crud->set_relation('id_pais_local', 'pais', 'nombre', array('estado' => PAIS_ACTIVO));
				$crud->set_relation('id_pais_visitante', 'pais', 'nombre', array('estado' => PAIS_ACTIVO));

				$crud->unset_texteditor('incidencias_local','full_text');
				$crud->unset_texteditor('incidencias_visitante','full_text');

				$crud->columns( 'fecha', 'id_pais_local', 'id_pais_visitante', 'goles_local', 'goles_visitante', 'fase', 'grupo', 'estado');
				$crud->fields( 'fecha', 'id_pais_local', 'id_pais_visitante', 'fase', 'grupo', 'goles_local', 'goles_visitante', 'incidencias_local', 'incidencias_visitante', 'estado');
				$crud->required_fields( 'fecha', 'id_pais_local', 'id_pais_visitante', 'fase', 'grupo', 'estado');

				$crud->unset_print();
				$crud->unset_read();
				$crud->unset_clone();

				$output = $crud->render();

				$dataHeader['css_files'] = $output->css_files;
				$dataFooter['js_files'] = $output->js_files;
				$dataContent['output'] = $output->output;

			}catch(Exception $e){
				show_error($e->getMessage().' --- '.$e->getTraceAsString());
			}

			// Se cargan las vistas
	        $data['header'] = $this->load->view('superadmin/blocks/header', $dataHeader);
	        $data['menu'] = $this->load->view('superadmin/blocks/menu', $dataMenu );
	        $data['content'] = $this->load->view('superadmin/templates/blank', $dataContent );
	        $data['footer'] = $this->load->view('superadmin/blocks/footer', $dataFooter );
		}else{
			redirect('superadmin/logout','refresh');
		}
	}
}
