<?php

namespace App\View\Composers;

use App\Interfaces\Cart\ICartService;
use Illuminate\View\View;

class CartMenuComposer
{
    /**
     * Create a new profile composer.
     */
    protected $cartService;
    public function __construct(ICartService $cartService)
    {
        $this->cartService = $cartService;
    }

    /**
     * Bind data to the view.
     * @param View $view
     */
    public function compose(View $view)
    {
        $totalItemCartMenus = $this->cartService->getItemCount();
        $view->with('totalItemCartMenus', $totalItemCartMenus);
    }
}
