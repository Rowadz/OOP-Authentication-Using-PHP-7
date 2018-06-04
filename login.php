<!DOCTYPE html>
<?php session_start(); ?>
<html>
   <head>
      <title>Login</title>
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/css/materialize.min.css">
      <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      <link rel="stylesheet" type="text/css" href="css/login.css">
   </head>
   <body class="grey darken-4 white-text flow-text ">
      <div class="valign-wrapper" style="width:100%;height:100%;position: absolute;">
         <div class="valign" style="width:100%;">
            <div class="container">
               <div class="row">
                  <div class="col s12 m6 ">
                     <?php if (isset($_SESSION["wrongCredentials"])): ?>
                     <div class="card red darken-1">
                        <div class="card-content white-text">
                           <span class="card-title">Error</span>
                           <p>wrong Credentials</p>
                        </div>
                     </div>
                     <?php endif ?>
                     <?php if (isset($_SESSION["email"])): ?>
                     <div class="card red darken-1">
                        <div class="card-content white-text">
                           <span class="card-title">Error</span>
                           <p>Empty Email</p>
                        </div>
                     </div>                        
                     <?php endif ?>
                     <?php if (isset($_SESSION["password"])): ?>
                     <div class="card red darken-1">
                        <div class="card-content white-text">
                           <span class="card-title">Error</span>
                           <p>Empty password</p>
                        </div>
                     </div>                        
                     <?php endif ?>
                     <?php if (isset($_SESSION["invalidEmail"])): ?>
                     <div class="card red darken-1">
                        <div class="card-content white-text">
                           <span class="card-title">Error</span>
                           <p>invalid Email</p>
                        </div>
                     </div>                        
                     <?php endif ?>
                     <?php if(isset($_SESSION["connection_error"])): ?>
                     <div class="card red darken-1">
                        <div class="card-content white-text">
                           <span class="card-title">Error</span>
                           <p>Can't connect with the server right now</p>
                        </div>
                     </div>
                     <?php endif ?>
                  </div>
                  <div class="col s12 m6 ">
                     <div class="card grey darken-4 z-depth-5">
                        <div class="card-content">
                           <span class="card-title white-text"><b>Login</b></span>
                           <a class="btn-floating btn-large waves-effect waves-light grey darken-3 right"
                              href="#!"><i class="material-icons">arrow_back</i></a>
                           <form id="loginForm" action="php/loginUtl.php" method="POST">
                              <div class="row">
                                 <div class="input-field col s12">
                                    <input 
                                       id="email"
                                       name="email"
                                       type="email"
                                       class="validate"
                                       required
                                       placeholder="Me@website.com"
                                       >
                                    <label for="email" class="active white-text">E-mail</label>
                                 </div>
                              </div>
                              <div class="row">
                                 <div class="input-field col s12">
                                    <input 
                                       id="password"
                                       name="password"
                                       type="password" 
                                       class="validate" 
                                       required
                                       placeholder="Enter your password here"
                                       >
                                    <label for="password" class="active white-text">Password</label>
                                 </div>
                              </div>
                           </form>
                        </div>
                        <div class="card-action">
                           <button type="button" onclick="submit(1)" class="btn  grey darken-2 waves-effect waves-light z-depth-5"> Login</button>
                           <a href="SignUp.php" class="btn right  grey darken-2 waves-effect waves-light z-depth-5" 
                              style="outline: none !important"> SignUp</a>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <script
         src="https://code.jquery.com/jquery-3.3.1.min.js"
         integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
         crossorigin="anonymous"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/js/materialize.min.js"></script>
      <script src="js/main.js"></script>
   </body>
</html>