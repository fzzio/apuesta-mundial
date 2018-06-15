<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| Display Debug backtrace
|--------------------------------------------------------------------------
|
| If set to TRUE, a backtrace will be displayed along with php errors. If
| error_reporting is disabled, the backtrace will not display, regardless
| of this setting
|
*/
defined('SHOW_DEBUG_BACKTRACE') OR define('SHOW_DEBUG_BACKTRACE', TRUE);

/*
|--------------------------------------------------------------------------
| File and Directory Modes
|--------------------------------------------------------------------------
|
| These prefs are used when checking and setting modes when working
| with the file system.  The defaults are fine on servers with proper
| security, but you may wish (or even need) to change the values in
| certain environments (Apache running a separate process for each
| user, PHP under CGI with Apache suEXEC, etc.).  Octal values should
| always be used to set the mode correctly.
|
*/
defined('FILE_READ_MODE')  OR define('FILE_READ_MODE', 0644);
defined('FILE_WRITE_MODE') OR define('FILE_WRITE_MODE', 0666);
defined('DIR_READ_MODE')   OR define('DIR_READ_MODE', 0755);
defined('DIR_WRITE_MODE')  OR define('DIR_WRITE_MODE', 0755);

/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
|
| These modes are used when working with fopen()/popen()
|
*/
defined('FOPEN_READ')                           OR define('FOPEN_READ', 'rb');
defined('FOPEN_READ_WRITE')                     OR define('FOPEN_READ_WRITE', 'r+b');
defined('FOPEN_WRITE_CREATE_DESTRUCTIVE')       OR define('FOPEN_WRITE_CREATE_DESTRUCTIVE', 'wb'); // truncates existing file data, use with care
defined('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE')  OR define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE', 'w+b'); // truncates existing file data, use with care
defined('FOPEN_WRITE_CREATE')                   OR define('FOPEN_WRITE_CREATE', 'ab');
defined('FOPEN_READ_WRITE_CREATE')              OR define('FOPEN_READ_WRITE_CREATE', 'a+b');
defined('FOPEN_WRITE_CREATE_STRICT')            OR define('FOPEN_WRITE_CREATE_STRICT', 'xb');
defined('FOPEN_READ_WRITE_CREATE_STRICT')       OR define('FOPEN_READ_WRITE_CREATE_STRICT', 'x+b');

/*
|--------------------------------------------------------------------------
| Exit Status Codes
|--------------------------------------------------------------------------
|
| Used to indicate the conditions under which the script is exit()ing.
| While there is no universal standard for error codes, there are some
| broad conventions.  Three such conventions are mentioned below, for
| those who wish to make use of them.  The CodeIgniter defaults were
| chosen for the least overlap with these conventions, while still
| leaving room for others to be defined in future versions and user
| applications.
|
| The three main conventions used for determining exit status codes
| are as follows:
|
|    Standard C/C++ Library (stdlibc):
|       http://www.gnu.org/software/libc/manual/html_node/Exit-Status.html
|       (This link also contains other GNU-specific conventions)
|    BSD sysexits.h:
|       http://www.gsp.com/cgi-bin/man.cgi?section=3&topic=sysexits
|    Bash scripting:
|       http://tldp.org/LDP/abs/html/exitcodes.html
|
*/
defined('EXIT_SUCCESS')        OR define('EXIT_SUCCESS', 0); // no errors
defined('EXIT_ERROR')          OR define('EXIT_ERROR', 1); // generic error
defined('EXIT_CONFIG')         OR define('EXIT_CONFIG', 3); // configuration error
defined('EXIT_UNKNOWN_FILE')   OR define('EXIT_UNKNOWN_FILE', 4); // file not found
defined('EXIT_UNKNOWN_CLASS')  OR define('EXIT_UNKNOWN_CLASS', 5); // unknown class
defined('EXIT_UNKNOWN_METHOD') OR define('EXIT_UNKNOWN_METHOD', 6); // unknown class member
defined('EXIT_USER_INPUT')     OR define('EXIT_USER_INPUT', 7); // invalid user input
defined('EXIT_DATABASE')       OR define('EXIT_DATABASE', 8); // database error
defined('EXIT__AUTO_MIN')      OR define('EXIT__AUTO_MIN', 9); // lowest automatically-assigned error code
defined('EXIT__AUTO_MAX')      OR define('EXIT__AUTO_MAX', 125); // highest automatically-assigned error code

// Constantes del Proyecto
defined('PROYECTO_NOMBRE')			OR define('PROYECTO_NOMBRE', 'Apuesta Mundial'); // Nombre
defined('PROYECTO_AUTOR')			OR define('PROYECTO_AUTOR', 'Fabricio Orrala'); // Autor
defined('PROYECTO_DESARROLLADOR')	OR define('PROYECTO_DESARROLLADOR', 'CAJANEGRA S.A.'); // Desarrollador

// Manejo de estados
defined('ESTADO_INACTIVO')		OR define('ESTADO_INACTIVO', 0);
defined('ESTADO_ACTIVO')		OR define('ESTADO_ACTIVO', 1);

defined('PAIS_INACTIVO')		OR define('PAIS_INACTIVO', 0);
defined('PAIS_ACTIVO')			OR define('PAIS_ACTIVO', 1);
defined('PAIS_ELIMINADO')		OR define('PAIS_ELIMINADO', 2);

defined('PARTIDO_INACTIVO')		OR define('PARTIDO_INACTIVO', 0);
defined('PARTIDO_POR_JUGAR')	OR define('PARTIDO_POR_JUGAR', 1);
defined('PARTIDO_JUGANDO')		OR define('PARTIDO_JUGANDO', 2);
defined('PARTIDO_FINALIZADO')	OR define('PARTIDO_FINALIZADO', 3);

defined('FASE_INACTIVO')		OR define('FASE_INACTIVO', 0);
defined('FASE_GRUPOS')			OR define('FASE_GRUPOS', 1);
defined('FASE_OCTAVOS')			OR define('FASE_OCTAVOS', 2);
defined('FASE_CUARTOS')			OR define('FASE_CUARTOS', 3);
defined('FASE_SEMIFINAL')		OR define('FASE_SEMIFINAL', 4);
defined('FASE_FINAL')			OR define('FASE_FINAL', 5);
defined('FASE_TERCERO')			OR define('FASE_TERCERO', 6);

defined('PRONOSTICO_GANA_LOCAL')		OR define('PRONOSTICO_GANA_LOCAL', 1);
defined('PRONOSTICO_GANA_VISITANTE')	OR define('PRONOSTICO_GANA_VISITANTE', 2);
defined('PRONOSTICO_EMPATE')			OR define('PRONOSTICO_EMPATE', 3);

defined('RESULTADO_GANASTE')		OR define('RESULTADO_GANASTE', 1);
defined('RESULTADO_PERDISTE')		OR define('RESULTADO_PERDISTE', 2);
defined('RESULTADO_CASA_GANA')		OR define('RESULTADO_CASA_GANA', 3);

defined('APUESTA_NO_EMPAREJADA')	OR define('APUESTA_NO_EMPAREJADA', 0);
defined('APUESTA_EMPAREJADA')		OR define('APUESTA_EMPAREJADA', 1);

// Roles
defined('ROL_CASA')				OR define('ROL_CASA', 1);
defined('ROL_APOSTADOR')		OR define('ROL_APOSTADOR', 2);

defined('FECHA_HOY')			OR define('FECHA_HOY', date('Y-m-d H:i:s', time()));