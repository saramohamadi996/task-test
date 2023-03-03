<?php

namespace Tests\Feature\Category;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Response;
use App\Models\Category;
use App\Models\User;
use Tests\TestCase;

class UpdateCategoryTest extends TestCase
{
    use RefreshDatabase;

    public function test_unauthenticated_user_not_update_category()
    {
        $category = Category::factory()->create();
        $response = $this->get(route('categories.edit', $category->id));
        $response->assertRedirect('/login');
    }

    public function test_authenticated_user_save_update_category()
    {
        $this->actingAs(User::factory()->create());
        $category = Category::factory()->create();
        $category['title'] = 'Title (update)';
        $category['parent_id'] = null;
        $response = $this->put(route('categories.update', $category->id), $category->toArray());

        $this->assertDatabaseHas('categories', [
            'id' => $category->id,
            'title' => 'title (update)',
            'parent_id' => $category['parent_id']
        ]);
        $response->assertRedirect(route('categories.index'));
        $response->assertStatus(Response::HTTP_FOUND);
    }
}
