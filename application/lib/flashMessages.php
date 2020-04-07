<?php

namespace Tumic\Lib;


class FlashMessages
{
    use Singleton;
    public function __construct()
    {
    }
    public function once(string $type, string $message)
    {
        $_SESSION["flash_messages"][$type][] = $message;
    }

    public function getMessages()
    {
        if (!isset($_SESSION["flash_messages"])) {
            $this->resetMessages();
        }
        $messages = $_SESSION["flash_messages"];
        $this->resetMessages();
        return $messages;
    }

    private function resetMessages()
    {
        $_SESSION["flash_messages"] = [
            "success" => [],
            "warning" => [],
            "info" => [],
            "danger" => [],

        ];
    }
}
