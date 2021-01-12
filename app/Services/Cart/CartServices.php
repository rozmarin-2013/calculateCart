<?php
declare(strict_types=1);

namespace App\Services\Cart;

use App\Http\Requests\Cart\CartCalculate;
use App\Helpers\Exchange\Exchange;

/**
 * Class CartServices
 * @package App\Services\Cart
 */
class CartServices
{
    /**
     * @var Exchange
     */
    private Exchange $exchange;

    /**
     * CartServices constructor.
     */
    public function __construct()
    {
        $this->exchange = new Exchange();
    }

    /**
     * @param CartCalculate $request
     * @return array
     * @throws \Exception
     */
    public function calculate(CartCalculate $request): array
    {
        $items = $request->input('items');
        $checkoutCurrency = $request->input('checkoutCurrency');
        $total = 0;

        foreach ($items as $item) {
            if (empty($item['price']) || empty($item['currency'])) {
                throw new \Exception('Empty price or currency');
            }

            $calcCurrency = 0;

            if ($item['currency'] == $checkoutCurrency) {
                $calcCurrency = $item['price'];
            } else {
                $calcCurrency = $this->exchange->get($item['price'], $item['currency'], $checkoutCurrency);
            }

            $total += $calcCurrency;
        }

        return [
            'checkoutPrice' => $total,
            'checkoutCurrency' => $checkoutCurrency
        ];
    }
}
