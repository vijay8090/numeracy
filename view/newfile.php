<?php



?>


<head>

    <script src="js/jquery.js"></script>
    <link media="all" type="text/css" rel="stylesheet" href="css/fullscreen.css">
    <link media="all" type="text/css" rel="stylesheet" href="css/login-boot.css">
    <link href="bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src= "js/angular.js"></script>



    <style>



    </style>

    <script type="text/javascript">

$( document ).ready(function() {
    // DOM ready

    // Test data
    /*
     * To test the script you should discomment the function
     * testLocalStorageData and refresh the page. The function
     * will load some test data and the loadProfile
     * will do the changes in the UI
     */
    // testLocalStorageData();
    // Load profile if it exits
    //loadProfile();
});

/**
 * Function that gets the data of the profile in case
 * thar it has already saved in localstorage. Only the
 * UI will be update in case that all data is available
 *
 * A not existing key in localstorage return null
 *
 */
function getLocalProfile(callback){
    var profileImgSrc      = localStorage.getItem("PROFILE_IMG_SRC");
    var profileName        = localStorage.getItem("PROFILE_NAME");
    var profileReAuthEmail = localStorage.getItem("PROFILE_REAUTH_EMAIL");

    if(profileName !== null
            && profileReAuthEmail !== null
            && profileImgSrc !== null) {
        callback(profileImgSrc, profileName, profileReAuthEmail);
    }
}

/**
 * Main function that load the profile if exists
 * in localstorage
 */
function loadProfile() {
    if(!supportsHTML5Storage()) { return false; }
    // we have to provide to the callback the basic
    // information to set the profile
    getLocalProfile(function(profileImgSrc, profileName, profileReAuthEmail) {
        //changes in the UI
        $("#profile-img").attr("src",profileImgSrc);
        $("#profile-name").html(profileName);
        $("#reauth-email").html(profileReAuthEmail);
        $("#inputEmail").hide();
        $("#remember").hide();
    });
}

/**
 * function that checks if the browser supports HTML5
 * local storage
 *
 * @returns {boolean}
 */
function supportsHTML5Storage() {
    try {
        return 'localStorage' in window && window['localStorage'] !== null;
    } catch (e) {
        return false;
    }
}

/**
 * Test data. This data will be safe by the web app
 * in the first successful login of a auth user.
 * To Test the scripts, delete the localstorage data
 * and comment this call.
 *
 * @returns {boolean}
 */
function testLocalStorageData() {
    if(!supportsHTML5Storage()) { return false; }
    localStorage.setItem("PROFILE_IMG_SRC", "images/icon.png" );
    localStorage.setItem("PROFILE_NAME", "adminlogin");
    localStorage.setItem("PROFILE_REAUTH_EMAIL", "admin@vansquare.com");
}

</script>


</head>
<body>
<!--
    you can substitue the span of reauth email for a input with the email and
    include the remember me checkbox
    -->
<div class="container" ng-app="myApp" ng-controller="customersCtrl">
    <div class="card card-container">
        <!-- <img class="profile-img-card" src="//lh3.googleusercontent.com/-6V8xOA6M7BA/AAAAAAAAAAI/AAAAAAAAAAA/rzlHcD0KYwo/photo.jpg?sz=120" alt="" /> -->
        <img id="profile-img" class="profile-img-card" src="images/icon.png" />
        <p id="profile-name" class="profile-name-card"></p>
        <form name="f1" class="form-signin" action="#" method="POST">
            <span id="reauth-email" class="reauth-email"></span>
            <input type="text" name= "username" id="username" class="form-control" placeholder="Email address" required autofocus>
            <input type="password" name= "password"  id="password" class="form-control" placeholder="Password" required>
            <div id="remember" class="checkbox">
                <label>
                    <input type="checkbox" value="remember-me"> Remember me
                </label>
            </div>
            <a href="#" ng-click="add()" class="enviar">Sign in</a>
           <button name="submit" ng-click="add()" class="btn btn-lg btn-primary btn-block btn-signin" >Sign in</button>
            <!--<button name="submit" class="btn btn-lg btn-primary btn-block btn-signin" type="submit">Sign in</button>-->
        </form><!-- /form -->
        <a href="#" class="btn btn-lg btn-primary forgot-password">
            Forgot the password?
        </a>

        <ul>
            {{ loginMsg}}
        </ul>
    </div><!-- /card-container -->
</div><!-- /container -->
<!--<script src="js/loginApp.js"></script>-->

<script>
var app = angular.module('myApp', []);
app.controller('customersCtrl', function($scope, $http) {
 $scope.add = function() {

 alert("test");
  var FormData = {
      'username' : document.f1.username.value,
      'password' : document.f1.password.value
    };

    alert(FormData.username);
     alert(FormData.password);
   var responsePromise = $http.post("http://numeracy.vansquare.com/tempLogin.php",FormData);
  responsePromise.success(function (response) {
   $scope.loginMsg = response.message;
  // alert(response.message.indexOf("Success") > -1);
   if(response.message.indexOf("Success") > -1) {
   window.location = "subtraction.html";
   }
  });

  responsePromise.error(function(response) {
                    alert("AJAX failed!" + JSON.stringify(response));
                });
  }
});
</script>

</body>