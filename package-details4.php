<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(isset($_POST['submit2']))
{
$pid=intval($_GET['pkgid']);
$useremail=$_SESSION['login'];
$fromdate=$_POST['fromdate'];
$todate=$_POST['todate'];
$comment=$_POST['comment'];
$status=0;
$sql="INSERT INTO tblbooking(PackageId,UserEmail,FromDate,ToDate,Comment,status) VALUES(:pid,:useremail,:fromdate,:todate,:comment,:status)";
$query = $dbh->prepare($sql);
$query->bindParam(':pid',$pid,PDO::PARAM_STR);
$query->bindParam(':useremail',$useremail,PDO::PARAM_STR);
$query->bindParam(':fromdate',$fromdate,PDO::PARAM_STR);
$query->bindParam(':todate',$todate,PDO::PARAM_STR);
$query->bindParam(':comment',$comment,PDO::PARAM_STR);
$query->bindParam(':status',$status,PDO::PARAM_STR);
$query->execute();
$lastInsertId = $dbh->lastInsertId();
if($lastInsertId)
{
$msg="Booked Successfully";
}
else 
{
$error="Something went wrong. Please try again";
}

}
?>
<!DOCTYPE HTML>
<html>
<head>
<title>TMS | Package Details</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="applijewelleryion/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<link href="css/bootstrap.css" rel='stylesheet' type='text/css' />
<link href="css/style.css" rel='stylesheet' type='text/css' />
<link href='//fonts.googleapis.com/css?family=Open+Sans:400,700,600' rel='stylesheet' type='text/css'>
<link href='//fonts.googleapis.com/css?family=Roboto+Condensed:400,700,300' rel='stylesheet' type='text/css'>
<link href='//fonts.googleapis.com/css?family=Oswald' rel='stylesheet' type='text/css'>
<link href="css/font-awesome.css" rel="stylesheet">
<!-- Custom Theme files -->

<!-- Style CSS -->
    <link href="new/css/style.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Merriweather+Sans:300,300i,400,400i,700,700i,800,800i" rel="stylesheet">
    <!-- owl-carousel -->
    <link href="new/css/owl.carousel.css" rel="stylesheet">
    <link href="new/css/owl.theme.default.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/jquery-ui.css">
    <!-- FontAwesome CSS -->
    <link href="new/css/font-awesome.min.css" rel="stylesheet">


<script src="js/jquery-1.12.0.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<!--animate-->
<link href="css/animate.css" rel="stylesheet" type="text/css" media="all">
<script src="js/wow.min.js"></script>
<link rel="stylesheet" href="css/jquery-ui.css" />
	<script>
		 new WOW().init();
	</script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>	
<script src="js/jquery-ui.js"></script>
					<script>
						$(function() {
						$( "#datepicker,#datepicker1" ).datepicker();
						});
					</script>
	  <style>
		.errorWrap {
    padding: 10px;
    margin: 0 0 20px 0;
    background: #fff;
    border-left: 4px solid #dd3d36;
    -webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
    box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
}
.succWrap{
    padding: 10px;
    margin: 0 0 20px 0;
    background: #fff;
    border-left: 4px solid #5cb85c;
    -webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
    box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
}
		</style>				
</head>
<body>
<!-- top-header -->
<?php include('includes/header.php');?>
<div class="banner-3">
	<div class="container">
		<h1 class="wow zoomIn animated animated" data-wow-delay=".5s" style="visibility: visible; animation-delay: 0.5s; animation-name: zoomIn;"> TS -Package Details</h1>
	</div>
</div>
<!--- /banner ---->
<!--- selectroom ---->
<div class="selectroom">
	<div class="container">	
		  <?php if($error){?><div class="errorWrap"><strong>ERROR</strong>:<?php echo htmlentities($error); ?> </div><?php } 
				else if($msg){?><div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> </div><?php }?>
