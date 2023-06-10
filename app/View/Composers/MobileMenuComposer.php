<?php

namespace App\View\Composers;

use App\Interfaces\Category\ICategoryService;
use Illuminate\View\View;

class MobileMenuComposer
{
    /**
     * Create a new profile composer.
     */
    protected $categoryService;
    public function __construct(ICategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    /**
     * Bind data to the view.
     * @param View $view
     */
    public function compose(View $view)
    {
        $categoryMenus = $this->categoryService->getAll();
        $view->with('categoryMenus', $categoryMenus);
    }
}
