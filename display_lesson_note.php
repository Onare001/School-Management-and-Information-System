<?php $theme = ""; $page_title = "My Lesson Note"; ?>
<?php include "include/connection.php"; ?>
<?php include ("functions/functions.php"); ?>
<?php include ("include/lock_all.php"); ?>
<?php 
	if(isset($_GET['url'])){
		$url = base64_decode($_GET['url']); //base64_decode
		$topic = base64_decode($_GET['topic']);
	} else {
		//
	}	
?>
<!DOCTYPE html>
<html lang="en">
<?php include('include/styles2.php');?>
	<body class="layout layout-header-fixed" style="margin-top:0px; padding-top:0px;">
		<div class="card">
			<div class="card-body" data-toggle="match-height">
				<div class="col-md-12 card">					
					<table>
						<thead style="font-size:3vw;">
							<tr>
								<th class="text-center"><img src="<?php echo getSchLogo($sch_id);?>" width="90px" height="90px" class="img-circle"/></th>
								<th class="text-center"><h2 style="font-family:Imprint MT Shadow; color:white;margin:0px auto;"><span><?php echo getSchName($sch_id);?></span></h2></th>
							</tr>                      
						</thead>
						<tbody style="font-size:2vw;">
							<tr>    
								<td colspan="2" class="text-center" style="min-width:100px"> LESSON NOTE | Week: | <?php echo $topic;?></td>
							</tr>                      
							<tr>
								<td colspan="2">
									<object data="<?php echo $url;?>" type="application/pdf" width="100%" height="700px">
									<p>Your web browser doesn't have a PDF plugin. <a href="<?php echo $url;?>">click here to download the PDF file.</a></p></object>
								</td>
							</tr>									
						</tbody>
					</table>
					<div class="modal-footer">
						<button onclick="window.close()" class="btn btn-secondary">Close</button>
						<form action="#">
							<input type="button" name="print" value="PRINT" '+' onClick="javascript:window.print()" class="btn btn-success" style="height:34px;">
						</form>
					</div>
				</div>
				<div class="footer">
					<div class="layout-footer-body">
						<small class="copyright">Copyright © 2023 SMS. Powered by Niel Technologies +2348145162722. All Rights Reserved.</a></small>
					</div>
				</div>
			</div>
		</div>
	</body>
	<style>
		.footer{
			background: darkblue;
			text-align:center;
			color:white;
			padding:10px;
		}
	</style>
</html>