<?php


namespace app\base;


use app\models\records\Queue;
use app\models\repositories\QueueRepository;

class QueueClient
{
    protected $queueRepository;

    /**
     * QueueClient constructor.
     */
    public function __construct()
    {
        $this->queueRepository = new QueueRepository();
    }


    public function push(string $message)
    {
        $QueueMessage = new Queue();
        $QueueMessage->message = $message;
        $QueueMessage->created_at = date("Y-m-d H:i:s");
        $this->queueRepository->insert($QueueMessage);
    }

    public function shift()
    {
        $message = $this->queueRepository->getFirst();
        if(!is_null($message)) {
            $this->queueRepository->delete($message);
        }
        return $message;
    }
}