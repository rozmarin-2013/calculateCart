<?php
declare(strict_types=1);

namespace App\Helpers\Exchange;

use stdClass;

/**
 * Class LatestCurrency
 * @package App\Helpers\Exchange
 */
class LatestCurrency
{
    /**
     * @var string
     */
    private string  $base;
    /**
     * @var stdClass
     */
    private  stdClass $rates;

    /**
     * LatestCurrency constructor.
     * @param $data
     */
    public function __construct($data)
    {
        $this->base = $data->base;
        $this->rates = $data->rates;
    }

    /**
     * @param float $value
     * @param string $from
     * @param string $to
     * @return float
     * @throws \Exception
     */
    public function calc(float $value, string $from, string $to): float
    {
        if (empty ($this->rates->$to) || empty ($this->rates->$from)) {
            throw new \Exception('WRONG currience');
        }

        if ($from === $this->base) {
            if (!empty($this->rates->$to)) {
                return $value * $this->rates->$to;
            }
        } elseif ($to === $this->base) {
            return $value / $this->rates->$to;
        } else {
            return ($value * $this->rates->$to) / $this->rates->$from;
        }
    }

    /**
     * @return string
     */
    public function getBase(): string
    {
        return $this->base;
    }

    /**
     * @return stdClass
     */
    public function getRates(): stdClass
    {
        return $this->rates;
    }
}
