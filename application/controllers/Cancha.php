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
                'Partido_model',
                'Pronostico_model',
                'Apuesta_model',
            )
        );
	}

	public function index(){
		if ( estaLogueadoApostador() ) {
			$dataHeader['titlePage'] = "Cancha";
			$dataContent['totalApostadores'] = count(Apostador_model::getTodos(ESTADO_ACTIVO));
			$dataContent['partidosJugadosObj'] = Partido_model::getTodos(PARTIDO_FINALIZADO);
			$dataContent['partidosProximosObj'] = Partido_model::getTodos(PARTIDO_POR_JUGAR);

			//////////////////////////////////////////////////
			// Resultados
			$totalGanado = 0;
			$totalPerdido = 0;
			$dataContent['numeroAciertos'] = 0;

			$dataContent['apostadorObj'] = Apostador_model::getApostadorPorID( $this->session->id );
			
			//////////////////////////////////////////////////
			// Apuestas propias
			$dataContent['misApuestasObj'] = Apuesta_model::getTodosPorApostador( $dataContent['apostadorObj']  );
			$dataContent['arrConsolidadoMisApuestas'] = array();
			foreach ( $dataContent['misApuestasObj']  as $indiceApuesta => $apuestaObj) {
				// Partido
				$partidoObj = $apuestaObj->getPronosticoApostador1()->getPartido();
				$totalPerdido += 0.20;

				// Monto
				$montoApuesta = $apuestaObj->getMonto();

				// Mi apuesta
				$resultadoMio = $apuestaObj->getPronosticoApostador1()->getResultado();
				$resultadoMioStr = "";
				if ( $resultadoMio == PRONOSTICO_GANA_LOCAL ) {
					$resultadoMioStr = "Gana " . $partidoObj->getPaisLocal()->getNombre();
				}elseif ( $resultadoMio == PRONOSTICO_GANA_VISITANTE ) {
					$resultadoMioStr = "Gana " . $partidoObj->getPaisVisitante()->getNombre();
				}else{
					$resultadoMioStr = "Empate";
				}

				// Mi rival
				$rivalNombre = "";
				$resultadoRival = null;
				$resultadoRivalStr = "";
				if( !is_null( $apuestaObj->getPronosticoApostador2() ) ){
					$rivalNombre = $apuestaObj->getPronosticoApostador2()->getApostador()->getNombre();
					$resultadoRival = $apuestaObj->getPronosticoApostador2()->getResultado();
					if ( $resultadoRival == PRONOSTICO_GANA_LOCAL ) {
						$resultadoRivalStr = "Gana " . $partidoObj->getPaisLocal()->getNombre();
					}elseif ( $resultadoRival == PRONOSTICO_GANA_VISITANTE ) {
						$resultadoRivalStr = "Gana " . $partidoObj->getPaisVisitante()->getNombre();
					}else{
						$resultadoRivalStr = "Empate";
					}
				}

				// Si está finalizado se obtiene el resultado
				$resultadoApuesta = null;
				if ( $partidoObj->getEstado() == PARTIDO_FINALIZADO ) {
					$resultadoPartido = null;
					if ( ($partidoObj->getGolesLocal() - $partidoObj->getGolesVisitante() ) > 0) {
						$resultadoPartido = PRONOSTICO_GANA_LOCAL;
					}elseif ( ($partidoObj->getGolesLocal() - $partidoObj->getGolesVisitante() ) < 0) {
						$resultadoPartido = PRONOSTICO_GANA_VISITANTE;						
					}else{
						$resultadoPartido = PRONOSTICO_EMPATE;
					}

					// Verificamos si ganó o no
					if( $resultadoPartido == $resultadoMio ){
						$resultadoApuesta = RESULTADO_GANASTE;
						$totalGanado += $montoApuesta;
						$dataContent['numeroAciertos'] += 1;
					}elseif( $resultadoPartido == $resultadoRival ){
						$resultadoApuesta = RESULTADO_PERDISTE;
						$totalPerdido += $montoApuesta;
					}else{
						$resultadoApuesta = RESULTADO_CASA_GANA;
						$totalPerdido += $montoApuesta;
					}
				}

				array_push(
					$dataContent['arrConsolidadoMisApuestas'], array(
						"partidoObj" => $partidoObj,
						"montoApuesta" => $montoApuesta,
						"resultadoMioStr" => $resultadoMioStr,
						"rivalNombre" => $rivalNombre,
						"resultadoRivalStr" => $resultadoRivalStr,
						"resultadoApuesta" => $resultadoApuesta,
					)
				);
			}
			$dataContent['saldoApuesta'] = $dataContent['apostadorObj']->getMontoInicial() + $totalGanado - $totalPerdido;

			//////////////////////////////////////////////////
			// Apuestas de otros
			$dataContent['otrasApuestasObj'] = Apuesta_model::getTodosPorApostadorSin( $dataContent['apostadorObj']  );
			$dataContent['arrConsolidadoOtrasApuestas'] = array();
			foreach ( $dataContent['otrasApuestasObj']  as $indiceApuesta => $apuestaObj) {
				// Partido
				$partidoObj = $apuestaObj->getPronosticoApostador1()->getPartido();
				

				// Monto
				$montoApuesta = $apuestaObj->getMonto();

				// Rival
				$resultadoRivalStr = "";
				$resultadoRival = $apuestaObj->getPronosticoApostador1()->getResultado();
				$rivalNombre = $apuestaObj->getPronosticoApostador1()->getApostador()->getNombre();
				if ( $resultadoRival == PRONOSTICO_GANA_LOCAL ) {
					$resultadoRivalStr = "Gana " . $partidoObj->getPaisLocal()->getNombre();
				}elseif ( $resultadoRival == PRONOSTICO_GANA_VISITANTE ) {
					$resultadoRivalStr = "Gana " . $partidoObj->getPaisVisitante()->getNombre();
				}else{
					$resultadoRivalStr = "Empate";
				}

				// Mi rival
				$resultadoMio = null;
				$resultadoMioStr = "";
				if( !is_null( $apuestaObj->getPronosticoApostador2() ) ){
					$resultadoMio = $apuestaObj->getPronosticoApostador2()->getResultado();
					if ( $resultadoMio == PRONOSTICO_GANA_LOCAL ) {
						$resultadoMioStr = "Gana " . $partidoObj->getPaisLocal()->getNombre();
					}elseif ( $resultadoMio == PRONOSTICO_GANA_VISITANTE ) {
						$resultadoMioStr = "Gana " . $partidoObj->getPaisVisitante()->getNombre();
					}else{
						$resultadoMioStr = "Empate";
					}
				}

				// Si está finalizado se obtiene el resultado
				$resultadoApuesta = null;
				if ( $partidoObj->getEstado() == PARTIDO_FINALIZADO ) {
					$resultadoPartido = null;
					if ( ($partidoObj->getGolesLocal() - $partidoObj->getGolesVisitante() ) > 0) {
						$resultadoPartido = PRONOSTICO_GANA_LOCAL;
					}elseif ( ($partidoObj->getGolesLocal() - $partidoObj->getGolesVisitante() ) < 0) {
						$resultadoPartido = PRONOSTICO_GANA_VISITANTE;						
					}else{
						$resultadoPartido = PRONOSTICO_EMPATE;
					}

					// Verificamos si ganó o no
					if( $resultadoPartido == $resultadoMio ){
						$resultadoApuesta = RESULTADO_GANASTE;
						//$totalGanado += $montoApuesta;
						//$dataContent['numeroAciertos'] += 1;
					}elseif( $resultadoPartido == $resultadoRival ){
						$resultadoApuesta = RESULTADO_PERDISTE;
						//$totalPerdido += $montoApuesta;
					}else{
						$resultadoApuesta = RESULTADO_CASA_GANA;
						//$totalPerdido += $montoApuesta;
					}
				}

				array_push(
					$dataContent['arrConsolidadoOtrasApuestas'], array(
						"partidoObj" => $partidoObj,
						"montoApuesta" => $montoApuesta,
						"resultadoMioStr" => $resultadoMioStr,
						"rivalNombre" => $rivalNombre,
						"resultadoRivalStr" => $resultadoRivalStr,
						"resultadoApuesta" => $resultadoApuesta,
					)
				);
			}



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

	public function mediadores(){
		if ( estaLogueadoApostador() ) {
			$dataHeader['titlePage'] = "Mediadores";
			$dataMenu = array();
			$dataContent = array();
			$dataFooter = array();
			// Se cargan las vistas
	        $data['header'] = $this->load->view('cancha/blocks/header', $dataHeader);
	        $data['menu'] = $this->load->view('cancha/blocks/menu', $dataMenu );
	        $data['content'] = $this->load->view('cancha/templates/mediadores', $dataContent );
	        $data['footer'] = $this->load->view('cancha/blocks/footer', $dataFooter );
		}else{
			redirect('cancha/logout','refresh');
		}
	}
}
