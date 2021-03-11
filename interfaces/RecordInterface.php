<?php

namespace app\interfaces;

interface RecordInterface
{
    public static function getAll();

    public static function getById(int $id);

    public function delete();

    public static function getTableName(): string;
}