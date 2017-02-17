<?php
/**
 * File system\Session.php
 *
 * @category System
 * @package  Netoverconsulting
 * @author   Loïc Dandoy <ldandoy@overconsulting.net>
 * @license  GNU 
 * @link     http://overconsulting.net
 */

namespace system;

/**
 * Class gérant les sessions des utilisateurs
 *
 * @category System
 * @package  Netoverconsulting
 * @author   Loïc Dandoy <ldandoy@overconsulting.net>
 * @license  GNU 
 * @link     http://overconsulting.net
 */
class Session
{
    /**
     * Constructeur
     *
     * @return void
     */
    public function __construct()
    {
        if (!isset($_SESSION)) {
            session_start();
        }
    }

    /**
     * Ajout un message flash à la session
     *
     * @param string $message le texte à afficher
     * @param string $type chaine de caractères pour le style de la fenètre (danger|success|info)
     *
     * @return void
     */
    public function setFlash($message = '', $type = 'danger')
    {
        $_SESSION['flash'] = array(
                'message'    => $message,
                'type'       => $type
            );
    }

    /**
     * Renvoie le message flash stocké en session
     *
     * @return string $html contient le code du flash message à afficher
     */
    public function flash()
    {
        if (isset($_SESSION['flash']) && !empty($_SESSION['flash'])) {
            $html = '<div class="alert alert-'.$_SESSION['flash']['type'].'">'
            .$_SESSION['flash']['message']
            .'</div>';
            $_SESSION['flash'] = array();
            return $html;
        }
    }
}
