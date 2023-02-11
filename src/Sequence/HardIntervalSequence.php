<?php

declare(strict_types=1);

namespace Crutch\DevClock\Sequence;

use DateInterval;

final class HardIntervalSequence implements Sequence
{
    private int $seconds;

    public function __construct(int $seconds = 1)
    {
        $this->seconds = $seconds;
    }

    /**
     * @inheritDoc
     */
    public function calculatePeriod(int $request): DateInterval
    {
        $seconds = $request * $this->seconds;
        return new DateInterval(sprintf('PT%dS', $seconds));
    }
}
