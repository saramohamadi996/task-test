<?php

namespace App\Contracts\Interfaces;

interface CategoryRepositoryInterface
{
    /**
     * Get the value from the database.
     */
    public function getAllCategory();

    public function allExceptById($id);

    /**
     * find by id the record with the given id.
     */
    public function getById(int $category);

    /**
     * create new category.
     */
    public function store($value);

    /**
     * update existing categories.
     */
    public function update($is, $value);

    /**
     * deletes an existing category.
     */
    public function delete($id);
}
