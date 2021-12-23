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
                                <h1 style="color:red;"><b><i class="glyphicon glyphicon-map-marker" style="color: #31A249;"></i> <?php echo htmlentities($result->PackageName);?></b><img src="new/444.gif" alt="Girl in a jacket" width="5" height="4"></h1>
                                <ul class="angle list-none">
									<p><b>Package Type :</b> <?php echo htmlentities($result->PackageType);?></p>
									<p style="padding-top: 1%"><b>Package Details :</b><?php echo htmlentities($result->PackageDetails);?> </p>
                                </ul>
                            </div>
							<div class="included-section mb60">
                            <h3 class="mb30">What to do to keep yourself and others safe from COVID-19</h3>
                            <div class="row">
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                    <ul class="arrow list-none">
                                        <li>Maintain at least a 1-metre distance from others</li>
                                        <li>Make wearing a mask</li>
                                        <li>Clean your hands before you put your mask on</li>
                                        <li>Avoid crowded or indoor settings</li>
                                    </ul>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                    <ul class="arrow list-none">
                                        <li>Clean your hands often</li>
                                        <li>Avoid touching your eyes, nose and mouth</li>
                                        <li>Clean frequently touched objects and surfaces</li>
                                        <li>Cough or sneeze in your bent elbow - not your hands</li>
                                    </ul>
                                </div>
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
                                    <p>This is a beautiful place.</p>
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
                                    <p>It's good enough to spend a day at. It was not that busy when we were there. Wish there were more things to do though.</p>
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
                                    <p>Visited this place for more than 15 times. Never felt bored or bad.</p>
                                </div>
                            </div>
                        </div>
						<h2>NearBy</h2><br>
			<div class="selectroom-info animated wow fadeInUp animated" data-wow-duration="1200ms" data-wow-delay="500ms" style="visibility: visible; animation-duration: 1200ms; animation-delay: 500ms; animation-name: fadeInUp; margin-top: -70px">
				<ul>
				
					<li class="spe">
						
					</li>
			<div class="col-md-4 selectroom_left wow fadeInLeft animated" data-wow-delay=".5s">
				<img src="admin/packagehotel/<?php echo htmlentities($result->PackageHotelImg1);?>" class="img-responsive" alt="">
				<a href="#" data-toggle="modal" data-target="#myModal5" class="view">Details</a>
			</div>
			<div class="col-md-4 selectroom_left wow fadeInLeft animated" data-wow-delay=".5s">
				<img src="admin/packagehotel/<?php echo htmlentities($result->PackageHotelImg2);?>" class="img-responsive" alt="">
				<a href="#" data-toggle="modal" data-target="#myModal2" class="view">Details</a>
			</div>
			<div class="col-md-4 selectroom_left wow fadeInLeft animated" data-wow-delay=".5s">
				<img src="admin/packagehotel/<?php echo htmlentities($result->PackageHotelImg3);?>" class="img-responsive" alt="">
				<a href="#" data-toggle="modal" data-target="#myModal3" class="view">Details</a>
			</div>
					<div class="clearfix"></div>
				</ul>
			</div>
			<!-- accordions -->
        <div class="content">
            <div class="container">
                <div class="row">
                    <div class="col-xl-8 col-lg-8 offset-md-2 col-md-8 col-sm-12 col-12">
                        <p class="lead">Accordions</p>
                        <div id="accordion">
                            <div class="accordion-card card">
                                <div class="accordion-card-header" id="headingOne">
                                    <h5 class="mb-0">
        <a role="button" href="#" class="accordion-card-title" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
           
        How do I book?   <span class="fa fa-angle-down pull-right"></span>
        </a>
      </h5>
                                </div>
                                <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                                    <div class="card-body">
                                        Click book button with proper details and we'll confirm your booking by email.
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-card card">
                                <div class="accordion-card-header" id="headingTwo">
                                    <h5 class="mb-0">
        <a role="button" href="#" class="accordion-card-title" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
         What if I don't hear from you after I have made the booking request?   <span class="fa fa-angle-down pull-right"></span>
        </a>
      </h5>
                                </div>
                                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                                    <div class="card-body">
                                        Verify that you received an inquiry confirmation email from us. This will confirm that your inquiry was delivered to the host and verify that you do not have any responses in your email’s junk or spam folder.
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-card card">
                                <div class="accordion-card-header" id="headingThree">
                                    <h5 class="mb-0">
                   <a role="button" href="#" class="accordion-card-title" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                    What Do I Do If I Lost My Ticket? <span class="fa fa-angle-down pull-right"></span>
                       </a>
                             </h5>
                                </div>
                                <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
                                    <div class="card-body">
                                        As soon as possible you should contact with us.
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-card card">
                                <div class="accordion-card-header" id="headingFour">
                                    <h5 class="mb-0">
                   <a role="button" href="#" class="accordion-card-title" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                 Is My Personal Information Safe? <span class="fa fa-angle-down pull-right"></span>
                       </a>
                             </h5>
                                </div>
                                <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordion">
                                    <div class="card-body">
                                        Yes.We maintain privacy policy properly.
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-card card">
                                <div class="accordion-card-header" id="headingFive">
                                    <h5 class="mb-0">
                   <a role="button" href="#" class="accordion-card-title" data-toggle="collapse" data-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                How Will I Receive My Travel Documents? <span class="fa fa-angle-down pull-right"></span>
                       </a>
                             </h5>
                                </div>
                                <div id="collapseFive" class="collapse" aria-labelledby="headingFive" data-parent="#accordion">
                                    <div class="card-body">
                                        We will sent the documents to your email. 
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-card card">
                                <div class="accordion-card-header" id="headingSix">
                                    <h5 class="mb-0">
                   <a role="button" href="#" class="accordion-card-title" data-toggle="collapse" data-target="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
                How Do I Receive My Bus E-Tickets? <span class="fa fa-angle-down pull-right"></span>
                       </a>
                             </h5>
                                </div>
                                <div id="collapseSix" class="collapse" aria-labelledby="headingSix" data-parent="#accordion">
                                    <div class="card-body">
                                        We'll receive the tickets in your email account.
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-card card">
                                <div class="accordion-card-header" id="headingSeven">
                                    <h5 class="mb-0">
                   <a role="button" href="#" class="accordion-card-title" data-toggle="collapse" data-target="#collapseSeven" aria-expanded="false" aria-controls="collapseSeven">
             Will paying by Cheque/Demand Draft slow down my order? <span class="fa fa-angle-down pull-right"></span>
                       </a>
                             </h5>
                                </div>
                                <div id="collapseSeven" class="collapse" aria-labelledby="headingSeven" data-parent="#accordion">
                                    <div class="card-body">
                                        Yes.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
		
        <!-- /.accordions -->
			<div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v10.0" nonce="kM8jN3Qj"></script>
