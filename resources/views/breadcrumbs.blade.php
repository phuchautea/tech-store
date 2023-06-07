<div class="shop-page-title category-page-title page-title ">
    <div class="page-title-inner flex-row  medium-flex-wrap container">
        <div class="flex-col flex-grow medium-text-center">
            <div class="is-small">
                <nav class="woocommerce-breadcrumb breadcrumbs uppercase">
                    <a href="/">Trang chủ</a> <span class="divider"> › </span>
                    @if(isset($breadcrumbs))
                        {{ $breadcrumbs }}
                    @endif
                </nav>
            </div>
        </div>
        <!-- <div class="flex-col medium-text-center">
                    <p class="woocommerce-result-count hide-for-medium">
                        Hiển thị tất cả 10 kết quả</p>
                    <form class="woocommerce-ordering" method="get">
                        <select name="orderby" class="orderby" aria-label="Đơn hàng của cửa hàng">
                            <option value="menu_order" selected='selected'>Thứ tự mặc định</option>
                            <option value="popularity">Thứ tự theo mức độ phổ biến</option>
                            <option value="rating">Thứ tự theo điểm đánh giá</option>
                            <option value="date">Mới nhất</option>
                            <option value="price">Thứ tự theo giá: thấp đến cao</option>
                            <option value="price-desc">Thứ tự theo giá: cao xuống thấp</option>
                        </select>
                        <input type="hidden" name="paged" value="1" />
                    </form>
                </div> -->
    </div>
</div>