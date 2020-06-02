<?php
require_once('inc/config.php');


if(isset($_POST['fileSubmit'])){

    $path = "user_uploads/"; //file to place within the server
    $allowed_files = array("mp3","wav");
    $fileFullname = $_FILES['fileToUpload']['name'];//full file name (ex: Pop Smoke - Dior.mp3)
    $fileSize = $_FILES['fileToUpload']['size'];;//file size
    $fileSizeBytes = number_format($fileSize / 1048576, 2) . ' MB'; //file size in MB


    function getRandomID(){
      global $con;
      $values = 'abcdefghijklmnopqrstuvwxyz01234567891011121314151617181920212223242526';
      $shuffled = str_shuffle($values);
      $shuffled = substr($shuffled,1,50);
      $assigned_url = strtoupper($shuffled);

      return $assigned_url;
  
  
  
  
  }
  

  $uniqueURL = getRandomID();
  $uploader_ip = $_SERVER['REMOTE_ADDR'];
  

  //get ready to save to server
  $newFile = time().'_'.$_FILES['fileToUpload']['name'];

  $target = 'user_uploads/' . $newFile;


  if(move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $target)){
    //upload to server was success

    //upload to database
    $uploadFileQuery = mysqli_query($con, "INSERT INTO wi_uploads (file_fullname,file_uniqueurl,file_size,file_downloadcount,file_removed,file_uploadip,file_location)
    VALUES('$fileFullname','$uniqueURL','$fileSizeBytes','0','0','$uploader_ip','$target')");
    

    //redirect to actual file location
    header("location:$uniqueURL");


  } else{
    echo 'error';
  }

    
}




?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/style.css">

    <style type="text/css">

        </style>
    <title><?php echo $SITE_NAME;?></title>
  </head>
  <body>
    
        <!-- navbar -->
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" id="navbarheader" href="index" style="text-transform:uppercase;font-size:50px;font-weight:bold;"><?php echo $SITE_NAME;?></a>
            
            </nav>


            <!--body -->

            <div class="container text-center" style="margin-top:8%;">

                <button type="button" class="btn" id="uploadBtn" style="border:1px solid black;padding: 40px 120px 40px 120px;font-weight:bold;" data-toggle="modal" data-target="#uploadAudio">UPLOAD AUDIO</button>



                <div style="margin-top:50px;font-size:20px;">
                  <a href="abuse" data-toggle="modal" data-target="#abuseReport" style="color:black;">abuse</a> |
                  <a href="contact" style="color:black;">contact</a> |
                  <a href="terms" style="color:black;">terms</a> 



                </div>


</div>



    <!-- UPLOAD AUDIO MODEL -->
    <!-- Modal -->
<div class="modal fade" id="uploadAudio" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<form action="" method="POST" enctype="multipart/form-data">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">File Upload</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <input type="file" accept="audio/*" name="fileToUpload" id="fileToUpload">
      </div>
      <div class="modal-footer">



        <button type="submit" name="fileSubmit" id="fileSubmit" class="btn btn-primary">Upload</button>
      </div>
    </div>
  </div>
</form>
</div>


<!-- Modal -->
<div class="modal fade" id="abuseReport" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Abuse / Copyright Report</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        
      </div>
      <div class="modal-footer">
        
        <button type="button" class="btn btn-primary">Send</button>
      </div>
    </div>
  </div>
</div>


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>

    <script type="text/javascript">




    </script>


  </body>
</html>