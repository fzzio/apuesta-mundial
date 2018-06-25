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
			$dataContent['partidosJugadosObj'] = Partido_model::getUltimos(5, PARTIDO_FINALIZADO);
			$dataContent['partidosProximosObj'] = Partido_model::getProximos(5, PARTIDO_POR_JUGAR);
			$dataContent['partidosJugandoObj'] = Partido_model::getProximos(null, PARTIDO_JUGANDO);

			$dataContent['apostadorObj'] = Apostador_model::getApostadorPorID( $this->session->id );
			//////////////////////////////////////////////////
			// Resultados
			
			$dataContent['numeroJugados'] = count( Partido_model::getTodos(PARTIDO_FINALIZADO) );
			$dataContent['numeroApuestasGanadas'] = $dataContent['apostadorObj']->getNumeroApuestasGanadas();
			$dataContent['numeroDesafiosGanados'] = $dataContent['apostadorObj']->getNumeroDesafiosGanados();
			$dataContent['numeroGanados'] = $dataContent['numeroApuestasGanadas'] + $dataContent['numeroDesafiosGanados'];

			
			$dataContent['saldoDisponible'] = $dataContent['apostadorObj']->getValorDisponible();
			$dataContent['saldoBloqueado'] = $dataContent['apostadorObj']->getValorAculumadoBloqueado();
			$dataContent['saldoGanado'] = $dataContent['apostadorObj']->getValorAculumadoGanadoReal();

			
			//////////////////////////////////////////////////
			// Apuestas propias
			$dataContent['arrConsolidadoApuestas'] = $this->getConsolidadoApostador( Apuesta_model::getApuestasIniciadasPorApostador( $dataContent['apostadorObj'], null, 5, ORDEN_DESCENDENTE, null ) );

			//////////////////////////////////////////////////
			// Apuestas de otros
			$dataContent['arrConsolidadoApostadorParticipaciones'] = $this->getConsolidadoApostadorParticipaciones( Apuesta_model::getApuestasEmparejadasConApostador( $dataContent['apostadorObj'], 5, ORDEN_DESCENDENTE, null ) );

			//////////////////////////////////////////////////
			// Apuestas abiertas de otros
			$dataContent['arrConsolidadoOtrasApuestasAbiertas'] = $this->getConsolidadoOtrosApostadores( Apuesta_model::getApuestasIniciadasOtrosApostadores( $dataContent['apostadorObj'], APUESTA_NO_EMPAREJADA, 5, ORDEN_ASCENDENTE, PARTIDO_POR_JUGAR ) );


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

	public function instrucciones(){
		if ( estaLogueadoApostador() ) {
			$dataHeader['titlePage'] = "Instrucciones";
			$dataMenu = array();
			$dataContent = array();
			$dataFooter = array();
			// Se cargan las vistas
	        $data['header'] = $this->load->view('cancha/blocks/header', $dataHeader);
	        $data['menu'] = $this->load->view('cancha/blocks/menu', $dataMenu );
	        $data['content'] = $this->load->view('cancha/templates/instrucciones', $dataContent );
	        $data['footer'] = $this->load->view('cancha/blocks/footer', $dataFooter );
		}else{
			redirect('cancha/logout','refresh');
		}
	}


	public function getConsolidadoApostador( $apuestasObj ){
		$arrConsolidadoApuestas = array();
		foreach ( $apuestasObj as $indiceApuesta => $apuestaObj) {
			// Partido
			$partidoObj = $apuestaObj->getPronosticoApostador1()->getPartido();

			// Monto
			$montoApuesta = $apuestaObj->getMonto();

			// Apostador
			$resultadoApostador = $apuestaObj->getPronosticoApostador1()->getResultado();
			$resultadoApostadorStr = "";
			if ( $resultadoApostador == PRONOSTICO_GANA_LOCAL ) {
				$resultadoApostadorStr = "Gana " . $partidoObj->getPaisLocal()->getNombre();
			}elseif ( $resultadoApostador == PRONOSTICO_GANA_VISITANTE ) {
				$resultadoApostadorStr = "Gana " . $partidoObj->getPaisVisitante()->getNombre();
			}else{
				$resultadoApostadorStr = "Empate";
			}

			// Rival
			$rivalNombre = "";
			$resultadoRival = null;
			$resultadoRivalStr = "";
			$resultadoApuesta = null;
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

				// Si está finalizado se obtiene el resultado
				if ( $partidoObj->getEstado() == PARTIDO_FINALIZADO ) {
					$resultadoPartido = null;
					if ( ($partidoObj->getGolesLocal() - $partidoObj->getGolesVisitante() ) > 0) {
						$resultadoPartido = PRONOSTICO_GANA_LOCAL;
					}elseif ( ($partidoObj->getGolesLocal() - $partidoObj->getGolesVisitante() ) < 0) {
						$resultadoPartido = PRONOSTICO_GANA_VISITANTE;						
					}else{
						$resultadoPartido = PRONOSTICO_EMPATE;
					}

					// Verificamos si ganó el apostador o no
					if( $resultadoPartido == $resultadoApostador ){
						$resultadoApuesta = RESULTADO_GANASTE;
					}elseif( $resultadoPartido == $resultadoRival ){
						$resultadoApuesta = RESULTADO_PERDISTE;
					}else{
						$resultadoApuesta = RESULTADO_NADIE_GANA;
					}
				}else{
					$resultadoApuesta = RESULTADO_PENDIENTE;
				}
			}else{
				if ( $partidoObj->getEstado() == PARTIDO_FINALIZADO ) {
					$resultadoApuesta = RESULTADO_DESIERTA;
				}else{
					$resultadoApuesta = RESULTADO_PENDIENTE;
				}
			}

			array_push(
				$arrConsolidadoApuestas, array(
					"partidoObj" => $partidoObj,
					"montoApuesta" => $montoApuesta,
					"resultadoApostadorStr" => $resultadoApostadorStr,
					"rivalNombre" => $rivalNombre,
					"resultadoRivalStr" => $resultadoRivalStr,
					"resultadoApuesta" => $resultadoApuesta,
				)
			);
		}
		return $arrConsolidadoApuestas;
	}

	public function getConsolidadoApostadorParticipaciones( $apuestasObj ){
		$arrConsolidadoApuestas = array();
		foreach ( $apuestasObj as $indiceApuesta => $apuestaObj) {
			// Partido
			$partidoObj = $apuestaObj->getPronosticoApostador2()->getPartido();

			// Monto
			$montoApuesta = $apuestaObj->getMonto();

			// Apostador
			$resultadoApostador = $apuestaObj->getPronosticoApostador2()->getResultado();
			$resultadoApostadorStr = "";
			if ( $resultadoApostador == PRONOSTICO_GANA_LOCAL ) {
				$resultadoApostadorStr = "Gana " . $partidoObj->getPaisLocal()->getNombre();
			}elseif ( $resultadoApostador == PRONOSTICO_GANA_VISITANTE ) {
				$resultadoApostadorStr = "Gana " . $partidoObj->getPaisVisitante()->getNombre();
			}else{
				$resultadoApostadorStr = "Empate";
			}

			// Rival
			$rivalNombre = "";
			$resultadoRival = null;
			$resultadoRivalStr = "";
			$resultadoApuesta = null;
			if( !is_null( $apuestaObj->getPronosticoApostador1() ) ){
				$rivalNombre = $apuestaObj->getPronosticoApostador1()->getApostador()->getNombre();
				$resultadoRival = $apuestaObj->getPronosticoApostador1()->getResultado();
				if ( $resultadoRival == PRONOSTICO_GANA_LOCAL ) {
					$resultadoRivalStr = "Gana " . $partidoObj->getPaisLocal()->getNombre();
				}elseif ( $resultadoRival == PRONOSTICO_GANA_VISITANTE ) {
					$resultadoRivalStr = "Gana " . $partidoObj->getPaisVisitante()->getNombre();
				}else{
					$resultadoRivalStr = "Empate";
				}

				// Si está finalizado se obtiene el resultado
				if ( $partidoObj->getEstado() == PARTIDO_FINALIZADO ) {
					$resultadoPartido = null;
					if ( ($partidoObj->getGolesLocal() - $partidoObj->getGolesVisitante() ) > 0) {
						$resultadoPartido = PRONOSTICO_GANA_LOCAL;
					}elseif ( ($partidoObj->getGolesLocal() - $partidoObj->getGolesVisitante() ) < 0) {
						$resultadoPartido = PRONOSTICO_GANA_VISITANTE;						
					}else{
						$resultadoPartido = PRONOSTICO_EMPATE;
					}

					// Verificamos si ganó el apostador o no
					if( $resultadoPartido == $resultadoApostador ){
						$resultadoApuesta = RESULTADO_GANASTE;
					}elseif( $resultadoPartido == $resultadoRival ){
						$resultadoApuesta = RESULTADO_PERDISTE;
					}else{
						$resultadoApuesta = RESULTADO_NADIE_GANA;
					}
				}else{
					$resultadoApuesta = RESULTADO_PENDIENTE;
				}
			}else{
				if ( $partidoObj->getEstado() == PARTIDO_FINALIZADO ) {
					$resultadoApuesta = RESULTADO_DESIERTA;
				}else{
					$resultadoApuesta = RESULTADO_PENDIENTE;
				}
			}

			array_push(
				$arrConsolidadoApuestas, array(
					"partidoObj" => $partidoObj,
					"montoApuesta" => $montoApuesta,
					"resultadoApostadorStr" => $resultadoApostadorStr,
					"rivalNombre" => $rivalNombre,
					"resultadoRivalStr" => $resultadoRivalStr,
					"resultadoApuesta" => $resultadoApuesta,
				)
			);
		}
		return $arrConsolidadoApuestas;
	}

	public function getConsolidadoOtrosApostadores( $apuestasObj ){
		$arrConsolidadoApuestas = array();
		foreach ( $apuestasObj as $indiceApuesta => $apuestaObj) {
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

			// Apostador
			$resultadoApostador = null;
			$resultadoApuesta = null;
			$resultadoApostadorStr = "";
			if( !is_null( $apuestaObj->getPronosticoApostador2() ) ){
				$resultadoApostador = $apuestaObj->getPronosticoApostador2()->getResultado();
				if ( $resultadoApostador == PRONOSTICO_GANA_LOCAL ) {
					$resultadoApostadorStr = "Gana " . $partidoObj->getPaisLocal()->getNombre();
				}elseif ( $resultadoApostador == PRONOSTICO_GANA_VISITANTE ) {
					$resultadoApostadorStr = "Gana " . $partidoObj->getPaisVisitante()->getNombre();
				}else{
					$resultadoApostadorStr = "Empate";
				}

				// Si está finalizado se obtiene el resultado
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
					if( $resultadoPartido == $resultadoApostador ){
						$resultadoApuesta = RESULTADO_GANASTE;
					}elseif( $resultadoPartido == $resultadoRival ){
						$resultadoApuesta = RESULTADO_PERDISTE;
					}else{
						$resultadoApuesta = RESULTADO_NADIE_GANA;
					}
				}
			}else{
				$resultadoApuesta = RESULTADO_DESIERTA;
			}

			array_push(
				$arrConsolidadoApuestas, array(
					"apuestaID" => $apuestaObj->getID(),
					"partidoObj" => $partidoObj,
					"montoApuesta" => $montoApuesta,
					"resultadoApostadorStr" => $resultadoApostadorStr,
					"rivalNombre" => $rivalNombre,
					"resultadoRival" => $resultadoRival,
					"resultadoRivalStr" => $resultadoRivalStr,
					"resultadoApuesta" => $resultadoApuesta,
				)
			);
		}
		return $arrConsolidadoApuestas;
	}

	public function crearApuesta(){
		$resultado = array();
		if ( $this->input->server('REQUEST_METHOD') == 'POST' ) {
			$partidoObj = Partido_model::getPartidoPorID( $this->input->post( 'partido', TRUE ) );
			$apostadorObj = Apostador_model::getApostadorPorID( $this->input->post( 'apostador', TRUE ) );
			$apuestaMonto = $this->input->post( 'monto', TRUE );
			$apuestaPronostico = $this->input->post( 'pronostico', TRUE );
			if ( !is_null( $partidoObj ) && !is_null( $apostadorObj ) && ( $apuestaMonto != "" ) && ( $apuestaPronostico != "" ) ) {
				if ( ($partidoObj->getFase() != FASE_GRUPOS  ) && ( $apuestaPronostico == PRONOSTICO_EMPATE ) ) {
					$resultado = array(
						'codigo' => 0, 
						'fecha' => date('Y-m-d H:i:s'), 
						'mensaje' => "Error: No se puede apostar al empate en esta fase." 
					);
				}else{
					if ( $apuestaMonto > 0 ) {
						if ( $apostadorObj->getValorDisponible() > ($apuestaMonto + $partidoObj->getValorPartido() ) ) {
							try {
								$this->db->trans_start();
									$pronosticoObj = new Pronostico_model();
									$pronosticoObj->setPartido( $partidoObj );
									$pronosticoObj->setApostador( $apostadorObj );
									$pronosticoObj->setResultado( $apuestaPronostico );
									$pronosticoObj->setFecha( FECHA_HOY );
									$pronosticoObj->setEstado( ESTADO_ACTIVO );
									$idPronostico = $pronosticoObj->grabar( );
									$pronosticoObj = Pronostico_model::getPronosticoPorID( $idPronostico );

									$apuestaObj = new Apuesta_model();
									$apuestaObj->setPronosticoApostador1( $pronosticoObj );
									$apuestaObj->setPronosticoApostador2( null );
									$apuestaObj->setMonto( $apuestaMonto );
									$apuestaObj->setFecha( FECHA_HOY );
									$apuestaObj->setEstado( APUESTA_NO_EMPAREJADA );
									$idApuesta = $apuestaObj->grabar( );
								$this->db->trans_complete();

								if ($this->db->trans_status() === FALSE){
								    $this->db->trans_rollback();
								    $resultado = array(
								    	'codigo' => 0, 
								    	'fecha' => date('Y-m-d H:i:s'), 
								    	'mensaje' => "Error al insertar datos."
								    );
								}else{
								    $this->db->trans_commit();
									$resultado = array(
										'codigo' => 1, 
										'fecha' => date('Y-m-d H:i:s'), 
										'mensaje' => "Se registró apuesta ID: " . $idApuesta,
										'data' => array()
									);	
								}
							} catch (Exception $e) {
								$resultado = array(
									'codigo' => 0, 
									'fecha' => date('Y-m-d H:i:s'), 
									'mensaje' => $e->getMessage() 
								);
							}
						}else{
							$resultado = array(
						    	'codigo' => 0, 
						    	'fecha' => date('Y-m-d H:i:s'), 
						    	'mensaje' => "Error: El saldo Disponible ($ " . number_format( $apostadorObj->getValorDisponible(), 2) . ") es menor al Monto de la apuesta ($ " . number_format( ( $apuestaMonto + $partidoObj->getValorPartido() )  , 2) . "). Por favor recargue saldo."
						    );
						}
					}else{
						$resultado = array(
							'codigo' => 0, 
							'fecha' => date('Y-m-d H:i:s'), 
							'mensaje' => "Error: El monto debe ser mayor a $ 0.00 en su apuesta." 
						);
					}
				}

			}else{
				$resultado = array(
					'codigo' => 0, 
					'fecha' => date('Y-m-d H:i:s'), 
					'mensaje' => "Error: Faltan datos." 
				);
			}

		}else{
			$resultado = array(
				'codigo' => 0, 
				'fecha' => date('Y-m-d H:i:s'), 
				'mensaje' => "Error: No se recibieron parámetros" 
			);
		}
		header('Content-Type: application/json');
		echo json_encode( $resultado );
	}
	public function unirApuesta(){
		$resultado = array();
		if ( $this->input->server('REQUEST_METHOD') == 'POST' ) {
			$apuestaObj = Apuesta_model::getApuestaPorID( $this->input->post( 'apuesta', TRUE ) );
			$apostadorObj = Apostador_model::getApostadorPorID( $this->input->post( 'apostador', TRUE ) );
			$apuestaPronostico = $this->input->post( 'pronostico', TRUE );
			if ( !is_null( $apuestaObj ) && !is_null( $apostadorObj ) && ( $apuestaPronostico != "" ) ) {
				if ( ($apuestaObj->getPronosticoApostador1()->getPartido()->getFase() != FASE_GRUPOS  ) && ( $apuestaPronostico == PRONOSTICO_EMPATE ) ) {
					$resultado = array(
						'codigo' => 0, 
						'fecha' => date('Y-m-d H:i:s'), 
						'mensaje' => "Error: No se puede apostar al empate en esta fase." 
					);
				}else{
					if ( $apuestaObj->getMonto() > 0 ) {
						if ( $apostadorObj->getValorDisponible() > ($apuestaObj->getMonto() + $apuestaObj->getPronosticoApostador1()->getPartido()->getValorPartido() ) ) {
							try {
								$this->db->trans_start();
									$pronosticoObj = new Pronostico_model();
									$pronosticoObj->setPartido( $apuestaObj->getPronosticoApostador1()->getPartido() );
									$pronosticoObj->setApostador( $apostadorObj );
									$pronosticoObj->setResultado( $apuestaPronostico );
									$pronosticoObj->setFecha( FECHA_HOY );
									$pronosticoObj->setEstado( ESTADO_ACTIVO );
									$idPronostico = $pronosticoObj->grabar( );
									$pronosticoObj = Pronostico_model::getPronosticoPorID( $idPronostico );

									$apuestaObj->setPronosticoApostador2( $pronosticoObj );
									$apuestaObj->setEstado( APUESTA_EMPAREJADA );
									$idApuesta = $apuestaObj->actualizar( );
								$this->db->trans_complete();

								if ($this->db->trans_status() === FALSE){
								    $this->db->trans_rollback();
								    $resultado = array(
								    	'codigo' => 0, 
								    	'fecha' => date('Y-m-d H:i:s'), 
								    	'mensaje' => "Error al actualizar datos."
								    );
								}else{
								    $this->db->trans_commit();
									$resultado = array(
										'codigo' => 1, 
										'fecha' => date('Y-m-d H:i:s'), 
										'mensaje' => "Se actualizó apuesta ID: " . $idApuesta,
										'data' => array()
									);	
								}
							} catch (Exception $e) {
								$resultado = array(
									'codigo' => 0, 
									'fecha' => date('Y-m-d H:i:s'), 
									'mensaje' => $e->getMessage() 
								);
							}
						}else{
							$resultado = array(
						    	'codigo' => 0, 
						    	'fecha' => date('Y-m-d H:i:s'), 
						    	'mensaje' => "Error: El saldo Disponible ($ " . number_format( $apostadorObj->getValorDisponible(), 2) . ") es menor al Monto de la apuesta ($ " . number_format( ( $apuestaObj->getMonto() + $apuestaObj->getPronosticoApostador1()->getPartido()->getValorPartido() )  , 2) . "). Por favor recargue saldo."
						    );
						}
					}else{
						$resultado = array(
							'codigo' => 0, 
							'fecha' => date('Y-m-d H:i:s'), 
							'mensaje' => "Error: El monto debe ser mayor a $ 0.00 en su apuesta." 
						);
					}
				}
			}else{
				$resultado = array(
					'codigo' => 0, 
					'fecha' => date('Y-m-d H:i:s'), 
					'mensaje' => "Error: Faltan datos" 
				);
			}

		}else{
			$resultado = array(
				'codigo' => 0, 
				'fecha' => date('Y-m-d H:i:s'), 
				'mensaje' => "Error: No se recibieron parámetros" 
			);
		}
		header('Content-Type: application/json');
		echo json_encode( $resultado );
	}

	public function getPartidoToJson(){
		$resultado = array();
		if ( $this->input->server('REQUEST_METHOD') == 'POST' ) {
			$partidoObj = Partido_model::getPartidoPorID( $this->input->post( 'partido' ) );
			if ( $partidoObj !== null ) {
				$fechaHoraPartido = DateTime::createFromFormat('Y-m-d H:i:s', $partidoObj->getFecha());
				$resultado = array(
					'codigo' => 1, 
					'fecha' => date('Y-m-d H:i:s'), 
					'mensaje' => "Se encontró datos del partido",
					'data' => array(
						"partidoID" => $partidoObj->getID(),
						"partidoPaisLocal" => $partidoObj->getPaisLocal()->getNombre(),
						"partidoPaisVisitante" => $partidoObj->getPaisVisitante()->getNombre(),
						"partidoIsoPaisLocal" => strtolower($partidoObj->getPaisLocal()->getIso()),
						"partidoIsoPaisVisitante" => strtolower($partidoObj->getPaisVisitante()->getIso()),
						"partidoFechaMes" => $fechaHoraPartido->format('M'),
						"partidoFechaDia" => $fechaHoraPartido->format('d'),
						"partidoFechaHora" => $fechaHoraPartido->format('H:i'),
						"partidoFase" => $partidoObj->getFase(),
						"partidoCostoApuesta" => number_format( $partidoObj->getValorPartido(), 2),
					)
				);	
			}else{
				$resultado = array(
					'codigo' => 0, 
					'fecha' => date('Y-m-d H:i:s'), 
					'mensaje' => "Error: No se encontró partido" 
				);
			}

		}else{
			$resultado = array(
				'codigo' => 0, 
				'fecha' => date('Y-m-d H:i:s'), 
				'mensaje' => "Error: No se recibieron parámetros" 
			);
		}
		header('Content-Type: application/json');
		echo json_encode( $resultado );
	}

	public function getApuestaToJson(){
		$resultado = array();
		if ( $this->input->server('REQUEST_METHOD') == 'POST' ) {
			$apuestaObj = Apuesta_model::getApuestaPorID( $this->input->post( 'apuesta' ) );
			if ( $apuestaObj !== null ) {
				$partidoObj = $apuestaObj->getPronosticoApostador1()->getPartido();
				$fechaHoraPartido = DateTime::createFromFormat('Y-m-d H:i:s', $partidoObj->getFecha());
				$resultado = array(
					'codigo' => 1, 
					'fecha' => date('Y-m-d H:i:s'), 
					'mensaje' => "Se encontró datos de la apuesta",
					'data' => array(
						"partidoPaisLocal" => $partidoObj->getPaisLocal()->getNombre(),
						"partidoPaisVisitante" => $partidoObj->getPaisVisitante()->getNombre(),
						"partidoIsoPaisLocal" => strtolower($partidoObj->getPaisLocal()->getIso()),
						"partidoIsoPaisVisitante" => strtolower($partidoObj->getPaisVisitante()->getIso()),
						"partidoFechaMes" => $fechaHoraPartido->format('M'),
						"partidoFechaDia" => $fechaHoraPartido->format('d'),
						"partidoFechaHora" => $fechaHoraPartido->format('H:i'),
						"partidoCostoApuesta" => number_format( $partidoObj->getValorPartido(), 2),
						"rivalNombre" => $apuestaObj->getPronosticoApostador1()->getApostador()->getNombre(),
						"rivalPronostico" => $apuestaObj->getPronosticoApostador1()->getResultado(),
						"apuestaID" => $apuestaObj->getID(),
						"apuestaMonto" => number_format( $apuestaObj->getMonto() , 2),
					)
				);	
			}else{
				$resultado = array(
					'codigo' => 0, 
					'fecha' => date('Y-m-d H:i:s'), 
					'mensaje' => "Error: No se encontró apuesta" 
				);
			}

		}else{
			$resultado = array(
				'codigo' => 0, 
				'fecha' => date('Y-m-d H:i:s'), 
				'mensaje' => "Error: No se recibieron parámetros" 
			);
		}
		header('Content-Type: application/json');
		echo json_encode( $resultado );
	}

	public function apuestas(){
		if ( estaLogueadoApostador() ) {
			$dataHeader['titlePage'] = "Mis apuestas";
			$dataMenu = array();
			$dataContent['apostadorObj'] = Apostador_model::getApostadorPorID( $this->session->id );
			$dataContent['arrConsolidadoApuestas'] = $this->getConsolidadoApostador( Apuesta_model::getApuestasIniciadasPorApostador( $dataContent['apostadorObj'], null, null, ORDEN_DESCENDENTE, null ) );
			$dataFooter = array();
			// Se cargan las vistas
	        $data['header'] = $this->load->view('cancha/blocks/header', $dataHeader);
	        $data['menu'] = $this->load->view('cancha/blocks/menu', $dataMenu );
	        $data['content'] = $this->load->view('cancha/templates/apuestas', $dataContent );
	        $data['footer'] = $this->load->view('cancha/blocks/footer', $dataFooter );
		}else{
			redirect('cancha/logout','refresh');
		}
	}

	public function desafios(){
		if ( estaLogueadoApostador() ) {
			$dataHeader['titlePage'] = "Desafíos aceptados";
			$dataMenu = array();
			$dataContent['apostadorObj'] = Apostador_model::getApostadorPorID( $this->session->id );
			$dataContent['arrConsolidadoApostadorParticipaciones'] = $this->getConsolidadoApostadorParticipaciones( Apuesta_model::getApuestasEmparejadasConApostador( $dataContent['apostadorObj'], null, ORDEN_DESCENDENTE, null ) );
			$dataFooter = array();
			// Se cargan las vistas
	        $data['header'] = $this->load->view('cancha/blocks/header', $dataHeader);
	        $data['menu'] = $this->load->view('cancha/blocks/menu', $dataMenu );
	        $data['content'] = $this->load->view('cancha/templates/desafios', $dataContent );
	        $data['footer'] = $this->load->view('cancha/blocks/footer', $dataFooter );
		}else{
			redirect('cancha/logout','refresh');
		}
	}

	public function abiertas(){
		if ( estaLogueadoApostador() ) {
			$dataHeader['titlePage'] = "Apuestas abiertas";
			$dataMenu = array();
			$dataContent['apostadorObj'] = Apostador_model::getApostadorPorID( $this->session->id );
			$dataContent['arrConsolidadoOtrasApuestasAbiertas'] = $this->getConsolidadoOtrosApostadores( Apuesta_model::getApuestasIniciadasOtrosApostadores( $dataContent['apostadorObj'], APUESTA_NO_EMPAREJADA, null, ORDEN_ASCENDENTE, PARTIDO_POR_JUGAR ) );
			$dataFooter = array();
			// Se cargan las vistas
	        $data['header'] = $this->load->view('cancha/blocks/header', $dataHeader);
	        $data['menu'] = $this->load->view('cancha/blocks/menu', $dataMenu );
	        $data['content'] = $this->load->view('cancha/templates/abiertas', $dataContent );
	        $data['footer'] = $this->load->view('cancha/blocks/footer', $dataFooter );
		}else{
			redirect('cancha/logout','refresh');
		}
	}

	public function ranking(){
		if ( estaLogueadoApostador() ) {
			$dataHeader['titlePage'] = "Ranking";
			$dataMenu = array();
			$dataContent['apostadorObj'] = Apostador_model::getApostadorPorID( $this->session->id );
			//////////////////////////////////////////////////
			// Ranking
			$dataContent['arrRanking'] = Apostador_model::getRanking(10, ESTADO_ACTIVO);

			$dataFooter = array();
			// Se cargan las vistas
	        $data['header'] = $this->load->view('cancha/blocks/header', $dataHeader);
	        $data['menu'] = $this->load->view('cancha/blocks/menu', $dataMenu );
	        $data['content'] = $this->load->view('cancha/templates/ranking', $dataContent );
	        $data['footer'] = $this->load->view('cancha/blocks/footer', $dataFooter );
		}else{
			redirect('cancha/logout','refresh');
		}
	}
}
