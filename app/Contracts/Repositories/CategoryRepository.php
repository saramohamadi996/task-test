<?php

namespace App\Contracts\Repositories;

use App\Contracts\Interfaces\CategoryRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use App\Models\Category;

class CategoryRepository implements CategoryRepositoryInterface
{
    /**
     * Get the value from the database.
     */
    public function getAllCategory(): Collection
    {
        return Category::all();
    }

    public function allExceptById($id): Collection
    {
        return $this->getAllCategory()->filter(function ($item) use ($id) {
            return $item->id != $id;
        });
    }

    /**
     * find by id the record with the given id.
     */
    public function getById(int $category)
    {
        return Category::findOrFail($category);
    }

    /**
     * create new category.
     */
    public function store($value)
    {
        return Category::create([
            'title' => $value->title,
            'parent_id' => $value->parent_id,
        ]);
    }

    /**
     * update existing categories.
     */
    public function update($id, $value)
    {
        return Category::where('id', $id)->update([
            'title' => $value->title,
            'parent_id' => $value->parent_id,
        ]);
    }

    /**
     * deletes an existing category
     */
    public function delete($id)
    {
        Category::where('id', $id)->delete();
    }
}

