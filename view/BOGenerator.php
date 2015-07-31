<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="">
<meta name="author" content="">

<?php include_once 'headerincludes.php';?>


</head>

<body>

	<div id="wrapper">

		<!-- Sidebar -->
		<div id="sidebar-wrapper">
          <?php include_once 'navigation.php';?>
          
        </div>
		<!-- /#sidebar-wrapper -->

		<!-- Page Content -->
		<div id="page-content-wrapper">
			<div class="container-fluid">
				<div class="row">
					<div class="col-lg-12">

						<div class="alert alert-info">
							<strong>Numeracy - ADMIN MENU </strong>
						</div>
						<a href="#menu-toggle" class="btn btn-default" id="menu-toggle">Toggle
							Menu</a>
                        
                           <?php include_once 'BOGeneratorSidebar.php'; ?>
                    </div>
				</div>
			</div>
		</div>

		<div id="page-content-wrapper">
			<div class="container-fluid">
				<div class="row">
					<div class="col-lg-12">
         <?php include_once 'footer.php'; ?>
         
           </div>
				</div>
			</div>
		</div>


	</div>


</body>

</html>
