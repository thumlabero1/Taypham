<?php 
require("model/database.php");
require("model/danhmuc.php");
require("model/mathang.php");
require("model/giohang.php");
require("model/khachhang.php");
require("model/donhang.php");
require("model/donhangct.php");
require("model/diachi.php");

$dm = new DANHMUC();
$mh = new MATHANG();
$kh = new KHACHHANG();
$dh = new DONHANG();
$dhct = new DONHANGCT();
$dc = new DIACHI();


$danhmuc = $dm->laydanhmuc();

if(isset($_REQUEST["action"])){
    $action = $_REQUEST["action"];
}
else{
    $action="macdinh"; 
}

$mathangnoibat = $mh->laymathangnoibat();

switch($action){
    case "macdinh": 
		$soluong = 4; // mỗi trang hiển thị $soluong mẫu tin
		$tongmathang = $mh->demtongsomathang(); // tổng số mẫu tin hiện có
		$tongsotrang = ceil($tongmathang/$soluong);	// tổng số trang
		if(isset($_REQUEST["trang"]))
			$tranghh = $_REQUEST["trang"];
		else
			$tranghh = 1;
		$batdau = ($tranghh - 1) * $soluong; // mẫu tin bắt đầu sẽ lấy
        $mathang = $mh->laymathangphantrang($batdau, $soluong);
        include("main.php");
        break;
    case "xemnhom": 
        if(isset($_REQUEST["madm"])){
            $madm = $_REQUEST["madm"];
            $dmuc = $dm->laydanhmuctheoid($madm);
            $tendm =  $dmuc["tendanhmuc"];   
            $mathang = $mh->laymathangtheodanhmuc($madm);
            include("group.php");
        }
        else{
            include("main.php");
        }
        break;
    case "xemchitiet": 
        if(isset($_GET["mahang"])){
            $mahang = $_GET["mahang"];
            // tăng lượt xem lên 1
            $mh->tangluotxem($mahang);
            // lấy thông tin chi tiết mặt hàng
            $mhct = $mh->laymathangtheoid($mahang);
            // lấy các mặt hàng cùng danh mục
            $madm = $mhct["danhmuc_id"];
            $mathang = $mh->laymathangtheodanhmuc($madm);
            include("detail.php");
        }
        break;
    case "chovaogio":
		$id = $_REQUEST["id"];
		$soluong = $_REQUEST["soluong"];
		// nếu hàng đã có trong giỏ thì tăng thêm số lượng
		if (kiemtramathang($id)){
			tangsoluong($id, $soluong);
		}
		else{
		// chưa có thì thêm mới
			themhangvaogio($id, $soluong);
		}
		$giohang = laygiohang();
		include("cart.php");
		break;
	case "xemgiohang":		
		$giohang = laygiohang();
		include("cart.php");
		break;
	case "xoagiohang":	
		xoagiohang();
		$giohang = laygiohang();
		include("cart.php");
		break;
	case "capnhatgiohang":	
		if(isset($_REQUEST["mh"])){
			$mh = $_REQUEST["mh"];
			foreach($mh as $mahang=>$soluong){
				if($soluong > 0)
					capnhatsoluong($mahang, $soluong);
				else
					xoamotmathang($mahang);
			}
		}
		$giohang = laygiohang();
		include("cart.php");
		break;
	case "datmua":
		$giohang = laygiohang();
		include("checkout.php");
		break;
	case "luudonhang":
		$email = $_POST["txtemail"];
		$hoten = $_POST["txthoten"];
		$sodienthoai = $_POST["txtsodienthoai"];
		$diachi = $_POST["txtdiachi"];

		$khachang_id = $kh->themkhachhang($email, $sodienthoai, $hoten);

		$diachi_id = $dc->themdiachi($khachang_id,$diachi);

		$tongtien = tinhtiengiohang();
		$donhang_id = $dh->themdonhang($khachang_id,$diachi_id,$tongtien);

		$giohang = laygiohang();

		foreach ($giohang as $mahang => $mh) {
			$dongia = $mh['giaban'];
			$soluong = $mh['soluong'];
			$thanhtien = $mh['sotien'];
			$dhct->themchitietdonhang($donhang_id,$mahang,$dongia,$soluong,$thanhtien);
			$mh = new MATHANG();
			$mh->capnhatsoluong($mahang,$soluong);
		}
		xoagiohang();
		include("thanks.php");
		break;
    default:
        break;
}
?>
