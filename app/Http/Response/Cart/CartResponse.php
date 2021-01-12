<?php
declare(strict_types=1);

namespace App\Http\Response\Cart;

use Illuminate\Support\Collection;

class CartResponse
{
    /**
     * @param Collection $articles
     * @return array
     */
    public static function totalBycheckoutCurrency(Array $cart): array
    {
        return [
            'checkoutPrice' => round($cart['checkoutPrice'], 2),
            'checkoutCurrency' => $cart['checkoutCurrency']
        ];
    }
}
