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

use System\Router;

/**
 * Display debug info
 *
 * @param mixed $data
 *
 * @return void
 */
function debug($data)
{
    $backtrace = debug_backtrace();
    echo '<div class="well">';
    echo '<p><a href=""><strong>'.$backtrace[0]['file'].'</strong> '.$backtrace[0]['line'].'</a></p>';
    echo '<ol>';
    foreach ($backtrace as $k => $v) {
        if ($k > 2) {
            echo '<li><strong>'.$v['file'].'</strong> '.$v['line'].'</lip>';
        }
    }
    echo '</ol>';
    echo '<pre>';
    print_r($data);
    echo '</pre>';
    echo '</div>';
}

/**
 * Return the last element of an array
 *
 * @param array $a
 *
 * @return array $lastElement
 */
function getLastElement($a)
{
    return $a[count($a)-1];
}

/**
 * Function called to filter arrays
 *
 * @param mixed $v value to test
 *
 * @return boolean
 */
function notEmpty($v)
{
    return empty($v) ? false : true;
}

/**
 * Function called to filter arrays
 *
 * @param mixed $a
 *
 * @return boolean
 */
function deleteEmptyItem($a)
{
    return array_filter($a, 'notEmpty');
}

/**
 * Shorcut for Router::url
 *
 * @param string $string
 * @param mixed $params
 *
 * @return string
 */
function url($string, $params = array())
{
    return Router::url($string, $params);
}

/**
 * Generate options array for select
 *
 * @param mixed $data
 * @param string $fieldValue
 * @param string $fieldLabel
 *
 * @return string
 */
function options($data, $fieldValue, $fieldLabel)
{
    $options = array();

    foreach ((array)$data as $d) {
        $options[$d[$fieldValue]] = array(
            'value' => $d[$fieldValue],
            'label' => $d[$fieldLabel]
        );
    }

    return $options;
}
