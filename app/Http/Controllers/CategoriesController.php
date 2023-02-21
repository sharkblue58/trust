<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Traits\HttpResponses;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\CategoriesResource;
use App\Http\Requests\StoreCategoriesRequest;

class CategoriesController extends Controller
{
    use HttpResponses;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return CategoriesResource::collection(
              Category::all()
        );
    }
    


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store( StoreCategoriesRequest $request)
    {
        $request->validated($request->all());

        $Category = Category::create([
         
            'name' => $request->name,
            'desc' => $request->desc,
            
           
        ]);

        return new CategoriesResource($Category);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show( Request $Category,$id)
    {

        $Category=Category::find($id);
        return  new   CategoriesResource($Category);

    }
    
    public function update($id,Request $request)
    {
        $Category=Category::find($id);
        $Category->update($request->all());
        return new CategoriesResource($Category);;

      
    }
   
    public function destroy($id)
    {
        $Category= Category::find($id );
    
        return  $Category->delete();
    }
   
 
   
    public function search($name)
    {    
       
    
        if ($name) {
            return Category::where('name', $name)
            ->orWhere('name',"like","$name%",$name)->
            
            orWhere('id',$name)->get();
     
        }
    

     }

}
