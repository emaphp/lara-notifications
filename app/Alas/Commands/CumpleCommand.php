<?php

namespace Alas\Commands;

use App\User;
use Carbon\Carbon;
use phpDocumentor\Reflection\Types\Object_;

class CumpleCommand implements CommandInterface
{

    private $birthdays;
    private $month;

    public function __construct($month = null)
    {
        $this->month = $month;
        $this->birthdays = array();
    }

    public function execute()
    {
        setlocale(LC_TIME, 'es_AR.UTF-8');

        $employees = User::where('type','employee')->get();

        $currentDate = Carbon::now();
        $year = $currentDate->year;

        if (is_null($this->month)) {
            $startDate = $currentDate->startOfWeek(Carbon::MONDAY)->copy();
            $endDate = $currentDate->endOfWeek(Carbon::SUNDAY)->copy();
        }
        else {
            $month = $currentDate->month;
            if ($this->month <= $month) {
                $year++;
            }
            $date = Carbon::createFromDate($year, $this->month, 1);
            $startDate = $date->startOfMonth()->copy();
            $endDate = $date->endOfMonth()->copy();
        }

        foreach ($employees as $employee) {
            $profile = $employee->profile()->first();
            if (!is_null($profile) && !is_null($profile->birthdate)) {
                $birthdate = Carbon::parse($profile->birthdate);
                $birthdate->year = $year;
                if ($birthdate->greaterThanOrEqualTo($startDate) && $birthdate->lessThanOrEqualTo($endDate)) {
                    $this->birthdays[$employee->id] = $employee->name . ' (' . ucfirst($birthdate->formatLocalized('%A')) . ' ' . $birthdate->day . ').';
                }
            }
        }

        if ($this->birthdays == []) {
            if (is_null($this->month)) {
                return 'No hay cumpleaños esta semana';
            }
            else {
                return 'No hay cumpleaños este mes';
            }
        }
        else {
            return $this->birthdays;
        }

    }
}