<?php


namespace app\models\repositories;


use app\models\records\Queue;

class QueueRepository extends Repository
{
    public function getTableName(): string
    {
        return 'queue';
    }

    public function getRecordClass(): string
    {
        return Queue::class;
    }

    public function getFirst()
    {
        $table = $this->getTableName();
        $sql = "SELECT * FROM {$table} ORDER BY created_at LIMIT 1";
        $this->getQuery($sql);
        return $this->getQuery($sql)[0];
    }


}