<?php
declare(strict_types=1);

namespace App\Http\Controllers\Cart;

use App\Http\Controllers\Controller;
use App\Services\Cart\CartServices;
use App\Http\Requests\Cart\CartCalculate;
use App\Http\Response\Cart\CartResponse;
use Illuminate\Http\JsonResponse;

/**
 * Class CartController
 * @package App\Http\Controllers\Cart
 */
class CartController extends Controller
{
    /**
     * @var CartServices
     */
    private CartServices $services;

    /**
     * CartController constructor.
     * @param CartServices $cartServices
     */
    public function __construct(CartServices $cartServices)
    {
        $this->services = $cartServices;
    }

    /**
     * @param CartCalculate $request
     * @return JsonResponse
     * @throws \Exception
     */
    public function calculate(CartCalculate $request): JsonResponse
    {
        $data = $this->services->calculate($request);

        return $this->sendResponse(CartResponse::totalBycheckoutCurrency($data));
    }
}
