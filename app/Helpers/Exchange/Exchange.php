<?php
declare(strict_types=1);

namespace App\Helpers\Exchange;

use App\Helpers\Exchange\ExchangeSource;
use App\Helpers\Exchange\LatestCurrency;

/**
 * Class Exchange
 * @package App\Helpers\Exchange
 */
class Exchange
{
    /**
     * @var \App\Helpers\Exchange\ExchangeSource
     */
    private ExchangeSource $source;

    /**
     * Exchange constructor.
     */
    public function __construct()
    {
        $this->source = new ExchangeSource();
    }

    /**
     * @param float $value
     * @param string $from
     * @param string $to
     * @return float
     * @throws \Exception
     */
    public function get(float $value, string $from, string $to): float
    {
        $data = $this->source->getLatest();

        if (empty($data)) {
            throw new \Exception('Get empty data from API', 422);
        }

        $data = json_decode($data);
        $currency = new LatestCurrency($data);

        return $currency->calc($value, $from, $to);
    }
}
