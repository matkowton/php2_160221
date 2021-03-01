<?php

namespace app\interfaces;

interface ModelInterface
{
    public function getAll();

    public function getById(int $id);

    public function delete();

    public function getTableName(): string;
}