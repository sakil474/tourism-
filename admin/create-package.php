<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0)
	{	
header('location:index.php');
}
else{
if(isset($_POST['submit']))
{
$pname=$_POST['packagename'];
$ptype=$_POST['packagetype'];	
$plocation=$_POST['packagelocation'];
$pprice=$_POST['packageprice'];	
$pfeatures=$_POST['packagefeatures'];
$pdetails=$_POST['packagedetails'];	
$pimage=$_FILES["packageimage"]["name"];
$pgallery=$_FILES["packagepgallery"]["name"];
$pgallery2=$_FILES["packagepgallery2"]["name"];
$pmap=$_FILES["packagemap"]["name"];
$pgoogle=$_POST['packagegoogle'];
$photelname1=$_POST['packagehotelname1'];
$photeldetails1=$_POST['packagehoteldetails1'];
$photelimg1=$_FILES["packagehotelimg1"]["name"];
$photelname2=$_POST['packagehotelname2'];
$photeldetails2=$_POST['packagehoteldetails2'];
$photelimg2=$_FILES["packagehotelimg2"]["name"];
$photelname3=$_POST['packagehotelname3'];
$photeldetails3=$_POST['packagehoteldetails3'];
$pbus=$_POST['packagebus'];
$ptrain=$_POST['packagetrain'];
$pair=$_POST['packageair'];
$pboat=$_POST['packageboat'];
$photelimg3=$_FILES["packagehotelimg3"]["name"];
move_uploaded_file($_FILES["packageimage"]["tmp_name"],"pacakgeimages/".$_FILES["packageimage"]["name"]);
move_uploaded_file($_FILES["packagemap"]["tmp_name"],"packagemap/".$_FILES["packagemap"]["name"]);
move_uploaded_file($_FILES["packagepgallery"]["tmp_name"],"packagemap/".$_FILES["packagepgallery"]["name"]);
move_uploaded_file($_FILES["packagepgallery2"]["tmp_name"],"packagemap/".$_FILES["packagepgallery2"]["name"]);
move_uploaded_file($_FILES["packagehotelimg1"]["tmp_name"],"packagehotel/".$_FILES["packagehotelimg1"]["name"]);
move_uploaded_file($_FILES["packagehotelimg2"]["tmp_name"],"packagehotel/".$_FILES["packagehotelimg2"]["name"]);
move_uploaded_file($_FILES["packagehotelimg3"]["tmp_name"],"packagehotel/".$_FILES["packagehotelimg3"]["name"]);
$sql="INSERT INTO TblTourPackages(PackageName,PackageType,PackageLocation,PackagePrice,PackageFetures,PackageDetails,PackageImage,PackageMap,PackageGallery,PackageGallery2,PackageGooglemapurl,PackageHotelName1,PackageHotelDetails1,PackageHotelImg1,PackageHotelName2,PackageHotelDetails2,PackageHotelImg2,PackageHotelName3,PackageHotelDetails3,PackageBus,PackageTrain,PackageAir,PackageBoat,PackageHotelImg3) VALUES(:pname,:ptype,:plocation,:pprice,:pfeatures,:pdetails,:pimage,:pmap,:pgallery,:pgallery2,:pgoogle,:photelname1,:photeldetails1,:photelimg1,:photelname2,:photeldetails2,:photelimg2,:photelname3,:photeldetails3,:pbus,:ptrain,:pair,:pboat,:photelimg3)";
$query = $dbh->prepare($sql);
$query->bindParam(':pname',$pname,PDO::PARAM_STR);
$query->bindParam(':ptype',$ptype,PDO::PARAM_STR);
$query->bindParam(':plocation',$plocation,PDO::PARAM_STR);
$query->bindParam(':pprice',$pprice,PDO::PARAM_STR);
$query->bindParam(':pfeatures',$pfeatures,PDO::PARAM_STR);
$query->bindParam(':pdetails',$pdetails,PDO::PARAM_STR);
$query->bindParam(':pimage',$pimage,PDO::PARAM_STR);
$query->bindParam(':pmap',$pmap,PDO::PARAM_STR);
$query->bindParam(':pgallery',$pgallery,PDO::PARAM_STR);
$query->bindParam(':pgallery2',$pgallery2,PDO::PARAM_STR);
$query->bindParam(':pgoogle',$pgoogle,PDO::PARAM_STR);
$query->bindParam(':photelname1',$photelname1,PDO::PARAM_STR);
$query->bindParam(':photeldetails1',$photeldetails1,PDO::PARAM_STR);
$query->bindParam(':photelimg1',$photelimg1,PDO::PARAM_STR);
$query->bindParam(':photelname2',$photelname2,PDO::PARAM_STR);
$query->bindParam(':photeldetails2',$photeldetails2,PDO::PARAM_STR);
$query->bindParam(':photelimg2',$photelimg2,PDO::PARAM_STR);
$query->bindParam(':photelname3',$photelname3,PDO::PARAM_STR);
$query->bindParam(':photeldetails3',$photeldetails3,PDO::PARAM_STR);
$query->bindParam(':pbus',$pbus,PDO::PARAM_STR);
$query->bindParam(':ptrain',$ptrain,PDO::PARAM_STR);
$query->bindParam(':pair',$pair,PDO::PARAM_STR);
$query->bindParam(':pboat',$pboat,PDO::PARAM_STR);
$query->bindParam(':photelimg3',$photelimg3,PDO::PARAM_STR);
$query->execute();
$lastInsertId = $dbh->lastInsertId();
if($lastInsertId)
{
$msg="Package Created Successfully";
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
<title>TMS | Admin Package Creation</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Pooled Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<link href="css/bootstrap.min.css" rel='stylesheet' type='text/css' />
<link href="css/style.css" rel='stylesheet' type='text/css' />
<link rel="stylesheet" href="css/morris.css" type="text/css"/>
<link href="css/font-awesome.css" rel="stylesheet"> 
<script src="js/jquery-2.1.4.min.js"></script>
<link href='//fonts.googleapis.com/css?family=Roboto:700,500,300,100italic,100,400' rel='stylesheet' type='text/css'/>
<link href='//fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
<link rel="stylesheet" href="css/icon-font.min.css" type='text/css' />
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
   <div class="page-container">
   <!--/content-inner-->
<div class="left-content">
	   <div class="mother-grid-inner">
              <!--header start here-->
<?php include('includes/header.php');?>
							
				     <div class="clearfix"> </div>	
				</div>
<!--heder end here-->
	<ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="dashboard.php">Home</a><i class="fa fa-angle-right"></i>Update Package </li>
            </ol>
		<!--grid-->
 	<div class="grid-form">
 
<!---->
  <div class="grid-form1">
  	       <h3>Create Package</h3>
  	        	  <?php if($error){?><div class="errorWrap"><strong>ERROR</strong>:<?php echo htmlentities($error); ?> </div><?php } 
				else if($msg){?><div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> </div><?php }?>
  	         <div class="tab-content">
						<div class="tab-pane active" id="horizontal-form">
							<form class="form-horizontal" name="package" method="post" enctype="multipart/form-data">
								<div class="form-group">
									<label for="focusedinput" class="col-sm-2 control-label">Package Name</label>
									<div class="col-sm-8">
										<input type="text" class="form-control1" name="packagename" id="packagename" placeholder="Create Package" required>
									</div>
								</div>
								<div class="form-group">
									<label for="focusedinput" class="col-sm-2 control-label">Package Type</label>
									<div class="col-sm-8">
										<input type="text" class="form-control1" name="packagetype" id="packagetype" placeholder=" Package Type eg- Family Package / Couple Package" required>
									</div>
								</div>

								<div class="form-group">
									<label for="focusedinput" class="col-sm-2 control-label">Package Location</label>
									<div class="col-sm-8">
										<input type="text" class="form-control1" name="packagelocation" id="packagelocation" placeholder=" Package Location" required>
									</div>
								</div>

								<div class="form-group">
									<label for="focusedinput" class="col-sm-2 control-label">Package Price in Tk</label>
									<div class="col-sm-8">
										<input type="text" class="form-control1" name="packageprice" id="packageprice" placeholder=" Package Price is Tk" required>
									</div>
								</div>

								<div class="form-group">
									<label for="focusedinput" class="col-sm-2 control-label">Bus/Train Info</label>
									<div class="col-sm-8">
										<input type="text" class="form-control1" name="packagefeatures" id="packagefeatures" placeholder="Bus/Train Pickup-drop facility" required>
									</div>
								</div>		


								<div class="form-group">
									<label for="focusedinput" class="col-sm-2 control-label">Package Details</label>
									<div class="col-sm-8">
										<textarea class="form-control" rows="5" cols="50" name="packagedetails" id="packagedetails" placeholder="Package Details" required></textarea> 
									</div>
								</div>															
								<div class="form-group">
									<label for="focusedinput" class="col-sm-2 control-label">Package Image</label>
									<div class="col-sm-8">
										<input type="file" name="packageimage" id="packageimage" required>
									</div>
								</div>
								<div class="form-group">
									<label for="focusedinput" class="col-sm-2 control-label">Photo Gallery-1</label>
									<div class="col-sm-8">
										<input type="file" name="packagemap" id="packagemap" required>
									</div>
								</div>
								<div class="form-group">
									<label for="focusedinput" class="col-sm-2 control-label">Photo Gallery-2</label>
									<div class="col-sm-8">
										<input type="file" name="packagepgallery" id="packagepgallery" required>
									</div>
								</div>
								<div class="form-group">
									<label for="focusedinput" class="col-sm-2 control-label">Photo Gallery-3</label>
									<div class="col-sm-8">
										<input type="file" name="packagepgallery2" id="packagepgallery2" required>
									</div>
								</div>
								<div class="form-group">
									<label for="focusedinput" class="col-sm-2 control-label">Google Map URL</label>
									<div class="col-sm-8">
										<textarea class="form-control" rows="5" cols="50" name="packagegoogle" id="packagegoogle" placeholder="Google Map URL" required></textarea> 
									</div>
								</div>
								<div class="form-group">
									<label for="focusedinput" class="col-sm-2 control-label">NearBy- Name (1)</label>
									<div class="col-sm-8">
										<input type="text" class="form-control1" name="packagehotelname1" id="packagehotelname1" placeholder="Hotel Name" required>
									</div>
								</div>
								<div class="form-group">
									<label for="focusedinput" class="col-sm-2 control-label">NearBy Details</label>
									<div class="col-sm-8">
										<input type="text" class="form-control1" name="packagehoteldetails1" id="packagehoteldetails1" placeholder="Hotel Details" required>
									</div>
								</div>
								<div class="form-group">
									<label for="focusedinput" class="col-sm-2 control-label">NearBy Image</label>
									<div class="col-sm-8">
										<input type="file" name="packagehotelimg1" id="packagehotelimg1" required>
									</div>
								</div>
								<div class="form-group">
									<label for="focusedinput" class="col-sm-2 control-label">NearBy Name (2)</label>
									<div class="col-sm-8">
										<input type="text" class="form-control1" name="packagehotelname2" id="packagehotelname2" placeholder="Hotel Name" required>
									</div>
								</div>
								<div class="form-group">
									<label for="focusedinput" class="col-sm-2 control-label">NearBy Details</label>
									<div class="col-sm-8">
										<input type="text" class="form-control1" name="packagehoteldetails2" id="packagehoteldetails2" placeholder="Hotel Details" required>
									</div>
								</div>
								<div class="form-group">
									<label for="focusedinput" class="col-sm-2 control-label">NearBy Image</label>
									<div class="col-sm-8">
										<input type="file" name="packagehotelimg2" id="packagehotelimg2" required>
									</div>
								</div>
								<div class="form-group">
									<label for="focusedinput" class="col-sm-2 control-label">NearBy Name (3)</label>
									<div class="col-sm-8">
										<input type="text" class="form-control1" name="packagehotelname3" id="packagehotelname3" placeholder="Hotel Name" required>
									</div>
								</div>
								<div class="form-group">
									<label for="focusedinput" class="col-sm-2 control-label">NearBy Details</label>
									<div class="col-sm-8">
										<input type="text" class="form-control1" name="packagehoteldetails3" id="packagehoteldetails3" placeholder="Hotel Details" required>
									</div>
								</div>
								<div class="form-group">
									<label for="focusedinput" class="col-sm-2 control-label">NearBy Image</label>
									<div class="col-sm-8">
										<input type="file" name="packagehotelimg3" id="packagehotelimg3" required>
									</div>
								</div>
								<div class="form-group">
									<label for="focusedinput" class="col-sm-2 control-label">Bus Services</label>
									<div class="col-sm-8">
										<input type="text" class="form-control1" name="packagebus" id="packagebus" placeholder="Bus Services" required>
									</div>
								</div>
								<div class="form-group">
									<label for="focusedinput" class="col-sm-2 control-label">Hot Line Number</label>
									<div class="col-sm-8">
										<input type="text" class="form-control1" name="packagetrain" id="packagetrain" placeholder="Hot Line Number" required>
									</div>
								</div>
								<div class="form-group">
									<label for="focusedinput" class="col-sm-2 control-label">Status</label>
									<div class="col-sm-8">
										<input type="text" class="form-control1" name="packageair" id="packageair" placeholder="Status" required>
									</div>
								</div>
								<div class="form-group">
									<label for="focusedinput" class="col-sm-2 control-label">Bus operators and timings</label>
									<div class="col-sm-8">
										<input type="text" class="form-control1" name="packageboat" id="packageboat" placeholder="Bus operators and timings" required>
									</div>
								</div>
								<div class="row">
			<div class="col-sm-8 col-sm-offset-2">
				<button type="submit" name="submit" class="btn-primary btn">Create</button>

				<button type="reset" class="btn-inverse btn">Reset</button>
			</div>
		</div>
						
					
						
						
						
					</div>
					
					</form>

     
      

      
      <div class="panel-footer">
		
	 </div>
    </form>
  </div>
 	</div>
 	<!--//grid-->

<!-- script-for sticky-nav -->
		<script>
		$(document).ready(function() {
			 var navoffeset=$(".header-main").offset().top;
			 $(window).scroll(function(){
				var scrollpos=$(window).scrollTop(); 
				if(scrollpos >=navoffeset){
					$(".header-main").addClass("fixed");
				}else{
					$(".header-main").removeClass("fixed");
				}
			 });
			 
		});
		</script>
		<!-- /script-for sticky-nav -->
<!--inner block start here-->
<div class="inner-block">

</div>
<!--inner block end here-->
<!--copy rights start here-->
<?php include('includes/footer.php');?>
<!--COPY rights end here-->
</div>
</div>
  <!--//content-inner-->
		<!--/sidebar-menu-->
					<?php include('includes/sidebarmenu.php');?>
							  <div class="clearfix"></div>		
							</div>
							<script>
							var toggle = true;
										
							$(".sidebar-icon").click(function() {                
							  if (toggle)
							  {
								$(".page-container").addClass("sidebar-collapsed").removeClass("sidebar-collapsed-back");
								$("#menu span").css({"position":"absolute"});
							  }
							  else
							  {
								$(".page-container").removeClass("sidebar-collapsed").addClass("sidebar-collapsed-back");
								setTimeout(function() {
								  $("#menu span").css({"position":"relative"});
								}, 400);
							  }
											
											toggle = !toggle;
										});
							</script>
<!--js -->
<script src="js/jquery.nicescroll.js"></script>
<script src="js/scripts.js"></script>
<!-- Bootstrap Core JavaScript -->
   <script src="js/bootstrap.min.js"></script>
   <!-- /Bootstrap Core JavaScript -->	   

</body>
</html>
<?php } ?>