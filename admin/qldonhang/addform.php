<?php include("../view/top.php"); ?>

<h3>Order Detail</h3> 
<br>
<form method="post">
		<!-- <input type="hidden" name="action" value="luudonhang"> -->
		<div class="form-group">
			<label>Email</label>
			<input type="email" disabled value="<?php echo $khOrder['email']; ?>" class="form-control" name="txtemail" required>
		</div>
		<div class="form-group">
			<label>Họ tên</label>
			<input type="text" disabled value="<?php echo $khOrder['hoten']; ?>" class="form-control" name="txthoten" required>
		</div>
		<div class="form-group">
			<label>Số điện thoại</label>
			<input type="number" disabled value="<?php echo $khOrder['sodienthoai']; ?>" class="form-control" name="txtsodienthoai" required>
		</div>
		<!-- <div class="form-group">
			<label>Địa chỉ</label>
			<textarea class="form-control" disabled value="<?php echo $khOrder['email']; ?>" name="txtdiachi" required></textarea>
		</div> -->
</form>
<div class="col-sm-6">
	<h4>Detail</h4>
		<table class="table table-bordered">
		<tr class="info">
		<th>Id</th>
		<th>Id Order</th>
		<th>Id Product</th>
		<th>Price</th>
		<th>Quantity</th>
		<th>Total</th>
		</tr>
		<?php foreach($donhangct as $id=> $mh): ?>
		<tr>
		<td><?php echo $mh["id"]; ?></td>
		<td><?php echo $mh["donhang_id"]; ?></td>
		<td><?php echo $mh["mathang_id"]; ?></td>
		<td><?php echo number_format($mh["dongia"]) . "đ"; ?></td>
		<td><?php echo $mh["soluong"]; ?></td>
		<td><?php echo number_format($mh["thanhtien"]) . "đ"; ?></td>
		</tr>
		<?php endforeach; ?>
		<tr>	
		</table>
	<div>
	<?php if($donhang['ghichu'] == null): ?>
		<a class="btn btn-danger" href="index.php?action=confirm&id=<?php echo $donhangct[0]['donhang_id']; ?>">Confirm</a>
	<?php endif; ?>
</div>
</div>


<?php include("../view/bottom.php"); ?>
