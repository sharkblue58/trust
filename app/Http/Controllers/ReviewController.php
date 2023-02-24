<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function index()
    {
        $allReview=Review::all();
        return response()->json([
            'status'=>'true',
             'data'=>$allReview,
        ],201);
    }

    public function store(Request $request)
    {
        $review=new Review();
        $review->rate=$request->rate;
        $review->desc=$request->desc;
        $review->user_id=$request->user_id;
        $review->product_id=$request->product_id;
        $review->save();
        return response()->json([
            'status'=>'true',
            'msg'=>'data stored successfuly'
        ],201);
    }

    public function show($id)
    {
        $review=Review::find($id);
        return response()->json([
         'status'=>'true',
         'user'=>$review,
        ],201);
    }

    public function update(Request $request,$id)
    {
        $review = Review::find($id);
        $review->rate = $request->rate;
        $review->desc = $request->desc;
        $review->save();
        return response()->json([
          'status'=>'true',
          'msg'=>'your review is updated now'
        ]); 
    }

    public function destroy($id)
    {
        try{
            $review = Review::find($id);
            $review->delete();
            return response()->json([
              'status'=>'true',
              'msg'=>'your review is deleted now'
            ]);
        }catch(Exception $ex){
        return response()->json(['status'=>'error','expcetion'=>$ex->getMessage(),'msg'=>'delete process failed'],500);
        }
 
    }
     
}
