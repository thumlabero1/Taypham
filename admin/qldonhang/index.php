<?php 
if(!isset($_SESSION["nguoidung"])){
    header("location:../index.php");
}
require("../../model/database.php");
require("../../model/donhang.php");
require("../../model/donhangct.php");
require("../../model/khachhang.php");
// Xét xem có thao tác nào được chọn
if(isset($_REQUEST["action"])){
    $action = $_REQUEST["action"];
}
else{
    $action="xem";
}

$dh = new DONHANG();
$dhct = new DONHANGCT();
$kh = new KHACHHANG();

switch($action){
    case "xem":
        $donhang = $dh->laydonhang();
		include("main.php");
        break;
	case "view":
		$id = $_GET['id'];

        $donhangct = $dhct->laydonhangct($id);
        $donhang = $dh->laydonhangId($id);
        // print_r($donhang['nguoidung_id']);
        $khOrder= $kh->khachangId($donhang['nguoidung_id']);
        // print_r($khOrder);
		include("addform.php");

        break;  
	case "confirm":	
		
        $id = $_GET['id'];

        $dh->confirm($id);

		$donhang = $dh->laydonhang();
        include("main.php");
        break;
    case "xulysua":
        break;

    default:
        break;
}
?>
