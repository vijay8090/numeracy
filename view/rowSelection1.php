
<?php include_once 'header.php'; ?>
<!DOCTYPE html>
<html ng-app="app">

  <head>
   
  <style>
    
    .grid {
  width: 100%;
  height: 450px;
}
    
    
    </style>
  </head>

  <body>
    <div ng-controller="MainCtrl">
      <div id="grid1" ui-grid="gridOptions" ui-grid-selection class="grid"></div>
    </div>
    <script src="app.js"></script>
  </body>

</html>

