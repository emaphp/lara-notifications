<?php
/**
 * Created by PhpStorm.
 * User: joabuono
 * Date: 08/11/18
 * Time: 11:52
 */

namespace Alas;


use Alas\Commands\ListCommand;

class CommandManager
{
    public function analyzeMessage($message) {
        $regex= '/^(\/.+)/';
        if (preg_match($regex,$message)) {
            return $this->findCommand(explode('/', $message)[1]);
        }
        return "No es un comando >:(";
        //%F0%9F%A4%AC
    }

    public function findCommand($command) {
        $cmd = null;
        switch ($command) {
            case 'list':
                $cmd = new ListCommand(new EmployeesQueue());
                break;
        }

        if (!is_null($cmd)) {
            $invoker = new Invoker();
            $invoker->setCommand($cmd);
            $command_response = $invoker->run();

            return $command_response;
        }
        return "No se encontro el comando";
    }
}