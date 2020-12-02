<?php

namespace MustafaRefaey\LaravelHybrid\Tests;

use Illuminate\Http\Response;
use MustafaRefaey\LaravelHybrid\JsonResponse;

class JsonResponseTest extends TestCase
{
    /** @test */
    public function success_method_returns_json_response()
    {
        $response = JsonResponse::success();
        // assert it is a response
        $this->assertInstanceOf(Response::class, $response);
        // assert it is a json response
        $this->assertTrue($response->headers->contains('Content-Type', 'application/json'));
        $this->assertJson($response->content());
    }

    /** @test */
    public function success_method_returns_response_with_status_property_true()
    {
        $response = JsonResponse::success();
        $responseDecoded = json_decode($response->content(), true);
        // assert response has status property
        $this->assertArrayHasKey('status', $responseDecoded);
        // assert response's status is true
        $this->assertTrue($responseDecoded['status']);
    }

    /** @test */
    public function success_method_returns_response_with_passed_data_as_data_property()
    {
        $data = ['key' => 'value'];
        $response = JsonResponse::success($data);
        $responseDecoded = json_decode($response->content(), true);
        // assert response has data property
        $this->assertArrayHasKey('data', $responseDecoded);
        // assert response's data is passed data
        $this->assertTrue($responseDecoded['data'] == $data);
    }

    /** @test */
    public function success_method_returns_response_with_passed_messages_as_success_messages_property()
    {
        $messages = ['message 1', 'message 2'];
        $response = JsonResponse::success([], $messages);
        $responseDecoded = json_decode($response->content(), true);
        // assert response has success_messages property
        $this->assertArrayHasKey('success_messages', $responseDecoded);
        // assert response's success_messages is passed messages
        $this->assertTrue($responseDecoded['success_messages'] == $messages);
    }

    /** @test */
    public function fail_method_returns_json_response()
    {
        $response = JsonResponse::fail();
        // assert it is a response
        $this->assertInstanceOf(Response::class, $response);
        // assert it is a json response
        $this->assertTrue($response->headers->contains('Content-Type', 'application/json'));
        $this->assertJson($response->content());
    }

    /** @test */
    public function fail_method_returns_response_with_status_property_false()
    {
        $response = JsonResponse::fail();
        $responseDecoded = json_decode($response->content(), true);
        // assert response has status property
        $this->assertArrayHasKey('status', $responseDecoded);
        // assert response's status is false
        $this->assertFalse($responseDecoded['status']);
    }

    /** @test */
    public function fail_method_returns_response_with_passed_data_as_data_property()
    {
        $data = ['key' => 'value'];
        $response = JsonResponse::fail($data);
        $responseDecoded = json_decode($response->content(), true);
        // assert response has data property
        $this->assertArrayHasKey('data', $responseDecoded);
        // assert response's data is passed data
        $this->assertTrue($responseDecoded['data'] == $data);
    }

    /** @test */
    public function fail_method_returns_response_with_passed_messages_as_error_messages_property()
    {
        $messages = ['message 1', 'message 2'];
        $response = JsonResponse::fail([], $messages);
        $responseDecoded = json_decode($response->content(), true);
        // assert response has error_messages property
        $this->assertArrayHasKey('error_messages', $responseDecoded);
        // assert response's error_messages is passed messages
        $this->assertTrue($responseDecoded['error_messages'] == $messages);
    }

    /** @test */
    public function custom_method_returns_json_response()
    {
        $response = JsonResponse::custom(true, 209);
        // assert it is a response
        $this->assertInstanceOf(Response::class, $response);
        // assert it is a json response
        $this->assertTrue($response->headers->contains('Content-Type', 'application/json'));
        $this->assertJson($response->content());
    }

    /** @test */
    public function custom_method_returns_response_with_status_property_as_specified()
    {
        // test true status
        $response = JsonResponse::custom(true, 207);
        $responseDecoded = json_decode($response->content(), true);
        // assert response has status property
        $this->assertArrayHasKey('status', $responseDecoded);
        // assert response's status is true
        $this->assertTrue($responseDecoded['status']);

        // test false status
        $response = JsonResponse::custom(false, 408);
        $responseDecoded = json_decode($response->content(), true);
        // assert response has status property
        $this->assertArrayHasKey('status', $responseDecoded);
        // assert response's status is false
        $this->assertFalse($responseDecoded['status']);
    }

    /** @test */
    public function custom_method_returns_response_with_passed_data_as_data_property()
    {
        $data = ['key' => 'value'];
        $response = JsonResponse::custom(true, 201, $data);
        $responseDecoded = json_decode($response->content(), true);
        // assert response has data property
        $this->assertArrayHasKey('data', $responseDecoded);
        // assert response's data is passed data
        $this->assertTrue($responseDecoded['data'] == $data);
    }

    /** @test */
    public function custom_method_returns_response_with_passed_messages_as_specified()
    {
        $success_messages = ['success message 1', 'success message 2'];
        $error_messages = ['error message 1', 'error message 2'];
        $response = JsonResponse::custom(true, 207, [], compact('success_messages', 'error_messages'));
        $responseDecoded = json_decode($response->content(), true);
        // assert response has success_messages property
        $this->assertArrayHasKey('success_messages', $responseDecoded);
        // assert response's success_messages is passed success_messages
        $this->assertTrue($responseDecoded['success_messages'] == $success_messages);
        // assert response has error_messages property
        $this->assertArrayHasKey('error_messages', $responseDecoded);
        // assert response's error_messages is passed error_messages
        $this->assertTrue($responseDecoded['error_messages'] == $error_messages);
    }
}
