<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Trang quản trị tài khoản</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    
  <script src="https://code.jquery.com/jquery-3.7.1.js" ></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
            integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
            crossorigin="anonymous"></script>
  <script src="https://cdn.datatables.net/2.0.3/js/dataTables.js"></script>
  <script src="https://cdn.datatables.net/2.0.3/js/dataTables.bootstrap4.js"></script>
  <link rel="stylesheet" href="https://cdn.datatables.net/2.0.3/css/dataTables.bootstrap4.css">
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
   
  <!-- Scripts -->

  <style>
    .sidebar {
      position: fixed;
      top: 0;
      bottom: 0;
      left: 0;
      z-index: 100;
      padding: 48px 0 0; /* Height of navbar */
      box-shadow: inset -1px 0 0 rgba(0, 0, 0, .1);
      background-color:#404e68!important
      
    }
    .sidebar a
    {
        color:white!important;
    }
    .navbar {
        
        font-weight:bold;
        margin:0 auto;
        margin-bottom: 20px;
     

    }
    .navbar-nav
    {
        margin:0 auto;
        width:1000px;
        
    }
    .navbar-nav a
    {
        color:black!important;
    }
    .content {
      margin-left: 240px; /* Width of sidebar */
    }
  </style>
</head>
<body>
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <ul class="navbar-nav">
            <li class="nav-item active">
                <a class="nav-link" href="{{url('sach')}}">Trang chủ</a>
            </li>
        </ul>
  </nav>

  <div class="container-fluid">
    <div class="row">
      <nav class="col-md-2 d-none d-md-block  sidebar">
        <div class="sidebar-sticky">
          <ul class="nav flex-column">
            <li class="nav-item">
              <a class="nav-link active" href="{{route('account')}}">
                Thông tin tài khoản
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{route('booklist')}}">
                Quản lý sách
              </a>
            </li>
          </ul>
        </div>
      </nav>

      <main role="main" class="col-md-10 ml-sm-auto col-lg-10 px-md-4 content ">
        <!-- Nội dung trang quản trị -->
            {{$slot}}
      </main>
    </div>
  </div>


 
</body>
</html>
