<?php

namespace App\Http\Integrations\Scrapper\Requests;

use App\Http\Integrations\Scrapper\ScrapperConnector;
use Saloon\Enums\Method;
use Saloon\Http\Request;

class ScrapperFixtureRequest extends Request
{
    protected Method $method = Method::GET;

    public function resolveEndpoint(): string
    {
        return '/api/fixtures';
    }
}