<?php 
$pid=intval($_GET['pkgid']);
$sql = "SELECT * from tbltourpackages where PackageId=:pid";
$query = $dbh->prepare($sql);
$query -> bindParam(':pid', $pid, PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{	?>

<form name="book" method="post">
		<div class="selectroom_top">
			<div class="content">
            <div class="container">
                <div class="row">
                    <div class="col-xl-8 col-lg-8 col-md-7 col-sm-12 col-12">
                        <div class="highlights-section mb60">
                            <div class="slide-thumb-gallery">
                                <div class="owl-carousel" data-slider-id="1">
                                    <div><img src="admin/pacakgeimages/<?php echo htmlentities($result->PackageImage);?>" class="img-fluid"></div>
                                    <div><img src="admin/packagemap/<?php echo htmlentities($result->PackageMap);?>" alt="" class="img-fluid"></div>
                                    <div><img src="admin/packagemap/<?php echo htmlentities($result->PackageGallery);?>" alt="" class="img-fluid"></div>
                                    <div><img src="admin/packagemap/<?php echo htmlentities($result->PackageGallery2);?>" alt="" class="img-fluid"></div>
                                </div>
                                <div class="owl-thumbs" data-slider-id="1">
                                    <button class="owl-thumb-item"><img src="images/slide_small_1.jpg" alt="" class="img-fluid"></button>
                                    <button class="owl-thumb-item"><img src="images/slide_small_2.jpg" alt="" class="img-fluid"></button>
                                    <button class="owl-thumb-item"><img src="images/slide_small_3.jpg" alt="" class="img-fluid"></button>
                                    <button class="owl-thumb-item"><img src="images/slide_small_4.jpg" alt="" class="img-fluid"></button>
                                </div>
                            </div>
                        </div>         
                        <div class="journey-section mb60">
                            <div class="well-bg-block">
                                <h1 class="journey-day-title"><?php echo htmlentities($result->PackageName);?></h1>
                                <ul class="angle list-none">
									<p><b>Package Type :</b> <?php echo htmlentities($result->PackageType);?></p>
									<p style="padding-top: 1%"><b>Package Details :</b><?php echo htmlentities($result->PackageDetails);?> </p>
                                </ul>
                            </div>
                        </div>
						<h2>NearBy Hotel </h2><br>
			<div class="selectroom-info animated wow fadeInUp animated" data-wow-duration="1200ms" data-wow-delay="500ms" style="visibility: visible; animation-duration: 1200ms; animation-delay: 500ms; animation-name: fadeInUp; margin-top: -70px">
				<ul>
				
					<li class="spe">
						
					</li>
			<div class="col-md-4 selectroom_left wow fadeInLeft animated" data-wow-delay=".5s">
				<img src="admin/packagehotel/<?php echo htmlentities($result->PackageHotelImg1);?>" class="img-responsive" alt="">
				<p><b></b> <label class="inputLabel"><?php echo htmlentities($result->PackageHotelName1);?>--</label>
				<?php echo htmlentities($result->PackageHotelDetails1);?></p>
			</div>
			<div class="col-md-4 selectroom_left wow fadeInLeft animated" data-wow-delay=".5s">
				<img src="admin/packagehotel/<?php echo htmlentities($result->PackageHotelImg2);?>" class="img-responsive" alt="">
				<p><b></b> <label class="inputLabel"><?php echo htmlentities($result->PackageHotelName2);?>--</label>
				<?php echo htmlentities($result->PackageHotelDetails2);?></p>
			</div>
			<div class="col-md-4 selectroom_left wow fadeInLeft animated" data-wow-delay=".5s">
				<img src="admin/packagehotel/<?php echo htmlentities($result->PackageHotelImg3);?>" class="img-responsive" alt="">
				<p><b></b> <label class="inputLabel"><?php echo htmlentities($result->PackageHotelName3);?>--</label>
				<?php echo htmlentities($result->PackageHotelDetails3);?></p>
			</div>
					<div class="clearfix"></div>
				</ul>
			</div>
                        <div class="included-section mb60">
                            <h3 class="mb30">What's Included</h3>
                            <div class="row">
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                    <ul class="arrow list-none">
                                        <li>Fusce in mais arcutiam consmassa vulputate</li>
                                        <li>Vestibulum rutrutiuamus sed felisat leo</li>
                                        <li>Eget euismod ns quamed vitae ipsum augue</li>
                                        <li>Destas turpis consect malesuada</li>
                                        <li>Laciniorci venenatis anteiulisrbi sitame</li>
                                    </ul>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                    <ul class="arrow list-none">
                                        <li>Eget euismod ns quamed vitae ipsum augue</li>
                                        <li>Vestibulum rutrutiuamus sed felisat leo</li>
                                        <li>Fusce in mais arcutiam consmassa vulputate</li>
                                        <li>Destas turpis consect malesuada</li>
                                        <li>Laciniorci venenatis anteiulisrbi sitame</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="reviews-section mb60">
                            <h3 class="mb40">Customer Reviews</h3>
                            <div class="review-block">
                                <div class="review-img"><img src="images/user_img_1.jpg" alt="" class="rounded-circle"></div>
                                <div class="review-content">
                                    <h5 class="title-bold d-inline">Jennifer Wirtz</h5>
                                    <div class="star-rating">
                                        <span><i class="fa fa-star"></i></span>
                                        <span><i class="fa fa-star"></i></span>
                                        <span><i class="fa fa-star"></i></span>
                                        <span><i class="fa fa-star"></i></span>
                                        <span><i class="fa fa-star"></i></span>
                                    </div>
                                    <p>Vivamus velit ligula tempus id dui apretium imperdiet liguorbi sit amet pharetra leo. Integer tempus enim vel placerat consectetu ecenascula.</p>
                                </div>
                            </div>
                            <div class="review-block">
                                <div class="review-img"><img src="images/user_img_2.jpg" alt="" class="rounded-circle"></div>
                                <div class="review-content">
                                    <h5 class="title-bold d-inline">Maria Hershberger</h5>
                                    <div class="star-rating">
                                        <span><i class="fa fa-star"></i></span>
                                        <span><i class="fa fa-star"></i></span>
                                        <span><i class="fa fa-star"></i></span>
                                        <span><i class="fa fa-star"></i></span>
                                        <span><i class="fa fa-star"></i></span>
                                    </div>
                                    <p>Eempus id dui apretium imperdiet ligorbi sitamet pharetra leonteger tempus enimvel placerat consectaecenas vehicula.</p>
                                </div>
                            </div>
                            <div class="review-block">
                                <div class="review-img"><img src="images/user_img_3.jpg" alt="" class="rounded-circle"></div>
                                <div class="review-content">
                                    <h5 class="title-bold d-inline">Della Betty</h5>
                                    <div class="star-rating">
                                        <span><i class="fa fa-star"></i></span>
                                        <span><i class="fa fa-star"></i></span>
                                        <span><i class="fa fa-star"></i></span>
                                        <span><i class="fa fa-star"></i></span>
                                        <span><i class="fa fa-star"></i></span>
                                    </div>
                                    <p>Nullam orci exegestaset finibus amolestie ut nisuspendisse mollisleo sedcongue iaculis eratneque consectetur nisiquis feugia.</p>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                    <div class="col-xl-4 col-lg-4 col-md-5 col-sm-12 col-12">
                        <div class="widget-primary support-list">
                            <div class="widget-primary-title">
                                <h3>Book With Us?</h3>
                            </div>
                            <ul class="arrow list-none">
								<p>Package with Hotel Total</p>
								<h3 style="color:red;"><b>Tk.<?php echo htmlentities($result->PackagePrice);?></b></h3>
                                <li><b>PKG :</b><?php echo htmlentities($result->PackageId);?></li>
                                <li><b>Package Type :</b> <?php echo htmlentities($result->PackageType);?></li>
                                <li><b>Package Location :</b> <?php echo htmlentities($result->PackageLocation);?></li>
                                <li><b>Bus/Train Facility :</b> <?php echo htmlentities($result->PackageFetures);?></li>
                            </ul>
                        </div>
                        <!-- enguiry-form -->
						<!--Google map-->
						<div class="selectroom_top">
							<div class="rom-btm">
								<iframe width="100%" height="300"  src="<?php echo htmlentities($result->PackageGooglemapurl);?>" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe>
							</div>		
						</div>
						<!--Google map-->
                        <!-- form -->
                        <div class="widget-form">
                            <form>
                                <div class="row">
                                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
										<center><div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Travel Services</h4>
        </div>
        <div class="modal-body">
		<p><img src="img/bus.png" width="80" height="80" alt=""><b> 
		<p><b>Services Details :</b> <?php echo htmlentities($result->PackageBus);?></b></p>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
	</div></center>
                                    </div>
                                </div>
                            </form>
                            <!-- /.form -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
			
			<div class="col-md-4 selectroom_left wow fadeInLeft animated" data-wow-delay=".5s">
			</div>
			<div class="col-md-8 selectroom_right wow fadeInRight animated" data-wow-delay=".5s">	
				
					<div class="ban-bottom">
				<div class="bnr-right">
				<label class="inputLabel">From</label>
				<input class="date" id="datepicker" type="text" placeholder="dd-mm-yyyy"  name="fromdate" required="">
			</div>
			<div class="bnr-right">
				<label class="inputLabel">To</label>
				<input class="date" id="datepicker1" type="text" placeholder="dd-mm-yyyy" name="todate" required="">
			</div>
			</div>
						<div class="clearfix"></div>
				<div class="grand">

				</div>
			</div>
		<h3>Package Details</h3>
				<p style="padding-top: 1%"><?php echo htmlentities($result->PackageDetails);?> </p>	
				<div class="clearfix"></div>
				<a href="#" data-toggle="modal" data-target="#myModal" class="view">Photo Gallery</a>
				<a href="#" data-toggle="modal" data-target="#myModal2" class="view">All Transportation Services</a>
		</div>
		<!-- Modal -->
		<div class="container">
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Photo Gallery</h4>
        </div>
        <div class="modal-body">
		  <div class="column">
			<img src="admin/packagemap/<?php echo htmlentities($result->PackageMap);?>" alt="Lights" style="width:100%" onclick="myFunction(this);"><hr>
		  </div>
		  <div class="column">
			<img src="admin/packagemap/<?php echo htmlentities($result->PackageGallery);?>" alt="Lights" style="width:100%" onclick="myFunction(this);"><hr>
		  </div>
		  <div class="column">
			<img src="admin/packagemap/<?php echo htmlentities($result->PackageGallery2);?>" alt="Lights" style="width:100%" onclick="myFunction(this);">
		  </div>
</div>	  
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
  <div class="container">
  <div class="modal fade" id="myModal2" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">All Travel Services</h4>
        </div>
        <div class="modal-body">
		<p><b>Package Location :</b> <?php echo htmlentities($result->PackageLocation);?></p>
		<p><img src="img/bus.png" width="80" height="80" alt=""><b> <?php echo htmlentities($result->PackageBus);?></b></p>
		<p><img src="img/trin.png" width="80" height="80" alt=""><b> <?php echo htmlentities($result->PackageTrain);?></b></p>
		<p><img src="img/biman.png" width="80" height="80" alt=""><b> <?php echo htmlentities($result->PackageAir);?></b></p>
		<p><img src="img/boat.png" width="80" height="80" alt=""><b> <?php echo htmlentities($result->PackageBoat);?></b></p> 
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
</div>	
		<div class="selectroom_top">
			<h2>Booking</h2>
			<div class="selectroom-info animated wow fadeInUp animated" data-wow-duration="1200ms" data-wow-delay="500ms" style="visibility: visible; animation-duration: 1200ms; animation-delay: 500ms; animation-name: fadeInUp; margin-top: -70px">
				<ul>
				
					<li class="spe">
						<label class="inputLabel">Enter Your Hotels Name </label>
						<input class="special" type="text" name="comment" required="">
					</li>
					<?php if($_SESSION['login'])
					{?>
						<li class="spe" align="center">
					<button type="submit" name="submit2" class="btn-primary btn">Book</button>
						</li>
						<?php } else {?>
							<li class="sigi" align="center" style="margin-top: 1%">
							<a href="#" data-toggle="modal" data-target="#myModal4" class="btn-primary btn" > Book</a></li>
							<?php } ?>
					<div class="clearfix"></div>
				</ul>
			</div>
			
		</div>
		</form>
<?php }} ?>


	</div>
