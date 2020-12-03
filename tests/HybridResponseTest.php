<?php

namespace MustafaRefaey\LaravelHybridSpa\Tests;

use Illuminate\Contracts\View\View;
use Illuminate\Http\Response;
use MustafaRefaey\LaravelHybridSpa\HybridResponse;

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
        $pageState = ['key' => 'value'];
        $response = HybridResponse::make($pageState);
        // assert it is a view response
        $this->assertInstanceOf(View::class, $response);

        $viewData = $response->getData();

        $this->assertArrayHasKey("page_state", $viewData);
        $this->assertEquals(json_encode($pageState), $viewData["page_state"]);

        $this->assertArrayHasKey("shared_state", $viewData);
        $this->assertArrayHasKey("session_success_messages", $viewData);
        $this->assertArrayHasKey("session_error_messages", $viewData);
    }

    /** @test */
    public function should_return_view_that_has_a_div_with_js_app_id_as_its_id()
    {
        $jsAppId = 'app';
        config()->set('laravel-hybrid-spa.js-app-id', $jsAppId);

        $response = HybridResponse::make();
        // assert it is a view response
        $this->assertInstanceOf(View::class, $response);
        $this->assertStringContainsString("<div id='{$jsAppId}'></div>", $response->render());
    }

    /** @test */
    public function should_return_view_that_loads_js_app()
    {
        $jsAppUrl = url('app.js');
        config()->set('laravel-hybrid-spa.js-app-url', $jsAppUrl);

        $response = HybridResponse::make();
        // assert it is a view response
        $this->assertInstanceOf(View::class, $response);
        $this->assertStringContainsString("<script src='{$jsAppUrl}'></script>", $response->render());
    }

    /** @test */
    public function should_return_view_with_page_state_variable()
    {
        $pageStateVariable = "pageState";
        config()->set('laravel-hybrid-spa.page-state-variable', $pageStateVariable);

        $pageState = ['key' => 'value'];
        $response = HybridResponse::make($pageState);
        // assert it is a view response
        $this->assertInstanceOf(View::class, $response);
        $this->assertStringContainsString("window.{$pageStateVariable} = " . json_encode($pageState), $response->render());
    }

    /** @test */
    public function should_return_view_with_shared_state_variable()
    {
        $sharedStateVariable = "sharedState";
        $sharedStateHandler = '\\MustafaRefaey\\LaravelHybridSpa\\SharedStateHandler';
        config()->set('laravel-hybrid-spa.shared-state-variable', $sharedStateVariable);
        config()->set('shared-state-handler', $sharedStateHandler);

        $response = HybridResponse::make();
        // assert it is a view response
        $this->assertInstanceOf(View::class, $response);

        $expectedSharedState = str_replace("'", "&#39;", json_encode((new $sharedStateHandler())->getSharedState(), JSON_UNESCAPED_UNICODE));
        $this->assertStringContainsString("window.{$sharedStateVariable} = " . $expectedSharedState, $response->render());
    }
}
