<?php

namespace Tests\Feature\Category;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Response;
use App\Models\Category;
use App\Models\User;
use Tests\TestCase;

class DeleteCategoryTest extends TestCase
{
    use RefreshDatabase;

    public function test_authenticated_user_delete_categories()
    {
        $this->actingAs(User::factory()->create());
        $product = Category::factory()->create();
        $response = $this->delete(route('categories.delete', $product->id));
        $response->assertStatus(Response::HTTP_FOUND);
        $this->assertDatabaseMissing('categories', $product->toArray());
        $response->assertRedirect(route('categories.index'));
    }

    public function test_authenticated_user_can_delete_categories()
    {
        $product = Category::factory()->create();
        $response = $this->delete(route('categories.delete', $product->id));
        $response->assertRedirect('/login');
    }
}
