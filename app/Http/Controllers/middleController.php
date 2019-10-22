<?php
//------------ create by helen 2019-10-21------------
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class middleController extends Controller
{
    //__construct()：當物件生成的同時，強制先去實作 __construct() 內的功能。
    public function __construct()
    {
        // 這裡延用之前創建的中介層
        $this->middleware('before') ->only('sayHiToAdmin'); 
        $this->middleware('after');

        //或是直接寫一個中介層
        $this->middleware(function ($request, $next)         
        {
            // do something...
            return $next($request);
        });
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        //
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
        echo 'mid show id '.$id;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
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

    public function sayHiToAdmin(Request $request)
    {
        echo 'Hi, '.$request->name;
    }
}
