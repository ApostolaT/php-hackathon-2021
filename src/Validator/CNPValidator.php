<?php


namespace App\Validator;

/**
 * A quick custom CNP validator based on the information found on the inet.
 * RN it is lacking bisect year check, and does not support state checking.
 * Class CNPValidator
 * @package App\Validator
 */
class CNPValidator
{
    public function validate(string $cnp):bool {
        $day = $this->extractDay($cnp);
        $month = $this->extractMonth($cnp);
        if (!$this->checkMonthAndDate($month, $day)) {
            return false;
        }
        $orderNumber = $this->extractOrderNumber($cnp);

        if (!$this->checkOrderNumber($orderNumber)) {
            return false;
        }

        return true;
    }

    private function checkMonthAndDate(int $month, int $day): bool {
        $evenMonths = array(4, 6, 9, 11);

        if ($month < 1 || $month > 12) {
            return false;
        }

        if ($day < 1 || $day > 31) {
            return false;
        }

        if (in_array($month, $evenMonths) && $day == 31) {
            return false;
        }

        if ($month == 2 && $day > 29) {
            return false;
        }

        return true;
    }

    private function checkOrderNumber(int $orderNumber):bool {
        if ($orderNumber < 500) {
            return false;
        }

        return true;
    }

    private function extractMonth(string $cnp):int {
        return (int)$cnp[3] * 10 + (int)$cnp[4];
    }

    private function extractDay(string $cnp):int {
        return (int)$cnp[5] + (int)$cnp[6];
    }

    private function extractOrderNumber(string $cnp): int {
        return (int)$cnp[9] * 100 + (int)$cnp[10] * 10 + (int)$cnp[11];
    }
}