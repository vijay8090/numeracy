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
			<!-- <div id="grid1" ui-grid="{ data: myData.gridData }" class="grid"></div> -->
			
			<br>
      <strong>Data Length:</strong> {{ gridOptions.data.length | number }}
      <br>
      <strong>Last Cell Edited:</strong> {{msg.lastCellEdited}}
      
       <button type="button" class="btn btn-success" ng-click="myData.delete()">delete</button>  <span ng-bind="myData.deletemsg"></span>
      
      <button type="button" class="btn btn-success" ng-disabled="!gridApi.grid.options.multiSelect" ng-click="selectAll()">Select All</button>
      <button type="button" class="btn btn-success" ng-click="clearAll()">Clear All</button>
      <br>
			
			<div ui-grid="gridOptions" ui-grid-edit ui-grid-selection ui-grid-cellnav class="grid"></div>
			
		</div>
	</div>

	<script>


	var url =  "../controller/CategoryController.php";

var app = angular.module('myApp', ['ngTouch', 'ui.grid', 'ui.grid.selection','ui.grid.edit', 'ui.grid.cellNav']);

app.controller("categoryCtrl", ['$scope', '$http', '$log', '$timeout', 'uiGridConstants', function($scope, $http) {


			$scope.gridOptions = {  
					 	enableRowSelection: true,
					    enableSelectAll: true,
					    selectionRowHeaderWidth: 35,
					    rowHeight: 35,
					    enableFiltering: true,
					    flatEntityAccess: true,
					    showGridFooter: true,
					    fastWatch: true
					  };
				
			  $scope.gridOptions.enableCellEditOnFocus = true;
			  $scope.gridOptions.multiSelect = true;
			 // $scope.gridApi.selection.setMultiSelect(true);

			  /* function to select all rows */
			  $scope.selectAll = function() {
			      $scope.gridApi.selection.selectAllRows();
			    };

			    /* function to deselect all rows */
			    $scope.clearAll = function() {
			        $scope.gridApi.selection.clearSelectedRows();
			      };
			 
			  $scope.gridOptions.columnDefs = [
			    { name: 'id', displayName: 'S.No', enableCellEdit: false,width: 70  },
			    { name: 'label', displayName: 'CategoryLabel', enableCellEditOnFocus: true, width: 300  },
			    { name: 'startAge', displayName: 'Start Age', enableCellEdit: true, width: 200 },
			    { name: 'endAge', displayName: 'End Age', width: 200},
			    { name: 'gender', displayName: 'Gender', width: 100}
			    
			  ];

			     
		       $scope.msg = {};
		     
		        $scope.gridOptions.onRegisterApi = function(gridApi){
		           $scope.gridApi = gridApi;
		           
		           gridApi.edit.on.afterCellEdit($scope,function(rowEntity, colDef, newValue, oldValue){
		               $scope.msg.lastCellEdited = 'edited row id:' + rowEntity.id + ' Column:' + colDef.name + ' newValue:' + newValue + ' oldValue:' + oldValue ;
		               $scope.msg.updateVal = {};
			              // $scope.msg.updateVal = {'id': rowEntity.id, ''+colDef.name : newValue };
		               $scope.msg.updateVal.id=rowEntity.id;
		               $scope.msg.updateVal[colDef.name]= newValue ;
		              // 
			          	$scope.$apply();
			          	if(newValue != oldValue){
		               $scope.myData.update();
			          	}
		               
		             });


		            gridApi.selection.on.rowSelectionChanged($scope,function(row){
		               var msg = 'row selected ' + row.isSelected;
		               //alert(msg);
		             });
		        
		             gridApi.selection.on.rowSelectionChangedBatch($scope,function(rows){
		               var msg = 'rows changed ' + rows.length;
		              // alert(msg);
		             }); 
		             
		        };
				
	
            $scope.myData = {};

            $scope.myData.intializeForm = function() {

            $scope.master = {category:"Category-", startAge:"6", endAge:"12", gender:"M"};
            $scope.reset = function() {
                $scope.fields = angular.copy($scope.master);
            };
            $scope.reset();
            }

            
            $scope.myData.delete = function() {
            	$scope.myData.deletemsg = "success";
            	angular.forEach($scope.gridApi.selection.getSelectedRows(), function (data, index) {
            	    //$scope.gridOptions.data.splice($scope.gridOptions.data.lastIndexOf(data), 1);
            	    alert(index);
            	  });
            }


            // create new Category
            $scope.myData.update = function(item, event) {

                
            	//alert(  $scope.msg.updateVal.startAge);
            	
            	 var FormData = $scope.msg.updateVal;  

            	FormData.btn_action ="update"; // controller action
            	
                var responsePromise = $http.post(url, FormData);
               
                responsePromise.success(function(response) {       
                	//alert("AJAX success!" +response);
                	 var obj = 	JSON.parse(response);
                     // alert(obj.message);
                     if(obj.message == 'success'){
                    	 $scope.myData.fromServer = obj.message;
                    	// $scope.myData.getAllCategory();
                     } else {
                    	 $scope.myData.fromServer = obj.message;
                     }
                    
                });
                responsePromise.error(function(response) {
                    alert("AJAX failed!" + JSON.stringify(responsePromise));
                }); 
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

            //	alert("getAllCategory!" );
                
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
            	 $scope.gridOptions.data  = obj.data;
            	 
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
            
        } ]);

  </script>

</div>



<?php include_once 'footer.php'; ?>
