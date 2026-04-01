<!DOCTYPE html>
<html>
  <head>
    <title>{{ $title }}</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

    <style>
        .navbar {
            background-color: #ff5850; 
            font-weight:bold;
            display:flex;
            justify-content: space-between;
            align-items: center;
        }
      .nav-item a {
        color: #fff!important;
      }
      .navbar-nav {
        margin:0 auto;
      }
      .list-book{
        display:grid;
        grid-template-columns:repeat(4,24%);
      }
      .book {
        margin:10px;
        text-align:center;
      }
      .book
{
position:relative;
margin:10px;
text-align:center;
padding-bottom:35px;
}
.btn-add-product
{
position:absolute;
bottom:0;
width:100%;
}
    </style>
  </head>
  <body>
    <header style='text-align:center'>
      <img src="{{asset('hinh/banner_sach.jpg')}}" width="1000px">
    </header>
    <main style="width:1000px; margin:2px auto;">
      <div class='row'>
        <div class='col-3 pr-0'>
          <nav class="navbar navbar-light">
            <ul class="navbar-nav">
                <li class="nav-item active">
                <a class="nav-link" href="{{url('sach')}}">Trang chủ</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="{{url('sach/theloai/1')}}">Tiểu thuyết</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="{{url('sach/theloai/2')}}">Truyện ngắn - tản văn</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="{{url('sach/theloai/3')}}">Tác phẩm kinh điển</a>
                </li>
            </ul>

            <div style='color:white;position:relative' class='mr-2'>
              <div style='width:20px; height:20px;background-color:#23b85c; font-size:12px; border:none;
              border-radius:50%; position:absolute;right:2px;top:-2px' id='cart-number-product'>
              @if (session('cart'))
              {{ count(session('cart')) }}
              @else
              0
              @endif
              </div>
              <a href="{{route('order')}}" style='cursor:pointer;color:white;'>
              <i class="fa fa-cart-arrow-down fa-2x mr-2 mt-2" aria-hidden="true"></i>
              </a>
            </div>

          </nav>
          <img src="{{asset('hinh/sidebar_1.jpg')}}" width="100%" class='mt-1'>
          <img src="{{asset('hinh/sidebar_2.jpg')}}" width="100%" class='mt-1'>
        </div>
        <div class='col-9'>
          {{ $slot }}
        </div>
      </div>
    </main>
  </body>
</html>