<?php

namespace system;

class Session
{
    public function __construct()
    {
        session_start();
    }

    public function setFlash($message, $type='danger')
    {
        $_SESSION['flash'] = array(
                'message'    =>    $message,
                'type'        =>    $type
            );
    }

    public function flash()
    {
        if (isset($_SESSION['flash']) && !empty($_SESSION['flash'])) {
            $html = '<div class="alert alert-'.$_SESSION['flash']['type'].'">'.$_SESSION['flash']['message'].'</div>';
            $_SESSION['flash'] = array();
            return $html;
        }
    }
}
