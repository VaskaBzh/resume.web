<?php

declare(strict_types=1);

namespace App\Services\External;

class ApiRequest
{
    /**
     * Store the headers that will be sent with the API request.
     */
    protected array $headers = [];

    /**
     * Store any query string parameters
     */
    protected array $query = [];

    /**
     * Store the body of the request.
     */
    protected array $body = [];

    /**
     * Create an API request for a given HTTP method and URI.
     */
    public function __construct(
        protected string $method = 'get',
        protected string $uri = ''
    ) {
    }

    /**
     * Set query parameters for the request.
     * This accepts either a key and value, or an array of key/value pairs.
     */
    public function setQuery(array|string $key, string $value = null): static
    {
        if (is_array($key)) {
            $this->query = $key;
        } else {
            $this->query[$key] = $value;
        }

        return $this;
    }

    /**
     * Clear query parameters for the request.
     * This method can clear a specific parameter or all parameters if a key is
     * not provided.
     */
    public function clearQuery(string $key = null): static
    {
        if ($key) {
            unset($this->query[$key]);
        } else {
            $this->query = [];
        }

        return $this;
    }

    /**
     * Set body data for the request.
     * This accepts either a key and value, or an array of key/value pairs.
     */
    public function setBody(array|string $key, string $value = null): static
    {
        if (is_array($key)) {
            $this->body = $key;
        } else {
            $this->body[$key] = $value;
        }

        return $this;
    }

    /**
     * Clear body data for the request.
     * This method can clear a specific key of data or all data.
     */
    public function clearBody(string $key = null): static
    {
        if ($key) {
            unset($this->body[$key]);
        } else {
            $this->body = [];
        }

        return $this;
    }

    /**
     * This method returns the headers for the API request.
     */
    public function getHeaders(): array
    {
        return $this->headers;
    }

    /**
     * This method returns the query for the API request.
     */
    public function getQuery(): array
    {
        return $this->query;
    }

    /**
     * This method returns the body for the API request.
     */
    public function getBody(): array
    {
        return $this->body;
    }

    /**
     * This method returns the URI for the API request.
     * If the query is empty, or we have a GET request, the URI can be returned
     * as is.
     * Otherwise, we need to append the query string to the URI.
     */
    public function getUri(): string
    {
        if (empty($this->query) || $this->method === 'get') {
            return $this->uri;
        }

        return $this->uri.'?'.http_build_query($this->query);
    }

    /**
     * This method returns the HTTP method for the API request.
     */
    public function getMethod(): string
    {
        return $this->method;
    }

    public static function get(string $uri = ''): static
    {
        return new static('get', $uri);
    }

    public static function post(string $uri = ''): static
    {
        return new static('post', $uri);
    }

    public static function put(string $uri = ''): static
    {
        return new static('put', $uri);
    }

    public static function delete(string $uri = ''): static
    {
        return new static('delete', $uri);
    }
}