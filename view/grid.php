<!doctype html>

<?php include_once 'header.php'; ?>

<html >
<head>
<!--
 <script
	src="http://ajax.googleapis.com/ajax/libs/angularjs/1.3.16/angular.js"></script>
	
<script
	src="http://ajax.googleapis.com/ajax/libs/angularjs/1.3.16/angular-touch.js"></script>
	
<script
	src="http://ajax.googleapis.com/ajax/libs/angularjs/1.3.16/angular-animate.js"></script>
	
	-->
	<!--
<script src="http://ui-grid.info/docs/grunt-scripts/csv.js"></script>
<script src="http://ui-grid.info/docs/grunt-scripts/pdfmake.js"></script>
<script src="http://ui-grid.info/docs/grunt-scripts/vfs_fonts.js"></script> 
-->
<style>
.grid {
/*	width: 960px;
	height:500px;*/
}
</style>
</head>
<body>
<div class="container">

<div ng-app="myApp">

	<div ng-controller = "categoryGridCtrl">
		<div id="grid1" ui-grid="{ data: myData }" class="grid"></div>
			<button class="btn btn-large btn-primary" ng-click="myData.doClick(item, $event)">Refresh</button>
			<a href="index.php" class="btn btn-large btn-success">
			<i class="glyphicon glyphicon-backward"></i> &nbsp; Back to index</a>
			<br /> Data from server: {{myData.fromServer}}
	</div>
</div>
</div>
	<script>

	var app = angular.module('myApp', ['ngTouch', 'ui.grid']);

	app.controller("categoryGridCtrl", function($scope, $http) {
        $scope.myData = {};
      //  $scope.myData.doClick = function(item, event) {
           // alert("doClick");
        	var FormData = {
        		  'btn_action' : 'getAllCategory'
      		    };

  		   // alert(FormData);

            var responsePromise = $http.post("http://localhost/vijay/controller/CategoryController.php", FormData);

            responsePromise.success(function(response) {
           	// alert("AJAX success!" + JSON.stringify(response));
           //	 alert("AJAX success!" );

           	 
           var obj = 	JSON.parse(response);
          // alert(obj.message);
          // alert(obj.data);
           $scope.myData = obj.data;
                //$scope.myData.fromServer = response.id;
            });
            responsePromise.error(function(response) {
                alert("AJAX failed!" + response);
            });
      //  }
            
    } );

	

    
   /* 
    app.controller('MainCtrl', ['$scope', function ($scope) {
     
      $scope.myData = [
        {
            "firstName": "Cox",
            "lastName": "Carney",
            "company": "Enormo",
            "employed": true
        },
        {
            "firstName": "Lorraine",
            "lastName": "Wise",
            "company": "Comveyer",
            "employed": false
        },
        {
            "firstName": "Nancy",
            "lastName": "Waters",
            "company": "Fuelton",
            "employed": false
        }
    ];
    }]);*/
    </script>
</body>
</html>

<?php include_once 'footer.php'; ?>

