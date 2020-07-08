<?php
require_once '../../bootloader.php';

use App\Comments\Comment;
use App\App;
use App\Comments\Model;
use App\Views\Forms\AddForm;

function success_form(&$form, $input)
{
    $comment = new Comment([
        'date'=>date('Y-m-d'),
        'user_id'=>App::$session->getUser()->id,
        'comment'=>$input['comment']
    ]);

    $id = Model::insert($comment);
    $comment->id = $id;

    print json_encode($comment);
}

function form_fail(&$form, $input)
{
    $form['message'] = 'Failed to add comment';
}

$form = new AddForm();
$form->validate();