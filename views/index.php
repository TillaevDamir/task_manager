<?php include"inc/header.php"; ?>

	<div class="container">
		<div class="row justify-content-md-center mt-5">
			<div class="col col-md-4 text-center">
				<h1>Tasks</h1>
			</div>

		</div>
	</div>	

	<div class="container">
		<div class="row">
			<div class="col-md-12 text-center">
				<form class="form-inline" method="POST">
					<input type="text" name="task" placeholder="Enter your task" class="form-control col-md-4 border-0 text-center">
					<div class="col-1"></div>
					<input type="text" name="desc" placeholder="Enter description" class="form-control col-md-5 border-0 text-center">
					
					<input type="submit" name="save" value="Save" class="btn btn-outline-success text-center col-2">
					</form>
				</form>
			</div>
		</div>
	</div>

	<?php  
	if(!empty($_SESSION['msg']))
	{?>
		<div class="container">
			<div class="row bg-info">
				<div class="col-12 text-center bg-success">	
					<h3 class="text-white"><?php echo $_SESSION['msg']; $_SESSION['msg'] = null;?></h3>
				</div>
			</div>
		</div>
	<?php }
	if(!empty($_SESSION['err'])):
	?>
	<div class="container">
		<div class="row bg-info">
			<div class="col-12 text-center bg-danger">	
				<h3 class="text-white"><?php echo $_SESSION['err']; $_SESSION['err'] = null;?></h3>
			</div>
		</div>
	</div>
	<?php endif;?>

	<?php if(isset($data['tasks'])): ?>

	<div class="container mt-3">
		<table class="table table-hover text-center">
			<thead>
				<tr>
					<th>#</th>
					<th style="width: 25%">Task</th>
					<th >Description</th>
					<th >Date</th>
					<th >Action</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach($data['tasks'] as $k=>$tasks): 
					$k++;?>
				<tr>
					<th scope="row"><?= $k;?></th>
					<td><?= $tasks['tasks'];?></td>
					<td><?= $tasks['description'];?></td>
					<td><?= $tasks['created_at'];?></td>
					<td>
					<form method="POST">
						<input type="hidden" name="id" value="<?= $tasks['id'];?>">
						<input type="submit" name="edit" value="Edit" class="btn btn-outline-success">
						<input type="submit" name="delete" value="Delete" class="btn btn-outline-danger">

					</form>
					</td>
				</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
	</div>

<?php endif; ?>
<div class="container">
	<div class="row justify-content-md-center ">
		<nav aria-label="...">
		  <ul class="pagination pagination-sm">
		  	<?php $prev = $page - 1; ?>
		  	<li class="page-item <?php if($page == 1) echo "disabled"; ?>">
		        <a class="page-link" href="?page=<?= $prev; ?>">Previous</a>
		    </li>
			<?php 
				if($total < 5) foreach(range(1, $total) as $p) echo $pag = '<li class="page-item"><a class="page-link" href="?page='.$p.'">'.$p.'</a></li>';
				if($total > 4 && $page < 5) foreach(range(1, 5) as $p) echo $pag = '<li class="page-item"><a class="page-link" href="?page='.$p.'">'.$p.'</a></li>';
				if($total - 5 < 5 && $page > 5 && $total -5 > 0 ) foreach(range($total-4, $total) as $p) echo $pag = '<li class="page-item"><a class="page-link" href="?page='.$p.'">'.$p.'</a></li>';
				if($total > 4 && $total - 5 < 5 && $page == 5) foreach(range($page-2, $total) as $p) echo $pag = '<li class="page-item"><a class="page-link" href="?page='.$p.'">'.$p.'</a></li>';
				if($total > 4 && $total - 5 < 5 && $page >= 5 && $page <= $total - 4) foreach(range($page-2, $page+2) as $p) echo $pag = '<li class="page-item"><a class="page-link" href="?page='.$p.'">'.$p.'</a></li>';
				if($total > 4 && $total -5 > 5 && $page > $total - 4) foreach(range($total-4, $total) as $p) echo $pag = '<li class="page-item"><a class="page-link" href="?page='.$p.'">'.$p.'</a></li>';
			?>
		    
		
		<?php $next = $page + 1; ?>
			<li class="page-item <?php if($page == $total) echo "disabled"; ?>">
		      <a class="page-link" href="?page=<?= $next; ?>">Next</a>
		    </li>
		  </ul>
		</nav>
	</div>
</div>
</body>
</html>