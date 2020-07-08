<?php

require_once '../bootloader.php';

use App\App;
use App\Views\Forms\Auth\Login;
use App\Views\Navigation;
use App\Users\Model;

if (App::$session->getUser()) {
    header('Location: /feedback.php');
}

function form_success(&$form, $input)
{
    $user_data = Model::getWhere(['email' => $input['email']]);

    $user = $user_data[0];
    App::$session->login($user->email, $user->password);

    header('Location: feedback.php');
}

function form_fail(&$form, $input)
{
    $form['message'] = 'Failed to log in';
}

$viewLogin = new Login();

$viewLogin->validate();

$login_html = $viewLogin->render();
$navigationView = new Navigation();
$navigation_html = $navigationView->render();

?>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Login</title>
        <link rel="stylesheet" href="assets/css/style.css">
    </head>
    <body class="login">
        <?php print $navigation_html; ?>
        <main class="main-login">
            <div class="wrapper">
                <?php print $login_html; ?>
            </div>
        </main>
        <?php require_once '../core/templates/footer.php'; ?>
    </body>
</html>
