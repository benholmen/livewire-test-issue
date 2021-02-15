<?php

namespace Tests\Feature;

use Tests\TestCase;
use Livewire\Livewire;
use App\Http\Livewire\SampleLivewire;

class LivewireTest extends TestCase
{
    /**
     * Calling set('variable', value) disables middleware for other tests
     * including some we expect to have enabled (ConvertEmptyStringsToNull)
     *
     * @return void
     */
    public function testSettingPropertyBreaksOtherTests()
    {
        Livewire::test(SampleLivewire::class)
            ->set('count', 42)
            ->assertViewHas('count');
    }

    /**
     * This test does not disable any middleware and other tests are unaffected
     *
     * @return void
     */
    public function testNotSettingPropertyDoesNotBreakOtherTests()
    {
        Livewire::test(SampleLivewire::class)
            ->assertViewHas('count');
    }
}
