<?php

require_once '../bootloader.php';

use App\Views\Navigation;
use App\Views\Forms\Tables\TableData;
use App\Views\Forms\AddForm;
use App\Comments\Comment;
use App\Comments\Model;
use App\App;

function form_success(&$form, $input)
{
    $comment = new Comment([
        'date' => date('Y-m-d'),
        'user_id' => App::$session->getUser()->id,
        'comment' => $input['comment']
    ]);

    Model::insert($comment);
    $form['message'] = 'Comment added';
}

function form_fail(&$form, $input)
{
    $form['message'] = 'Fail to add';
}

/*$table = new TableData();
$table_html = $table->render();*/

if (App::$session->getUser()) {
    $form = new AddForm();
    $form->validate();
    $form_html = $form->render();
}

$navigationView = new Navigation();
$navigation_html = $navigationView->render();
?>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Login</title>
        <link rel="stylesheet" href="assets/css/style.css">
        <script src="assets/js/app.js" type="module"></script>
    </head>
    <body>
        <?php print $navigation_html; ?>
        <main class="main-feedback">
            <h1>Reviews: </h1>
            <div class="feedback-wrapper">
               <!-- --><?php /*print $table_html */?>
            </div>
            <div class="comment-form-wrapper">
                <?php if (App::$session->getUser()) : ?>
                    <?php print $form_html; ?>
                <?php else : ?>
                    <h2>Want to write a comment? Just sign up!</h2>
                <?php endif; ?>
            </div>
        </main>
        <?php require_once '../core/templates/footer.php'; ?>
    </body>
</html>
