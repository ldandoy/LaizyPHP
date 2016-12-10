<?php

    namespace system;

function debug($message)
{
    $backtrace = debug_backtrace();
    echo '<div class="well">';
    echo '<p><a href=""><strong>'.$backtrace[0]["file"].'</strong> '.$backtrace[0]['line'].'</a></p>';
    echo '<ol>';
    foreach ($backtrace as $k => $v) {
        if ($k > 1) {
            echo '<li><strong>'.$v['file'].'</strong> '.$v['line'].'</lip>';
        }
    }
    echo '</ol>';
    echo "<pre>";
    print_r($message);
    echo "</pre>";
    echo '</div>';
}
