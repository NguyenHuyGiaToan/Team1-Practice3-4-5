<div class='list-book'>
    @foreach($data as $row)
        <div class='book'>
            <a href="{{url('sach/chitiet/'.$row->id)}}">
                <img src="{{asset('storage/book_image/'.$row->file_anh_bia)}}" width='200px' height='200px'><br>
                <b>{{$row->tieu_de}}</b><br/>
                <i>{{number_format($row->gia_ban,0,",",".")}}đ</i><br>
            </a> 
            <div class='btn-add-product'>
                <button class='btn btn-success btn-sm mb-1 add-product' book_id="{{$row->id}}">
                Thêm vào giỏ hàng
                </button> 
            </div>
        </div>
    @endforeach
 </div>
