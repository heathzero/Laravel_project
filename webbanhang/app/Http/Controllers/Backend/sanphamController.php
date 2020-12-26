<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\SanPham;
use App\Loai;
use App\HinhAnh;
use Session;
use Storage;
use App\Exports\SanPhamExport;
use Maatwebsite\Excel\Facades\Excel as Excel;
use Barryvdh\DomPDF\Facade as PDF;


class sanphamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ds_sp = SanPham::all();
        return view('sanpham.index')->with('dssanpham', $ds_sp);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $ds_loai = Loai::all();
        return view('sanpham.create')->with('ds_loai', $ds_loai);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
//        dd($request);
        $sp = new SanPham();
        $sp->sp_ten = $request->sp_ten;
        $sp->sp_giaGoc = $request->sp_giaGoc;
        $sp->sp_giaBan = $request->sp_giaBan;
        $sp->sp_thongtin = $request->sp_thongtin;
        $sp->l_ma = $request->l_ma;

        if($request->hasFile('sp_hinh'))
        {
        $file = $request->sp_hinh;

        // Lưu tên hình vào column sp_hinh
        $sp->sp_hinh = $file->getClientOriginalName();
        // Chép file vào thư mục "photos"
        $fileSaved = $file->storeAs('public/photos', $sp->sp_hinh);
        }
        $sp->save();
        
        // Lưu hình ảnh liên quan
        if($request->hasFile('sp_hinhanhlienquan')) {
            $files = $request->sp_hinhanhlienquan;

            // duyệt từng ảnh và thực hiện lưu
            foreach ($request->sp_hinhanhlienquan as $index => $file) {

                $file->storeAs('public/photos', $file->getClientOriginalName());

                // Tạo đối tưọng HinhAnh
                $hinhAnh = new HinhAnh();
                $hinhAnh->sp_ma = $sp->sp_ma;
                $hinhAnh->ha_stt = ($index + 1);
                $hinhAnh->ha_ten = $file->getClientOriginalName();
                $hinhAnh->save();
            }
        }

        Session::flash('sussecs', 'Thêm mới thành công!');
        return redirect()->route('admin.sanpham.index');
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
        $infosp = SanPham::find($id);
        $ds_loai = Loai::all();
//        $hinhanh = HinhAnh::find
        return view('sanpham.edit')->with('ds_loai', $ds_loai)->with('infosp', $infosp);
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
        $sanpham = SanPham::find($id);
        $sanpham->sp_ten = $request->input('sp_ten');
        $sanpham->sp_giaGoc = $request->input('sp_giaGoc');
        $sanpham->sp_giaBan = $request->input('sp_giaBan');
        $sanpham->sp_thongtin = $request->input('sp_thongtin');
        $sanpham->sp_taoMoi = $request->input('sp_taoMoi');
        $sanpham->sp_capNhat = $request->input('sp_capNhat');
        $sanpham->l_ma = $request->input('l_ma');
        if($request->hasFile('sp_hinh'))
        {
        $file = $request->sp_hinh;
        Storage::delete('public/photos/' . $sanpham->sp_hinh);
        // Lưu tên hình vào column sp_hinh
        $sanpham->sp_hinh = $file->getClientOriginalName();
        // Chép file vào thư mục "photos"
        $file->storeAs('public/photos', $sanpham->sp_hinh);
        }
        $sanpham->save();
        
        Session::flash('sussecs','Sửa thành công!');
        return redirect()->route('admin.sanpham.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $sanpham = SanPham::find($id);

        Storage::delete('public/photos/' . $sanpham->sp_hinh);
        // Lưu tên hình vào column sp_hinh
        $sanpham->delete();
        
        Session::flash('sussecs','Xóa thành công!');
        return redirect()->route('admin.sanpham.index');
    }
    
    public function print() {
        $ds_sanpham = Sanpham::all();
        $ds_loai    = Loai::all();

        return view('sanpham.print')
            ->with('danhsachsanpham', $ds_sanpham)
            ->with('danhsachloai', $ds_loai);
        }
    public function excel() {
        /* Code dành cho việc debug
        - Khi debug cần hiển thị view để xem trước khi Export Excel
        */
        // $ds_sanpham = Sanpham::all();
        // $ds_loai    = Loai::all();
        // return view('backend.sanpham.excel')
        //     ->with('danhsachsanpham', $ds_sanpham)
        //     ->with('danhsachloai', $ds_loai);

        return Excel::download(new SanPhamExport, 'danhsachsanpham.xlsx');
    }
    
        /**
     * Action xuất PDF
     */
    public function pdf() 
    {
        $ds_sanpham = Sanpham::all();
        $ds_loai    = Loai::all();
        $data = [
            'danhsachsanpham' => $ds_sanpham,
            'danhsachloai'    => $ds_loai,
        ];

        /* Code dành cho việc debug
        - Khi debug cần hiển thị view để xem trước khi Export PDF
        */
        // return view('backend.sanpham.pdf')
        //     ->with('danhsachsanpham', $ds_sanpham)
        //     ->with('danhsachloai', $ds_loai);

        $pdf = PDF::loadView('sanpham.pdf', $data);
        return $pdf->download('DanhMucSanPham.pdf');
    }
}
