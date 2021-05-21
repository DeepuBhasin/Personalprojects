<?php
include '__database.php';
session_start();
if(!isset($_SESSION['imageName']) && !isset($_SESSION['teacherId']))
{
    header('location:index.php?status=error&message=Access Denied');
}
include 'header.php';
?>

    <div class="container">
      <br/>
        <div class="row">
          <h1 class="text-primary">Select Template</h1>
        </div>
        <div class="row">
        <?php 
        $c=0;
        $sql = "SELECT id,nameImage,headerName FROM  imageTemplates ORDER BY id ASC";
        $result = mysqli_query($conn,$sql);
        while($row = mysqli_fetch_assoc($result))
        {  
        ?>
          <div class="col-sm-3">
            <div class="card bg-light mb-3" style="max-width: 20rem;">
             <div class="card-header">Template <?= ++$c;?></div>
              <div class="card-body">
                <h4 class="card-title"><?= $row['headerName']?></h4>
                  <img src="images/templates/<?= $row['nameImage']?>" alt="" class="img-responsive img-thumbnail">
                  <div class="form-group">
                    <a class="btn btn-primary btn-block showButton" data-toggle="modal" data-id="<?= $row['nameImage'];?>" href="#modal-id" data-class="<?= $row['headerName']?>" data-value="<?= $row['id']?>">Preview</a>
                    
                  </div>
               </div>
            </div>
          </div>
         <?php }?> 
           
        </div>
        <div class="modal fade" id="modal-id">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Template Preview</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <p>Are you sure you want to select this <strong> <span id="showTemplate"></span></strong> ? </p>
                <img src="" id="previewImageTab" class="img-responsive img-thumbnail" style="width: 70%;">
              </div>
              <div class="modal-footer">
              <form action="mergePhoto.php" method="post">
                <input type="hidden" value="" name="templateId" id="templateIdHidden">
                <button type="submit" class="btn btn-success" name="select">Select</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
              </form>  
              </div>
            </div>
          </div>
        </div>
      </div>  
  <script src="public/js/jquery.js"></script>
  <script src="public/js/bootstrap.bundle.min.js"></script>
  <script src="public/js/custom.js"></script>
  <script type="text/javascript">
  $(".showButton").on('click',function(){
      var imageName = 'images/templates/' + $(this).data('id'); 
      var templateName = $(this).data('class');
      var templateId = $(this).data('value');
      document.getElementById('templateIdHidden').setAttribute('value',templateId);
      document.getElementById('previewImageTab').setAttribute("src",imageName);
      document.getElementById('showTemplate').innerHTML=templateName;
    $('#modal-id').show();
   });
  </script>
  </body>
</html>

 <?php

?>