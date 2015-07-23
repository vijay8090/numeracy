<?php include_once 'header.php'; ?>


<div class="container">

<p class="btn-info">Manage Category</p>


	<div ng-app="myApp">
	
	
		<div ng-controller="formCtrl">

			<form name="f1" method='post' action="#">

				<table class='table table-bordered table-hover table-striped'>

					<tr>
						<td>Category</td>
						<td><input type='text' name='category' ng-model="user.category"
							class='form-control' required></td>
					</tr>

					<tr>
						<td>Start Age</td>
						<td><input type='text' name='startAge' ng-model="user.startAge"
							class='form-control' required></td>
					</tr>

					<tr>
						<td>End Age</td>
						<td><input type='text' name='endAge' ng-model="user.endAge"
							class='form-control' required></td>
					</tr>

					<tr>
						<td colspan="2">
							<!-- <button type="submit" class="btn btn-large btn-primary" name="btn-save">
								<span class="glyphicon glyphicon-plus"></span> Create New Record
							</button>  -->

							<br> <br>
							<button class="btn btn-large btn-primary" ng-click="reset()">RESET</button>
						</td>
					</tr>
				</table>
			</form>
			
		</div>

		<div ng-controller = "categoryCtrl">
		
			<button class="btn btn-large btn-primary" ng-click="myData.createNew(item, $event)">Create New</button>
			<a href="index.php" class="btn btn-large btn-success">
			<i class="glyphicon glyphicon-backward"></i> &nbsp; Back to index</a>
			<br /> Data from server: {{myData.fromServer}}
			
			<div id="grid1" ui-grid="{ data: myData.gridData }" class="grid"></div>	
			
		</div>
		
	</div>
	
	<script>

	//var baseurl = "http://localhost/pilot/";

	var url =  baseurl+"controller/CategoryController.php";

var app = angular.module('myApp', ['ngTouch', 'ui.grid']);
  
app.controller('formCtrl', function($scope) {
        $scope.master = {category:"Category", startAge:"6", endAge:"12"};
        $scope.reset = function() {
            $scope.user = angular.copy($scope.master);
        };
        $scope.reset();
    });

app.controller("categoryCtrl", function($scope, $http) {
            $scope.myData = {};
            $scope.myData.createNew = function(item, event) {
               // alert("doClick");
            	var FormData = {
          		      'category' : document.f1.category.value,
          		      'startAge' : document.f1.startAge.value,
          		      'endAge' : document.f1.endAge.value,
            		  'btn_action' : 'save'
          		    };

      		   // alert(FormData);

                var responsePromise = $http.post(url, FormData);

                responsePromise.success(function(response) {
               	// alert("AJAX success!" + response.message);
                    $scope.myData.fromServer = response.message;
                    $scope.myData.getAllCategory();
                });
                responsePromise.error(function(response) {
                    alert("AJAX failed!" + response.message);
                });
            }


            $scope.myData.getAllCategory = function() {
                
        	var FormData = {
          		  'btn_action' : 'getAllCategory'
        		    };

      		   // alert(FormData);

              var responsePromise = $http.post(url, FormData);

              responsePromise.success(function(response) {
             	// alert("AJAX success!" + JSON.stringify(response));
             //	 alert("AJAX success!" );

             	 
             var obj = 	JSON.parse(response);
            // alert(obj.message);
            // alert(obj.data);
             $scope.myData.gridData = obj.data;

                  //$scope.myData.fromServer = response.id;
              });
              
              responsePromise.error(function(response) {
                  alert("AJAX failed!" + response);
              });

           }

            $scope.myData.getAllCategory();
            
        } );

  </script>

</div>



<?php include_once 'footer.php'; ?>
