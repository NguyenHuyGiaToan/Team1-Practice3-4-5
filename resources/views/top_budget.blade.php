<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Danh sách Phim</title>
    <style>
        body { font-family: sans-serif; line-height: 1.6; padding: 20px; }
        .movie-item { margin-bottom: 20px; border-bottom: 1px solid #ccc; padding-bottom: 10px; }
        .movie-name { font-weight: bold; font-size: 1.2em; color: #007bff; }
    </style>
</head>
<body>

    <h1>10 Bộ phim có doanh thu cao nhất</h1>

    @foreach($movies as $movie)
        <div class="movie-item">
            <div class="movie-name">Tên phim: {{ $movie->movie_name }}</div>
            <div>Ngày phát hành: {{ date('d/m/Y', strtotime($movie->release_date)) }}</div>
            <div>Doanh thu: {{ number_format($movie->budget) }} USD</div>
        </div>
    @endforeach

</body>
</html>