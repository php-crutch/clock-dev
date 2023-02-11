<?php

declare(strict_types=1);

namespace Crutch\DevClock;

use DateTimeImmutable;
use DateTimeZone;
use Psr\Clock\ClockInterface;

final class ClockWaited implements ClockInterface
{
    private DateTimeZone $timezone;
    private int $offset;

    public function __construct(
        ?DateTimeZone  $timezone = null,
        ?DateTimeImmutable $begin = null
    ) {
        $this->timezone = $timezone ?? new DateTimeZone('UTC');
        $now = new DateTimeImmutable();
        $this->offset = (is_null($begin) ? 0 : $begin->getTimestamp()) - $now->getTimestamp();
    }

    public function wait(int $seconds): void
    {
        $this->offset += (max(0, $seconds));
    }

    public function now(): DateTimeImmutable
    {
        return (new DateTimeImmutable('now', $this->timezone))
            ->modify(sprintf('%s%d seconds', $this->offset < 0 ? '-' : '+', $this->offset))
            ;
    }
}
