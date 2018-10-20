<?php

namespace Tests\Unit\Currencies;

use Tests\TestCase;
use App\Currencies\Currency;
use App\Repositories\CurrencyRepository;
use Illuminate\Foundation\Testing\WithFaker;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CurrencyUnitTest extends TestCase
{
    use WithFaker;

    /** @test */
    public function it_can_create_a_currency()
    {
        $data = [
            'title' => $this->faker->word,
            'symbol' => $this->faker->currencyCode,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'deleted_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ];

        $currencyRepo = new CurrencyRepository(new Currency);
        $currency = $currencyRepo->createCurrency($data);

        $this->assertInstanceOf(Currency::class, $currency);
        $this->assertEquals($data['title'], $currency->title);
        $this->assertEquals($data['symbol'], $currency->symbol);
        $this->assertEquals($data['created_at'], $currency->created_at);
        $this->assertEquals($data['updated_at'], $currency->updated_at);
        $this->assertEquals($data['deleted_at'], $currency->deleted_at);
    }

    /** @test */
    public function it_can_show_the_currency()
    {
        $currency = factory(Currency::class)->create();
        $currencyRepo = new CurrencyRepository(new Currency);
        $found = $currencyRepo->findCurrency($currency->id);

        $this->assertInstanceOf(Currency::class, $found);
        $this->assertEquals($found->title, $currency->title);
        $this->assertEquals($found->symbol, $currency->symbol);
        $this->assertEquals($found->created_at, $currency->created_at);
        $this->assertEquals($found->updated_at, $currency->updated_at);
        $this->assertEquals($found->deleted_at, $currency->deleted_at);
    }

    /** @test */
    public function it_can_update_the_currency()
    {
        $currency = factory(Currency::class)->create();

        $data = [
            'title' => "pound",
            'symbol' => "GBP",
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'deleted_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ];

        $currencyRepo = new CurrencyRepository($currency);
        $update = $currencyRepo->updateCurrency($data);

        $this->assertTrue($update);
        $this->assertEquals($data['title'], $currency->title);
        $this->assertEquals($data['symbol'], $currency->symbol);
        $this->assertEquals($data['created_at'], $currency->created_at);
        $this->assertEquals($data['updated_at'], $currency->updated_at);
        $this->assertEquals($data['deleted_at'], $currency->deleted_at);
    }

    /** @test */
    public function it_can_delete_the_currency()
    {
        $currency = factory(Currency::class)->create();

        $currencyRepo = new CurrencyRepository($currency);
        $delete = $currencyRepo->deleteCurrency();

        $this->assertTrue($delete);
    }

}
