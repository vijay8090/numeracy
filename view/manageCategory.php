<?php include_once 'header.php'; ?>


<div class="container">

	<p class="btn-info">Manage Category</p>
	<div ng-app="myApp">
		<div ng-controller="categoryCtrl">

			<form name="f1" method='post' action="#">

				<table class='table table-bordered table-hover table-striped'>

					<tr>
						<td>Category</td>
						<td><input type='text' name='category' ng-model="fields.category"
							class='form-control' required></td>
					</tr>

					<tr>
						<td>Start Age</td>
						<td><input type='text' name='startAge' ng-model="fields.startAge"
							class='form-control' required></td>
					</tr>

					<tr>
						<td>End Age</td>
						<td><input type='text' name='endAge' ng-model="fields.endAge"
							class='form-control' required></td>
					</tr>
					
					<tr>
					<td>Gender</td>
						<td>
							<div class="radio" class='form-control' required>
								<label> <input type="radio" name="gender" ng-model="fields.gender"
									id="gender" value="M" checked="checked" > Male
								</label>
							</div>
							<div class="radio" class='form-control' required>
								<label> <input type="radio" name="gender" ng-model="fields.gender"
									id="gender" value="F"> Female
								</label>
							</div></td>
					</tr>
					
				</table>
			</form>
			
			<button class="btn btn-lg btn-primary" ng-click="reset()">Reset</button>
			
			<button class="btn btn-lg btn-primary"
								ng-click="myData.createNew(item, $event)">Save</button> <a
							href="index.php" class="btn btn-lg btn-success"> <i
								class="glyphicon glyphicon-backward"></i> &nbsp; Home
						</a>&nbsp;&nbsp; Response from server: {{myData.fromServer}}
			<p class="btn-info">All Categories</p>
			<div id="grid1" ui-grid="{ data: myData.gridData }" class="grid"></div>
		</div>
	</div>

	<script>


	var url =  "../controller/CategoryController.php";

var app = angular.module('myApp', ['ngTouch', 'ui.grid']);

app.controller("categoryCtrl", function($scope, $http) {
	
            $scope.myData = {};

            $scope.myData.intializeForm = function() {

            $scope.master = {category:"Category-", startAge:"6", endAge:"12", gender:"M"};
            $scope.reset = function() {
                $scope.fields = angular.copy($scope.master);
            };
            $scope.reset();
            }

            // create new Category
            $scope.myData.createNew = function(item, event) {

            	var FormData = $scope.fields;  

            	FormData.btn_action ="save"; // controller action
            	
                var responsePromise = $http.post(url, FormData);
               
                responsePromise.success(function(response) {       

                	 var obj = 	JSON.parse(response);
                    // alert(obj.message);
                     if(obj.message == 'success'){
                    	 $scope.myData.fromServer = obj.message;
                    	 $scope.myData.getAllCategory();
                     } else {
                    	 $scope.myData.fromServer = obj.message;
                     }
                    
                });
                responsePromise.error(function(response) {
                    alert("AJAX failed!" + JSON.stringify(responsePromise));
                });
            }

            // Get All Category
            $scope.myData.getAllCategory = function() {

            	//alert("getAllCategory!" );
                
        	var FormData = {
          		  'btn_action' : 'getAllCategory'
            };
		    
            var responsePromise = $http.post(url, FormData);

            responsePromise.success(function(response) {
             //	 alert("AJAX success!" + JSON.stringify(response));
             //	 alert("AJAX success!" );
             var obj = 	JSON.parse(response);
            // alert(obj.message);
             if(obj.message == 'success'){
         	     $scope.myData.gridData = obj.data;
             } else {
            	 $scope.myData.fromServer = obj.message;
             }
              });
              
              responsePromise.error(function(response) {
                  alert("AJAX failed!" + response);
              });

           }

            // call form intializer after the page load
            $scope.myData.intializeForm();
            // call form get All Category after the page load
            $scope.myData.getAllCategory();
            
        } );

  </script>

</div>



<?php include_once 'footer.php'; ?>
