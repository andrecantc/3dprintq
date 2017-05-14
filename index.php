<?php
   /*
    *index.php 
    * Uses lib/create.php server side script to store customer Details 
    * Uses lib/ReadMe.php to Display current customers in the queue
    * Uses lib/delete.php to remove customer in the queue 
    * Author Ruben Faraj 
    * Email: Reben_f@hotmail.co.uk 
    * Date : 14-05-2017 
    
    */
   include 'config/db_connector.php';
   ?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <!-- SEO -->
      <meta name="description" content=" Council Queue System">
      <meta name="author" content="Ruben Faraj">
      <link rel="icon" href="favicon.ico">
      <title>Queue App System</title>
      <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
      <link href="css/ie10-viewport-bug-workaround.css" rel="stylesheet">
      <link href="css/custom.css" rel="stylesheet">
      <!-- Custom styles for the queue App
         <link href="css/navbar-fixed-top.css" rel="stylesheet"> -->
      <link href="css/site.min.css" rel="stylesheet">
      <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
      <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
      <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
      <![endif]-->
   </head>
   <body onload="startTime()">
      <!--=============Navbars ================= -->
      <div class="navbar">
         <nav class="navbar navbar-default" role="navigation">
            <div class="container-fluid">
               <!-- Brand and toggle get grouped for better mobile display -->
               <div class="navbar-header">
                  <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                  <span class="sr-only">Toggle navigation</span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                  </button>
                  <a class="navbar-brand" href="index.php">Queue App</a>
               </div>
               <!-- Collect the nav links, forms, and other content for toggling -->
               <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                  <ul class="nav navbar-nav">
                     <li class="active"><a href="index.php">HOME</a></li>
                     <li><a href="#">ABOUT</a></li>
                     <li><a href="#">CONTACT</a></li>
                  </ul>
                  <ul class="nav navbar-nav navbar-right">
                     <li class="dropdown active">
                        <a href="#" class="dropdown-toggle glyphicon glyphicon-user" data-toggle="dropdown" role="button" aria-haspopup="true" 
                           aria-expanded="false"> Username<span class="caret"></span></a>
                        <ul class="dropdown-menu">
                           <li><a href="#">Profile</a></li>
                           <li><a href="#">Setting</a></li>
                           <li><a href="#">Edit Account</a></li>
                           <li role="separator" class="divider"></li>
                           <li><a href="#">Logout</a></li>
                        </ul>
                     </li>
                  </ul>
               </div>
               <!-- /.navbar-collapse -->
            </div>
            <!-- /.container-fluid -->
         </nav>
      </div>
      <div class="container">
         <div class="row">
            <div class="col-sm-5">
               <div class="panel panel-info">
                  <div class="panel-heading">
                     <h2 class="panel-title"><strong>Add New Customer To The Queue</strong></h2>
                  </div>
                  <div class="panel-body">
                     <!-- form here where the customer information will be entered -->
                     <form name="myForm" action="lib/create.php" method="post" >
                        <label class="control control--radio">
                           Housing
                           <input type="radio"  value="Housing" name="service" required/>
                           <div class="control__indicator"></div>
                        </label>
                        <label class="control control--radio">
                           Benefits
                           <input type="radio"  value="Benefits" name="service"/>
                           <div class="control__indicator"></div>
                        </label>
                        <label class="control control--radio">
                           Council Tax
                           <input type="radio"  value="Council Tax" name="service"/>
                           <div class="control__indicator"></div>
                        </label>
                        <label class="control control--radio">
                           Fly-tipping
                           <input type="radio"  value="Fly-tipping" name="service"/>
                           <div class="control__indicator"></div>
                        </label>
                        <label class="control control--radio">
                           Missed Bin
                           <input type="radio" value="Missed Bin" name="service"/>
                           <div class="control__indicator"></div>
                        </label>
                        <hr>
                        <label>Citizen</label>
                        <label class="toggle"> 
                        <input type="checkbox" name="type" value="Citizen">
                        <span class="handle"></span>
                        </label>
                        <label>Organisation</label>
                        <label class="toggle"> 
                        <input type="checkbox" name="type" value="Organisation" alt="click">
                        <span class="handle"></span>
                        </label>
                        <label>Anonymous</label>
                        <label class="toggle toggle-success"> 
                        <input type="checkbox" name="type" value="Anonymous" >
                        <span class="handle"></span>
                        </label>
                        <hr>
                        <select name="title" class="btn btn-info" required>
                           <option value="" disabled selected>Select Your Title</option>
                           <option  vlaue="Mr">Mr</option>
                           <option  vlaue="Mrs">Mrs</option>
                           <option  vlaue="Miss">Miss</option>
                           <option  vlaue="Others">Others</option>
                        </select>
                        <br/>
                        <label>Name</label>
                        <input type='text' name='firstname' class='form-control input' placeholder='Customer First Name' required/>
                        <label>LastName</label>
                        <input type='text' name='lastname' class='form-control' placeholder='Customer Last Name' required/>
                        <button type='submit' class='btn btn-info glyphicon glyphicon-floppy-save'> Save </button>
                        <button type='reset' class='btn btn-danger glyphicon glyphicon-remove-sign'> Reset </button>
                     </form><!-- /.form-->
                  </div>
               </div>
            </div><!--/Add new Record  -->

            <!-- Display list Of Customer in the queue  -->
            <div class="col-md-7">
               <div class="panel panel-info">
                  <div class="panel-heading">
                     <strong>
                        <center>List of Customers Been Queued Today 
                          <span id="txt"> </span> <?php echo date("d/m/Y");?> 
                        </center>
                   </strong>
                  </div>
                  <div class="panel-body"> 
                     <?php  
                          //Display All customers in the queue 
                          include('lib/queued-today.php');  
                        
                      ?>
                  </div><!--/.panel-body -->
               </div> <!--/.panel panel-info   -->
            </div><!-- /.col-md-7 -->
          </div> <!--/.row   -->
           
         </div><!-- /container -->

      <!-- Bootstrap core JavaScripts ============= -->
      <!-- pages load faster -->
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
      <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js">
        <\/script>')</script>
      <script src="js/bootstrap.min.js"></script>
      <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
      <script src="js/ie10-viewport-bug-workaround.js"></script>
      <script>
         function startTime() {
          var today = new Date();
          var h = today.getHours();
          var m = today.getMinutes();
          var s = today.getSeconds();
          m = checkTime(m);
          s = checkTime(s);
          document.getElementById('txt').innerHTML =
          h + ":" + m + ":" + s;
          var t = setTimeout(startTime, 500);
         }
         function checkTime(i) {
         if (i < 10) {i = "0" + i};  // add zero in front of numbers < 10
         return i;
         }

         /* control checkbox for type of customers, one type selected at a time */
         $(':checkbox').on('change',function(){
          var th = $(this), name = th.prop('name'); 
          if(th.is(':checked')){
              $(':checkbox[name="'  + name + '"]').not($(this)).prop('checked',false);   
           }
         });
      </script>
   </body>
</html>