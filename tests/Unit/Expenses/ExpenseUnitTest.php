<?php

namespace Tests\Unit\Expenses;

use Tests\TestCase;
use App\Expenses\Expense;
use App\Repositories\ExpenseRepository;
use Illuminate\Foundation\Testing\WithFaker;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ExpenseUnitTest extends TestCase
{
    use WithFaker;

    /** @test */
    public function it_can_create_an_expense()
    {
        $data = [
            'entry_date' => Carbon::now()->format('Y-m-d'),
            'amount' => $this->faker->randomNumber(4),
            'expense_category_id' => random_int(1, 3),
            'currency_id' => random_int(1, 3),
            'created_by_id' => random_int(1, 4),
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ];

        $expenseRepo = new ExpenseRepository(new Expense);
        $expense = $expenseRepo->createExpense($data);

        $this->assertInstanceOf(Expense::class, $expense);
        $this->assertEquals($data['entry_date'], $expense->entry_date);
        $this->assertEquals($data['amount'], $expense->amount);
        $this->assertEquals($data['expense_category_id'], $expense->expense_category_id);
        $this->assertEquals($data['currency_id'], $expense->currency_id);
        $this->assertEquals($data['created_by_id'], $expense->created_by_id);
        $this->assertEquals($data['created_at'], $expense->created_at);
        $this->assertEquals($data['updated_at'], $expense->updated_at);
    }

    /** @test */
    public function it_can_show_the_expense()
    {
        $expense = factory(Expense::class)->create();
        $expenseRepo = new ExpenseRepository(new Expense);
        $found = $expenseRepo->findExpense($expense->id);

        $this->assertInstanceOf(Expense::class, $found);
        $this->assertEquals($found->entry_date, $expense->entry_date);
        $this->assertEquals($found->amount, $expense->amount);
        $this->assertEquals($found->expense_category_id, $expense->expense_category_id);
        $this->assertEquals($found->currency_id, $expense->currency_id);
        $this->assertEquals($found->created_by_id, $expense->created_by_id);
        $this->assertEquals($found->created_at, $expense->created_at);
        $this->assertEquals($found->updated_at, $expense->updated_at);
    }

    /** @test */
    public function it_can_update_the_expense()
    {
        $expense = factory(Expense::class)->create();

        $data = [
            'entry_date' => Carbon::now()->format('Y-m-d'),
            'amount' => "2233",
            'expense_category_id' => random_int(1, 3),
            'currency_id' => random_int(1, 3),
            'created_by_id' => random_int(1, 4),
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ];

        $expenseRepo = new ExpenseRepository($expense);
        $update = $expenseRepo->updateExpense($data);

        $this->assertTrue($update);
        $this->assertEquals($data['entry_date'], $expense->entry_date);
        $this->assertEquals($data['amount'], $expense->amount);
        $this->assertEquals($data['expense_category_id'], $expense->expense_category_id);
        $this->assertEquals($data['currency_id'], $expense->currency_id);
        $this->assertEquals($data['created_by_id'], $expense->created_by_id);
        $this->assertEquals($data['created_at'], $expense->created_at);
        $this->assertEquals($data['updated_at'], $expense->updated_at);
    }

    /** @test */
    public function it_can_delete_the_expense()
    {
        $expense = factory(Expense::class)->create();

        $expenseRepo = new ExpenseRepository($expense);
        $delete = $expenseRepo->deleteExpense();

        $this->assertTrue($delete);
    }

}
