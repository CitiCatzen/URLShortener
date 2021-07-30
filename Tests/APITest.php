<?php

namespace Tests;

class APITest extends BaseTest
{

    public function test_user_can_create_short_url_without_http_or_https()
    {
        $decodeResponse = json_decode($this->post(self::API_URL, ['url' => 'google.com']), true);

        $this->assertTrue($decodeResponse['success']);
        $this->assertNotEmpty($decodeResponse['short_url']);
    }

    public function test_user_can_create_short_url_with_http_or_https()
    {
        $decodeResponse = json_decode($this->post(self::API_URL, ['url' => 'https://google.com']), true);

        $this->assertTrue($decodeResponse['success']);
        $this->assertNotEmpty($decodeResponse['short_url']);
    }

    public function test_user_can_create_custom_url_by_origin()
    {
        $custom_url = 'go';
        $decodeResponse = json_decode($this->post(
            self::API_URL,
            [
                'url' => 'https://google.com',
                'custom_url' => $custom_url,
            ]
        ), true);

        $this->assertTrue($decodeResponse['success']);
        $this->assertEquals($decodeResponse['short_url'], $custom_url);
    }

    public function test_user_can_create_short_url_with_empty_custom()
    {
        $decodeResponse = json_decode($this->post(
            self::API_URL,
            [
                'url' => 'https://google.com',
                'custom_url' => '',
            ]
        ), true);

        $this->assertTrue($decodeResponse['success']);
        $this->assertNotEmpty($decodeResponse['short_url']);
    }

    public function test_user_can_get_origin_url_by_short()
    {
        $origin_url = 'https://google.com';
        $short_url = json_decode($this->post(self::API_URL, ['url' => $origin_url]), true)['short_url'];
        $response = json_decode($this->get(self::API_URL . $short_url));

        $this->assertEquals($origin_url, $response);
    }

    public function test_user_cannot_create_short_url_without_origin()
    {
        $expectation = json_encode(['error' => 'Please, provide url']);

        $response = $this->post(self::API_URL, []);

        $this->assertJsonStringEqualsJsonString($expectation, $response);
    }

    public function test_user_cannot_create_short_url_with_empty_origin()
    {
        $expectation = json_encode(['error' => 'Please, provide url']);

        $response = $this->post(self::API_URL, ['url' => '']);

        $this->assertEquals($expectation, $response);
    }

    public function test_user_cannot_create_custom_url_with_invalid_custom()
    {
        $expectation = json_encode(['error' => 'Please, provide valid custom url']);

        $response = $this->post(
            self::API_URL,
            [
                'url' => 'https://google.com',
                'custom_url' => 'https://go',
            ]
        );

        $this->assertEquals($expectation, $response);
    }

    public function test_user_cannot_create_custom_url_with_busy_url()
    {
        $expectation = json_encode(['error' => 'This url is busy']);
        $this->post(self::API_URL, ['url' => 'https://yandex.ru', 'custom_url' => 'ya']);
        $response = $this->post(self::API_URL, ['url' => 'https://yandex.ru', 'custom_url' => 'ya']);

        $this->assertEquals($expectation, $response);
    }

    public function test_user_cannot_get_origin_url_by_non_existent_origin()
    {
        $expectation = json_encode(['error' => "You've entered an invalid URL"]);
        $response = $this->get(self::API_URL . bin2hex(random_bytes(5)));

        $this->assertEquals($expectation, $response);
    }
}