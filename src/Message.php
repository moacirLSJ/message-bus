<?php

namespace Moacir\Barramento;

class Message
{
    private string $topicId;
    private array $payload;

    public function onTopic(string $topicId): self
    {
        $this->topicId = $topicId;
        return $this;
    }
    public function payload(array $payload): self
    {
        $this->payload = $payload;
        return $this;
    }

    public function getTopicId(): string
    {
        return $this->topicId;
    }

    public function getPayload(): array
    {
        return $this->payload;
    }
}