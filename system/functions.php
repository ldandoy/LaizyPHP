<?php

/**
 * File system\functions.php
 *
 * @category System
 * @package  Netoverconsulting
 * @author   Loïc Dandoy <ldandoy@overconsulting.net>
 * @license  GNU 
 * @link     http://overconsulting.net
 */

/**
 * Fonction affichant les debug
 *
 * @param string $message le text a afficher
 *
 * @return void
 */
function debug($message)
{
    $backtrace = debug_backtrace();
    echo '<div class="well">';
    echo '<p><a href=""><strong>'.$backtrace[0]["file"].'</strong> '.$backtrace[0]['line'].'</a></p>';
    echo '<ol>';
    foreach ($backtrace as $k => $v) {
        if ($k > 2) {
            echo '<li><strong>'.$v['file'].'</strong> '.$v['line'].'</lip>';
        }
    }
    echo '</ol>';
    echo "<pre>";
    print_r($message);
    echo "</pre>";
    echo '</div>';
}

/**
 * Fonction appelé pour filtrer les tableau
 *
 * @param string $v le text a valider
 *
 * @return boolean
 */
function fillarray($v)
{
    return ($v == null) ? false : true;
}
