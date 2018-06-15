<?php
    if ( ! defined('BASEPATH')) exit('No direct script access allowed');

    /*
        Tabla:
            partido
        Campos:
            id,
            id_pais_local,
            id_pais_visitante,
            fecha,
            goles_local,
            goles_visitante,
            incidencias_local,
            incidencias_visitante,
            fase,
            grupo,
            estado,
    */
 
    class Partido_model extends CI_Model {
        
        protected $ID;
        private $PaisLocal;
        private $PaisVisitante;
        private $fecha;
        private $golesLocal;
        private $golesVisitante;
        private $incidenciasLocal;
        private $incidenciasVisitante;
        private $fase;
        private $grupo;
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
                    'Pais_model',
                )
            );
        }

        ///////////////////////////////////
        // Getters
        ///////////////////////////////////        
        public function getID(){
            return $this->ID;
        }
        public function getPaisLocal(){
            return $this->PaisLocal;
        }
        public function getPaisVisitante(){
            return $this->PaisVisitante;
        }
        public function getFecha(){
            return $this->fecha;
        }
        public function getGolesLocal(){
            return $this->golesLocal;
        }
        public function getGolesVisitante(){
            return $this->golesVisitante;
        }
        public function getIncidenciasLocal(){
            return $this->incidenciasLocal;
        }
        public function getIncidenciasVisitante(){
            return $this->incidenciasVisitante;
        }
        public function getFase(){
            return $this->fase;
        }
        public function getGrupo(){
            return $this->grupo;
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
        public function setPaisLocal( Pais_model $PaisLocal = null ){
            if ( !is_null( $PaisLocal ) ) {
                $this->PaisLocal = $PaisLocal;
            }
        }
        public function setPaisVisitante( Pais_model $PaisVisitante = null ){
            if ( !is_null( $PaisVisitante ) ) {
                $this->PaisVisitante = $PaisVisitante;
            }
        }
        public function setFecha( $fecha ){
            $this->fecha = $fecha;
        }
        public function setGolesLocal( $golesLocal ){
            $this->golesLocal = $golesLocal;
        }
        public function setGolesVisitante( $golesVisitante ){
            $this->golesVisitante = $golesVisitante;
        }
        public function setIncidenciasLocal( $incidenciasLocal ){
            $this->incidenciasLocal = $incidenciasLocal;
        }
        public function setIncidenciasVisitante( $incidenciasVisitante ){
            $this->incidenciasVisitante = $incidenciasVisitante;
        }
        public function setFase( $fase ){
            $this->fase = $fase;
        }
        public function setGrupo( $grupo ){
            $this->grupo = $grupo;
        }
        public function setEstado( $estado ){
            $this->estado = $estado;
        }


        ///////////////////////////////////
        // Getters y Setters de Objeto
        ///////////////////////////////////
        public function getPartido(){
            return $this;
        }

        public function setPartido( $ID, Pais_model $PaisLocal = null, Pais_model $PaisVisitante = null, $fecha, $golesLocal, $golesVisitante, $incidenciasLocal, $incidenciasVisitante, $fase, $grupo, $estado ){
            $this->setID( $ID );
            $this->setPaisLocal( $PaisLocal );
            $this->setPaisVisitante( $PaisVisitante );
            $this->setFecha( $fecha );
            $this->setGolesLocal( $golesLocal );
            $this->setGolesVisitante( $golesVisitante );
            $this->setIncidenciasLocal( $incidenciasLocal );
            $this->setIncidenciasVisitante( $incidenciasVisitante );
            $this->setFase( $fase );
            $this->setGrupo( $grupo );
            $this->setEstado( $estado );
        }


        ///////////////////////////////////
        // Funciones
        ///////////////////////////////////
        public static function getPartidoPorID( $partidoID ){
            if ( !is_null( $partidoID ) ) {
                // Obtener instancia de CI para manejo de base
                $instanciaCI =& get_instance();

                $partidoDB = null;
                $instanciaCI->db->select("p.*");
                $instanciaCI->db->from('partido AS p');
                $instanciaCI->db->where('p.id', intval($partidoID));
                $partidoDB = $instanciaCI->db->get()->row();
                
                if ( !is_null($partidoDB) ) {
                    $partidoObj = new Partido_model();
                    $partidoObj->setPartido(
                        $partidoDB->id,
                        Pais_model::getPaisPorID( $partidoDB->id_pais_local ),
                        Pais_model::getPaisPorID( $partidoDB->id_pais_visitante ),
                        $partidoDB->fecha,
                        $partidoDB->goles_local,
                        $partidoDB->goles_visitante,
                        $partidoDB->incidencias_local,
                        $partidoDB->incidencias_visitante,
                        $partidoDB->fase,
                        $partidoDB->grupo,
                        $partidoDB->estado
                    );

                    return $partidoObj;
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

            $partidosDB = null;
            $instanciaCI->db->select("p.id");
            $instanciaCI->db->from('partido AS p');
            if ( $estado != null ) {
                $instanciaCI->db->where('p.estado', intval($estado));
            }else{
                $instanciaCI->db->where_in('p.estado', array(PARTIDO_POR_JUGAR, PARTIDO_JUGANDO, PARTIDO_FINALIZADO, PARTIDO_INACTIVO));
            }
            $partidosDB = $instanciaCI->db->get()->result_array();

            $arrPartidosObj = array();
            if ( !is_null($partidosDB) ) {
                foreach ($partidosDB as $partidoDB) {
                    $partidoObj = self::getPartidoPorID($partidoDB["id"]);
                    array_push($arrPartidosObj, $partidoObj);
                }
                return $arrPartidosObj;
            }else{
                return null;
            }
        }
        public static function getUltimos( $limite = 5, $estado = null ){
            // Obtener instancia de CI para manejo de base
            $instanciaCI =& get_instance();

            $partidosDB = null;
            $instanciaCI->db->select("p.id");
            $instanciaCI->db->from('partido AS p');
            if ( $estado != null ) {
                $instanciaCI->db->where('p.estado', intval($estado));
            }else{
                $instanciaCI->db->where_in('p.estado', array(PARTIDO_POR_JUGAR, PARTIDO_JUGANDO, PARTIDO_FINALIZADO, PARTIDO_INACTIVO));
            }
            if ( $limite !== null ) {
                $instanciaCI->db->limit( $limite );
            }
            $instanciaCI->db->order_by('p.fecha', 'DESC');
            $partidosDB = $instanciaCI->db->get()->result_array();

            $arrPartidosObj = array();
            if ( !is_null($partidosDB) ) {
                foreach ($partidosDB as $partidoDB) {
                    $partidoObj = self::getPartidoPorID($partidoDB["id"]);
                    array_push($arrPartidosObj, $partidoObj);
                }
                return $arrPartidosObj;
            }else{
                return null;
            }
        }
        public static function getProximos( $limite = 5, $estado = null ){
            // Obtener instancia de CI para manejo de base
            $instanciaCI =& get_instance();

            $partidosDB = null;
            $instanciaCI->db->select("p.id");
            $instanciaCI->db->from('partido AS p');
            if ( $estado != null ) {
                $instanciaCI->db->where('p.estado', intval($estado));
            }else{
                $instanciaCI->db->where_in('p.estado', array(PARTIDO_POR_JUGAR, PARTIDO_JUGANDO, PARTIDO_FINALIZADO, PARTIDO_INACTIVO));
            }
            if ( $limite !== null ) {
                $instanciaCI->db->limit( $limite );
            }
            $instanciaCI->db->order_by('p.fecha', 'ASC');
            $partidosDB = $instanciaCI->db->get()->result_array();

            $arrPartidosObj = array();
            if ( !is_null($partidosDB) ) {
                foreach ($partidosDB as $partidoDB) {
                    $partidoObj = self::getPartidoPorID($partidoDB["id"]);
                    array_push($arrPartidosObj, $partidoObj);
                }
                return $arrPartidosObj;
            }else{
                return null;
            }
        }

        ///////////////////////////////////
        // Modificación de base de datos
        ///////////////////////////////////
        public function grabar( ){
            try {
                $dataPartido = array(
                    'id_pais_local' => $this->getPaisLocal()->getID(),
                    'id_pais_visitante' => $this->getPaisVisitante()->getID(),
                    'fecha' => $this->getFecha(),
                    'goles_local' => $this->getGolesLocal(),
                    'goles_visitante' => $this->getGolesVisitante(),
                    'incidencias_local' => $this->getIncidenciasLocal(),
                    'incidencias_visitante' => $this->getIncidenciasVisitante(),
                    'fase' => $this->getFase(),
                    'grupo' => $this->getGrupo(),
                    'estado' => $this->getEstado(),
                );
                $this->db->insert('partido', $dataPartido);
                return $this->db->insert_id();
            } catch (Exception $e) {
                return null;
            }
        }
        public function actualizar( ){
            try {
                $dataPartido = array(
                    'id_pais_local' => $this->getPaisLocal()->getID(),
                    'id_pais_visitante' => $this->getPaisVisitante()->getID(),
                    'fecha' => $this->getFecha(),
                    'goles_local' => $this->getGolesLocal(),
                    'goles_visitante' => $this->getGolesVisitante(),
                    'incidencias_local' => $this->getIncidenciasLocal(),
                    'incidencias_visitante' => $this->getIncidenciasVisitante(),
                    'fase' => $this->getFase(),
                    'grupo' => $this->getGrupo(),
                    'estado' => $this->getEstado(),
                );
                $this->db->where('id', $this->getID() );
                $this->db->update('partido', $dataPartido);
                return $this->getID();
            } catch (Exception $e) {
                return null;
            }
        }
        public static function borrarPorID( $partidoID ){
            // Obtener instancia de CI para manejo de base
            $instanciaCI =& get_instance();

            try {
                $condicionPartido = array (
                    'id' => $partidoID
                );
                $instanciaCI->db->delete('partido', $condicionPartido);
                return true;
            } catch (Exception $e) {
                return null;
            }
        }
        
        ///////////////////////////////////
        // Otros
        ///////////////////////////////////
        public function __toString() {
            return get_class($this) . " [ID: " . $this->getID() . ", Partido: " . $this->getPaisLocal()-getNombre() . " vs. " . $this->getPaisVisitante()-getNombre() . "]";
        }
    }
?>