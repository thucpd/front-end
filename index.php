<?php 
    if(isset($_GET['coupon_id'])){
        include 'db_management.php';
        $connection = db_connect();
        $couponID = $_GET['coupon_id'];
        $sql = "select c.*, b.name as brand_name from gb_coupon c join gb_brand b on b.brand_id = c.brand_id where coupon_id = $couponID";
        $result = db_select($connection,$sql);
        if(!$result){
            header('Location: error.php');
        }else{
            $coupon = $result[0];
        }
    }else{
        header('Location: error.php');
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>
<body id ="body">
    <div class="header">
        <h2>Detail Coupon</h2>
    </div>
    <div class="body">
        <img src="<?php echo $coupon['media_url']?>" alt="">
        <div class="info">
            <div class="info-left">
                <div class="brand-coupon">
                    <p><?php echo $coupon['brand_name']?></p>
                </div>
                <div class="coupon-name">
                    <p><?php echo $coupon['coupon_name']?></p>
                </div>
            </div>
            <div class="info-right">

            </div>
        </div>

    </div>

   

    
    <!-- <a class="btn btn-primary" href="https://itunes.apple.com/vn/app/gibi/id1186112381?l=vi&mt=8">Down App Tại</a>
    <br>
    <a class="btn btn-primary" href="https://play.google.com/store/apps/details?id=vn.com.feliz.gb&hl=vi">Down App Tại</a> -->
</body>
</html>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<script>
    function getMobileOperatingSystem() {
        var userAgent = navigator.userAgent || navigator.vendor || window.opera;

        // Windows Phone must come first because its UA also contains "Android"
   
        if (/android/i.test(userAgent)) {
            return "Android";
        }

        // iOS detection from: http://stackoverflow.com/a/9039885/177710
        if (/iPad|iPhone|iPod/.test(userAgent) && !window.MSStream) {
            return "iOS";
        }

        return "unknown";
    }
    var os = getMobileOperatingSystem();
    console.log(os)
    if(os == "Android"){
        $("#download").attr("href", "https://play.google.com/store/apps/details?id=vn.com.feliz.gb&hl=vi")
    }else if(os == "iOS"){
        $("#download").attr("href", "https://itunes.apple.com/vn/app/gibi/id1186112381?l=vi&mt=8")
    }
</script>