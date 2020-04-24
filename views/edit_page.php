<?php include"inc/header.php"; ?>

	<div class="container">
		<div class="row justify-content-md-center mt-5">
			<div class="col col-md-4 text-center">
				<h1>Tasks</h1>
			</div>

		</div>
	</div>	
	<?php  
	if(!empty($_SESSION['msg']))
	{?>
		<div class="container">
			<div class="row bg-info">
				<div class="col-12 text-center">	
					<h3 class="text-white"><?php echo $_SESSION['msg']; $_SESSION['msg'] = null;?></h3>
				</div>
			</div>
		</div>
	<?php }
	?>
	
	<?php if(isset($data['setTask'])): ?>
	<div class="container mt-5">
		<div class="row">
			<div class="col-md-12">
					
				<form class="form-inline" method="POST">
					<input type="text" name="task" value="<?= $data['setTask']['tasks'];?>" placeholder="Enter your task" class="form-control col-12 text-center">
					<input type="text" name="desc" value="<?= $data['setTask']['description'];?>" placeholder="Enter description" class="form-control col-12 mt-2 text-center">
					<input type="hidden" name="id" value="<?= $data['setTask']['id'];?>">
					<input type="submit" name="update" value="Update" class="btn btn-outline-success text-center col-12 mt-5">
				</form>
					
			</div>
		</div>
	</div>
	<?php endif; ?>

</div>
</body>
</html>