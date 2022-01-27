<?php

$page = "script";

include_once "includes" . DIRECTORY_SEPARATOR . "functions.php";

extract(checkAuth());

if(count($errors) > 0) {
    setErrors($errors);
    redirect("index.php");
} else {
    redirect("correct.php");
}