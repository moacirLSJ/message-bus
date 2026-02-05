<?php

namespace Moacir\Barramento;

class MessageBus
{
    private array $subscribers = [];
    private array $messages = [];
    private static $instance;


    public static function getInstance(): self
    {

        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }
    public function subscribe(string $topicId, callable $callback): void
    {
        $this->subscribers[$topicId][] = $callback;
    }
    public function publish(Message $message): void
    {
        $this->messages[] = $message;
    }
    public function dispatch(): void
    {
        foreach ($this->messages as $message) {
            $subscribers = $this->subscribers[$message->getTopicId()] ?? [];
            foreach ($subscribers as $subscriber) {
                $subscriber($message->getPayload());
            }
        }
        $this->messages = [];
    }
}