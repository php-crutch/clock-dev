<?php

declare(strict_types=1);

namespace Crutch\DevClock;

use Crutch\DevClock\Sequence\HardIntervalSequence;
use Crutch\DevClock\Sequence\Sequence;
use DateTimeImmutable;
use DateTimeZone;
use Psr\Clock\ClockInterface;

final class ClockSequence implements ClockInterface
{
    private DateTimeImmutable $start;
    private Sequence $sequence;
    private DateTimeZone $timezone;
    private int $request = 0;

    public function __construct(
        DateTimeImmutable $start,
        ?Sequence $sequence = null,
        ?DateTimeZone $timezone = null
    ) {
        $this->start = $start;
        $this->sequence = $sequence ?? new HardIntervalSequence();
        $this->timezone = $timezone ?? new DateTimeZone('UTC');
    }

    /**
     * @inheritDoc
     */
    public function now(): DateTimeImmutable
    {
        $request = $this->request;
        $this->request++;
        if ($request === 0) {
            return $this->start->setTimezone($this->timezone);
        }
        $interval = $this->sequence->calculatePeriod($request);
        return $this->start->add($interval)->setTimezone($this->timezone);
    }
}
