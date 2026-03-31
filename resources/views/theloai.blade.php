<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Danh sách thể loại phim</title>
</head>
<body>
    <h2>Danh Sách Thể Loại Phim</h2>

    <ul>
        @foreach($danh_sach_the_loai as $the_loai)
            <li>
                <strong>Tiếng Anh:</strong> {{ $the_loai->genre_name }} | 
                <strong>Tiếng Việt:</strong> {{ $the_loai->genre_name_vn }}
            </li>
        @endforeach
    </ul>

</body>
</html>