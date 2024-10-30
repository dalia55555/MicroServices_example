<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Exception;

class ProductClient
{
    protected string $baseUrl;
    protected string $apiKey; 

    public function __construct()
    {
        $this->baseUrl = config('services.product_service.base_url');
        $this->apiKey = config('services.product_service.api_key');
    }

    public function setApiKey(string $apiKey): void
    {
        $this->apiKey = $apiKey;
    }

    /**
     * Fetch all products from the Product Service.
     *
     * @return array
     * @throws Exception
     */
    public function getProducts(): array
    {
        return $this->makeRequest('/api/products');
    }

    /**
     * Fetch a specific product by ID.
     *
     * @param int $id
     * @return array
     * @throws Exception
     */
    public function getProductById(int $id): array
    {
        return $this->makeRequest("/api/products/{$id}");
    }

    /**
     * Make a GET request to the specified endpoint.
     *
     * @param string $endpoint
     * @return array
     * @throws Exception
     */
    protected function makeRequest(string $endpoint): array
    {
        $response = Http::withHeaders(['x-api-key' => $this->apiKey])
                        ->get("{$this->baseUrl}{$endpoint}");

        if ($response->successful()) {
            return $response->json();
        }

        throw new Exception($this->getErrorMessage($response));
    }

    /**
     * Get a detailed error message based on the response.
     *
     * @param \Illuminate\Http\Client\Response $response
     * @return string
     */
    protected function getErrorMessage($response): string
    {
        return sprintf(
            'Error %s: %s',
            $response->status(),
            $response->body() ?: 'Unknown error'
        );
    }
}
