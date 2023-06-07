<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class MainController extends Controller
{
    public function index()
    {
        $monthMap = array(
            'January' => 'Tháng 1',
            'February' => 'Tháng 2',
            'March' => 'Tháng 3',
            'April' => 'Tháng 4',
            'May' => 'Tháng 5',
            'June' => 'Tháng 6',
            'July' => 'Tháng 7',
            'August' => 'Tháng 8',
            'September' => 'Tháng 9',
            'October' => 'Tháng 10',
            'November' => 'Tháng 11',
            'December' => 'Tháng 12'
        );

        // Thống kê doanh thu theo tháng
        $currentYear = date('Y');
        $sales = DB::table('orders')
        ->select(DB::raw('DATE_FORMAT(created_at, "%M") as month'), DB::raw('SUM(total_price) as sales'))
        ->whereYear('created_at', $currentYear)
        ->groupBy(DB::raw('YEAR(created_at)'), DB::raw('MONTH(created_at)'))
        ->orderBy(DB::raw('YEAR(created_at)'), 'asc')
        ->orderBy(DB::raw('MONTH(created_at)'), 'asc')
        ->get();

        $salesStatistics = [['Tháng', 'Doanh thu']];
        foreach ($sales as $data) {
            $salesStatistics[] = array($monthMap[$data->month], (int) $data->sales);
        }

        // Thống kê phương thức thanh toán
        $payment_methods = DB::table('orders')
                            ->select('payment_method', DB::raw('count(*) as total'))
                            ->groupBy('payment_method')
                            ->get();

        $paymentMethodStatistics = [['Phương thức thanh toán', 'Tổng']];
        foreach ($payment_methods as $data) {
            $paymentMethodStatistics[] = array($data->payment_method, $data->total);
        }

        // Thống kê sản phẩm bán chạy
        $bestSellingProducts = DB::table('product_variants')
            ->join('products', 'product_variants.product_id', '=', 'products.id')
            ->select('product_variants.id', 'products.name as product_name', 'product_variants.name as variant_name', 'product_variants.sold_quantity')
            ->orderBy('product_variants.sold_quantity', 'desc')
            ->take(5)
            ->get();
        $soldQuantityStatistics = [['Tên', 'Số lượng']];
        foreach ($bestSellingProducts as $data) {
            $name = $data->product_name . ' - ' . $data->variant_name;
            $soldQuantityStatistics[] = array($name, $data->sold_quantity);
        }

        return view('admin.home', [
            'title' => 'Dashboard Admin',
            'salesStatistics' => $salesStatistics,
            'paymentMethodStatistics' => $paymentMethodStatistics,
            'soldQuantityStatistics' => $soldQuantityStatistics,
        ]);
    }
}
