<?php

require_once '../bootloader.php';

use App\App;
use App\Users\User;
use App\Views\Forms\Auth\Register;
use App\Views\Navigation;
use App\Users\Model;


if (App::$session->getUser()) {
    header('Location: /feedback.php');
}

function form_success(&$form, $input)
{
    $input['password'] = password_hash($input['password'], PASSWORD_BCRYPT);
    $user = new User($input);

    Model::insert($user);

    header('Location: login.php');
}


function form_fail(&$form, $input)
{
    $form['message'] = 'Failed to Register';
}

$registerView = new Register();

$registerView->validate();

$register_html = $registerView->render();
$navigationView = new Navigation();
$navigation_html = $navigationView->render();
?>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Register</title>
        <link rel="stylesheet" href="assets/css/style.css">
    </head>
    <body class="register">
        <?php print $navigation_html; ?>
        <main class="main-register">
            <div class="wrapper">
                <?php print $register_html; ?>
            </div>
        </main>
        <?php require_once '../core/templates/footer.php'; ?>
    </body>
</html>
