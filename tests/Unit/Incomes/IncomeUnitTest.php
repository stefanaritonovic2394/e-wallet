<?php

namespace Tests\Unit\Incomes;

use Tests\TestCase;
use App\Incomes\Income;
use App\Repositories\IncomeRepository;
use Illuminate\Foundation\Testing\WithFaker;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;

class IncomeUnitTest extends TestCase
{
    use WithFaker;

    /** @test */
    public function it_can_create_an_income()
    {
        $data = [
            'entry_date' => Carbon::now()->format('Y-m-d'),
            'amount' => $this->faker->randomNumber(4),
            'currency_id' => random_int(1, 3),
            'created_by_id' => random_int(1, 4),
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'income_category_id' => random_int(1, 3),
        ];

        $incomeRepo = new IncomeRepository(new Income);
        $income = $incomeRepo->createIncome($data);

        $this->assertInstanceOf(Income::class, $income);
        $this->assertEquals($data['entry_date'], $income->entry_date);
        $this->assertEquals($data['amount'], $income->amount);
        $this->assertEquals($data['currency_id'], $income->currency_id);
        $this->assertEquals($data['created_by_id'], $income->created_by_id);
        $this->assertEquals($data['created_at'], $income->created_at);
        $this->assertEquals($data['updated_at'], $income->updated_at);
        $this->assertEquals($data['income_category_id'], $income->income_category_id);
    }

    /** @test */
    public function it_can_show_the_income()
    {
        $income = factory(Income::class)->create();
        $incomeRepo = new IncomeRepository(new Income);
        $found = $incomeRepo->findIncome($income->id);

        $this->assertInstanceOf(Income::class, $found);
        $this->assertEquals($found->entry_date, $income->entry_date);
        $this->assertEquals($found->amount, $income->amount);
        $this->assertEquals($found->currency_id, $income->currency_id);
        $this->assertEquals($found->created_by_id, $income->created_by_id);
        $this->assertEquals($found->created_at, $income->created_at);
        $this->assertEquals($found->updated_at, $income->updated_at);
        $this->assertEquals($found->income_category_id, $income->income_category_id);
    }

    /** @test */
    public function it_can_update_the_income()
    {
        $income = factory(Income::class)->create();

        $data = [
            'entry_date' => Carbon::now()->format('Y-m-d'),
            'amount' => "2394",
            'currency_id' => random_int(1, 3),
            'created_by_id' => random_int(1, 4),
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'income_category_id' => random_int(1, 3),
        ];

        $incomeRepo = new IncomeRepository($income);
        $update = $incomeRepo->updateIncome($data);

        $this->assertTrue($update);
        $this->assertEquals($data['entry_date'], $income->entry_date);
        $this->assertEquals($data['amount'], $income->amount);
        $this->assertEquals($data['currency_id'], $income->currency_id);
        $this->assertEquals($data['created_by_id'], $income->created_by_id);
        $this->assertEquals($data['created_at'], $income->created_at);
        $this->assertEquals($data['updated_at'], $income->updated_at);
        $this->assertEquals($data['income_category_id'], $income->income_category_id);
    }

    /** @test */
    public function it_can_delete_the_income()
    {
        $income = factory(Income::class)->create();

        $incomeRepo = new IncomeRepository($income);
        $delete = $incomeRepo->deleteIncome();

        $this->assertTrue($delete);
    }

}
