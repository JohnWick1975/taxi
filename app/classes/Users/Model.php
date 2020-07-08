<?php


namespace App\Users;

use App\App;
class Model
{
    const TABLE = 'users';

    public static function insert(User $user)
    {
        App::$db->createTable(self::TABLE);
        return App::$db->insertRow(self::TABLE, $user->_getData());
    }

    public static function getWhere($conditions)
    {
        $rows = App::$db->getRowsWhere(self::TABLE, $conditions);

        $users = [];

        foreach ($rows as $row) {
            $users[] = new User($row);
        }
        return $users;
    }

    public static function find(int $id): ?User
    {
        $user_data = App::$db->getRowById(self::TABLE, $id);

        if ($user_data) {
            $user = new User($user_data);
            $user->id = $id;

            return $user;
        }

        return null;
    }

    public static function update(User $user)
    {
        return App::$db->updateRow(self::TABLE, $user->_getData(), $user->id);
    }

    public static function delete(User $user)
    {
        return App::$db->deleteRow(self::TABLE, $user->id);
    }
}