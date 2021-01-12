<?php
declare(strict_types=1);

namespace App\Helpers\Exchange;

use GuzzleHttp\Client;

/**
 * Class ExchangeSource
 * @package App\Helpers\Exchange
 */
class ExchangeSource
{
    /**
     *
     */
    const URL = 'https://openexchangerates.org/api/latest.json';
    /**
     *
     */
    const API_ID = 'acb2829ae6d34e5a9da64fcc1a0b7dbd';

    /**
     * @return string
     */
    public function getLatest(): string
    {
        return $this->getData();
    }

    /**
     * @return string
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    private function getData(): string
    {
        $data = '';
        $client = new Client();

        $res = $client->get(self::URL, ['query' => ['app_id' => self::API_ID]]);

        if ($res->getStatusCode() == 200) {
            $data = $res->getBody()->getContents();
        }

        return $data;
    }
}
