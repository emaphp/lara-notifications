<?php

namespace Alas;


use Alas\Commands\CommandInterface;

class Invoker
{
    private $command;

    public function setCommand(CommandInterface $cmd) {
        $this->command = $cmd;
    }

    public function run() {
        return $this->command->execute();
    }
}