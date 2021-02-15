<?php

namespace Tests\Feature;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Tests\TestCase;

class OtherTest extends TestCase
{
    /**
     * We expect that blank values are converted to null with the
     * ConvertEmptyStringsToNull middleware.
     *
     * When a Livewire test is also included in the test suite that
     * middleware is disabled and this test will erroneously fail.
     *
     * @return void
     */
    public function testShouldPassButFailsWhenAlsoTestingLivewire()
    {
        Route::post('/test-route', function(Request $request) {
            return $request->all();
        });

        $response = $this->post('/test-route', [
            'blank_param' => '',
            'null_param' => null,
        ]);

        $this->assertNull($response->json('blank_param'));
        $this->assertNull($response->json('null_param'));
    }

    /**
     * This test shows that disabling all middleware has the same effect
     * as running a Livewire test in the test suite.
     *
     * @return void
     */
    public function testShowThatDisablingMiddlewareHasSameEffectOnBlankValues()
    {
        $this->withoutMiddleware();

        Route::post('/test-route', function(Request $request) {
            return $request->all();
        });

        $response = $this->post('/test-route', [
            'blank_param' => '',
            'null_param' => null,
        ]);

        $this->assertEquals('', $response->json('blank_param'));
        $this->assertNull($response->json('null_param'));
    }
}
