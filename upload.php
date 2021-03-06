<?php
    include_once('includes/util.php');

    require_authenticated();
?>
<!DOCTYPE html>
<html>
  <head>
    <?php include_once('includes/util.php'); ?>
    <?php include_once('includes/head.php'); ?>
    <script src="/js/upload.js"></script>
  </head>
  <body>
    <div class="container">
      <?php include_once('includes/nav.php'); ?>
      <div id="after-nav"></div>
      <div style="display:flex;justify-content:center;align-items:center;" id="select">
        <div style="width:560px;height:480px;" id="select-inner">
          <form style="display: none" id="form-upload">
            <input type="file" id="file-chooser" name="file">
            <input type="text" id="category-chooser" name="type">
          </form>

          <button class="btn btn-primary" id="select-button" onclick="selectFile()">Select File</button>
          <div class="dropdown" id="type-chooser" style="display: none">
            <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" id="category-button">
              Document Category
              <span class="caret"></span>
            </button>
            <ul id="dropdown-items" class="dropdown-menu" aria-labelledby="dropdownMenu1">
            </ul>
          </div>
          <br/>
          <button class="btn btn-primary" style="display: none" id="upload-button" onclick="doUpload()">Upload!</button>
        </div>
      </div>

      <div class="row marketing">
      </div>

      <footer class="footer">
        <p>&copy; 2015 CDC, Inc.</p>
      </footer>

    </div> <!-- /container -->
  </body>
</html>
