<?php

namespace app\interfaces;

use app\models\records\Record;

interface RepositoryInterface
{
    public  function getAll(array $ids = []);

    public  function getById(int $id);

    public function delete(Record $record);

    public function update(Record $record);

    public function insert(Record $record): Record;

    public function save(Record $record);

    public function getTableName(): string;

    public function getRecordClass(): string;
}