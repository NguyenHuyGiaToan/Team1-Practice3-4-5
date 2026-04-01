<!DOCTYPE html>
<html>
<head>
    <title>{{$title ?? 'Cửa hàng sách'}}</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

    <style>
        .navbar {
            background-color: #ff5850;
            max-width: 1000px;
            font-weight: bold;
            margin: 0 auto;
        }
        .nav-item a { color: #fff !important; }
        .list-book {
            display: grid;
            grid-template-columns: repeat(5, 20%);
        }
        .book { margin: 10px; text-align: center; }
        
        /* Cải thiện hiển thị số lượng giỏ hàng */
        #cart-number-product {
            width: 20px;
            height: 20px;
            background-color: #23b85c;
            color: white;
            font-size: 11px;
            border-radius: 50%;
            position: absolute;
            right: -5px;
            top: -5px;
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 10;
        }
    </style>
</head>
<body>
    <header style='text-align:center'>
        <img src="{{asset('hinh/banner_sach.jpg')}}" width="1000px">
        <nav class="navbar navbar-dark navbar-expand-sm"> <div class='container-fluid p-0'>
                <div class='col-9 p-0'>
                    <ul class="navbar-nav">
                        <li class="nav-item {{ request()->is('sach') ? 'active' : '' }}">
                            <a class="nav-link  menu-the-loai" href="#" the_loai="">Trang chủ</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link  menu-the-loai"  href="#" the_loai="1">Tiểu thuyết</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link  menu-the-loai" href="#" the_loai="2">Truyện ngắn - tản văn</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link  menu-the-loai" href="#" the_loai="3">Tác phẩm kinh điển</a>
                        </li>
                    </ul>
                </div>

                <div class='col-3 p-0 d-flex justify-content-end align-items-center'>
                    <div style='position:relative' class='mr-4'>
                        <div id='cart-number-product'>
                            {{ session('cart') ? count(session('cart')) : 0 }}
                        </div>
                        <a href="{{route('order')}}" style='cursor:pointer; color:white;'>
                            <i class="fa fa-shopping-cart fa-2x"></i>
                        </a>
                    </div>

                    @auth
                        <div class="dropdown">
                            <button type="button" class="btn btn-success btn-sm dropdown-toggle" data-toggle="dropdown">
                                {{ Auth::user()->name }}
                            </button>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a class="dropdown-item" href="{{route('account')}}">Quản lý</a>
                                <div class="dropdown-divider"></div>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item">Đăng xuất</button>
                                </form>
                            </div>
                        </div>
                    @else
                        <div class="btn-group">
                            <a href="{{ route('login') }}" class='btn btn-sm btn-primary'>Đăng nhập</a>
                            <a href="{{ route('register') }}" class='btn btn-sm btn-success'>Đăng ký</a>
                        </div>
                    @endauth
                </div>
            </div>
        </nav>
    </header>
    <main style="width:1000px; margin:2px auto;">
        <div class='row'>
            <div class='col-12'>
               {{$slot}}
            </div>
        </div>
    </main>
    <script>
    $(document).ready(function(){
        $(".menu-the-loai").click(function(e){
            e.preventDefault(); // Ngăn chặn nhảy dấu # lên URL
            
            let id_theloai = $(this).attr("the_loai");
            
            // KIỂM TRA NGỮ CẢNH: 
            // Nếu không ở trang chủ (ví dụ đang ở trang chi tiết), 
            // thì phải chuyển hướng về trang chủ kèm tham số lọc.
            if (window.location.pathname.includes('/chitiet/')) {
                window.location.href = "{{ url('sach') }}?theloai=" + id_theloai;
                return;
            }

            // Nếu đang ở trang chủ, thực hiện Ajax để lọc sách
            $.ajax({
                type: "GET",
                url: "{{ url('sach/filter') }}", // Bạn cần tạo Route này trong web.php
                data: { id: id_theloai },
                success: function(response){
                    // Giả sử vùng hiển thị sách của bạn có class là .list-book
                    $(".list-book").html(response);
                }
            });
        });
    });
</script>
</body>
</html>