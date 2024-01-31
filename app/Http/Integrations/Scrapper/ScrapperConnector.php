<?php

namespace App\Http\Integrations\Scrapper;

use Saloon\Http\Connector;

class ScrapperConnector extends Connector
{
    protected function defaultHeaders(): array
    {
        return [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
        ];
    }

    public function resolveBaseUrl(): string
    {
        return (string) config('system.scraper_url');
    }
}
