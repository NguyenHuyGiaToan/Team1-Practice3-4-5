<x-account-panel>
    <script>
$(document).ready(function(){
new DataTable('#book-table', {
responsive: true,
"bStateSave":true
});
});
</script>
    <div style='text-align:center; color:#15c; font-weight:bold; font-size:20px;'>QUẢN LÝ SÁCH</div>
    @if (session('status'))
<div class="alert alert-success">
{{ session('status') }}
</div>
@endif
    <a href="{{route('bookcreate')}}" class='btn btn-sm btn-success mb-1'>Thêm</a>
    <table id = "book-table" class="table table-striped table-bordered" width="100%">
        <thead>
            <tr>
                <th>Tiêu đề</th>
                <th>Nhà xuất bản</th>
                <th>Nhà cung cấp</th>
                <th>Tác giả</th>
                <th>Hình thức bìa</th>
                <th>Giá bán</th>
                <th>Hình ảnh</th>
                <th width="120px">Thao tác</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $row)
            <tr>
                <td >{{$row->tieu_de}}</td>
                <td>{{$row->nha_xuat_ban}}</td>
                <td>{{$row->nha_cung_cap}}</td>
                <td>{{$row->tac_gia}}</td>
                <td>{{$row->hinh_thuc_bia}}</td>
                <td>{{$row->gia_ban}}</td>
                <td><img src="{{asset('hinh/image/'.$row->file_anh_bia)}}" width="50px"></td>
                <td>
                    <div class="btn-group">
                        <a href="{{route('bookedit',['id'=>$row->id])}}" class='btn btn-sm btn-primary'>Sửa</a>
                        &nbsp;
                        <form method='post' action = "{{route('bookdelete')}}" onsubmit="return confirm('Bạn có chắc chắn muốn xóa cuốn sách này không?');">
                            <input type='hidden' value='{{$row->id}}' name='id'>
                            <input type='submit' class='btn btn-sm btn-danger' value='Xóa'>
                            {{ csrf_field() }}
                        </form>
                    </div>
                    
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</x-account-panel>
