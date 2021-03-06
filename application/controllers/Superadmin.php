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
                'Apostador_model',
                'Partido_model',
                'Pronostico_model',
                'Apuesta_model',
            )
        );
	}

	public function index(){
		if ( estaLogueadoCasa() ) {
			$dataHeader['titlePage'] = "Dashboard";
			$dataContent['apostadoresObj'] = Apostador_model::getTodos(ESTADO_ACTIVO, TRUE);
			$dataContent['totalApostadores'] = count( $dataContent['apostadoresObj'] );
			$dataContent['paisesObj'] = Pais_model::getTodos(PAIS_ACTIVO);

			$dataContent['totalComisiones'] = 0;
			$dataContent['totalComisionesReal'] = 0;
			$dataContent['totalComisionesInvitados'] = 0;

			$dataContent['totalInicial'] = 0;
			$dataContent['totalInicialReal'] = 0;
			$dataContent['totalInicialInvitados'] = 0;

			$dataContent['totalDisponible'] = 0;
			$dataContent['totalDisponibleReal'] = 0;
			$dataContent['totalDisponibleInvitados'] = 0;

			$dataContent['totalBloqueado'] = 0;
			$dataContent['totalBloqueadoReal'] = 0;
			$dataContent['totalBloqueadoInvitados'] = 0;

			foreach ($dataContent['apostadoresObj'] as $indiceApostadores => $apostadorObj) {
				if ( $apostadorObj->getID() == 4 ) {
					// Usuario Demo
					continue;
				}
				if ( $apostadorObj->getEstado() == ESTADO_INVITADO ) {
					$dataContent['totalComisionesInvitados'] += $apostadorObj->getGastoTotalPorApostar();
					$dataContent['totalInicialInvitados'] += $apostadorObj->getMontoInicial();
					$dataContent['totalDisponibleInvitados'] += $apostadorObj->getValorDisponible();
					$dataContent['totalBloqueadoInvitados'] += $apostadorObj->getValorAculumadoBloqueado();
					
				}else{
					$dataContent['totalComisionesReal'] += $apostadorObj->getGastoTotalPorApostar();
					$dataContent['totalInicialReal'] += $apostadorObj->getMontoInicial();
					$dataContent['totalDisponibleReal'] += $apostadorObj->getValorDisponible();
					$dataContent['totalBloqueadoReal'] += $apostadorObj->getValorAculumadoBloqueado();
				}
			}
			$dataContent['totalComisiones'] = $dataContent['totalComisionesReal'] + $dataContent['totalComisionesInvitados'];
			$dataContent['totalInicial'] = $dataContent['totalInicialReal'] + $dataContent['totalInicialInvitados'];
			$dataContent['totalDisponible'] = $dataContent['totalDisponibleReal'] + $dataContent['totalDisponibleInvitados'];
			$dataContent['totalBloqueado'] = $dataContent['totalBloqueadoReal'] - $dataContent['totalBloqueadoInvitados'];
			$dataContent['totalPagar'] = $dataContent['totalDisponibleReal'] + $dataContent['totalBloqueadoReal'];

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
		$this->form_validation->set_rules('sa-password', 'Contrase??a', 'required');
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

	public function partido(){
		if ( estaLogueadoCasa() ) {
			$dataHeader['titlePage'] = "Partido";
			$dataContent = array();
			$dataMenu = array();
			$dataFooter = array();

			try{
				$crud = new grocery_CRUD();
				//$crud->set_theme('datatables');

				$crud->set_table("partido");
				$crud->set_subject( $dataHeader['titlePage'] );

				$crud->display_as('id_pais_local', 'Pa??s Local');
				$crud->display_as('id_pais_visitante', 'Pa??s Visitante');
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
					'8' => 'Ninguno',
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

				$crud->order_by('fecha','asc');

				$crud->unset_print();
				$crud->unset_read();
				$crud->unset_export();
				$crud->unset_clone();
				$crud->unset_delete();

				$crud->unset_jquery();
				$crud->unset_bootstrap();

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
	public function pronostico(){
		if ( estaLogueadoCasa() ) {
			$dataHeader['titlePage'] = "Pron??stico";
			$dataContent = array();
			$dataMenu = array();
			$dataFooter = array();

			try{
				$crud = new grocery_CRUD();
				//$crud->set_theme('datatables');

				$crud->set_table("pronostico");
				$crud->set_subject( $dataHeader['titlePage'] );

				$crud->display_as('id_partido', 'Partido');
				$crud->display_as('id_apostador', 'Apostador');
				$crud->display_as('resultado', 'Resultado');
				$crud->display_as('fecha', 'Fecha');
				$crud->display_as('estado', 'Estado');

				$crud->field_type('resultado', 'dropdown', array(
					PRONOSTICO_GANA_LOCAL => 'Gana local',
					PRONOSTICO_GANA_VISITANTE => 'Gana visitante',
					PRONOSTICO_EMPATE => 'Empate',
				));

				$crud->field_type('estado', 'dropdown', array(
					ESTADO_INACTIVO => 'Inactivo',
					ESTADO_ACTIVO => 'Activo',
				));

				$crud->set_relation('id_partido', 'partido', '{id_pais_local} vs {id_pais_visitante}', array('estado' => PARTIDO_POR_JUGAR));
				$crud->set_relation('id_apostador', 'apostador', 'nombre', array('estado' => ESTADO_ACTIVO));


				$crud->columns( 'id_partido', 'id_apostador', 'resultado', 'fecha', 'estado' );
				$crud->fields( 'id_partido', 'id_apostador', 'resultado', 'estado' );
				$crud->required_fields( 'id_partido', 'id_apostador', 'resultado', 'estado' );

				//$crud->order_by('fecha','asc');

				$crud->unset_print();
				$crud->unset_read();
				$crud->unset_export();
				$crud->unset_clone();

				$crud->unset_jquery();
				$crud->unset_bootstrap();

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
	public function apuesta(){
		if ( estaLogueadoCasa() ) {
			$dataHeader['titlePage'] = "Apuesta";
			$dataContent = array();
			$dataMenu = array();
			$dataFooter = array();

			try{
				$crud = new grocery_CRUD();
				//$crud->set_theme('datatables');

				$crud->set_table("apuesta");
				$crud->set_subject( $dataHeader['titlePage'] );

				$crud->display_as('id_pronostico_apostador_1', 'Pron??stico 1');
				$crud->display_as('id_pronostico_apostador_2', 'Pron??stico 2');
				$crud->display_as('monto', 'Monto');
				$crud->display_as('fecha', 'Fecha');
				$crud->display_as('estado', 'Estado');

				$crud->field_type('estado', 'dropdown', array(
					APUESTA_NO_EMPAREJADA => 'No emparejada',
					APUESTA_EMPAREJADA => 'Empajerada',
				));

				$crud->set_relation('id_pronostico_apostador_1', 'pronostico', 'Partido: {id_partido}, Apostador: {id_apostador}, Resultado: {resultado}', array('estado' => ESTADO_ACTIVO));
				$crud->set_relation('id_pronostico_apostador_2', 'pronostico', 'Partido: {id_partido}, Apostador: {id_apostador}, Resultado: {resultado}', array('estado' => ESTADO_ACTIVO));


				$crud->columns( 'id_pronostico_apostador_1', 'id_pronostico_apostador_2', 'monto', 'fecha', 'estado' );
				$crud->fields( 'id_pronostico_apostador_1', 'id_pronostico_apostador_2', 'monto', 'estado' );
				$crud->required_fields( 'id_pronostico_apostador_1', 'id_pronostico_apostador_2', 'monto', 'estado' );

				//$crud->order_by('fecha','asc');

				$crud->unset_print();
				$crud->unset_read();
				$crud->unset_export();
				$crud->unset_clone();

				$crud->unset_jquery();
				$crud->unset_bootstrap();

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
	public function apostador(){
		if ( estaLogueadoCasa() ) {
			$dataHeader['titlePage'] = "Apostador";
			$dataContent = array();
			$dataMenu = array();
			$dataFooter = array();

			try{
				$crud = new grocery_CRUD();
				//$crud->set_theme('datatables');

				$crud->set_table("apostador");
				$crud->set_subject( $dataHeader['titlePage'] );

				$crud->display_as('cedula', 'C??dula');
				$crud->display_as('password', 'Contrase??a');
				$crud->display_as('nombre', 'Nombre completo');
				$crud->display_as('email', 'Email');
				$crud->display_as('celular', 'Celular');
				$crud->display_as('monto_inicial', 'Monto Inicial');
				$crud->display_as('fecha', 'Fecha y Hora');
				$crud->display_as('estado', 'Estado');

				$crud->field_type('password', 'password');
				$crud->field_type('estado', 'dropdown', array(
					ESTADO_INACTIVO => 'Inactivo',
					ESTADO_ACTIVO => 'Activo',
					ESTADO_INVITADO => 'Invitado',
				));

				$crud->columns( 'cedula', 'nombre', 'email', 'celular', 'monto_inicial', 'fecha', 'estado' );
				$crud->fields(  'cedula', 'password', 'nombre', 'email', 'celular', 'monto_inicial', 'fecha', 'estado' );
				$crud->required_fields( 'cedula', 'nombre', 'email', 'celular', 'monto_inicial', 'fecha', 'estado' );

				$crud->callback_edit_field('password', array($this, 'set_password_input_to_empty'));
	            $crud->callback_add_field('password', array($this, 'set_password_input_to_empty'));

				$crud->callback_before_insert(array($this, 'encrypt_pw'));
				$crud->callback_before_update(array($this, 'encrypt_pw'));

				//$crud->order_by('fecha','asc');

				$crud->unset_print();
				$crud->unset_read();
				$crud->unset_export();
				$crud->unset_clone();

				$crud->unset_jquery();
				$crud->unset_bootstrap();

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

	public function encrypt_pw($post_array) {
		if(!empty($post_array['password'])) {
			$post_array['password'] = md5($_POST['password']);
		} else {
			unset($post_array['password']);
		}
		return $post_array;
	}
	public function set_password_input_to_empty() {
        return "<input type='text' name='password' value='' />";
    }
}
