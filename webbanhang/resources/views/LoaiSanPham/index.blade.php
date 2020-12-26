@extends('backend.layouts.master')

@section('title')
    Danh sách sản phẩm
@endsection

@section('content')
<a class='btn btn-primary' href='{{route('admin.loaisanpham.create')}}'>Thêm mới</a>
<table class="table">
    <thead>
        <tr>
            <th scope="col">STT</th>
            <th scope="col">Mã</th>
            <th scope="col">Tên</th>
            <th scope="col">Ngày tạo mới</th>
            <th scope="col">Ngày cập nhật</th>
            <th scope="col">Trạng thái</th>
            <th scope="col">Chức năng</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($dssanpham as $k => $sp)
        <tr>
            <th scope="row">{{$k}}</th>
            <td>{{$sp->l_ma}}</td>
            <td>{{$sp->l_ten}}</td>
            <td>{{$sp->l_taoMoi}}</td>
            <td>{{$sp->l_capNhat}}</td>
            <td>{{$sp->l_trangThai}}</td>
            <td>
                <a class="btn btn-primary" href="{{route('admin.loaisanpham.edit',['id' => $sp->l_ma])}}">Sửa</a>
                <form name="frmXoa" method="POST" action="{{route('admin.loaisanpham.destroy',['id' => $sp->l_ma])}}"  class="delete-form" data-id = "{{ $sp->l_ma }}">
                    {{ csrf_field() }}
                    <input type="hidden" name="_method" value="DELETE" />
                    <button type="submit" class="btn btn-danger" >Xóa</button>
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
                          )
                        setTimeout(function(){ 
                            location.reload();  
                        }, 1500);
                    }
                  })
                }
              })
            });
        });
        
        
</script>
@endsection

