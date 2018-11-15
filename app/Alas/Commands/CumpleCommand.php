<?php

namespace Alas\Commands;

use App\User;
use Carbon\Carbon;
use phpDocumentor\Reflection\Types\Object_;

class CumpleCommand implements CommandInterface
{

    private $birthdays;

    public function __construct()
    {
        $this->birthdays = array();
    }

    public function execute()
    {
        setlocale(LC_TIME, 'es_AR.UTF-8');
        $currentDate = Carbon::now();

        $startWeek = $currentDate->startOfWeek(Carbon::MONDAY)->copy();
        $endWeek = $currentDate->endOfWeek(Carbon::SUNDAY)->copy();

        $employees = User::where('type','employee')->get();

        foreach ($employees as $employee) {
            $profile = $employee->profile()->first();
            if (!is_null($profile) && !is_null($profile->birthdate)) {
                $birthdate = Carbon::parse($profile->birthdate);
                $birthdate->year = $currentDate->year;
                if ($birthdate->greaterThanOrEqualTo($startWeek) && $birthdate->lessThanOrEqualTo($endWeek)) {
                    $this->birthdays[$employee->id] = $employee->name . ' (' . ucfirst($birthdate->formatLocalized('%A')) . ' ' . $birthdate->day . ').';
                }
            }
        }

        if ($this->birthdays == []) {
            return 'No hay cumpleaños esta semana';
        }
        else {
            return $this->birthdays;
        }

    }
}