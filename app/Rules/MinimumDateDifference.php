<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Carbon\Carbon;

class MinimumDateDifference implements Rule
{
    protected $minDays;

    public function __construct($minDays)
    {
        $this->minDays = $minDays;
    }

    public function passes($attribute, $value)
    {
        $startDate = Carbon::parse(request('waktu-mulai'));
        $endDate = Carbon::parse($value);

        return $endDate->diffInDays($startDate) >= $this->minDays;
    }

    public function message()
    {
        return 'Tanggal selesai harus memiliki jarak minimal ' . $this->minDays . ' hari dari tanggal mulai.';
    }
}
