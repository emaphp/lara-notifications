<?php
/**
 * Created by PhpStorm.
 * User: joabuono
 * Date: 16/11/18
 * Time: 12:43
 */

namespace Alas\Commands;


abstract class Command
{
    public function args($params) {
        // Elimino el comando
        unset($params[0]);
        return array_values($params);
    }
}