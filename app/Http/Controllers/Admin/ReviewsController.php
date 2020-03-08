<?php

namespace App\Http\Controllers\Admin;

use App\Review;
use App\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Auth;
use Carbon\Carbon;
use Exception;

class ReviewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $reviewsList = Review::join('users','users.id','=','reviews.user_id')->join('products','products.id','=','reviews.product_id')
        ->select('users.name','users.avatar','users.role','reviews.id','reviews.product_id','reviews.review','reviews.rate','reviews.created_at','products.name as product_name','reviews.created_at as review_created_at')
        ->get();
        return view('admin.panel.reviewsList',['reviewsList'=>$reviewsList]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Review::insert([
            'post_id' => $request->post_id,
            'user_id' => Auth::user()->id,
            'review' => $request->review,
            'created_at' => Carbon::now(),
        ]);
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function show(Review $review)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function edit(Review $review)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Review $review)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $enableMessage = true;
        $id = $request->get('id');
        try 
        {
            if (is_numeric($id)) 
            {
                $result = Review::where('id',$id)->delete();
                $alert = 'success';
                $message = 'Đã xóa';
                if (!$result)
                {
                    throw new Exception('Lại mò nữa rồi');
                }
            }
            else
            {
                throw new Exception('Lại mò nữa rồi');
            }
        }
        catch (Exception $e)
        {
            $alert = 'danger';
            $message = $e->getMessage();
        }
        return redirect()->back()
            ->with('enableMessage',$enableMessage)
            ->with('message',$message)
            ->with('alert',$alert);
    }
}
