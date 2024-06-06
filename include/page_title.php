<?php if ($priviledge == 1){ $page='admin_dashboard'; } else { $page='#'; } ?>
		<div class="content-wrapper">
			<div class="content-header">
				<div class="container-fluid">
					<div class="row mb-2">
						<div class="col-sm-6">
							<h6 class="m-0"><?php //echo strtoupper(getSchName($sch_id));?></h6>
						</div>
						<div class="col-sm-6">
							<ol class="breadcrumb float-sm-right">
								<li class="breadcrumb-item"><a href="<?php echo $page;?>">Home</a></li>
								<li class="breadcrumb-item active"><?php echo $page_title;?></li>
							</ol>
						</div>
					</div>
				</div>
			</div>