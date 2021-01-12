<?php
declare(strict_types=1);

namespace App\Helpers;

/**
 * Class ResponseUtil
 * @package App\Helpers
 */
class ResponseUtil
{
    /**
     * @param string $message
     * @param array $data
     * @return array
     */
    public static function makeResponse(string $message, array $data) : array
    {
        return [
            'success' => true,
            'data'    => $data,
            'message' => $message,
        ];
    }
}
