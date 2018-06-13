<?php
    if ( ! defined('BASEPATH')) exit('No direct script access allowed');

    /*
        Tabla:
            super_administrador
        Campos:
            id,
            user,
            password,
            fecha_registro,
            fecha_modificacion,
            estado,
    */
 
    class Super_administrador_model extends CI_Model {
        
        protected $ID;
        private $nombre;
        private $email;
        private $user;
        private $password;
        private $fechaRegistro;
        private $fechaModificacion;
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
        public function getUser(){
            return $this->user;
        }
        public function getEmail(){
            return $this->email;
        }
        public function getNombre(){
            return $this->nombre;
        }
        public function getPassword(){
            return $this->password;
        }
        public function getFechaRegistro(){
            return $this->fechaRegistro;
        }
        public function getFechaModificacion(){
            return $this->fechaModificacion;
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
        public function setEmail( $email ){
            $this->email = $email;
        }
        public function setUser( $user ){
            $this->user = $user;
        }
        public function setPassword( $password ){
            $this->password = $password;
        }
        public function setFechaRegistro( $fechaRegistro ){
            $this->fechaRegistro = $fechaRegistro;
        }
        public function setFechaModificacion( $fechaModificacion ){
            $this->fechaModificacion = $fechaModificacion;
        }
        public function setEstado( $estado ){
            $this->estado = $estado;
        }


        ///////////////////////////////////
        // Getters y Setters de Objeto
        ///////////////////////////////////
        public function getSuperAdministrador(){
            return $this;
        }

        public function setSuperAdministrador( $ID, $nombre, $email, $user, $password, $fechaRegistro, $fechaModificacion, $estado ){
            $this->setID( $ID );
            $this->setNombre( $nombre );
            $this->setEmail( $email );
            $this->setUser( $user );
            $this->setPassword( $password );
            $this->setFechaRegistro( $fechaRegistro );
            $this->setFechaModificacion( $fechaModificacion );
            $this->setEstado( $estado );
        }


        ///////////////////////////////////
        // Funciones
        ///////////////////////////////////
        public static function getSuperAdministradorPorID( $superAdministradorID, $estado = null ){
            if ( !is_null( $superAdministradorID ) ) {
                // Obtener instancia de CI para manejo de base
                $instanciaCI =& get_instance();

                $superAdministradorDB = null;
                $instanciaCI->db->select("s.*");
                $instanciaCI->db->from('super_administrador AS s');
                $instanciaCI->db->where('s.id', intval($superAdministradorID));
                if ( $estado !== null ) {
                    $instanciaCI->db->where('s.estado', intval($estado));
                }else{
                    $instanciaCI->db->where_in('s.estado', array(ESTADO_INACTIVO, ESTADO_ACTIVO));
                }
                $superAdministradorDB = $instanciaCI->db->get()->row();
                
                if ( !is_null($superAdministradorDB) ) {
                    $superAdministradorObj = new Super_administrador_model();
                    $superAdministradorObj->setSuperAdministrador(
                        $superAdministradorDB->id,
                        $superAdministradorDB->nombre,
                        $superAdministradorDB->email,
                        $superAdministradorDB->user,
                        $superAdministradorDB->password,
                        $superAdministradorDB->fecha_registro,
                        $superAdministradorDB->fecha_modificacion,
                        $superAdministradorDB->estado
                    );

                    return $superAdministradorObj;
                }else{
                    return null;
                }
            }else{
                return null;
            }
        }
        public static function getSuperAdministradorPorUserPorPassword( $user, $password ){
            if ( !is_null( $user ) && !is_null( $password ) ) {
                // Obtener instancia de CI para manejo de base
                $instanciaCI =& get_instance();

                $superAdministradorDB = null;
                $instanciaCI->db->select("s.*");
                $instanciaCI->db->from('super_administrador AS s');
                $instanciaCI->db->where('s.user', $user);
                $instanciaCI->db->where('s.password', md5($password));
                $superAdministradorDB = $instanciaCI->db->get()->row();
                
                if ( !is_null($superAdministradorDB) ) {
                    $superAdministradorObj = new Super_administrador_model();
                    $superAdministradorObj->setSuperAdministrador(
                        $superAdministradorDB->id,
                        $superAdministradorDB->nombre,
                        $superAdministradorDB->email,
                        $superAdministradorDB->user,
                        $superAdministradorDB->password,
                        $superAdministradorDB->fecha_registro,
                        $superAdministradorDB->fecha_modificacion,
                        $superAdministradorDB->estado
                    );

                    return $superAdministradorObj;
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

            $superAdministradoresDB = null;
            $instanciaCI->db->select("s.id");
            $instanciaCI->db->from('super_administrador AS s');
            if ( $estado != null ) {
                $instanciaCI->db->where('s.estado', intval($estado));
            }else{
                $instanciaCI->db->where_in('s.estado', array(ESTADO_INACTIVO, ESTADO_ACTIVO));
            }
            $superAdministradoresDB = $instanciaCI->db->get()->result_array();

            $arrSuperAdministradoresObj = array();
            if ( !is_null($superAdministradoresDB) ) {
                foreach ($superAdministradoresDB as $superAdministradorDB) {
                    $superAdministradorObj = self::getSuperAdministradorPorID($superAdministradorDB["id"]);
                    array_push($arrSuperAdministradoresObj, $superAdministradorObj);
                }
                return $arrSuperAdministradoresObj;
            }else{
                return null;
            }
        }

        ///////////////////////////////////
        // Modificación de base de datos
        ///////////////////////////////////
        public function grabar( ){
            try {
                $dataSuperAdministrador = array(
                    'nombre' => $this->getNombre(),
                    'email' => $this->getEmail(),
                    'user' => $this->getUser(),
                    'password' => md5($this->getPassword()),
                    'fecha_registro' => $this->getFechaRegistro(),
                    'fecha_modificacion' => $this->getFechaModificacion(),
                    'estado' => $this->getEstado(),
                );
                $this->db->insert('super_administrador', $dataSuperAdministrador);
                return $this->db->insert_id();
            } catch (Exception $e) {
                return null;
            }
        }
        public function actualizar( ){
            try {
                $dataSuperAdministrador = array(
                    'nombre' => $this->getNombre(),
                    'email' => $this->getEmail(),
                    'user' => $this->getUser(),
                    'password' => md5($this->getPassword()),
                    'fecha_registro' => $this->getFechaRegistro(),
                    'fecha_modificacion' => $this->getFechaModificacion(),
                    'estado' => $this->getEstado(),
                );
                $this->db->where('id', $this->getID() );
                $this->db->update('super_administrador', $dataSuperAdministrador);
                return $this->getID();
            } catch (Exception $e) {
                return null;
            }
        }
        public static function borrarPorID( $superAdministradorID ){
            // Obtener instancia de CI para manejo de base
            $instanciaCI =& get_instance();

            try {
                $condicionSuperAdministrador = array (
                    'id' => $superAdministradorID
                );
                $instanciaCI->db->delete('super_administrador', $condicionSuperAdministrador);
                return true;
            } catch (Exception $e) {
                return null;
            }
        }
        
        ///////////////////////////////////
        // Otros
        ///////////////////////////////////
        public function __toString() {
            return get_class($this) . " [ID: " . $this->getID() . ", User: " . $this->getUser() . "]";
        }
    }
?>