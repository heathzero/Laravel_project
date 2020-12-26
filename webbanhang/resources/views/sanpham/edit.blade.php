@extends('backend.layouts.master')

@section('title')
    Thêm mới sản phẩm
@endsection

@section('content')
<form name="frmChinhSua" method="POST" action="{{ route('admin.sanpham.update',['id' => $infosp->sp_ma]) }}" enctype="multipart/form-data">
  <div class="form-group">
    <br>
  </div>
    {{ csrf_field() }}
    <input type="hidden" name="_method" value="PUT" />
  <div class="form-group">
    <label for="exampleInputPassword1">Tên sản phẩm</label>
    <input type="text" name="sp_ten" value="{{ $infosp->sp_ten }}" class="form-control" id="exampleInputPassword1" placeholder="Tên loại sản phẩm">
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Giá gốc</label>
    <input type="text" name="sp_giaGoc" value="{{ $infosp->sp_giaGoc }}" class="form-control" id="sp_giaGoc" placeholder="Giá gốc">
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Giá bán</label>
    <input type="text" name="sp_giaBan" value="{{ $infosp->sp_giaBan }}" class="form-control" id="sp_giaBan" placeholder="Giá bán">
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Thông tin</label>
    <input type="text" name="sp_thongtin"  value="{{ $infosp->sp_thongtin }}" class="form-control" id="sp_thongtin" placeholder="Thông tin">
  </div>
    <div class="form-group">
    <label for="sp_taoMoi">Ngày tạo mới</label>
    <input type="text" class="form-control" id="sp_taoMoi" name="sp_taoMoi" value="{{ $infosp->sp_taoMoi }}">
  </div>
  <div class="form-group">
    <label for="sp_capNhat">Ngày cập nhật</label>
    <input type="text" class="form-control" id="sp_capNhat" name="sp_capNhat" value="{{ $infosp->sp_capNhat }}">
  </div>
  <div class="form-group">
        <label for="inputGroupSelect01">Loại</label>
        <select name = 'l_ma' class="custom-select" id="inputGroupSelect01">
          <option>Chọn</option>
          @foreach ($ds_loai as $loai)
            <option value="{{$loai->l_ma}}" {{ $loai->l_ma == $infosp->l_ma ? "selected" : '' }} >{{$loai->l_ten}}</option>
          @endforeach
        </select>
  </div>
   <div class="form-group">
        <div class="file-loading">
            <label>Hình đại diện</label>
            <input id="sp_hinh" type="file" name="sp_hinh">
        </div>
    </div>
   <div class="form-group">
        <div class="file-loading">
            <label>Hình ảnh liên quan sản phẩm</label>
            <input id="sp_hinhanhlienquan" type="file" name="sp_hinhanhlienquan[]" multiple>
        </div>
    </div>
  <button type="submit" class="btn btn-primary">Lưu</button>
</form>

@endsection

@section('custom-css')
    <link rel="stylesheet" href="{{ asset('vendor/bootstrap-fileinput/css/fileinput.min.css') }}">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" crossorigin="anonymous">
    <link href="{{ asset('vendor/bootstrap-fileinput/themes/explorer-fas/theme.css') }}" media="all" rel="stylesheet" type="text/css" />

@endsection

