<?php

namespace MustafaRefaey\LaravelHybrid\Tests;

use Illuminate\Contracts\View\View;
use Illuminate\Http\Response;
use MustafaRefaey\LaravelHybrid\HybridResponse;

class HybridResponseTest extends TestCase
{
    /** @test */
    public function should_return_json_response_when_json_expected()
    {
        // prepare test
        request()->headers->set('Accept', 'application/json');

        $response = HybridResponse::make();
        // assert it is a response
        $this->assertInstanceOf(Response::class, $response);
        // assert it is a json response
        $this->assertTrue($response->headers->contains('Content-Type', 'application/json'));
        $this->assertJson($response->content());
    }

    /** @test */
    public function should_return_view_response_when_json_is_not_expected()
    {
        $response = HybridResponse::make();
        // assert it is a view response
        $this->assertInstanceOf(View::class, $response);
    }

    /** @test */
    public function should_return_view_with_passed_data()
    {
        $response = HybridResponse::make();
        // assert it is a view response
        $this->assertInstanceOf(View::class, $response);

        $this->assertArrayHasKey("page_state", $response->getData());
        $this->assertArrayHasKey("shared_state", $response->getData());
        $this->assertArrayHasKey("session_success_messages", $response->getData());
        $this->assertArrayHasKey("session_error_messages", $response->getData());
    }
}
