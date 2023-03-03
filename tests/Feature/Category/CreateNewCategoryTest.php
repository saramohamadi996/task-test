<?php

namespace Tests\Feature\Category;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Testing\TestResponse;
use Illuminate\Http\Response;
use App\Models\Category;
use App\Models\User;
use Tests\TestCase;

class CreateNewCategoryTest extends TestCase
{
    use RefreshDatabase;
    public function authenticated_user_create_new_category()
    {
        $this->actingAs(User::factory()->create());
        $category = Category::factory()->make()->toArray();
        $response = $this->post(route('categories.store'));
        $response->assertStatus(Response::HTTP_FOUND);
        $this->assertDatabaseHas('categories', $category);
        $response->assertRedirect(route('categories.index'));
    }

    public function test_authenticated_user_create_new_category_not_null_title()
    {
        $this->actingAs(User::factory()->create());
        $response = $this->post(route('categories.store'),
            ['title' => null]
        );
        $response->assertSessionHasErrors(['title']);
        $response->assertStatus(Response::HTTP_FOUND);
    }

    public function test_authenticated_user_view_form_create_new_category()
    {
        $this->actingAs(User::factory()->create());
        $response = $this->get(route('categories.create'));
        $response->assertViewIs('categories.create');
        $response->assertStatus(Response::HTTP_OK);
    }

    public function test_authenticated_user_can_see_not_null_title()
    {
        $this->actingAs(User::factory()->create());
        $response = $this->from(route('categories.create'))
            ->post(route('categories.store'),
                ['title' => null]);
        $response->assertRedirect(route('categories.create'));
        $response->assertStatus(Response::HTTP_FOUND);
    }

    public function test_authenticated_user_must_login_can_see_form_create()
    {
        Category::factory()->make(['title' => null])->toArray();
        $response = $this->from(route('categories.create'))
            ->post(route('categories.store',
                    ['title' => null]
                )
            );
        $response->assertRedirect('/login');
    }
}
