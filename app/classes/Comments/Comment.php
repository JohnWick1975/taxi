<?php


namespace App\Comments;


use Core\DataHolder;

class Comment extends DataHolder
{
    public function setUserId(string $user_id): void
    {
        $this->user_id = $user_id;
    }

    public function getUserId(): ?string
    {
        return $this->user_id ?? null;
    }

    public function setComment(string $comment): void
    {
        $this->comment = $comment;
    }

    public function getComment(): ?string
    {
        return $this->comment ?? null;
    }

    public function setDate(string $date): void
    {
        $this->date = $date;
    }

    public function getDate(): ?string
    {
        return $this->date ?? null;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getId(): ?int
    {
        return $this->id ?? null;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getName(): ?string
    {
        return $this->id ?? null;
    }

}