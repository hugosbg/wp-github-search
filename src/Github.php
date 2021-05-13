<?php

namespace GithubSearch;

class Github
{
    private $baseUrl = 'https://api.github.com';

    public function doRequest($endpoint)
    {
        $cache_key = sanitize_title($endpoint);
        $response = wp_cache_get($cache_key);

        if (!$response) {
            $url = $this->baseUrl . $endpoint;
            $request = wp_remote_get($url, [
                'headers' => [
                    'Accept' => 'application/vnd.github.v3+json',
                ],
            ]);

            if (is_wp_error($request)) {
                throw new \Exception($request->get_error_message());
            }

            $body = wp_remote_retrieve_body($request);
            $response = json_decode($body);
            wp_cache_set($cache_key, $response, 'github_search_group', HOUR_IN_SECONDS * 12);
        }

        return $response;
    }

    public function listRepositoriesForUser($username)
    {
        $endpoint = sprintf('/users/%s/repos', $username);
        return $this->doRequest($endpoint);
    }

    public function getUser($username)
    {
        $endpoint = sprintf('/users/%s', $username);
        return $this->doRequest($endpoint);
    }
}