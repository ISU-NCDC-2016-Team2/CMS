<?php

# CSRF Protection

?>

<html>
  <head>
    <?php include('includes/util.php'); ?>
    <?php include('includes/head.php'); ?>
    <script src="<?php echo($base."/js/index.js"); ?>"></script>
  </head>
  <body>
    <div class="container">
      <?php include('includes/nav.php'); ?>
      <div id="after-nav"></div>

      <div class="jumbotron">
        <h1>Document Management System</h1>
        <p class="lead">
          This is the CDC Document Management System. Per 47 CFR 97.113, unauthorized access
          to critical systems is PROHIBITED. Leave IMMEDIATELY if unauthorized.
        </p>
        <p>
          Select a document category below to view or download files. Use the navigation options
          above to upload a new file or adjust category/user settings.
        </p>
      </div>

	<div style="display:flex;justify-content:center;align-items:center;" id="login">
	  <div style="width:560px;height:480px;" id="login-inner">
		  Username:<input type="text" id="username"><br/>
		  Password:<input type="password" id="password"><br/>
		  <button class="btn btn-primary" onclick="doLogin()">Log In</button>
          </div>
	</div>

      <div class="row marketing">
	<div class="col-lg-6" id="left-list"></div>
        <div class="col-lg-6" id="right-list"></div>
      <hr/>

      <footer class="footer">
        <p>&copy; 2015 CDC, Inc.</p>
        <p>For technical support, contact 232-7331.<p>
      </footer>

    </div> <!-- /container -->
  </body>
</html>
