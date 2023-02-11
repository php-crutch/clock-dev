<?php

declare(strict_types=1);

namespace Crutch\DevClock\Sequence;

use DateInterval;

interface Sequence
{
    /**
     * @param int $request
     * @return DateInterval
     */
    public function calculatePeriod(int $request): DateInterval;
}
