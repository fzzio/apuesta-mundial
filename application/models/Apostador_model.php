<?php
    if ( ! defined('BASEPATH')) exit('No direct script access allowed');

    /*
        Tabla:
            apostador
        Campos:
            id,
            cedula,
            password,
            nombre,
            email,
            celular,
            monto_inicial,
            fecha,
            estado,
    */
 
    class Apostador_model extends CI_Model {
        
        protected $ID;
        private $cedula;
        private $password;
        private $nombre;
        private $email;
        private $celular;
        private $montoInicial;
        private $fecha;
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
        public function getCedula(){
            return $this->cedula;
        }
        public function getPassword(){
            return $this->password;
        }
        public function getNombre(){
            return $this->nombre;
        }
        public function getEmail(){
            return $this->email;
        }
        public function getCelular(){
            return $this->celular;
        }
        public function getMontoInicial(){
            return $this->montoInicial;
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
        public function setCedula( $cedula ){
            $this->cedula = $cedula;
        }
        public function setPassword( $password ){
            $this->password = $password;
        }
        public function setNombre( $nombre ){
            $this->nombre = $nombre;
        }
        public function setEmail( $email ){
            $this->email = $email;
        }
        public function setCelular( $celular ){
            $this->celular = $celular;
        }
        public function setMontoInicial( $montoInicial ){
            $this->montoInicial = $montoInicial;
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
        public function getApostador(){
            return $this;
        }

        public function setApostador( $ID, $cedula, $password, $nombre, $email, $celular, $montoInicial, $fecha, $estado ){
            $this->setID( $ID );
            $this->setCedula( $cedula );
            $this->setPassword( $password );
            $this->setNombre( $nombre );
            $this->setEmail( $email );
            $this->setCelular( $celular );
            $this->setMontoInicial( $montoInicial );
            $this->setFecha( $fecha );
            $this->setEstado( $estado );
        }


        ///////////////////////////////////
        // Funciones
        ///////////////////////////////////
        public static function getApostadorPorID( $apostadorID, $estado = null ){
            if ( !is_null( $apostadorID ) ) {
                // Obtener instancia de CI para manejo de base
                $instanciaCI =& get_instance();

                $apostadorDB = null;
                $instanciaCI->db->select("a.*");
                $instanciaCI->db->from('apostador AS a');
                $instanciaCI->db->where('a.id', intval($apostadorID));
                if ( $estado !== null ) {
                    $instanciaCI->db->where('a.estado', intval($estado));
                }else{
                    $instanciaCI->db->where_in('a.estado', array(ESTADO_INACTIVO, ESTADO_ACTIVO));
                }
                $apostadorDB = $instanciaCI->db->get()->row();
                
                if ( !is_null($apostadorDB) ) {
                    $apostadorObj = new Apostador_model();
                    $apostadorObj->setApostador(
                        $apostadorDB->id,
                        $apostadorDB->cedula,
                        $apostadorDB->password,
                        $apostadorDB->nombre,
                        $apostadorDB->email,
                        $apostadorDB->celular,
                        $apostadorDB->monto_inicial,
                        $apostadorDB->fecha,
                        $apostadorDB->estado
                    );

                    return $apostadorObj;
                }else{
                    return null;
                }
            }else{
                return null;
            }
        }
        public static function getApostadorPorCedulaPorPassword( $cedula, $password ){
            if ( !is_null( $cedula ) && !is_null( $password ) ) {
                // Obtener instancia de CI para manejo de base
                $instanciaCI =& get_instance();

                $apostadorDB = null;
                $instanciaCI->db->select("a.*");
                $instanciaCI->db->from('apostador AS a');
                $instanciaCI->db->where('a.cedula', $cedula);
                $instanciaCI->db->where('a.password', md5($password));
                $apostadorDB = $instanciaCI->db->get()->row();
                
                if ( !is_null($apostadorDB) ) {
                    $apostadorObj = new Apostador_model();
                    $apostadorObj->setApostador(
                        $apostadorDB->id,
                        $apostadorDB->cedula,
                        $apostadorDB->password,
                        $apostadorDB->nombre,
                        $apostadorDB->email,
                        $apostadorDB->celular,
                        $apostadorDB->monto_inicial,
                        $apostadorDB->fecha,
                        $apostadorDB->estado
                    );

                    return $apostadorObj;
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

            $apostadoresDB = null;
            $instanciaCI->db->select("a.id");
            $instanciaCI->db->from('apostador AS a');
            if ( !is_null( $estado ) ) {
                $instanciaCI->db->where('a.estado', intval($estado));
            }else{
                $instanciaCI->db->where_in('a.estado', array(ESTADO_INACTIVO, ESTADO_ACTIVO));
            }
            $apostadoresDB = $instanciaCI->db->get()->result_array();

            $arrApostadoresObj = array();
            if ( !is_null($apostadoresDB) ) {
                foreach ($apostadoresDB as $apostadorDB) {
                    $apostadorObj = self::getApostadorPorID($apostadorDB["id"]);
                    array_push($arrApostadoresObj, $apostadorObj);
                }
                return $arrApostadoresObj;
            }else{
                return null;
            }
        }

        public function getNumeroApuestasPorFase( $fase = null ){
            if( $this->getID() && !is_null( $fase ) ){
                // Obtenemos el total de las que creo el apostador
                $this->db->select("a.id");
                $this->db->from('apuesta AS a');
                $this->db->join("pronostico as pr", "pr.id = a.id_pronostico_apostador_1");
                $this->db->join("partido as pa", "pa.id = pr.id_partido");
                $this->db->where_in('a.estado', array(APUESTA_NO_EMPAREJADA, APUESTA_EMPAREJADA));
                $this->db->where('pr.id_apostador', intval( $this->getID() ));
                $this->db->where('pa.fase', intval($fase));
                $numeroApuestasApostador = $this->db->count_all_results();

                // Obtenemos el total de las el apostador desafió a un rival
                $this->db->select("a.id");
                $this->db->from('apuesta AS a');
                $this->db->join("pronostico as pr", "pr.id = a.id_pronostico_apostador_2");
                $this->db->join("partido as pa", "pa.id = pr.id_partido");
                $this->db->where_in('a.estado', array(APUESTA_NO_EMPAREJADA, APUESTA_EMPAREJADA));
                $this->db->where('pr.id_apostador', intval( $this->getID() ));
                $this->db->where('pa.fase', intval($fase));
                $numeroApuestasParticipantes = $this->db->count_all_results();

                return $numeroApuestasApostador + $numeroApuestasParticipantes;
            }else{
                return 0;
            }
        }

        ///////////////////////////////////
        // Modificación de base de datos
        ///////////////////////////////////
        public function grabar( ){
            try {
                $dataApostador = array(
                    'cedula' => $this->getCedula(),
                    'password' => md5($this->getPassword()),
                    'nombre' => $this->getNombre(),
                    'email' => $this->getEmail(),
                    'celular' => $this->getCelular(),
                    'monto_inicial' => $this->getMontoInicial(),
                    'fecha' => $this->getFecha(),
                    'estado' => $this->getEstado(),
                );
                $this->db->insert('apostador', $dataApostador);
                return $this->db->insert_id();
            } catch (Exception $e) {
                return null;
            }
        }
        public function actualizar( ){
            try {
                $dataApostador = array(
                    'cedula' => $this->getCedula(),
                    'password' => md5($this->getPassword()),
                    'nombre' => $this->getNombre(),
                    'email' => $this->getEmail(),
                    'celular' => $this->getCelular(),
                    'monto_inicial' => $this->getMontoInicial(),
                    'fecha' => $this->getFecha(),
                    'estado' => $this->getEstado(),
                );
                $this->db->where('id', $this->getID() );
                $this->db->update('apostador', $dataApostador);
                return $this->getID();
            } catch (Exception $e) {
                return null;
            }
        }
        public static function borrarPorID( $apostadorID ){
            // Obtener instancia de CI para manejo de base
            $instanciaCI =& get_instance();

            try {
                $condicionApostador = array (
                    'id' => $apostadorID
                );
                $instanciaCI->db->delete('apostador', $condicionApostador);
                return true;
            } catch (Exception $e) {
                return null;
            }
        }
        
        ///////////////////////////////////
        // Otros
        ///////////////////////////////////
        public function __toString() {
            return get_class($this) . " [ID: " . $this->getID() . ", Cedula: " . $this->getCedula() . "]";
        }
    }
?>