</div>
<!--- /selectroom ---->
<<!--- /footer-top ---->
<?php include('includes/footer.php');?>
<!-- signup -->
<?php include('includes/signup.php');?>			
<!-- //signu -->
<!-- travel -->
<?php include('includes/travel.php');?>			
<!-- //travel -->
<!-- signin -->
<?php include('includes/signin.php');?>			
<!-- //signin -->
<!-- write us -->
<?php include('includes/write-us.php');?>


    <!-- /.Modal -->
     <a href="javascript:" id="return-to-top"><i class="fa fa-angle-up"></i></a>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="new/js/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="new/js/bootstrap.min.new/js"></script>
    <script src="new/js/menumaker.new/js"></script>
    <script src="new/js/jquery.sticky.js"></script>
    <script src="new/js/sticky-header.js"></script>   
    <!-- owl-thumb JavaScript -->
    <script src="new/js/owl.carousel.min.js"></script>
    <script src="new/js/owl.carousel2.thumbs.min.js"></script>
    <script src="new/js/thumb.js"></script>
    <script src="new/js/jquery-ui.js"></script>
    <script src="new/js/date.js"></script>
    <script src="new/js/return-to-top.js"></script>

    <script>
    function initMap() {
        var uluru = {
            lat: 23.094197,
            lng: 72.558148
        };
        var map = new google.maps.Map(document.getElementById('contact-map'), {
            zoom: 14,
            center: uluru,
            scrollwheel: false
        });
        var marker = new google.maps.Marker({
            position: uluru,
            map: map,
            icon: 'images/map_marker.png'

        });
    }
    </script>
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBZib4Lvp0g1L8eskVBFJ0SEbnENB6cJ-g&amp;callback=initMap">
    </script>
    </div>
</body>
</html>