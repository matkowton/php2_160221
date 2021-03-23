<?php


namespace app\models\records;


class Queue extends Record
{
    public $id;
    public $message;
    public $created_at;
}