<div class="fb-comments" data-href="http://localhost/tms/" data-width="" data-numposts="5"></div>
                        
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
							<div class="selectroom_top">
			<h2 style="color:green;">Booking</h2>
			<div class="selectroom-info animated wow fadeInUp animated" data-wow-duration="1200ms" data-wow-delay="500ms" style="visibility: visible; animation-duration: 1200ms; animation-delay: 500ms; animation-name: fadeInUp; margin-top: -70px">
				<ul>
				
					<li class="spe">
						<label style="color:blue;">Enter Your Mobile Number </label>
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
						
                        <!-- enguiry-form -->
						<!--Google map-->
						<div class="selectroom_top">
							<div class="rom-btm">
								<iframe width="100%" height="450"  src="<?php echo htmlentities($result->PackageGooglemapurl);?>" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe>
							</div>		
						</div>
						<!--Google map-->
					<div class=" widget widget-recent-post">
                            <h2 class="widget-title">Recent Post</h2>
                            <ul class="list-none">
                                <li>
                                    <div class="recent-post">
                                        <div class="recent-pic">
                                            <a href="#" class="imghover"><img src="images/recent_post_1.jpg" alt="" class="img-fluid"></a>
                                        </div>
                                        <div class="recent-content">
                                            <h5 class="recent-title "><a href="#" class="title">Bootstrap Website</a></h5>
                                            <div class="meta">
                                                <span class="meta-date">25 February, 2020</span></div>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="recent-post">
                                        <div class="recent-pic">
                                            <a href="#" class="imghover"> <img src="images/recent_post_2.jpg" alt="" class="img-responsive"></a>
                                        </div>
                                        <div class="recent-content">
                                            <h5 class="recent-title"><a href="#" class="title">Travel Website </a></h5>
                                            <div class="meta">
                                                <span class="meta-date">24 February, 2020</span> </div>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="recent-post">
                                        <div class="recent-pic">
                                            <a href="#" class="imghover"> <img src="images/recent_post_3.jpg" alt="" class="img-responsive"></a>
                                        </div>
                                        <div class="recent-content">
                                            <h5 class="recent-title"><a href="#" class="title">Tourism Website  </a></h5>
                                            <div class="meta">
                                                <span class="meta-date">23 February, 2020</span> </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>

					 </div>
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
		<p><img src="img/bus.png" width="50" height="50" alt=""><b>
		<p><b>Hot Line Number :</b> <?php echo htmlentities($result->PackageTrain);?></b></p>
		<p><b>Status :</b> <?php echo htmlentities($result->PackageAir);?></b></p>
		<p><b>Services Name :</b> <?php echo htmlentities($result->PackageBus);?></b></p>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" href="#" data-toggle="modal" data-target="#myModal10" class="btn-primary btn">Online Book</button>
		  <button type="button" class="btn btn-default" href="#" data-toggle="modal" data-target="#myModal7" class="btn-primary btn">Details</button>
        </div>
      </div>
      
	</div></center>
                 <div class="widget-default">
                            <div class="question-icon"><img src="images/question_icon.png" alt=""></div>
                            <h3 class="widget-default-title">Have You Any Question?</h3>
                            <p>Here is an important list of questions to help to solve your queries. </p>
							<p>Here is an important list of. </p>
                            
                        </div>                   
