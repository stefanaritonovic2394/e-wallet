<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\ExpenseCategories\ExpenseCategory;
use App\Repositories\ExpenseCategoryRepository;
use Illuminate\Foundation\Testing\WithFaker;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ExpenseCategoryUnitTest extends TestCase
{
    use WithFaker;

    /** @test */
    public function it_can_create_an_expense_category()
    {
        $data = [
            'name' => $this->faker->name,
            'created_by_id' => random_int(1, 4),
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ];

        $expenseCategoryRepo = new ExpenseCategoryRepository(new ExpenseCategory);
        $expenseCategory = $expenseCategoryRepo->createExpenseCategory($data);

        $this->assertInstanceOf(ExpenseCategory::class, $expenseCategory);
        $this->assertEquals($data['name'], $expenseCategory->name);
        $this->assertEquals($data['created_by_id'], $expenseCategory->created_by_id);
        $this->assertEquals($data['created_at'], $expenseCategory->created_at);
        $this->assertEquals($data['updated_at'], $expenseCategory->updated_at);
    }

    /** @test */
    public function it_can_show_the_expense_category()
    {
        $expenseCategory = factory(ExpenseCategory::class)->create();
        $expenseCategoryRepo = new ExpenseCategoryRepository(new ExpenseCategory);
        $found = $expenseCategoryRepo->findExpenseCategory($expenseCategory->id);

        $this->assertInstanceOf(ExpenseCategory::class, $found);
        $this->assertEquals($found->name, $expenseCategory->name);
        $this->assertEquals($found->created_by_id, $expenseCategory->created_by_id);
        $this->assertEquals($found->created_at, $expenseCategory->created_at);
        $this->assertEquals($found->updated_at, $expenseCategory->updated_at);
    }

    /** @test */
    public function it_can_update_the_expense_category()
    {
        $expenseCategory = factory(ExpenseCategory::class)->create();

        $data = [
            'name' => "Voda",
            'created_by_id' => random_int(1, 4),
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ];

        $expenseCategoryRepo = new ExpenseCategoryRepository($expenseCategory);
        $update = $expenseCategoryRepo->updateExpenseCategory($data);

        $this->assertTrue($update);
        $this->assertEquals($data['name'], $expenseCategory->name);
        $this->assertEquals($data['created_by_id'], $expenseCategory->created_by_id);
        $this->assertEquals($data['created_at'], $expenseCategory->created_at);
        $this->assertEquals($data['updated_at'], $expenseCategory->updated_at);
    }

    /** @test */
    public function it_can_delete_the_expense_category()
    {
        $expenseCategory = factory(ExpenseCategory::class)->create();

        $expenseCategoryRepo = new ExpenseCategoryRepository($expenseCategory);
        $delete = $expenseCategoryRepo->deleteExpenseCategory();

        $this->assertTrue($delete);
    }

}
