<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::latest()->get();
        return response()->json([
            'status'=>200,
            'message'=>'Successfully data Show',
            'data'=>$categories
        ]);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Make validation
        $data = Validator::make($request->all(),[
            'name'=>'required|string|unique:categories',
        ]);

        //Check validation

        if($data->fails()){
            return response()->json([
                'success'=> false,
                'message'=> 'Error',
                'errors'=> $data->getMessageBag(),
            ], 422);
        }

        $formData = $data->validated();
        $formData['slug'] = Str::slug($formData['name']);

        // category create

       $category = Category::create($formData);

        return response()->json([
            'success'=> true,
            'message'=> 'Successfully Category Created',
            'data'=> $category,
        ], 200);


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
