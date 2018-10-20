<?php

namespace Tests\Unit\IncomeCategories;

use Tests\TestCase;
use App\IncomeCategories\IncomeCategory;
use App\Repositories\IncomeCategoryRepository;
use Illuminate\Foundation\Testing\WithFaker;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;

class IncomeCategoryUnitTest extends TestCase
{
    use WithFaker;

    /** @test */
    public function it_can_create_an_income_category()
    {
        $data = [
            'name' => $this->faker->name,
            'created_by_id' => random_int(1, 4),
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ];

        $incomeCategoryRepo = new IncomeCategoryRepository(new IncomeCategory);
        $incomeCategory = $incomeCategoryRepo->createIncomeCategory($data);

        $this->assertInstanceOf(IncomeCategory::class, $incomeCategory);
        $this->assertEquals($data['name'], $incomeCategory->name);
        $this->assertEquals($data['created_by_id'], $incomeCategory->created_by_id);
        $this->assertEquals($data['created_at'], $incomeCategory->created_at);
        $this->assertEquals($data['updated_at'], $incomeCategory->updated_at);
    }

    /** @test */
    public function it_can_show_the_income_category()
    {
        $incomeCategory = factory(IncomeCategory::class)->create();
        $incomeCategoryRepo = new IncomeCategoryRepository(new IncomeCategory);
        $found = $incomeCategoryRepo->findIncomeCategory($incomeCategory->id);

        $this->assertInstanceOf(IncomeCategory::class, $found);
        $this->assertEquals($found->name, $incomeCategory->name);
        $this->assertEquals($found->created_by_id, $incomeCategory->created_by_id);
        $this->assertEquals($found->created_at, $incomeCategory->created_at);
        $this->assertEquals($found->updated_at, $incomeCategory->updated_at);
    }

    /** @test */
    public function it_can_update_the_income_category()
    {
        $incomeCategory = factory(IncomeCategory::class)->create();

        $data = [
            'name' => "Test 2",
            'created_by_id' => random_int(1, 4),
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ];

        $incomeCategoryRepo = new IncomeCategoryRepository($incomeCategory);
        $update = $incomeCategoryRepo->updateIncomeCategory($data);

        $this->assertTrue($update);
        $this->assertEquals($data['name'], $incomeCategory->name);
        $this->assertEquals($data['created_by_id'], $incomeCategory->created_by_id);
        $this->assertEquals($data['created_at'], $incomeCategory->created_at);
        $this->assertEquals($data['updated_at'], $incomeCategory->updated_at);
    }

    /** @test */
    public function it_can_delete_the_income_category()
    {
        $incomeCategory = factory(IncomeCategory::class)->create();

        $incomeCategoryRepo = new IncomeCategoryRepository($incomeCategory);
        $delete = $incomeCategoryRepo->deleteIncomeCategory();

        $this->assertTrue($delete);
    }

}