</div>
                                </div>
								
                            </form>	
                            <!-- /.form -->
                        </div>
						<div class="fb-page" data-href="https://www.facebook.com/TourismManagementSystem" data-tabs="timeline" data-width="" data-height="" data-small-header="true" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><blockquote cite="https://www.facebook.com/avijatrik" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/avijatrik">Avijatrik</a></blockquote></div>
                    </div>
                </div>
            </div>
        </div>
		
		<!-- Modal -->
		<div class="container">
  <div class="modal fade" id="myModal5" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Details</h4>
        </div>
        <div class="modal-body">
		  <div class="column">
			<img src="admin/packagehotel/<?php echo htmlentities($result->PackageHotelImg1);?>" alt="Lights" style="width:100%" onclick="myFunction(this);"><hr>
			<p><b></b> <label class="inputLabel"><?php echo htmlentities($result->PackageHotelName1);?>--</label>
				<?php echo htmlentities($result->PackageHotelDetails1);?></p>
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
          <h4 class="modal-title">Details</h4>
        </div>
        <div class="modal-body">
		  <div class="column">
			<img src="admin/packagehotel/<?php echo htmlentities($result->PackageHotelImg2);?>" alt="Lights" style="width:100%" onclick="myFunction(this);"><hr>
			<p><b></b> <label class="inputLabel"><?php echo htmlentities($result->PackageHotelName2);?>--</label>
				<?php echo htmlentities($result->PackageHotelDetails2);?></p>
		  </div>
		</div>	  
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div> 
</div>
<div class="modal fade" id="myModal3" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Details</h4>
        </div>
        <div class="modal-body">
		  <div class="column">
			<img src="admin/packagehotel/<?php echo htmlentities($result->PackageHotelImg3);?>" alt="Lights" style="width:100%" onclick="myFunction(this);"><hr>
			<p><b></b> <label class="inputLabel"><?php echo htmlentities($result->PackageHotelName3);?>--</label>
				<?php echo htmlentities($result->PackageHotelDetails3);?></p>
		  </div>
		</div>	  
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div> 
</div>	
<div class="modal fade" id="myModal7" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Details</h4>
        </div>
        <div class="modal-body">
		  <div class="column">
			<p><b></b> <label class="inputLabel"><?php echo htmlentities($result->PackageBoat);?>--</label>
		  </div>
		</div>	  
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div> 
</div>
<div class="modal fade" id="myModal10" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">ComingSoon </h4>
        </div>
        <div class="modal-body">
		  <div class="column">
			<center><iframe width="1000" height="900"  src="http://www.busbd.com.bd/" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe></center>
		  </div>
		</div>	  
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div> 
</div>
		</form>
		<div id="fb-root"></div>

