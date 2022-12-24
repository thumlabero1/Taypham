<?php include("../view/top.php"); ?>

<h3>Order Manager</h3> 
<br>
<br> <br> 
<table class="table table-hover">
	<tr>
		<th>Id</th>
		<th>Id customer</th>
		<th>Address</th>
		<th>Date</th>		
		<th>Total</th>
		<th>Status</th>
		<th>View</th>
	</tr>
	<?php
	foreach($donhang as $m):
	?>
	<tr>
		<td><?php echo $m["id"]; ?></td>
		<td><?php echo $m["nguoidung_id"]; ?></td>
		<td><?php echo $m["diachi_id"]; ?></td>
		<td><?php echo $m["ngay"]; ?></td>
		<td><?php echo $m["tongtien"]; ?></td>	
		<td>
		<?php if ($m["ghichu"] == null)  :?>
			Chua Giao
		<?php else:?>
			Da giao
		<?php endif; ?>	
		</td>
		<td><a class="btn btn-danger" href="index.php?action=view&id=<?php echo $m["id"]; ?>"><span class="glyphicon glyphicon-trash"></span></a></td>
	</tr>
	<?php
	endforeach;
	?>
</table>

<?php include("../view/bottom.php"); ?>
