<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\InfoStudent;

class StudentAjaxController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $students = InfoStudent::orderBy('id','desc')->get();

        return view('student.index',[
            'students' => $students,
        ]);
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
        $student=InfoStudent::create($request->all());
        return response()->json([
            'data'=>$student,
            'message'=>'Tạo sinh viên thành công'
        ],200); // 200 là mã lỗi
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $student = InfoStudent::find($id);
        return response()->json(['data'=>$student,'name'=>'Bình'],200); // 200 là mã lỗi
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $student=InfoStudent::find($id);
        return response()->json(['data'=>$student,'name'=>'Bình'],200); // 200 là mã lỗi
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
        $student=InfoStudent::find($id)->update($request->all());
        return response()->json(['data'=>$student,'student' => $request->all(),'studentid' => $id,'message'=>'Cập nhật thông tin sinh viên thành công'],200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        InfoStudent::find($id)->delete();
        return response()->json(['data'=>'removed'],200);
    }
}
