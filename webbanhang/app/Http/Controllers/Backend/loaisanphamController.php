<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Loai;
use Validator;
use Session;
use App\Http\Requests\LoaiCreateRequest;
use App\Http\Requests\loaiUpdateRequest;

class loaisanphamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ds_sp = Loai::all();
        return view('loaisanpham.index')->with('dssanpham', $ds_sp);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('loaisanpham.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(LoaiCreateRequest $request)
    {//su dung reques de validate trong file \app\Http\Requests\LoaiCreateRequest.php
        $l_ten = $request->l_ten;
        $l_trangthai = isset($request->l_trangthai) ? $request->l_trangthai: 2;
//validate trực tiếp
//        $validator = Validator::make($request->all(), [
//            'l_ten' => 'required|min:3|max:50|unique:cusc_loai',
//        ]);
//        
//        if ($validator->fails()) {
//            return redirect(route('admin.loaisanpham.create'))
//                        ->withErrors($validator)
//                        ->withInput();
//        }
        
        $m_loai = new Loai();
        $m_loai->l_ten = $l_ten;
        $m_loai->l_trangThai = $l_trangthai;
        $m_loai->save();
        Session::flash('sussecs','Thêm mới thành công!');
        return redirect(route('admin.loaisanpham.index'));
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $loai = Loai::find($id);
        return view('loaisanpham.edit')->with('loai', $loai);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(loaiUpdateRequest $request, $id)
    {
        $loai = Loai::find($id);
        $loai->l_ten = $request->input('l_ten');
        $loai->l_trangthai = isset($request->l_trangthai) ? $request->l_trangthai: 2;
        $loai->save();
        Session::flash('sussecs','Sửa thành công!');
        return redirect()->route('admin.loaisanpham.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
        $loai = Loai::find($id);
        $loai->delete();
        Session::flash('sussecs','Xóa thành công');
        return redirect()->route('admin.loaisanpham.index');
    }
}
