<?php
/**
 * Created by PhpStorm.
 * User: joabuono
 * Date: 08/11/18
 * Time: 11:52
 */

namespace Alas;


use Alas\Commands\CumpleCommand;
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

    public function findCommand($args) {
        $cmd = null;
        $params = explode(' ', $args);
        switch ($params[0]) {
            case 'list':
                $cmd = new ListCommand(new EmployeesQueue());
                break;
            case 'cumple':
                $cmd = new CumpleCommand($params);
                break;
        }

        if (!is_null($cmd)) {
            $invoker = new Invoker();
            $invoker->setCommand($cmd);
            $command_response = $invoker->run();

            if (is_array($command_response)) {
                $command_response = implode(PHP_EOL, $command_response);
            }
            return $command_response;
        }
        return "No se encontro el comando";
    }
}