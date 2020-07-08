<?php
require_once '../../bootloader.php';

use App\Comments\Comment;
use App\App;
use App\Comments\Model;
use App\Views\Forms\AddForm;

function form_success(&$form, $input)
{
    $comment = new Comment([
        'date' => date('Y-m-d'),
        'user_id' => App::$session->getUser()->id,
        'comment' => $input['comment']
    ]);
    $user = \App\Users\Model::find(App::$session->getUser()->id);

    $id = Model::insert($comment);
    $comment->id = $id;
    $comment->name = $user->name;

    print json_encode($comment);
}

function form_fail(&$form, $input)
{
    $form['message'] = 'Failed to add comment';
}

$form = new AddForm();
$form->validate();