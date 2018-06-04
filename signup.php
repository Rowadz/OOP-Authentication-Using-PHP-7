<!DOCTYPE html>
<?php include_once("php/signupUtl.php");  ?>
<html>
   <head>
      <title>SignUp</title>
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/css/materialize.min.css">
      <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.2.0/aos.css">
      <link rel="stylesheet" type="text/css" href="css/signup.css">
   </head>
   <body class="grey darken-4 white-text flow-text ">
      <div class="valign-wrapper SignUpOnSmall">
         <div class="valign" style="width:100%;">
            <div class="container">
               <div class="row">
                  <!-- ERRORS -->
                  <div class="col s12 m6 ">
                     <?php if (isset($_SESSION["errors"])): ?>
                        
                     
                     <div class="card red darken-1">
                        <div class="card-content white-text">
                           <span class="card-title">Error(s)</span>
                           <!-- Error Options -->
                           <?php if (isset($_SESSION["name"])): ?>
                              <p>The name is Empty</p>
                           <?php endif ?>
                           <?php if (isset($_SESSION["email"])): ?>
                              <p>The email is Empty</p>
                           <?php endif ?>
                           <?php if (isset($_SESSION["password"])): ?>
                              <p>The password is Empty</p>
                              <?php endif ?>
                           <?php if (isset($_SESSION["invalidPassword"])): ?>
                              <p>The password does not match</p>
                              <?php endif ?>
                           <?php if (isset($_SESSION["invalidEmail"])): ?>
                              <p>The Email is not valied</p>
                           <?php endif ?>
                           <?php if (isset($_SESSION["notUniqueName"])): ?>
                              <p>The Name  is not unique</p>
                           <?php endif ?>
                           <?php if (isset($_SESSION["passwordMinError"])): ?>
                              <p>The password is shorter than 6 characters</p>
                           <?php endif ?>
                           <?php if (isset($_SESSION["passwordMaxError"])): ?>
                              <p>The password is longer than 20 characters</p>
                           <?php endif ?>
                           <?php if (isset($_SESSION["userExist"])): ?>
                              <p>The user already exist in our database</p>
                           <?php endif ?>

                        </div>
                     </div>
                     <?php endif ?>
                  </div>
                  <div class="col s12 m6 ">
                     <div class="card grey darken-4 z-depth-5">
                        <div class="card-content">
                           <span class="card-title white-text"><b>SignUp
                           </b></span>
                           <a class="btn-floating btn-large waves-effect waves-light grey darken-3 right"
                              href="../index.html"><i class="material-icons">arrow_back</i></a>
                           <form id="signupForm" action="php/signupUtl.php" method="POST">
                              <div class="row">
                                 <div class="input-field col s12">
                                    <input 
                                       id="Name" 
                                       name="name"
                                       type="text" 
                                       class="validate" 
                                       required 
                                       placeholder="Should be unique"
                                       autofocus 
                                       value=<?php echo oldValue("name") ? oldValue("name") : null ?> 
                                       >
                                    <label for="Name" class="active white-text">Name</label>
                                 </div>
                              </div>
                              <div class="row">
                                 <div class="input-field col s12">
                                    <input 
                                       id="email"
                                       name="email"
                                       type="email"
                                       class="validate"
                                       required 
                                       placeholder="Me@website.com"
                                       value=<?php echo oldValue("email") ? oldValue("email") : null ?> 
                                       >
                                    <label for="email" class="active white-text">email</label>
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
                                       placeholder="6 or more characters"
                                       >
                                    <label for="password" class="active white-text">password</label>
                                 </div>
                              </div>
                              <div class="row">
                                 <div class="input-field col s12">
                                    <input 
                                       id="confirmPassword"
                                       name="confirmPassword" 
                                       type="password"
                                       class="validate"
                                       required 
                                       placeholder="confirm Password"
                                       >
                                    <label for="confirmPassword" class="active white-text">Confirm Password</label>
                                 </div>
                              </div>
                           </form>
                        </div>
                        <div class="card-action">
                           <a href="Login.php" class="btn  grey darken-2 waves-effect waves-light z-depth-5" 
                              style="outline: none !important"> Login</a>
                           <button type="button" 
                              onclick="submit(2)" 
                              class="btn right  grey darken-1 waves-effect waves-light z-depth-5"
                              style="outline: none !important">
                           SignUp
                           </button>
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