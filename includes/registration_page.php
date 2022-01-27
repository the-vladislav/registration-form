<?php

include_once "includes" . DIRECTORY_SEPARATOR . "functions.php";

$errors = getErrors();
$values = getValues();

if(isset($values["login"])) {
    $loginValue = $values["login"];
} else {
    $loginValue = "";
}

if(isset($values["email"])) {
    $emailValue = $values["email"];
} else {
    $emailValue = "";
}

?>


<?php if(count($errors) > 0):?>
    <ul>
        <?php foreach($errors as $error):?>
            <li><?= $error?></li>
        <?php endforeach;?>
    </ul>
<?php endif;?>


<form action="script.php" method="post">

    <?php include "title.php" ?>

    <div class="partRegBox">
        <label for="login">Логин:</label>
        <input type="text" name="login" value="<?php echo $loginValue;?>" id="login"/>
    </div>

    <div class="partRegBox">
        <label for="pass">Пароль:</label>
        <input type="password" name="pass" id="pass"/>
    </div>

    <div class="partRegBox">
        <label for="returnPass">Повтор пароля:</label>
        <input type="password" name="returnPass" id="returnPass"/>
    </div>

    <div class="partRegBox">
        <label for="email">E-Mail:</label>
        <input type="text" name="email" value="<?php echo $emailValue;?>" id="email"/>
    </div>

    <div class="submitBox">
        <input type="submit" value="Отправить"/>
    </div>

</form>