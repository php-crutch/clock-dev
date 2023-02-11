# crutch/clock-dev

psr/clock implementation for testing. Recommended for using in tests.

# Install

```bash
# Only for tests:
composer require --dev crutch/clock-dev
# Or for all project:
composer require crutch/clock-dev
```

# Usage

## Waited clock


```php
<?php

$format = 'Y-m-d\TH:i:sp';

$clock = new \Crutch\DevClock\ClockWaited(
    new DateTimeZone('UTC'),
    DateTimeImmutable::createFromFormat($format, '2022-01-01T00:00:00Z')
);

var_dump($clock->now()->format($format)); // "2022-01-01T00:00:00Z"
$clock->wait(5);
var_dump($clock->now()->format($format)); // "2022-01-01T00:00:05Z"
$clock->wait(300);
var_dump($clock->now()->format($format)); // "2022-01-01T00:05:05Z"
```



```php
<?php

$format = 'Y-m-d\TH:i:sp';

$timer = new \Crutch\DevClock\ClockSequence(
    DateTimeImmutable::createFromFormat($format, '2022-01-01T00:00:00Z'),
    new \Crutch\DevClock\Sequence\HardIntervalSequence(5),
    new DateTimeZone('UTC')
);

var_dump($timer->now()->format($format)); // "2022-01-01T00:00:00Z"
var_dump($timer->now()->format($format)); // "2022-01-01T00:00:05Z"
var_dump($timer->now()->format($format)); // "2022-01-01T00:00:10Z"
var_dump($timer->now()->format($format)); // "2022-01-01T00:00:15Z"
var_dump($timer->now()->format($format)); // "2022-01-01T00:00:20Z"
```
