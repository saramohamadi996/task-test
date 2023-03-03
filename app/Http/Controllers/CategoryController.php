<?php

namespace App\Http\Controllers;

use App\Contracts\Interfaces\CategoryRepositoryInterface;
use App\Http\Requests\CategoryUpdateRequest;
use App\Http\Requests\CategoryStoreRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\View\View;

class CategoryController extends Controller
{
    /**
     * The category repository instance.
     *
     * @var CategoryRepositoryInterface
     */
    protected CategoryRepositoryInterface $categoryRepository;

    /**
     *  Instantiate a new category instance.
     *
     * @param CategoryRepositoryInterface $categoryRepository
     */
    public function __construct(CategoryRepositoryInterface $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $categories = $this->categoryRepository->getAllCategory();
        return view('categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $categories = $this->categoryRepository->getAllCategory();
        return view('categories.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryStoreRequest $request): RedirectResponse
    {
        $result = $this->categoryRepository->store($request);
        if (!$result) {
            return redirect()->back()->with('error', trans('The save operation failed.'));
        }
        return redirect()->route('categories.index')
            ->with('success', trans('The save operation was completed successfully.'));
    }

    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $category = $this->categoryRepository->getById($id);
        return view('categories.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $category = $this->categoryRepository->getById($id);
        $categories = $this->categoryRepository->allExceptById($id);
        return view('categories.edit', compact('category', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update($id, CategoryUpdateRequest $request): RedirectResponse
    {
        $result = $this->categoryRepository->update($id, $request);
        if (!$result) {
            return redirect()->back()->with('error', trans('The update operation failed.'));
        }
        return redirect()->route('categories.index')
            ->with('success', trans('The update operation was completed successfully.'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id): RedirectResponse
    {
        $this->categoryRepository->getById($id);
        $result = $this->categoryRepository->delete($id);
        if (!$result) {
            return redirect()->route('categories.index')
                ->with('error', trans('The delete operation failed.'));
        }
        return redirect()->route('categories.index')
            ->with('success', trans('The delete operation was successful.'));
    }
}
