<?php

function getValues() {
//    session_start();

    if(!empty($_SESSION["values"])) {
        $values = $_SESSION["values"];
        unset($_SESSION["values"]);
    } else {
        $values = [];
    }
    return $values;
}

function getErrors() {
    session_start();

    if(!empty($_SESSION["errors"])) {
        $errors = $_SESSION["errors"];
        unset($_SESSION["errors"]);
    } else {
        $errors = [];
    }
    return $errors;
}

function redirect($url = null) {
    $url = $url ?? $_SERVER["PHP_SELF"];
    header("Location:" . $url);
    exit();
}

function setErrors($errors) {
    session_start();

    $_SESSION["errors"] = $errors;
}

function setValues($login, $email) {
    session_start();

    $values = [];
    $values["login"] = $login;
    $values["email"] = $email;

    $_SESSION["values"] = $values;
}

function checkAuth() {
    $login = filter_input(INPUT_POST, "login");
    $pass = filter_input(INPUT_POST, "pass");
    $returnPass = filter_input(INPUT_POST, "returnPass");
    $email = filter_input(INPUT_POST, "email");
    $errors = [];

    setValues($login, $email);

    if(empty($login)) {
        $errors[] = "login is empty";
    }

    if( ( !(empty($login)) ) && (strlen($login) < 5) ) {
        $errors[] = "login must contain at least 5 characters";
    }

    if(empty($pass)) {
        $errors[] = "password is empty";
    }

    if(empty($returnPass)) {
        $errors[] = "return password is empty";
    }

    if( (!empty($pass)) && (strlen($pass) < 8) ) {
        $errors[] = "password must contain at least 8 characters";
    }

    if( (!empty($returnPass)) && (strlen($returnPass) < 8) ) {
        $errors[] = "password must contain at least 8 characters";
    }

    if ( ($pass != "") && ($returnPass != "") && (strlen($pass) < 8) && (strlen($returnPass) < 8)) {
        if ($pass != $returnPass) {
            $errors[] = "passwords is not identical";
        }
    }

    if(empty($email)) {
        $errors[] = "email is empty";
    }

    if(!empty($email)) {
        if(strlen($email) < 5) {
            $errors[] = "email must contain at least 5 characters";
        } else {
            $index = strpos($email, "@");
            var_dump($index);
            if( ($index === false) || ($index === strlen($email) - 1) || ($index === 0) ) {

                $errors[] = "it is not email";
            }
        }
    }

    return [
        "login" => $login,
        "pass" => $pass,
        "returnPass" => $returnPass,
        "email" => $email,
        "errors" => $errors,
    ];
}