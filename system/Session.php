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
 * Class to manage session
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
     * Init
     *
     * @return void
     */
    public static function init()
    {
        session_start();
    }

    /**
     * Add a flash message
     *
     * @param string $text message to display
     * @param string $type message type (danger|success|warning|info)
     * @param bool $canClose
     *
     * @return void
     */
    public static function addFlash($text = '', $type = 'danger', $canClose = true)
    {
        $_SESSION['flash'][] = array(
            'text' => $text,
            'type' => $type,
            'canClose' => $canClose
        );
    }

    /**
     * Get the html for flash messages
     *
     * @return string
     */
    public static function flash()
    {
        $html = '';

        if (isset($_SESSION['flash'])) {
            foreach ($_SESSION['flash'] as $m) {
                $button = '';
                if($canClose === true)
                {
                    $button = '<button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>';
                }
                
                $html .=
                    '<div class="alert alert-'.$type.' alert-dismissible" role="alert">'.
                        $button.
                        $message.
                    '</div>';
            }
        }

        return $html;
    }

    /**
     * Add/Set a session variable
     *
     * @return void
     */
    public static function set($name, $value = null)
    {
        $_SESSION[$name] = $value;
    }

    /**
     * Get a session variable 
     *
     * @return mixed
     */
    public static function get($name)
    {        
        return isset($_SESSION[$name]) ? $_SESSION[$name] : null;
    }

    /**
     * Remove a session variable
     *
     * @return void
     */
    public static function remove($name)
    {
        unset($_SESSION[$name]);
    }
}
