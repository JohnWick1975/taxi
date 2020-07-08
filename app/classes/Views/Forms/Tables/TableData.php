<?php


namespace App\Views\Forms\Tables;

use App\App;
use App\Comments\Model;
use Core\View;
use App\Users\User;

class TableData extends Table
{
    public function __construct(array $table = [])
    {
        $data = [
            'attr' => [
                'class' => 'review-table'
            ],

            'headings' => [
                'Name',
                'Comments',
                'Date'
            ],
            'rows' => $this->getTableData()
        ];

        parent::__construct($data);
    }

    public function getTableData()
    {
        $comments = Model::getWhere([]);
        $rows = [];
        foreach ($comments as $key => $comment) {
            $user = \App\Users\Model::find($comment->user_id);
            $rows[] = [
                'name' => $user->name,
                'comment' => $comment->comment,
                'date' => $comment->date
            ];
        }
        return $rows;
    }

}