<?php

session_start("install");

if (isset($_POST['step'])) {
    $_SESSION['step'] = $_POST['step'];
} else {
    $_SESSION['step'] = 1;
}

include "step".$_SESSION['step'].".php";
