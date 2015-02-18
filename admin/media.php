<?php
session_start();
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
date_default_timezone_set("Asia/Makassar");

include "../config/koneksi.php";
include "../config/fungsi_indotgl.php";
include "../config/fungsi_thumb.php";
include "../config/fungsiku.php";
include '../config/konfigurasi.php';

if (!$_SESSION['sesId']){
echo "<meta http-equiv=refresh content=\"0;url=index.php\">";
exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
		<meta charset="utf-8" />
		<title><?php echo $_CONFIG['appname'];?></title>

		<meta name="description" content="" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />

		<!--basic styles-->

		<link href="assets/css/bootstrap.min.css" rel="stylesheet" />
		<link href="assets/css/bootstrap-responsive.min.css" rel="stylesheet" />
		<link rel="stylesheet" href="assets/css/font-awesome.min.css" />
		<link rel="stylesheet" href="assets/css/chosen.css" />
		<link rel="stylesheet" href="assets/css/datepicker.css" />
		<link rel="stylesheet" href="assets/css/bootstrap-timepicker.css" />

		<link rel="stylesheet" href="assets/css/jquery-ui-1.10.3.custom.min.css" />
		<link rel="stylesheet" href="assets/css/jquery.gritter.css" />
		<script src="assets/js/bootbox.min.js"></script>

		<!--[if IE 7]>
		  <link rel="stylesheet" href="../assets/css/font-awesome-ie7.min.css" />
		<![endif]-->

		<!--page specific plugin styles-->

		<!--fonts-->

		<link rel="stylesheet" href="../../../../fonts.googleapis.com/css5c0a.css?family=Open+Sans:400,300" />

		<!--ace styles-->

		<link rel="stylesheet" href="assets/css/ace.min.css" />
		<link rel="stylesheet" href="assets/css/ace-responsive.min.css" />
		<link rel="stylesheet" href="assets/css/ace-skins.min.css" />

		<!--[if lte IE 8]>
		  <link rel="stylesheet" href="assets/css/ace-ie.min.css" />
		<![endif]-->

		<!--inline styles related to this page-->

		<!--ace settings handler-->

		<script src="assets/js/ace-extra.min.js"></script>


<!--BASIC SCRIPT-->
			<!--[if !IE]>-->
			<script src="../../../../ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
			<!--<![endif]-->

			<!--[if IE]>
			<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
			<![endif]-->

			<!--[if !IE]>-->
			<script type="text/javascript">
				window.jQuery || document.write("<script src='assets/js/jquery-2.0.3.min.js'>"+"<"+"/script>");
			</script>
			<!--<![endif]-->

			<!--[if IE]>
			<script type="text/javascript">
	 			window.jQuery || document.write("<script src='assets/js/jquery-1.10.2.min.js'>"+"<"+"/script>");
			</script>
			<![endif]-->

			<script type="text/javascript">
				if("ontouchend" in document) document.write("<script src='assets/js/jquery.mobile.custom.min.js'>"+"<"+"/script>");
			</script>
			<script src="assets/js/bootstrap.min.js"></script>
		<!--BASIC SCRIPT-->




<!--PAGE SPESIFIC PLUGIN SCRIPT-->

			<!--[if lte IE 8]>
			  <script src="assets/js/excanvas.min.js"></script>
			<![endif]-->

			<script src="assets/js/jquery-ui-1.10.3.custom.min.js"></script>
			<script src="assets/js/jquery.ui.touch-punch.min.js"></script>
      	<script src="assets/js/chosen.jquery.min.js"></script>
			<script src="assets/js/date-time/bootstrap-datepicker.min.js"></script>
			<script src="assets/js/bootbox.min.js"></script>
			<script src="assets/js/jquery.gritter.min.js"></script>
			<script src="assets/js/bootbox.min.js"></script>
			<script src="assets/js/ace-elements.min.js"></script>
			<script src="assets/js/ace.min.js"></script>
			
			<script src="assets/ckeditor/ckeditor.js"></script>
			
			<script src="assets/js/markdown/markdown.min.js"></script>
			<script src="assets/js/markdown/bootstrap-markdown.min.js"></script>
			<script src="assets/js/jquery.hotkeys.min.js"></script>
			<script src="assets/js/bootstrap-wysiwyg.min.js"></script>

			<script src="assets/js/jquery.dataTables.min.js"></script>
      	<script src="assets/js/jquery.dataTables.bootstrap.js"></script>


      	<!-- DATATABLES-->
      	<script type="text/javascript">
		   jQuery(function($) {
		      var oTable1 = $('#myTable').dataTable();
		   
		      $('[data-rel="tooltip"]').tooltip({placement: tooltip_placement});
		      function tooltip_placement(context, source) {
		         var $source = $(source);
		         var $parent = $source.closest('table')
		         var off1 = $parent.offset();
		         var w1 = $parent.width();
		   
		         var off2 = $source.offset();
		         var w2 = $source.width();
		   
		         if( parseInt(off2.left) < parseInt(off1.left) + parseInt(w1 / 2) ) return 'right';
		         return 'left';
		      }
		   })
			</script>
			<!-- DATATABLES-->

			<!-- GRITTER NOTIF -->
			
			<script type="text/javascript">
			function notifsukses(x,y){
				jQuery.gritter.add({
					title: x,
					text: y,
					class_name: 'gritter-success'
				});
				return false;
			}
			function notiferror(x,y){
				jQuery.gritter.add({
					title: x,
					text: y,
					class_name: 'gritter-error'
				});
				return false;
			}
			function NewWindow(mypage,myname,w,h,scroll){
				LeftPosition = (screen.width) ? (screen.width-w)/2 : 0;
				TopPosition = (screen.height) ? 0 : 0;
				settings = 'height='+h+',width='+w+',top='+TopPosition+',left='+LeftPosition+',scrollbars='+scroll+',resizable'
				win = window.open(mypage,myname,settings)
				if(win.window.focus){
					win.window.focus();
				}
			}
			</script>

			<script type="text/javascript">
			function qh() {
				if (confirm("Yakin Hapus Data ?")){
					return true;
				}else{
					return false;
				}
			}
			</script>
			<!-- GRITTER NOTIF -->

			<!-- UPLOADER IMAGE -->
			<script type="text/javascript">
		   jQuery(function($) {
		   	$('#foto')
				.find('input[type=file]').ace_file_input({
					style:'well',
					btn_choose:'Image',
					btn_change:null,
					no_icon:'icon-picture',
					thumbnail:'large',
					droppable:true,
					before_change: function(files, dropped) {
						var file = files[0];
						if(typeof file === "string") {//files is just a file name here (in browsers that don't support FileReader API)
							if(! (/\.(jpe?g|png|gif)$/i).test(file) ) return false;
						}
						else {//file is a File object
							var type = $.trim(file.type);
							if( ( type.length > 0 && ! (/^image\/(jpe?g|png|gif)$/i).test(type) )
									|| ( type.length == 0 && ! (/\.(jpe?g|png|gif)$/i).test(file.name) )//for android default browser!
								) return false;
			
							if( file.size > 1100000 ) {//~1MB
								return false;
							}
						}
			
						return true;
					}
				})
				$.end().find('button[type=reset]').on(ace.click_event, function(){
					$('#foto input[type=file]').ace_file_input('reset_input');
				})
		   })
			</script>
			<!-- UPLOADER IMAGE -->
			<!-- GMAP -->
			<script>
		      function initialize() {
		        var map_canvas = document.getElementById('map_canvas');
		        var map_options = {
		          center: new google.maps.LatLng(-5.143662, 119.426339),
		          zoom: 8,
		          mapTypeId: google.maps.MapTypeId.ROADMAP
		        }
		        var #map = new google.maps.Map(map_canvas, map_options)

		      }
		      google.maps.event.addDomListener(window, 'load', initialize);
	  </script>
	  <!-- GMAP -->

	</head>

	<body>
		<div class="navbar" id="navbar">
			<script type="text/javascript">
				try{ace.settings.check('navbar' , 'fixed')}catch(e){}
			</script>

			<div class="navbar-inner">
				<div class="container-fluid">
					<ul class="nav ace-nav">
						<li class="light-blue">
							<a href="#">
								<img src="<?php echo $_CONFIG['slogo'];?>">
							</a>
						</li>
					</ul><!--/.ace-nav-->
					
					<a href="#" class="brand">
						<small>
							<?php echo $_CONFIG['appname'];?>
						</small>
					</a><!--/.brand-->

					<ul class="nav ace-nav pull-right">
						<?php
						if(!empty($_SESSION['sesId'])){
						?>
							<li class="light-blue">
							<a data-toggle="dropdown" href="#" class="dropdown-toggle">
								<img class="nav-user-photo" src="../images/photo.jpg" alt="<?php echo $_SESSION['sesNama'];?>">
								<span class="user-info">
									<small>Selamat Datang,</small><?php echo $_SESSION['sesNama'];?>
								</span>
								<i class="icon-caret-down"></i>
							</a>
								<ul class="user-menu pull-right dropdown-menu dropdown-yellow dropdown-caret dropdown-closer">
									<li><a href="logout.php"><i class="icon-off"></i>Logout</a></li>
								</ul>
							</li>
						<?php
						}
						?>
					</ul><!--/.ace-nav-->
				</div><!--/.container-fluid-->
			</div><!--/.navbar-inner-->

		</div>

		<div class="main-container container-fluid">
			<a class="menu-toggler" id="menu-toggler" href="#">
				<span class="menu-text"></span>
			</a>

			<div class="sidebar" id="sidebar">
				<script type="text/javascript">
					try{ace.settings.check('sidebar' , 'fixed')}catch(e){}
				</script>

				<?php 
					include "menu.php";
				?>

				<div class="sidebar-collapse" id="sidebar-collapse">
					<i class="icon-double-angle-left" data-icon1="icon-double-angle-left" data-icon2="icon-double-angle-right"></i>
				</div>
				<br><br><br>
				
				<ul class="nav-list">
				<li><a href="#"><span class="menu-text"><center><?php echo date("Y");?> &copy; <?php echo $_CONFIG[syscopyright];?></center></span></a></li>
			</ul>

				<script type="text/javascript">
					try{ace.settings.check('sidebar' , 'collapsed')}catch(e){}
				</script>
			</div>

			<div class="main-content">
				<div class="page-content">
					<?php
						include "content.php";
					?>							
				</div><!--/.page-content-->

				<div class="ace-settings-container" id="ace-settings-container">
					<div class="btn btn-app btn-mini btn-warning ace-settings-btn" id="ace-settings-btn">
						<i class="icon-cog bigger-150"></i>
					</div>

					<div class="ace-settings-box" id="ace-settings-box">
						<div>
							<div class="pull-left">
								<select id="skin-colorpicker" class="hide">
									<option data-skin="default" value="#438EB9">#438EB9</option>
									<option data-skin="skin-1" value="#222A2D">#222A2D</option>
									<option data-skin="skin-2" value="#C6487E">#C6487E</option>
									<option data-skin="skin-3" value="#D0D0D0">#D0D0D0</option>
								</select>
							</div>
							<span>&nbsp; Pilih Thema</span>
						</div>
						<div>
							<input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-navbar" />
							<label class="lbl" for="ace-settings-navbar"> Lock Navbar</label>
						</div>
						<div>
							<input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-sidebar" />
							<label class="lbl" for="ace-settings-sidebar"> Lock Sidebar</label>
						</div>

						
					</div>
				</div><!--/#ace-settings-container-->
			</div><!--/.main-content-->
		</div><!--/.main-container-->

		<a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-small btn-inverse">
			<i class="icon-double-angle-up icon-only bigger-110"></i>
		</a>
		<!--inline scripts related to this page-->
			<script type="text/javascript">
   		$(".chosen-select").chosen(); 
   		$('[data-rel=tooltip]').tooltip({container:'body'});
   		$('.date-picker').datepicker().next().on(ace.click_event, function(){
				$(this).prev().focus();
			});
      	</script>
      <!--inline scripts related to this page-->
	</body>
</html>