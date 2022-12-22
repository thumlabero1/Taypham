<?php 
	class DONHANG{
		public function themdonhang($nguoidung_id,$diachi_id,$tongtien){
		$db = DATABASE::connect();
		try{
			$sql = "INSERT INTO donhang(nguoidung_id,diachi_id,tongtien) VALUES(:nguoidung_id,:diachi_id,:tongtien)";
			$cmd = $db->prepare($sql);
			$cmd->bindValue(':nguoidung_id',$nguoidung_id);
			$cmd->bindValue(':diachi_id', $diachi_id);
			$cmd->bindValue(':tongtien', $tongtien);
			$cmd->execute();
			$id = $db->lastInsertId();
			return $id;
		}
		catch(PDOException $e){
			$error_message=$e->getMessage();
			echo "<p>Lỗi truy vấn: $error_message</p>";
			exit();
		}
		}
		public function laydonhang(){
        $dbcon = DATABASE::connect();
        try{
            $sql = "SELECT * FROM donhang";
            $cmd = $dbcon->prepare($sql);
            $cmd->execute();
            $result = $cmd->fetchAll();
            rsort($result); // sắp xếp giảm thay cho order by desc
            return $result;
        }
        catch(PDOException $e){
            $error_message = $e->getMessage();
            echo "<p>Lỗi truy vấn: $error_message</p>";
            exit();
        }
    }
    public function laydonhangId($id){
        $dbcon = DATABASE::connect();
        try{
            $sql = "SELECT * FROM donhang Where id=:id";
            $cmd = $dbcon->prepare($sql);
            $cmd->bindValue(':id',$id);
            $cmd->execute();
            $result = $cmd->fetch();  
            return $result;
        }
        catch(PDOException $e){
            $error_message = $e->getMessage();
            echo "<p>Lỗi truy vấn: $error_message</p>";
            exit();
        }
    }
    public function confirm($id){
        $dbcon = DATABASE::connect();
        try{
            $sql = "UPDATE donhang SET ghichu='Da Giao' WHERE id=:id";
            $cmd = $dbcon->prepare($sql);
            $cmd->bindValue(':id',$id);
            return $cmd->execute();
        }
        catch(PDOException $e){
            $error_message = $e->getMessage();
            echo "<p>Lỗi truy vấn: $error_message</p>";
            exit();
        }
    }
	}
?>