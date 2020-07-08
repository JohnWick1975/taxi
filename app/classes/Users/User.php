<?php

namespace App\Users;

use Core\DataHolder;

class User extends DataHolder
{

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getName(): ?string
    {
        return $this->name ?? null;
    }

    public function setSecondname(string $secondname): void
    {
        $this->secondname = $secondname;
    }

    public function getSecondname(): ?string
    {
        return $this->secondname ?? null;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function getEmail(): ?string
    {
        return $this->email ?? null;
    }

    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    public function getPassword(): ?string
    {
        return $this->password ?? null;
    }

    protected function setTelephone(int $telephone)
    {
        $this->telephone = $telephone;
    }

    protected function getTelephone()
    {
        return $this->telephone ?? null;
    }

    protected function setAdress(string $adress)
    {
        $this->adress = $adress;
    }

    protected function getAdress()
    {
        return $this->adress ?? null;
    }

    protected function setId(int $id)
    {
        $this->id = $id;
    }

    protected function getId()
    {
        return $this->id ?? null;
    }

}