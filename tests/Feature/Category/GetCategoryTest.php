<?php

namespace Tests\Feature\Category;

use App\Models\Category;
use App\Models\User;
use Tests\TestCase;

class GetCategoryTest extends TestCase
{

    public function test_get_all_list_category()
    {
        $this->actingAs(User::factory()->create());
        Category::factory()->create();
        $response = $this->get(route('categories.index'));

        $response->assertStatus(200);
        $response->assertViewIs('categories.index');
        $response->assertSee(['title']);
    }

    public function test_user_can_see_categories_list()
    {
        $response = $this->actingAs(User::factory()->create());
        $response->get(route('categories.index'))->assertOk();
    }

    public function test_normal_user_can_not_see_categories_list()
    {
        $response = $this->get(route('categories.index'));
        $response->assertRedirect('/login');

    }

    public function test_get_one_category()
    {
        $this->actingAs(User::factory()->create());
        $category = Category::factory()->create();
        $response = $this->get(route('categories.show', $category->id));

        $response->assertStatus(200);
        $response->assertViewIs('categories.show');
        $response->assertSee(['title']);
    }
}
