<?php
    if ( ! defined('BASEPATH')) exit('No direct script access allowed');

    /*
        Tabla:
            pais
        Campos:
            id,
            nombre,
            iso,
            estado,
    */
 
    class Pais_model extends CI_Model {
        
        protected $ID;
        private $nombre;
        private $iso;
        private $estado;
        
        function __construct() {
            parent::__construct();
            $this->load->database();
        }



        ///////////////////////////////////
        // Getters
        ///////////////////////////////////        
        public function getID(){
            return $this->ID;
        }
        public function getNombre(){
            return $this->nombre;
        }
        public function getIso(){
            return $this->iso;
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
        public function setNombre( $nombre ){
            $this->nombre = $nombre;
        }
        public function setIso( $iso ){
            $this->iso = $iso;
        }
        public function setEstado( $estado ){
            $this->estado = $estado;
        }


        ///////////////////////////////////
        // Getters y Setters de Objeto
        ///////////////////////////////////
        public function getPais(){
            return $this;
        }

        public function setPais( $ID, $nombre, $iso, $estado ){
            $this->setID( $ID );
            $this->setNombre( $nombre );
            $this->setIso( $iso );
            $this->setEstado( $estado );
        }


        ///////////////////////////////////
        // Funciones
        ///////////////////////////////////
        public static function getPaisPorID( $paisID ){
            if ( !is_null( $paisID ) ) {
                // Obtener instancia de CI para manejo de base
                $instanciaCI =& get_instance();

                $paisDB = null;
                $instanciaCI->db->select("p.*");
                $instanciaCI->db->from('pais AS p');
                $instanciaCI->db->where('p.id', intval($paisID));
                $paisDB = $instanciaCI->db->get()->row();
                
                if ( !is_null($paisDB) ) {
                    $paisObj = new Pais_model();
                    $paisObj->setPais(
                        $paisDB->id,
                        $paisDB->nombre,
                        $paisDB->iso,
                        $paisDB->estado
                    );

                    return $paisObj;
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

            $paisesDB = null;
            $instanciaCI->db->select("p.id");
            $instanciaCI->db->from('pais AS p');
            if ( $estado != null ) {
                $instanciaCI->db->where('p.estado', intval($estado));
            }else{
                //$instanciaCI->db->where_in('p.estado', array(PAIS_INACTIVO, PAIS_ACTIVO, PAIS_ELIMINADO);
                $instanciaCI->db->where_in('p.estado', array(PAIS_ACTIVO, PAIS_ELIMINADO));
            }
            $paisesDB = $instanciaCI->db->get()->result_array();

            $arrPaisesObj = array();
            if ( !is_null($paisesDB) ) {
                foreach ($paisesDB as $paisDB) {
                    $paisObj = self::getPaisPorID($paisDB["id"]);
                    array_push($arrPaisesObj, $paisObj);
                }
                return $arrPaisesObj;
            }else{
                return null;
            }
        }

        ///////////////////////////////////
        // Modificación de base de datos
        ///////////////////////////////////
        public function grabar( ){
            try {
                $dataPais = array(
                    'nombre' => $this->getNombre(),
                    'iso' => $this->getIso(),
                    'estado' => $this->getEstado(),
                );
                $this->db->insert('pais', $dataPais);
                return $this->db->insert_id();
            } catch (Exception $e) {
                return null;
            }
        }
        public function actualizar( ){
            try {
                $dataPais = array(
                    'nombre' => $this->getNombre(),
                    'iso' => $this->getIso(),
                    'estado' => $this->getEstado(),
                );
                $this->db->where('id', $this->getID() );
                $this->db->update('pais', $dataPais);
                return $this->getID();
            } catch (Exception $e) {
                return null;
            }
        }
        public static function borrarPorID( $paisID ){
            // Obtener instancia de CI para manejo de base
            $instanciaCI =& get_instance();

            try {
                $condicionPais = array (
                    'id' => $paisID
                );
                $instanciaCI->db->delete('pais', $condicionPais);
                return true;
            } catch (Exception $e) {
                return null;
            }
        }
        
        ///////////////////////////////////
        // Otros
        ///////////////////////////////////
        public function __toString() {
            return get_class($this) . " [ID: " . $this->getID() . ", Nombre: " . $this->getNombre() . "]";
        }
    }
?>