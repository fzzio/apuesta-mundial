<?php
    if ( ! defined('BASEPATH')) exit('No direct script access allowed');

    /*
        Tabla:
            pronostico
        Campos:
            id,
            id_pronostico_apostador_1,
            id_pronostico_apostador_2,
            monto,
            fecha,
            estado,
    */
 
    class Apuesta_model extends CI_Model {
        
        protected $ID;
        private $PronosticoPronosticoApostador21;
        private $PronosticoPronosticoApostador22;
        private $monto;
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
                    'Pronostico_model',
                )
            );
        }

        ///////////////////////////////////
        // Getters
        ///////////////////////////////////        
        public function getID(){
            return $this->ID;
        }
        public function getPronosticoApostador1(){
            return $this->PronosticoApostador1;
        }
        public function getPronosticoApostador2(){
            return $this->PronosticoApostador2;
        }
        public function getMonto(){
            return $this->monto;
        }
        public function getFecha(){
            return $this->fecha;
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
        public function setPronosticoApostador1( Pronostico_model $PronosticoApostador1 = null ){
            $this->PronosticoApostador1 = $PronosticoApostador1;
        }
        public function setPronosticoApostador2( Pronostico_model $PronosticoApostador2 = null ){
            $this->PronosticoApostador2 = $PronosticoApostador2;
        }
        public function setMonto( $monto ){
            $this->monto = $monto;
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
        public function getApuesta(){
            return $this;
        }

        public function setApuesta( $ID, Pronostico_model $PronosticoApostador1 = null, Pronostico_model $PronosticoApostador2 = null, $monto, $fecha, $estado ){
            $this->setID( $ID );
            $this->setPronosticoApostador1( $PronosticoApostador1 );
            $this->setPronosticoApostador2( $PronosticoApostador2 );
            $this->setMonto( $monto );
            $this->setFecha( $fecha );
            $this->setEstado( $estado );
        }


        ///////////////////////////////////
        // Funciones
        ///////////////////////////////////
        public static function getApuestaPorID( $apuestaID ){
            if ( !is_null( $apuestaID ) ) {
                // Obtener instancia de CI para manejo de base
                $instanciaCI =& get_instance();

                $apuestaDB = null;
                $instanciaCI->db->select("a.*");
                $instanciaCI->db->from('apuesta AS a');
                $instanciaCI->db->where('a.id', intval($apuestaID));
                $apuestaDB = $instanciaCI->db->get()->row();
                
                if ( !is_null($apuestaDB) ) {
                    $apuestaObj = new Apuesta_model();
                    $apuestaObj->setApuesta(
                        $apuestaDB->id,
                        Pronostico_model::getPronosticoPorID( $apuestaDB->id_pronostico_apostador_1 ),
                        Pronostico_model::getPronosticoPorID( $apuestaDB->id_pronostico_apostador_2 ),
                        $apuestaDB->monto,
                        $apuestaDB->fecha,
                        $apuestaDB->estado
                    );
                    return $apuestaObj;
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

            $apuestasDB = null;
            $instanciaCI->db->select("a.id");
            $instanciaCI->db->from('apuesta AS a');
            if ( !is_null($estado) ) {
                $instanciaCI->db->where('a.estado', intval($estado));
            }else{
                $instanciaCI->db->where_in('a.estado', array(APUESTA_NO_EMPAREJADA, APUESTA_EMPAREJADA));
            }
            $apuestasDB = $instanciaCI->db->get()->result_array();

            $arrApuestasObj = array();
            if ( !is_null($apuestasDB) ) {
                foreach ($apuestasDB as $apuestaDB) {
                    $apuestaObj = self::getApuestaPorID($apuestaDB["id"]);
                    array_push($arrApuestasObj, $apuestaObj);
                }
                return $arrApuestasObj;
            }else{
                return null;
            }
        }

        public static function getApuestasIniciadasPorApostador( Apostador_model $apostadorObj = null, $estadoApuesta = null, $limite = 5, $ordenHoraPartido = null, $estadoPartido = null ){
            // Obtener instancia de CI para manejo de base
            $instanciaCI =& get_instance();

            if( !is_null( $apostadorObj ) ){
                $apuestasDB = null;
                $instanciaCI->db->select("a.id");
                $instanciaCI->db->from('apuesta AS a');
                $instanciaCI->db->join("pronostico as p", "p.id = a.id_pronostico_apostador_1");
                $instanciaCI->db->join("partido as pa", "pa.id = p.id_partido");
                if ( !is_null( $estadoApuesta ) ) {
                    $instanciaCI->db->where('a.estado', intval($estadoApuesta));
                }else{
                    $instanciaCI->db->where_in('a.estado', array(APUESTA_NO_EMPAREJADA, APUESTA_EMPAREJADA));
                }
                if ( !is_null( $apostadorObj ) ) {
                    $instanciaCI->db->where('p.id_apostador', intval($apostadorObj->getID()));
                }
                if ( $limite !== null ) {
                    $instanciaCI->db->limit( $limite );
                }
                if ( !is_null( $ordenHoraPartido ) ) {
                    $instanciaCI->db->order_by('pa.fecha', $ordenHoraPartido);
                }else{
                    $instanciaCI->db->order_by('pa.fecha', 'DESC');
                }
                $apuestasDB = $instanciaCI->db->get()->result_array();

                $arrApuestasObj = array();
                if ( !is_null($apuestasDB) ) {
                    foreach ($apuestasDB as $apuestaDB) {
                        $apuestaObj = self::getApuestaPorID($apuestaDB["id"]);
                        array_push($arrApuestasObj, $apuestaObj);
                    }
                    return $arrApuestasObj;
                }else{
                    return null;
                }
            }else{
                return null;
            }
        }

        public static function getApuestasIniciadasOtrosApostadores( Apostador_model $apostadorObj = null, $estadoApuesta = null, $limite = 5, $ordenHoraPartido = null, $estadoPartido = null ){
            // Obtener instancia de CI para manejo de base
            $instanciaCI =& get_instance();

            if( !is_null( $apostadorObj ) ){
                $apuestasDB = null;
                $instanciaCI->db->select("a.id");
                $instanciaCI->db->from('apuesta AS a');
                $instanciaCI->db->join("pronostico as p", "p.id = a.id_pronostico_apostador_1");
                $instanciaCI->db->join("partido as pa", "pa.id = p.id_partido");
                if ( !is_null( $estadoApuesta ) ) {
                    $instanciaCI->db->where('a.estado', intval($estadoApuesta));
                }else{
                    $instanciaCI->db->where_in('a.estado', array(APUESTA_NO_EMPAREJADA, APUESTA_EMPAREJADA));
                }
                if ( !is_null( $apostadorObj ) ) {
                    $instanciaCI->db->where('p.id_apostador !=', intval($apostadorObj->getID()));
                }
                if ( !is_null( $estadoPartido ) ) {
                    $instanciaCI->db->where('pa.estado', intval($estadoPartido));
                }else{
                    $instanciaCI->db->where_in('pa.estado', array(PARTIDO_POR_JUGAR, PARTIDO_JUGANDO, PARTIDO_FINALIZADO, PARTIDO_INACTIVO));
                }
                if ( !is_null( $limite ) ) {
                    $instanciaCI->db->limit( $limite );
                }
                if ( !is_null( $ordenHoraPartido ) ) {
                    $instanciaCI->db->order_by('pa.fecha', $ordenHoraPartido);
                }else{
                    $instanciaCI->db->order_by('pa.fecha', 'DESC');
                }
                $apuestasDB = $instanciaCI->db->get()->result_array();

                $arrApuestasObj = array();
                if ( !is_null($apuestasDB) ) {
                    foreach ($apuestasDB as $apuestaDB) {
                        $apuestaObj = self::getApuestaPorID($apuestaDB["id"]);
                        array_push($arrApuestasObj, $apuestaObj);
                    }
                    return $arrApuestasObj;
                }else{
                    return null;
                }
            }else{
                return null;
            }
        }

        public static function getApuestasEmparejadasConApostador( Apostador_model $apostadorObj = null, $limite = 5, $ordenHoraPartido = null, $estadoPartido = null ){
            // Obtener instancia de CI para manejo de base
            $instanciaCI =& get_instance();

            if( !is_null( $apostadorObj ) ){
                $apuestasDB = null;
                $instanciaCI->db->select("a.id");
                $instanciaCI->db->from('apuesta AS a');
                $instanciaCI->db->join("pronostico as p", "p.id = a.id_pronostico_apostador_2");
                $instanciaCI->db->join("partido as pa", "pa.id = p.id_partido");
                $instanciaCI->db->where('a.estado', intval(APUESTA_EMPAREJADA));
                if ( !is_null( $apostadorObj ) ) {
                    $instanciaCI->db->where('p.id_apostador', intval($apostadorObj->getID()));
                }
                if ( !is_null( $estadoPartido ) ) {
                    $instanciaCI->db->where('pa.estado', intval($estadoPartido));
                }else{
                    $instanciaCI->db->where_in('pa.estado', array(PARTIDO_POR_JUGAR, PARTIDO_JUGANDO, PARTIDO_FINALIZADO, PARTIDO_INACTIVO));
                }
                if ( !is_null( $limite ) ) {
                    $instanciaCI->db->limit( $limite );
                }
                if ( !is_null( $ordenHoraPartido ) ) {
                    $instanciaCI->db->order_by('pa.fecha', $ordenHoraPartido);
                }else{
                    $instanciaCI->db->order_by('pa.fecha', 'DESC');
                }
                $apuestasDB = $instanciaCI->db->get()->result_array();

                $arrApuestasObj = array();
                if ( !is_null($apuestasDB) ) {
                    foreach ($apuestasDB as $apuestaDB) {
                        $apuestaObj = self::getApuestaPorID($apuestaDB["id"]);
                        array_push($arrApuestasObj, $apuestaObj);
                    }
                    return $arrApuestasObj;
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

            $apuestasDB = null;
            $instanciaCI->db->select("a.id");
            $instanciaCI->db->from('apuesta AS a');
            if ( !is_null( $estado ) ) {
                $instanciaCI->db->where('a.estado', intval($estado));
            }else{
                $instanciaCI->db->where_in('a.estado', array(APUESTA_NO_EMPAREJADA, APUESTA_EMPAREJADA));
            }
            if ( $limite !== null ) {
                $instanciaCI->db->limit( $limite );
            }
            $instanciaCI->db->order_by('a.fecha', 'DESC');
            $apuestasDB = $instanciaCI->db->get()->result_array();

            $arrApuestasObj = array();
            if ( !is_null($apuestasDB) ) {
                foreach ($apuestasDB as $apuestaDB) {
                    $apuestaObj = self::getApuestaPorID($apuestaDB["id"]);
                    array_push($arrApuestasObj, $apuestaObj);
                }
                return $arrApuestasObj;
            }else{
                return null;
            }
        }

        ///////////////////////////////////
        // Modificación de base de datos
        ///////////////////////////////////
        public function grabar( ){
            try {
                $dataApuesta = array(
                    'id_pronostico_apostador_1' => $this->getPronosticoApostador1()->getID(),
                    'id_pronostico_apostador_2' => ( !is_null( $this->getPronosticoApostador2() ) ) ? $this->getPronosticoApostador2()->getID() : NULL,
                    'monto' => $this->getMonto(),
                    'fecha' => $this->getFecha(),
                    'estado' => $this->getEstado(),
                );
                $this->db->insert('apuesta', $dataApuesta);
                return $this->db->insert_id();
            } catch (Exception $e) {
                return null;
            }
        }
        public function actualizar( ){
            try {
                $dataApuesta = array(
                    'id_pronostico_apostador_1' => $this->getPronosticoApostador1()->getID(),
                    'id_pronostico_apostador_2' => ( !is_null( $this->getPronosticoApostador2() ) ) ? $this->getPronosticoApostador2()->getID() : NULL,
                    'monto' => $this->getMonto(),
                    'fecha' => $this->getFecha(),
                    'estado' => $this->getEstado(),
                );
                $this->db->where('id', $this->getID() );
                $this->db->update('apuesta', $dataApuesta);
                return $this->getID();
            } catch (Exception $e) {
                return null;
            }
        }
        public static function borrarPorID( $apuestaID ){
            // Obtener instancia de CI para manejo de base
            $instanciaCI =& get_instance();

            try {
                $condicionApuesta = array (
                    'id' => $apuestaID
                );
                $instanciaCI->db->delete('apuesta', $condicionApuesta);
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