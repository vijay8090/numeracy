


<!DOCTYPE html>
<head>

<meta charset="utf-8">

<title>Dropzone simple example</title>




<link rel="stylesheet" href="../plugin/dropzone/css/dropzone.css" />
<link rel="stylesheet" href="../plugin/dropzone/css/basic.css" />
<script src="../plugin/dropzone/dropzone.js"></script>
<script src="../plugin/dropzone/dropzone-amd-module.js"></script>


</head>

<body>

<p>
  This is the most minimal example of Dropzone. The upload in this example
  doesn't work, because there is no actual server to handle the file upload.
</p>

<!-- Change /upload-target to your upload address -->
<form action="../controller/UploadController.php" class="dropzone"></form>
<?php 
$directory = "C:/wamp/www/numeracy/controller/uploads";

//echo scanDirectoryImages("../controller/uploads");

  //  $directory    = '/home/content/60/10826060/html/qun/new/images/client';
$it = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($directory));
 echo "<div align=left style='padding:20px;'>";
while($it->valid()) {

    if (!$it->isDot()) {
        
			echo "<table> <tr> <td>";
          echo " <img class=clientlogo src='../controller/uploads/".$it->getSubPathName()."' alt='".$it->getSubPathName()."' width='200' height='120' >";
		echo " </td><tr><td>";
		echo " <a href='../controller/uploads/".$it->getSubPathName()."' alt='".$it->getSubPathName()."' >Download </a>";
		//  echo $it->getSubPathName();     
     echo "</td>";
    }

    $it->next();
}
        echo "</div>";
 /*   
for ($i=0; $i<=10; $i++)
  {
  echo "<div>";
  echo "client".$i;
  echo "</div>";
  }*/
?>


</body>

</html>


