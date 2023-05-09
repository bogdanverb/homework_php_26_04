<?php

namespace App;

use Nette\Database\Context;
use Nette\Database\Table\ActiveRow;

class UserManager
{
    /** @var Context */
    private $database;

    public function __construct(Context $database)
    {
        $this->database = $database;
    }

    public function getUserById(int $id): ?User
    {
        $row = $this->database->table('users')->get($id);
        return $row ? $this->createUserFromRow($row) : null;
    }

    public function getUserByUsername(string $username): ?User
    {
        $row = $this->database->table('users')->where('username', $username)->fetch();
        return $row ? $this->createUserFromRow($row) : null;
    }

    public function createUser(string $username, string $password, array $roles = []): User
    {
        $row = $this->database->table('users')->insert([
            'username' => $username,
            'password' => password_hash($password, PASSWORD_DEFAULT),
            'roles' => json_encode($roles),
        ]);
        return $this->createUserFromRow($row);
    }

    public function updateUser(User $user, array $values): void
    {
        $user->update($values);
    }

    public function deleteUser(User $user): void
    {
        $user->delete();
    }

    private function createUserFromRow(ActiveRow $row): User
    {
        return new User(
            $row->id,
            $row->username,
            $row->password,
            json_decode($row->roles, true)
        );
    }
}