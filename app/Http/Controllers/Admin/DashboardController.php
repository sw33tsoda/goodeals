<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Product;
use App\ProductCategory;
use App\User;
use App\Post;
use App\Comment;
use App\Review;
use App\TransactionLog;
use Input;
use DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function statistics() {
        // SALES STATS

        $sale_day_limit = 30;
        $daysAgo = Carbon::today()->subDays(30);

        $sales_sql_query = "
            SELECT date(TL.created_at) AS 'day', count(*) AS 'copy_sold', sum(TL.transaction_value) AS 'revenue'
            FROM transaction_log as TL
            WHERE TL.transaction_type = 'payment' AND TL.created_at >= '$daysAgo'
            GROUP BY date(TL.created_at)
            ORDER BY TL.created_at
        ";

        $refund_sql_query = "
            SELECT date(TL.created_at) AS 'day', count(*) AS 'copy_refund', sum(TL.transaction_value) AS 'cost'
            FROM transaction_log as TL
            WHERE TL.transaction_type = 'refund' AND TL.created_at >= '$daysAgo'
            GROUP BY date(TL.created_at)
            ORDER BY TL.created_at
        ";

        $sales = DB::SELECT(DB::raw($sales_sql_query));
        $salesCount = TransactionLog::where('transaction_type','payment');
        $sum_salesDaysAgo_sql_query = "
            SELECT sum(TL.transaction_value) AS 'revenue'
            FROM transaction_log as TL
            WHERE TL.transaction_type = 'payment' AND TL.created_at >= '$daysAgo'
            GROUP BY TL.transaction_type
            ORDER BY TL.created_at
        ";
        $salesDaysAgo = DB::SELECT(DB::raw($sum_salesDaysAgo_sql_query)); 

        $refund = DB::SELECT(DB::raw($refund_sql_query));
        $refundCount = TransactionLog::where('transaction_type','refund');
        $sum_refundDaysAgo_sql_query = "
            SELECT sum(TL.transaction_value) AS 'money_back'
            FROM transaction_log as TL
            WHERE TL.transaction_type = 'refund' AND TL.created_at >= '$daysAgo'
            GROUP BY TL.transaction_type
            ORDER BY TL.created_at
        ";
        $refundDaysAgo = DB::SELECT(DB::raw($sum_refundDaysAgo_sql_query)); 

        // USER STATS
    	$usersStats = User::where('role','user');
        $adminsStats = User::where('role','admin');
        // PRODUCT STATS
        $productsStats = Product::all();
        $reviewsStats = Review::all();
        $productCategories = ProductCategory::all();

        $productQuantities_sql_query = "
            SELECT PC.platform_name AS 'platform_name', count(*) AS 'quantity' 
            FROM product_categories AS PC,products AS P 
            WHERE PC.id = P.platform_id
            GROUP BY PC.platform_name
        ";
        $productQuantitiesByCategoryName = DB::SELECT(DB::raw($productQuantities_sql_query));

        // POST STATS
        $postsStats = Post::all();
        $commentsStats = Comment::all();
        $commentsByDay_sql_query = "
            SELECT date(comments.created_at) as 'day',count(*) as 'num_of_comments'
            FROM comments
            WHERE comments.created_at >= '$daysAgo'
            GROUP BY date(comments.created_at)
            ORDER BY comments.created_at
        ";
        $commentsByDay = DB::SELECT(DB::raw($commentsByDay_sql_query));


        
    	return view('admin.panel.dashBoard',[
            'sales'                             => $sales,
            'salesCount'                        => $salesCount,
            'salesDaysAgo'                      => $salesDaysAgo,
            'refund'                            => $refund,
            'refundCount'                       => $refundCount,
            'refundDaysAgo'                     => $refundDaysAgo,
            'usersStats'                        => $usersStats,
            'adminsStats'                       => $adminsStats,
            'productsStats'                     => $productsStats,
            'reviewsStats'                      => $reviewsStats,
            'productCategories'                 => $productCategories,
            'productQuantitiesByCategoryName'   => $productQuantitiesByCategoryName,
            'postsStats'                        => $postsStats,
            'commentsByDay'                     => $commentsByDay,
            'commentsStats'                     => $commentsStats,
        ]);
    }
}
