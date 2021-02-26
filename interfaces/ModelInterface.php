<?php


interface ModelInterface
{
    public function getAll();

    public function getById(int $id);

    public function delete(int $id);

    public function getTableName(): string;
}