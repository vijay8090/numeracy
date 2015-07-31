
<?php include_once 'header.php'; ?>


<div class="container">
	<a href="manageCategory.php" class="btn btn-large btn-info"><i
		class="glyphicon glyphicon-plus"></i> &nbsp; Add Records</a>
</div>

<div class="clearfix"></div>
<br />

<div class="container">
	<table class='table table-bordered table-responsive'>
		<tr>
			<th>#</th>
			<th>Category</th>
			<th>Start Age</th>
			<th>End Age</th>
			<th>Gender</th>
			<th colspan="2" align="center">Actions</th>
		</tr>
		<?php
			
		//use com\vijay\util\DbUtil ;
		require_once('../util/DbUtil.php');

		$pdo = DbUtil::connect();

		$sql = "SELECT M02CATEGORYID as id, label,startage,endage,gender FROM M02_CATEGORY";
			
		$values= $pdo->query($sql) ;
			
		if (is_array($values) || is_object($values))
		{

			foreach ($values as $row) {
		?>

		<tr>
			<td><?php print($row['id']); ?></td>
			<td><?php print($row['label']); ?></td>
			<td><?php print($row['startage']); ?></td>
			<td><?php print($row['endage']); ?></td>
			<td><?php print($row['gender']); ?></td>
		</tr>

		<?php
	}
		}

		DbUtil::disconnect();

		?>


		<tr>
			<td colspan="7" align="center">
				<div class="pagination-wrap">
					<?php //$crud->paginglink($query,$records_per_page); ?>
				</div>
			</td>
		</tr>

	</table>


</div>

<?php include_once 'footer.php'; ?>
