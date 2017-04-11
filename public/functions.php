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
 * @param bool $displayBacktrace
 *
 * @return void
 */
function debug($data, $displayBacktrace = true)
{
    $html =
        '<div class="well">';

    if ($displayBacktrace) {
        $html .=
            '<ol>';
        $backtraces = debug_backtrace();
        foreach ($backtraces as $backtrace) {
            $html .=
                '<li><strong>'.$backtrace['file'].'</strong> '.$backtrace['line'].'</li>';
        }
        $html .=
            '</ol>';
    }

    $html .=
            '<pre>'.print_r($data, true).'<pre>'.
        '</div>';

    echo $html;
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
