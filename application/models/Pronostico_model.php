<?php
    if ( ! defined('BASEPATH')) exit('No direct script access allowed');

    /*
        Tabla:
            pronostico
        Campos:
            id,
            id_partido,
            id_apostador,
            resultado,
            fecha,
            estado,
    */
 
    class Pronostico_model extends CI_Model {
        
        protected $ID;
        private $Partido;
        private $Apostador;
        private $resultado;
        private $fecha;
        private $estado;
        
        function __construct() {
            parent::__construct();
            $this->load->database();

            $this->load->helper(
                array(
                    'form',
                    'url',
                    'funciones'
                )
            );
            $this->load->model(
                array(
                    'Partido_model',
                    'Apostador_model',
                )
            );
        }

        ///////////////////////////////////
        // Getters
        ///////////////////////////////////        
        public function getID(){
            return $this->ID;
        }
        public function getPartido(){
            return $this->Partido;
        }
        public function getApostador(){
            return $this->Apostador;
        }
        public function getResultado(){
            return $this->resultado;
        }
        public function getEstado(){
            return $this->estado;
        }


        ///////////////////////////////////
        // Setters
        ///////////////////////////////////        
        public function setID( $ID ){
            $this->ID = $ID;
        }
        public function setPartido( Partido_model $Partido = null ){
            if ( !is_null( $Partido ) ) {
                $this->Partido = $Partido;
            }
        }
        public function setApostador( Apostador_model $Apostador = null ){
            if ( !is_null( $Apostador ) ) {
                $this->Apostador = $Apostador;
            }
        }
        public function setResultado( $resultado ){
            $this->resultado = $resultado;
        }
        public function setFecha( $fecha ){
            $this->fecha = $fecha;
        }
        public function setEstado( $estado ){
            $this->estado = $estado;
        }


        ///////////////////////////////////
        // Getters y Setters de Objeto
        ///////////////////////////////////
        public function getPronostico(){
            return $this;
        }

        public function setPronostico( $ID, Partido_model $Partido = null, Apostador_model $Apostador = null, $resultado, $fecha, $estado ){
            $this->setID( $ID );
            $this->setPartido( $Partido );
            $this->setApostador( $Apostador );
            $this->setResultado( $resultado );
            $this->setFecha( $fecha );
            $this->setEstado( $estado );
        }


        ///////////////////////////////////
        // Funciones
        ///////////////////////////////////
        public static function getPronosticoPorID( $pronosticoID ){
            if ( !is_null( $pronosticoID ) ) {
                // Obtener instancia de CI para manejo de base
                $instanciaCI =& get_instance();

                $pronosticoDB = null;
                $instanciaCI->db->select("p.*");
                $instanciaCI->db->from('pronostico AS p');
                $instanciaCI->db->where('p.id', intval($pronosticoID));
                $pronosticoDB = $instanciaCI->db->get()->row();
                
                if ( !is_null($pronosticoDB) ) {
                    $pronosticoObj = new Pronostico_model();
                    $pronosticoObj->setPronostico(
                        $pronosticoDB->id,
                        Partido_model::getPartidoPorID( $pronosticoDB->id_partido ),
                        Apostador_model::getApostadorPorID( $pronosticoDB->id_apostador ),
                        $pronosticoDB->resultado,
                        $pronosticoDB->fecha,
                        $pronosticoDB->estado
                    );
                    return $pronosticoObj;
                }else{
                    return null;
                }
            }else{
                return null;
            }
        }
        public static function getTodos( $estado = null ){
            // Obtener instancia de CI para manejo de base
            $instanciaCI =& get_instance();

            $pronosticosDB = null;
            $instanciaCI->db->select("p.id");
            $instanciaCI->db->from('pronostico AS p');
            if ( $estado != null ) {
                $instanciaCI->db->where('p.estado', intval($estado));
            }else{
                $instanciaCI->db->where_in('p.estado', array(PRONOSTICO_GANA_LOCAL, PRONOSTICO_GANA_VISITANTE, PRONOSTICO_EMPATE));
            }
            $pronosticosDB = $instanciaCI->db->get()->result_array();

            $arrPronosticosObj = array();
            if ( !is_null($pronosticosDB) ) {
                foreach ($pronosticosDB as $pronosticoDB) {
                    $pronosticoObj = self::getPronosticoPorID($pronosticoDB["id"]);
                    array_push($arrPronosticosObj, $pronosticoObj);
                }
                return $arrPronosticosObj;
            }else{
                return null;
            }
        }
        public static function getTodosPorApostador( Apostador_model $apostadorObj = null, $estado = null ){
            if( !is_null( $apostadorObj ) ){
                // Obtener instancia de CI para manejo de base
                $instanciaCI =& get_instance();

                $pronosticosDB = null;
                $instanciaCI->db->select("p.id");
                $instanciaCI->db->from('pronostico AS p');
                $instanciaCI->db->where('p.id_apostador', intval( $apostadorObj->getID() ));
                if ( $estado != null ) {
                    $instanciaCI->db->where('p.estado', intval($estado));
                }else{
                    $instanciaCI->db->where_in('p.estado', array(PRONOSTICO_GANA_LOCAL, PRONOSTICO_GANA_VISITANTE, PRONOSTICO_EMPATE));
                }
                $pronosticosDB = $instanciaCI->db->get()->result_array();

                $arrPronosticosObj = array();
                if ( !is_null($pronosticosDB) ) {
                    foreach ($pronosticosDB as $pronosticoDB) {
                        $pronosticoObj = self::getPronosticoPorID($pronosticoDB["id"]);
                        array_push($arrPronosticosObj, $pronosticoObj);
                    }
                    return $arrPronosticosObj;
                }else{
                    return null;
                }
            }else{
                return null;
            }
        }
        public static function getTodosPorApostadorSin( Apostador_model $apostadorObj = null, $estado = null ){
            if( !is_null( $apostadorObj ) ){
                // Obtener instancia de CI para manejo de base
                $instanciaCI =& get_instance();

                $pronosticosDB = null;
                $instanciaCI->db->select("p.id");
                $instanciaCI->db->from('pronostico AS p');
                $instanciaCI->db->where('p.id_apostador !=', intval( $apostadorObj->getID() ));
                if ( $estado != null ) {
                    $instanciaCI->db->where('p.estado', intval($estado));
                }else{
                    $instanciaCI->db->where_in('p.estado', array(PRONOSTICO_GANA_LOCAL, PRONOSTICO_GANA_VISITANTE, PRONOSTICO_EMPATE));
                }
                $pronosticosDB = $instanciaCI->db->get()->result_array();

                $arrPronosticosObj = array();
                if ( !is_null($pronosticosDB) ) {
                    foreach ($pronosticosDB as $pronosticoDB) {
                        $pronosticoObj = self::getPronosticoPorID($pronosticoDB["id"]);
                        array_push($arrPronosticosObj, $pronosticoObj);
                    }
                    return $arrPronosticosObj;
                }else{
                    return null;
                }
            }else{
                return null;
            }
        }
        public static function getUltimos( $limite = 5, $estado = null ){
            // Obtener instancia de CI para manejo de base
            $instanciaCI =& get_instance();

            $pronosticosDB = null;
            $instanciaCI->db->select("p.id");
            $instanciaCI->db->from('pronostico AS p');
            if ( $estado != null ) {
                $instanciaCI->db->where('p.estado', intval($estado));
            }else{
                $instanciaCI->db->where_in('p.estado', array(PRONOSTICO_GANA_LOCAL, PRONOSTICO_GANA_VISITANTE, PRONOSTICO_EMPATE));
            }
            if ( $limite !== null ) {
                $instanciaCI->db->limit( $limite );
            }
            $instanciaCI->db->order_by('p.fecha', 'DESC');
            $pronosticosDB = $instanciaCI->db->get()->result_array();

            $arrPronosticosObj = array();
            if ( !is_null($pronosticosDB) ) {
                foreach ($pronosticosDB as $pronosticoDB) {
                    $pronosticoObj = self::getPronosticoPorID($pronosticoDB["id"]);
                    array_push($arrPronosticosObj, $pronosticoObj);
                }
                return $arrPronosticosObj;
            }else{
                return null;
            }
        }

        ///////////////////////////////////
        // Modificación de base de datos
        ///////////////////////////////////
        public function grabar( ){
            try {
                $dataPronostico = array(
                    'id_partido' => $this->getPartido()->getID(),
                    'id_apostador' => $this->getApostador()->getID(),
                    'resultado' => $this->getResultado(),
                    'fecha' => $this->getFecha(),
                    'estado' => $this->getEstado(),
                );
                $this->db->insert('pronostico', $dataPronostico);
                return $this->db->insert_id();
            } catch (Exception $e) {
                return null;
            }
        }
        public function actualizar( ){
            try {
                $dataPronostico = array(
                    'id_partido' => $this->getPartido()->getID(),
                    'id_apostador' => $this->getApostador()->getID(),
                    'resultado' => $this->getResultado(),
                    'fecha' => $this->getFecha(),
                    'estado' => $this->getEstado(),
                );
                $this->db->where('id', $this->getID() );
                $this->db->update('pronostico', $dataPronostico);
                return $this->getID();
            } catch (Exception $e) {
                return null;
            }
        }
        public static function borrarPorID( $pronosticoID ){
            // Obtener instancia de CI para manejo de base
            $instanciaCI =& get_instance();

            try {
                $condicionPronostico = array (
                    'id' => $pronosticoID
                );
                $instanciaCI->db->delete('pronostico', $condicionPronostico);
                return true;
            } catch (Exception $e) {
                return null;
            }
        }
        
        ///////////////////////////////////
        // Otros
        ///////////////////////////////////
        public function __toString() {
            return get_class($this) . " [ID: " . $this->getID() . "]";
        }
    }
?>