<?php }} ?>
<!-- /.client-section -->
        <div class="space-small">
            <div class="container">
                <div class="row">
                    <!-- client-logo -->
                    <div class="col-xl-2 col-lg-2 col-md-2 col-sm-6 col-6">
                        <div class="client-logo">
                            <a href="#"><img src="images/dummy_logo_1.png" alt=""></a>
                        </div>
                    </div>
                    <!-- /.client-logo -->
                    <!-- client-logo -->
                    <div class="col-xl-2 col-lg-2 col-md-2 col-sm-6 col-6">
                        <div class="client-logo">
                            <a href="#"> <img src="images/dummy_logo_2.png" alt=""></a>
                        </div>
                    </div>
                    <!-- /.client-logo -->
                    <!-- client-logo -->
                    <div class="col-xl-2 col-lg-2 col-md-2 col-sm-6 col-6">
                        <div class="client-logo">
                            <a href="#">  <img src="images/dummy_logo_3.png" alt=""></a>
                        </div>
                    </div>
                    <!-- /.client-logo -->
                    <!-- client-logo -->
                    <div class="col-xl-2 col-lg-2 col-md-2 col-sm-6 col-6">
                        <div class="client-logo">
                            <a href="#"><img src="images/dummy_logo_4.png" alt=""></a>
                        </div>
                    </div>
                    <!-- /.client-logo -->
                    <!-- client-logo -->
                    <div class="col-xl-2 col-lg-2 col-md-2 col-sm-6 col-6">
                        <div class="client-logo">
                            <a href="#"> <img src="images/dummy_logo_2.png" alt=""></a>
                        </div>
                    </div>
                    <!-- /.client-logo -->
                    <!-- client-logo -->
                    <div class="col-xl-2 col-lg-2 col-md-2 col-sm-6 col-6">
                        <div class="client-logo">
                            <a href="#">  <img src="images/dummy_logo_1.png" alt=""></a>
                        </div>
                    </div>
                    <!-- /.client-logo -->
                </div><br>
				<a href="https://sandbox.aamarpay.com/paynow.php?track=AAM1622613392103055">  <img src="new/client-logo.jpg" alt=""></a>
            </div>
        </div>
        <!-- /.client-section -->
	</div>
</div>

<!-- newsletter -->
    <div class="newsletter-wrapper newsletter-overlay" style="background: url(images/newsletter_wrapper.jpg) no-repeat;">
        <div class="container">
            <div class="row">
                <div class="col-xl-7 col-lg-7 offset-md-5 col-md-6 col-sm-12 col-12">
                    <div class="newsletter-block">
                      <h1 class="newsletter-title">Join The Newsletter</h1>
                        <p class="mb30">Subscribe the newsletter and get update for discounts on tours.</p>
                        <form>
                            <div class="input-group add-on">
                                <input class="form-control" placeholder="email address here" type="text">
                                <div class="input-group-btn">
                                    <button class="btn btn-primary newsletter-btn" type="submit">subscribe</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
	<center><iframe src="http://onlinetrishal.blogspot.com/?m=0" width=728 height=90 marginwidth=0 marginheight=0 hspace=0 vspace=0 frameborder=0 scrolling="no" allowtransparency="true" style="background:none transparent;display:block !important;"></iframe></center>
    <!-- /.newsletter -->
<!--- /selectroom ---->
<<!--- /footer-top ---->
<?php include('includes/footer2.php');?>
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