<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Notifications\OrderDetailSend;

class BookController extends Controller
{
    // Trang chủ - hiển thị danh sách sách
    public function sach()
    {
        $data = DB::select("select * from sach order by gia_ban asc limit 0,8");
        return view("vidusach.index", compact("data"));
    }

    // Hiển thị sách theo thể loại
    public function theloai($id)
    {
        $data = DB::select("select * from sach where the_loai = ?", [$id]);
        return view("vidusach.index", compact("data"));
    }

    // Chi tiết sách
    public function chitiet($id)
    {
        $data = DB::table('sach')->where('id', $id)->first();
        if (!$data) {
            return "Không tìm thấy sách";
        }
        return view("vidusach.chitiet", compact("data"));
    }

    public function bookview(Request $request)
    {
        $the_loai = $request->input("the_loai");
        $data = [];
        if($the_loai!="")
            $data = DB::select("select * from sach where the_loai = ?",[$the_loai]);
        else
            $data = DB::select("select * from sach order by gia_ban asc limit 0,10");
        return view("vidusach.bookview", compact("data"));
    }


    public function cartadd(Request $request)
    {
        $request->validate([
            "id"=>["required","numeric"],
            "num"=>["required","numeric"]
        ]);
        $id = $request->id;
        $num = $request->num;
        $total = 0;
        $cart = [];
        if(session()->has('cart'))
        {
            $cart = session()->get("cart");
            if(isset($cart[$id]))
                $cart[$id] += $num;
            else
                $cart[$id] = $num ;
        }
        else
        {
            $cart[$id] = $num ;
        }
        session()->put("cart",$cart);
        return count($cart);
    }
    
    public function order()
    {
        $cart = [];
        $data = [];
        $quantity = [];
        if (session()->has('cart')) {
            $cart = session("cart");
            $list_book = "";
            foreach ($cart as $id => $value) {
                $quantity[$id] = $value;
                $list_book .= $id . ", ";
            }
            if(!empty($list_book))
                {
                    $list_book = substr($list_book, 0, strlen($list_book) - 2);
                    $data = [];
                    $data = DB::table("sach")->whereRaw("id in (" . $list_book . ")")->get();
                }
        }

        return view("vidusach.order", compact("quantity", "data"));
    }

    public function cartdelete(Request $request)
    {
        $request->validate([
            "id"=>["required","numeric"]
        ]);
    $id = $request->id;
    $total = 0;
    $cart = [];
    if(session()->has('cart'))
    {
        $cart = session()->get("cart");
        unset($cart[$id]);
    }
    session()->put("cart",$cart);
    return redirect()->route('order');
    }

    public function ordercreate(Request $request)
    {
        $request->validate([
            "hinh_thuc_thanh_toan" => ["required", "numeric"]
        ]);
        $paymentLabels = [
            1 => 'Tiền mặt',
            2 => 'Chuyển khoản',
            3 => 'Thanh toán VNPay'
        ];
        $paymentMethod = $paymentLabels[$request->hinh_thuc_thanh_toan] ?? 'Khác';
        $data = [];
        $quantity = [];
        $emailData = [];
        if (session()->has('cart')) {
            $order = [
                "ngay_dat_hang" => DB::raw("now()"),
                "tinh_trang" => 1,
                "hinh_thuc_thanh_toan" => $request->hinh_thuc_thanh_toan,
                "user_id" => Auth::user()->id
            ];
            DB::transaction(function () use ($order, &$data, &$quantity, &$emailData) {
                $id_don_hang = DB::table("don_hang")->insertGetId($order);
                $cart = session("cart");
                $list_book = "";
                foreach ($cart as $id => $value) {
                    $quantity[$id] = $value;
                    $list_book .= $id . ", ";
                }
                $list_book = substr($list_book, 0, strlen($list_book) - 2);
                $data = DB::table("sach")->whereRaw("id in (" . $list_book . ")")->get();
                $detail = [];
                foreach ($data as $row) {
                    $detail[] = [
                        "ma_don_hang" => $id_don_hang,
                        "sach_id" => $row->id,
                        "so_luong" => $quantity[$row->id],
                        "don_gia" => $row->gia_ban
                    ];
                }
                DB::table("chi_tiet_don_hang")->insert($detail);
                foreach ($data as $row) {
                    $row->so_luong = $quantity[$row->id];
                    $emailData[] = $row;
                }
                session()->forget('cart');
            });

            if (!empty($emailData)) {
                $user = User::find(Auth::id());
                if ($user) {
                    $user->notify(new OrderDetailSend([
                        'items' => $emailData,
                        'customerName' => $user->name,
                        'paymentMethod' => $paymentMethod,
                    ]));
                }
            }
            return redirect()->route('order')
                ->with('success', 'Đơn đặt hàng của bạn thành công, vui lòng kiểm tra Email');
        }

        return redirect()->route('order');
    }



    // Quản lý sách - danh sách
    public function booklist()
    {
        $data = DB::table("sach")->get();
        return view("vidusach.book_list", compact("data"));
    }

    // Quản lý sách - form thêm
    public function bookcreate()
    {
        $the_loai = DB::table("dm_the_loai")->get();
        $action = "add";
        return view("vidusach.book_form", compact("the_loai", "action"));
    }

    // Quản lý sách - xử lý thêm/sửa
    public function booksave($action, Request $request)
    {
        $request->validate([
            'tieu_de' => ['required', 'string', 'max:200'],
            'nha_cung_cap' => ['required', 'string', 'max:50'],
            'nha_xuat_ban' => ['required', 'string', 'max:50'],
            'tac_gia' => ['required', 'string', 'max:50'],
            'hinh_thuc_bia' => ['required', 'string', 'max:50'],
            'gia_ban' => ['required', 'numeric'],
            'the_loai' => ['required', 'max:3'],
            'file_anh_bia' => ['nullable', 'image']
        ]);

        $data = $request->except("_token");

        if ($action == "edit") {
            $data = $request->except("_token", "id");
        }

        if ($request->hasFile("file_anh_bia")) {
            $fileName = $request->input("tieu_de") . "_" . rand(1000000, 9999999) . '.' . $request->file('file_anh_bia')->extension();
            $request->file('file_anh_bia')->storeAs('public/book_image', $fileName);
            $data['file_anh_bia'] = $fileName;
        }

        $message = "";
        if ($action == "add") {
            DB::table("sach")->insert($data);
            $message = "Thêm thành công";
        } else if ($action == "edit") {
            $id = $request->id;
            DB::table("sach")->where("id", $id)->update($data);
            $message = "Cập nhật thành công";
        }

        return redirect()->route('booklist')->with('status', $message);
    }

    // Quản lý sách - form sửa
    public function bookedit($id)
    {
        $action = "edit";
        $the_loai = DB::table("dm_the_loai")->get();
        $sach = DB::table("sach")->where("id", $id)->first();
        return view("vidusach.book_form", compact("the_loai", "action", "sach"));
    }

    // Quản lý sách - xóa
    public function bookdelete(Request $request)
    {
        $id = $request->id;
        DB::table("sach")->where("id", $id)->delete();
        return redirect()->route('booklist')->with('status', "Xóa thành công");
    }

    function testemail()
    {
        $user = User::find(Auth::user()->id);
        $donHang = DB::select("select * from chi_tiet_don_hang c, sach s
                where c.sach_id = s.id
                and c.ma_don_hang = (select max(id) from don_hang where user_id = ?)", [Auth::user()->id]);
        $user->notify(new OrderDetailSend($donHang));
    }
}
?>
