@extends('backend.layouts.master')

@section('title')
    Danh sách sản phẩm
@endsection


@section('content')
<a class='btn btn-primary' href='{{route('admin.sanpham.create')}}'>Thêm mới</a>
<a class='btn btn-primary' href='{{route('admin.sanpham.print')}}'>In</a>
<a class='btn btn-primary' href='{{route('admin.sanpham.excel')}}'>Xuất Excel</a>
<a class='btn btn-primary' href='{{route('admin.sanpham.pdf')}}'>Xuất pdf</a>
<table class="table table-bordered">
    <thead>
        <tr>
            <th scope="col">STT</th>
            <th scope="col">Tên</th>
            <th scope="col">Hình</th>
            <th scope="col">Giá gốc</th>
            <th scope="col">Giá bán</th>
            <th scope="col">Loại</th>
            <th scope="col" class="d-flex justify-content-center w-50">Chức năng</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($dssanpham as $k => $sp)
        <tr>
            <th scope="row">{{$k}}</th>
            <td>{{$sp->sp_ten}}</td>
            <td><img src="{{ asset('storage/photos/' . $sp->sp_hinh) }}" class="img-list" width="120px" height="120px" /></td>
            <!--<td><img src="{{ asset('storage/photos/' . 'hoa-2.jpg') }}" class="img-list" width="120px" height="120px" /></td>-->
            <td class="curency">{{$sp->sp_giaGoc}}</td>
            <td class="curency">{{$sp->sp_giaBan}}</td>
            <td>{{$sp->loaisanpham->l_ten}}</td>
            <td class="d-flex justify-content-center w-50">
                <a class="btn btn-primary" href="{{route('admin.sanpham.edit',['id' => $sp->sp_ma])}}"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
  <path fill-rule="evenodd" d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5L13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175l-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
</svg></a>                 
                    
                    <form name="frmXoa" method="POST" action="{{route('admin.sanpham.destroy',['id' => $sp->sp_ma])}}"  class="delete-form" data-id = "{{ $sp->sp_ma }}">
                    {{ csrf_field() }}
                    <input type="hidden" name="_method" value="DELETE" />
                    <button type="submit" class="btn btn-danger" ><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
  <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
  <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4L4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/></button>
                </form>
                </form>
            </td>
            

        </tr>
        @endforeach

    </tbody>
</table>

@endsection


@section('custom-scripts')
<script>
    $( document ).ready(function() { 
        
        
        $('.delete-form').submit(function (e){
            e.preventDefault();
            Swal.fire({
                title: 'Bạn có chắt chắn?',
                text: "Dữ liệu khi xóa sẽ không thể phục hồi!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Vâng, tôi chắt chắn!'
              }).then((result) => {
                if (result.isConfirmed) {
                  $.ajax({
                    type: $(this).attr('method'),
                    url: $(this).attr('action'),
                    data: $(this).serialize(),
                    success: function () {
                        Swal.fire(
                            'Xóa!',
                            'Bạn đã xóa thành công.',
                            'success'
                          );
                        setTimeout(function(){ 
                            location.reload();  
                        }, 1500);
                    }
                  });
                }
              });
            });
            
            $('.curency').inputmask({
                alias: 'currency',
                positionCaretOnClick: "radixFocus",
                radixPoint: ".",
                _radixDance: true,
                numericInput: true,
                groupSeparator: ",",
                suffix: '',
                min: 0,        
                max: 1000000000, 
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
        });
        
        
</script>
@endsection