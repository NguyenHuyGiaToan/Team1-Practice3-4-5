<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Top 10 Phim Hay Nhất</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="card shadow">
        <div class="card-header bg-danger text-white">
            <h3 class="mb-0 text-center">BẢNG XẾP HẠNG 10 BỘ PHIM CÓ ĐIỂM CAO NHẤT</h3>
        </div>
        <div class="card-body">
            <table class="table table-hover table-striped border">
                <thead class="table-dark text-center">
                    <tr>
                        <th>Hạng</th>
                        <th>Tên bộ phim</th>
                        <th>Ngày phát hành</th>
                        <th>Điểm bình chọn</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($ds_phim as $index => $phim)
                    <tr>
                        <td class="text-center fw-bold">{{ $index + 1 }}</td>
                        <td class="fw-bold">{{ $phim->movie_name }}</td>
                        <td class="text-center">
                            {{-- Định dạng ngày tháng năm cho dễ nhìn --}}
                            {{ date('d/m/Y', strtotime($phim->release_date)) }}
                        </td>
                        <td class="text-center">
                            <span class="badge bg-warning text-dark fs-6">
                                {{ $phim->vote_average }} ★
                            </span>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-footer text-muted text-center">
            Dữ liệu cập nhật mới nhất từ hệ thống
        </div>
    </div>
</div>

</body>
</html>