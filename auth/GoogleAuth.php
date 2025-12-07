<?php

class GoogleAuth
{
    private string $clientId;
    private string $clientSecret;
    private string $redirectUri;


    private string $authEndpoint = "https://accounts.google.com/o/oauth2/auth";
    private string $tokenEndpoint = "https://oauth2.googleapis.com/token";
    private string $userInfoEndpoint = "https://www.googleapis.com/oauth2/v3/userinfo";


    public function __construct(string $clientId, string $clientSecret, string $redirectUri)
    {
        $this->clientId = $clientId;
        $this->clientSecret = $clientSecret;
        $this->redirectUri = $redirectUri;
    }
    public function getAuthUrl(): string
    {
        $params = http_build_query([
            'client_id' => $this->clientId,
            'redirect_uri' => $this->redirectUri,
            'response_type' => 'code',
            'scope' => 'email profile',
            'access_type' => 'offline',
            'prompt' => 'consent'
        ]);

        return $this->authEndpoint . '?' . $params;
    }

    public function  getAccessToken(string $code): array
    {
        $data = [
            "code"           => $code,
            "client_id"      => $this->clientId,
            "client_secret"  => $this->clientSecret,
            "redirect_uri"   => $this->redirectUri,
            "grant_type"     => 'authorization_code'
        ];

        $ch = curl_init($this->tokenEndpoint);
        curl_setopt_array($ch, [
            CURLOPT_POST           => true,
            CURLOPT_POSTFIELDS     => http_build_query($data),
            CURLOPT_RETURNTRANSFER => true
        ]);

        $response = curl_exec($ch);

        $tokenData = json_decode($response, true);

        if (!isset($tokenData['access_token'])) {
            throw new Exception("Failed to obtain access token.");
        }
        return $tokenData;
    }

    public function getUserInfo(?string $accessToken): array
    {
        $ch = curl_init($this->userInfoEndpoint);
        curl_setopt_array($ch, [
            CURLOPT_HTTPHEADER => ["Authorization: Bearer {$accessToken}"],
            CURLOPT_RETURNTRANSFER => true
        ]);

        $response = curl_exec($ch);

        $userInfo = json_decode($response, true);

        if (!isset($userInfo['email'])) {
            throw new Exception("Failed to obtain user information.");
        }

        return $userInfo;
    }
}
