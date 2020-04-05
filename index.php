<?php include_once('config.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://kit.fontawesome.com/f3bfbc9f38.js" crossorigin="anonymous"></script>
  <link href="<?php echo MAIN_PATH; ?>css/style.css" rel="stylesheet" />
  <link href="<?php echo FONT; ?>" rel="stylesheet">
  <title>Stock System</title>
</head>
<body>
    <?php include_once('pages/header.php'); ?>
    <div class="cont">
        <?php  
            $url = isset($_GET['url']);
            if($url == '') {
                include('pages/includes/view.php');
            }else {
                Stock::loadPage(); 
            }  
        ?>
    </div><!--cont-->
</body>
</html>