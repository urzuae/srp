<?php
/**
 * ##$BRAND_NAME$##
 *
 * ##$DESCRIPTION$##
 *
 * @category   Project
 * @package    Project_Security
 * @copyright  ##$COPYRIGHT$##
 * @author     ##$AUTHOR$##, $LastChangedBy$
 * @version    ##$VERSION$##, SVN:  $Id$
 */

require_once 'lib/security/AuthException.php';
require_once 'application/models/catalogs/UserCatalog.php';
require_once 'application/models/catalogs/UserLogCatalog.php';

/**
 * Esta clase funge como el actor que realiza la autenticacion del usuario
 *
 * @category   project
 * @package    Project_Security
 * @copyright  ##$COPYRIGHT$##
 */
class Authentication
{

    /**
     * Metodo que autentica si existe el usuario y la contraseña en la base de datos de lo contrario tira una excepcion.
     * ademas si existe guarda una variable en sesion la cual es util para saber si el usuario ya ha sido autenticado.
     * @param string $username Nombre de usuario
     * @param string $password Password
     * @return User $user
     * @throws Exception Si no existen coincidencias en el usuario/password
     */
    public static function authenticate($username, $password)
    {
    	$request = new Zend_Controller_Request_Http();
        try
        {
            $criteria = new Criteria();
            $criteria->add(User::USERNAME, $username, Criteria::EQUAL);
            $criteria->add(User::PASSWORD, $password, Criteria::EQUAL, Criteria::PASSWORD);
            $criteria->setLimit(1);
            $user = UserCatalog::getInstance()->getByCriteria($criteria)->getOne();
            
            if(!($user instanceof User))
                throw new AuthException("Usuario y/o clave inválidos");
                
            if($user->getStatus() == 0)
                throw new AuthException("Usuario desactivado");
            
        	$userLog = UserLogFactory::create($user->getIdUser(), UserLog::LOGIN, $request->getServer("REMOTE_ADDR"), $user->getIdUser(), null, 'Inicio de sesión '.$user->getUsername());
            UserLogCatalog::getInstance()->create($userLog);
            return $user;
        }
        catch(AuthException $e)
        {
			if($username != null)
			{
				$criteria = new Criteria();
			    $criteria->add(User::USERNAME, $username, Criteria::EQUAL);
			    $criteria->setLimit(1);
			    $user = UserCatalog::getInstance()->getByCriteria($criteria)->getOne();
			    if($user instanceof User)
			    {
			        $userLog = UserLogFactory::create($user->getIdUser(), UserLog::FAILED_LOGIN, $request->getServer("REMOTE_ADDR"), $user->getIdUser(), null, 'Falló, inicio de sesión');
			        UserLogCatalog::getInstance()->create($userLog);
			    }
			}
			throw $e;
        }
    }
    
    /**
     * 
     * @param string $username
     * @param string $password
     * @param int $idAccessRole
     * @return $user
     */
    public static function authenticateAs($username, $password, $idAccessRole)
    {
    	$user = self::authenticate($username,$password);
    	if($user->getIdAccessRole() != $idAccessRole)
    		throw new AuthException('El usuario no tiene permisos suficientes');
        return $user;
    }
    
}


