<?php

namespace App\Providers;

#Category
use App\Interfaces\Category\ICategoryRepository;
use App\Repositories\CategoryRepository;
use App\Interfaces\Category\ICategoryService;
use App\Services\CategoryService;

#Product
use App\Interfaces\Product\IProductRepository;
use App\Repositories\ProductRepository;
use App\Interfaces\Product\IProductService;
use App\Services\ProductService;

#Review
use App\Interfaces\Review\IReviewRepository;
use App\Repositories\ReviewRepository;
use App\Interfaces\Review\IReviewService;
use App\Services\ReviewService;

#Product Variant
use App\Interfaces\ProductVariant\IProductVariantRepository;
use App\Repositories\ProductVariantRepository;
use App\Interfaces\ProductVariant\IProductVariantService;
use App\Services\ProductVariantService;

#Cart
use App\Interfaces\Cart\ICartService;
use App\Services\CartService;

#Order
use App\Interfaces\Order\IOrderRepository;
use App\Repositories\OrderRepository;
use App\Interfaces\Order\IOrderService;
use App\Services\OrderService;

#Order Detail
use App\Interfaces\OrderDetail\IOrderDetailRepository;
use App\Repositories\OrderDetailRepository;
use App\Interfaces\OrderDetail\IOrderDetailService;
use App\Services\OrderDetailService;

#Momo Payment
use App\Interfaces\IMomoPaymentService;
use App\Services\MomoPaymentService;

#Vnpay Payment
use App\Interfaces\IVnpayPaymentService;
use App\Services\VnpayPaymentService;

#User
use App\Interfaces\User\IUserRepository;
use App\Repositories\UserRepository;
use App\Interfaces\User\IUserService;
use App\Services\UserService;

#Image
use App\Interfaces\Image\IImageService;
use App\Services\ImageService;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //Category
        $this->app->bind(ICategoryRepository::class, CategoryRepository::class);
        $this->app->bind(ICategoryService::class, CategoryService::class);
        //Product
        $this->app->bind(IProductRepository::class, ProductRepository::class);
        $this->app->bind(IProductService::class, ProductService::class);
        //Review
        $this->app->bind(IReviewRepository::class, ReviewRepository::class);
        $this->app->bind(IReviewService::class, ReviewService::class);
        //Product Variant
        $this->app->bind(IProductVariantRepository::class, ProductVariantRepository::class);
        $this->app->bind(IProductVariantService::class, ProductVariantService::class);
        //Cart
        $this->app->bind(ICartService::class, CartService::class);
        //Order
        $this->app->bind(IOrderRepository::class, OrderRepository::class);
        $this->app->bind(IOrderService::class, OrderService::class);
        //Order Detail
        $this->app->bind(IOrderDetailRepository::class,OrderDetailRepository::class);
        $this->app->bind(IOrderDetailService::class,OrderDetailService::class);
        //Momo Payment
        $this->app->bind(IMomoPaymentService::class, MomoPaymentService::class);
        //VNPay Payment
        $this->app->bind(IVnpayPaymentService::class, VnpayPaymentService::class);

        //User
        $this->app->bind(IUserRepository::class, UserRepository::class);
        $this->app->bind(IUserService::class, UserService::class);

        //Image
        $this->app->bind(IImageService::class, ImageService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Schema::defaultStringLength(191);

        // add this statement to fix only_full_group_by issues
        DB::statement("SET sql_mode='STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION'");
    }
}
