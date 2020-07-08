<?php


namespace App\Comments;

use App\App;
class Model extends Comment
{
    const TABLE = 'comments';

    public static function insert(Comment $comment)
    {
        App::$db->createTable(self::TABLE);
        return App::$db->insertRow(self::TABLE, $comment->_getData());
    }

    public static function getWhere($conditions)
    {
        $rows = App::$db->getRowsWhere(self::TABLE, $conditions);

        $comments = [];

        foreach ($rows as $row) {
            $comments[] = new Comment($row);
        }
        return $comments;
    }
}