@section('custom-scripts')
    <script src="{{ asset('vendor/bootstrap-fileinput/js/fileinput.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap-fileinput/js/plugins/sortable.js') }}" type="text/javascript"></script>
    <script src="{{ asset('vendor/bootstrap-fileinput/js/fileinput.js') }}" type="text/javascript"></script>
    <script src="{{ asset('vendor/bootstrap-fileinput/themes/fas/theme.js') }}" type="text/javascript"></script>
    <script src="{{ asset('vendor/bootstrap-fileinput/themes/explorer-fas/theme.js') }}" type="text/javascript"></script>
    <script src="{{ asset('vendor/bootstrap-fileinput/js/locales/vi.js') }}" type="text/javascript"></script>
    
    
    <script>
    $(document).ready(function() {
        $("#sp_hinh").fileinput({
            language: "vi",
            theme: 'fas',
            showUpload: false,
            showCaption: false,
            browseClass: "btn btn-primary btn-lg",
            fileType: "any",
            append: false,
            showRemove: false,
            autoReplace: true,
            previewFileIcon: "<i class='glyphicon glyphicon-king'></i>",
            overwriteInitial: false,
            initialPreviewShowDelete: false,
            initialPreviewAsData: true,
            initialPreview: [
                "{{ asset('storage/photos/' . $infosp->sp_hinh) }}"
            ],
            initialPreviewConfig: [
                {
                    caption: "{{ $infosp->sp_hinh }}", 
                    size: {{ Storage::exists('public/photos/' . $infosp->sp_hinh) ? Storage::size('public/photos/' . $infosp->sp_hinh) : 0 }}, 
                    width: "120px", 
                    url: "{$url}", 
                    key: 1
                },
            ]
        });

        $("#sp_hinhanhlienquan").fileinput({
            language: "vi",
           theme: 'fas',
            showUpload: false,
            showCaption: false,
            browseClass: "btn btn-primary btn-lg",
            fileType: "any",
            append: false,
            showRemove: false,
            autoReplace: true,
            previewFileIcon: "<i class='glyphicon glyphicon-king'></i>",
            overwriteInitial: false,
            allowedFileExtensions: ["jpg", "gif", "png", "txt"],
            initialPreviewShowDelete: false,
            initialPreviewAsData: true,
            initialPreview: [
                @foreach($infosp->hinhanhlienquan()->get() as $hinhAnh)
                "{{ asset('storage/photos/' . $hinhAnh->ha_ten) }}",
                @endforeach
            ],
            initialPreviewConfig: [
                @foreach($infosp->hinhanhlienquan()->get() as $index=>$hinhAnh)
                {
                    caption: "{{ $hinhAnh->ha_ten }}", 
                    size: {{ Storage::exists('public/photos/' . $hinhAnh->ha_ten) ? Storage::size('public/photos/' . $hinhAnh->ha_ten) : 0 }}, 
                    width: "120px", 
                    url: "{$url}", 
                    key: {{ ($index + 1) }}
                },
                @endforeach
            ]
        });
         $('#sp_giaGoc').inputmask({
            alias: 'currency',
            positionCaretOnClick: "radixFocus",
            radixPoint: ".",
            _radixDance: true,
            numericInput: true,
            groupSeparator: ",",
            suffix: ' vnđ',
            min: 0,         // 0 ngàn
            max: 100000000, // 1 trăm triệu
            autoUnmask: true,
            removeMaskOnSubmit: true,
            unmaskAsNumber: true,
            inputtype: 'text',
            placeholder: "0",
            definitions: {
              "0": {
                validator: "[0-9\uFF11-\uFF19]"
              }
            }
          });
        $('#sp_giaBan').inputmask({
            alias: 'currency',
            positionCaretOnClick: "radixFocus",
            radixPoint: ".",
            _radixDance: true,
            numericInput: true,
            groupSeparator: ",",
            suffix: ' Đồng',
            min: 0,         // 0 ngàn
            max: 100000000, // 1 trăm triệu
            autoUnmask: true,
            removeMaskOnSubmit: true,
            unmaskAsNumber: true,
            inputtype: 'text',
            placeholder: "0",
            definitions: {
              "0": {
                validator: "[0-9\uFF11-\uFF19]"
              }
            }
          });
          
          // Gắn mặt nạ nhập liệu cho các ô nhập liệu Ngày tạo mới
            $('#sp_taoMoi').inputmask({
              alias: 'datetime',
              inputFormat: 'yyyy-mm-dd' // Định dạng Năm-Tháng-Ngày
            });

            // Gắn mặt nạ nhập liệu cho các ô nhập liệu Ngày cập nhật
            $('#sp_capNhat').inputmask({
              alias: 'datetime',
              inputFormat: 'yyyy-mm-dd' // Định dạng Năm-Tháng-Ngày
            });
    });
</script>
@endsection

