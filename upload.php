<?php
require_once('inc/config.php');


//get file information from url
$fileID = $_GET['fileid'];
$cleanFileID = mysqli_real_escape_string($con, $fileID);

if($cleanFileID){
    //exists so check if valid VIA DB
    $fileIDQuery = mysqli_query($con, "SELECT * FROM wi_uploads WHERE file_uniqueurl='$cleanFileID'");
    $fileIDNum = mysqli_num_rows($fileIDQuery);

        if($fileIDNum == 0){
            //does not exist
            header("location: index");
        } else{


            //get related information
            $file_row = mysqli_fetch_assoc($fileIDQuery);

            //check if file been deleted/ disabled or not

            if($file_row['file_removed'] == 1){
              //file removed / deleted

              header("location: index");
              
            } else{
              //not deleted
            }

        }


} else{
    header("location: index");
}




if(isset($_POST['fileDownload'])){
  echo 'test';
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

    <link href="https://vjs.zencdn.net/7.8.2/video-js.css" rel="stylesheet" />

  <!-- If you'd like to support IE8 (for Video.js versions prior to v7) -->
  <script src="https://vjs.zencdn.net/ie8/1.1.2/videojs-ie8.min.js"></script>

    <style type="text/css">

#uploadBtn:hover{
    box-shadow: 0px 2px 5px 1px;
}

.downloadBtn:hover{
  box-shadow: 0px 2px 5px 1px;

}
        </style>
    <title><?php echo $SITE_NAME;?> - <?php echo $file_row['file_fullname'];?></title>
  </head>
  <body>
    
        <!-- navbar -->
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" id="navbarheader" href="index" style="text-transform:uppercase;font-size:50px;font-weight:bold;"><?php echo $SITE_NAME;?></a>
            
            </nav>


            <!--body -->

            <div class="container text-center" style="margin-top:8%;">

            <form action="" method="POST">

                <h2 style="font-weight:bold;width:100%;overflow:hidden;"><?php echo $file_row['file_fullname'];?></h2>


            <audio id="audio_example" id="soundBar" style="width:100%;background-color: #2b333f;margin-top:20px;" controlsList="nodownload" class="video-js vjs-default-skin" controls 
  preload="auto" width="600" height="600" data-setup='{}' source src="<?php echo $file_row['file_location'];?>" type='audio/mp3'></audio>



    <a href="<?php echo $file_row['file_location'];?>" download="<?php echo $file_row['file_fullname'];?>"><button type="button" name="fileDownload" class="btn downloadBtn" id="downloadBtn" style="border:1px solid black;padding: 20px 80px 20px 80px;font-weight:bold;margin-top:40px;">DOWNLOAD (<?php echo $file_row['file_size'];?>)</button></a>


</form>
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