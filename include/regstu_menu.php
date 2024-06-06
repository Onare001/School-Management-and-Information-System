			<?php /*<!--div class="card box-solid" style="margin-left:10px;margin-right:10px;height:60px;width:0 auto;">
				<div class="card-header with-border" id="button-container">
					<button title="back" onclick="goBack()" id="buttonn" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Back </button>
					<button title="View Photo Album" onclick="location.href='view_stdnt_photo?cid=<?php //echo encrypt($class_id).'&cat=<?php //echo encrypt($cat_id).'"id="buttonn" class="btn btn-primary"><i class="fa fa-camera"></i> View Photo Album </button>
					<button title="Print Student ID Card" onclick="location.href='stdnt_idcard?cid=<?php //echo encrypt($class_id).'&cat=<?php //echo encrypt($cat_id).'"id="buttonn" class="btn btn-primary"><i class="fa fa-tag"></i> Print Student' ID Card </button>
					<button title="Print Score Sheet" onclick="location.href='view_score_sheet?cid=<?php //echo encrypt($class_id).'&cat=<?php //echo encrypt($cat_id).''"id="buttonn" class="btn btn-primary"><i class="fa fa-print"></i> Print Score Sheet </button>						
					<button title="View Class Biodata" onclick="location.href='view_class_biodata?cid=<?php //echo encrypt($class_id).'&cat=<?php //echo encrypt($cat_id).'"id="buttonn" class="btn btn-primary"><i class="fa fa-download"></i> View Class Biodata </button>
					<button title="Inactive Students" onclick="location.href='view_inactive_stu?cid=<?php //echo encrypt($class_id).'&cat=<?php //echo encrypt($cat_id).'"id="buttonn" class="btn btn-primary"><i class="fa fa-times"></i> Inactive Students </button>
				</div>
			</div-->*/;?>
						<?php
							if ($priviledge == '1') {
								echo '
								<div class="sticky-top mb-3">
									<div class="card">
										<div class="card-header">
											<h3 class="card-title"><b>' . getClass($class_id) . '&nbsp;' . getCategory($cat_id) . ' | '.$page_title.'</b></h3>
										</div>
										<div class="card-body">
											<div id="external-events" style="font-size:12px;">
												<div class="external-event bg-danger"><i class="fa fa-plus"></i> Total in Class: ' . getTotal_in_class($sch_id, $class_id, $cat_id) . '</div>
												<div class="external-event bg-pink"><i class="fa fa-venus"></i> No. of Female: ' . getNumClassFemale($sch_id, $class_id, $cat_id) . '</div>
												<div class="external-event bg-primary"><i class="fa fa-mars"></i> No. of Male: ' . getNumClassMale($sch_id, $class_id, $cat_id) . '</div>
											</div>
										</div>
									</div>
									<div class="card">
										<div class="card-body">
											<style> .btn-block{font-size:12px;}</style>
											<button type="button" title="back" onclick="goBack()" class="btn btn-secondary btn-block btn-sm"><i class="fa fa-arrow-left"></i> Back </button>
											
											<button type="button" title="Add new student" onclick="location.href=\'register_student?cid=' . encrypt($class_id) . '&cat=' . encrypt($cat_id) . '\'" class="btn btn-primary btn-block btn-sm"><i class="fa fa-user-plus"></i> Add New Student </button>
											
											<button title="View Photo Album" onclick="location.href=\'view_stdnt_photo?cid=' . encrypt($class_id) . '&cat=' . encrypt($cat_id) . ' \'" class="btn btn-primary btn-block btn-sm"><i class="fa fa-camera"></i> View Photo Album </button>
											
											<button onclick="window.open(\'stdnt_idcard?cid=' . urlencode(encrypt($class_id)) . '&cat=' . urlencode(encrypt($cat_id)) . '\', \'_blank\', \'width=800,height=600\')" class="btn btn-primary btn-block btn-sm"><i class="fa fa-tag"></i> Print Identity Card </button>
											
											<button title="Print Score Sheet" onclick="location.href=\'view_score_sheet?cid=' . encrypt($class_id) . '&cat=' . encrypt($cat_id) . '&sid=' . encrypt('0'). '\'" class="btn btn-primary btn-block btn-sm"><i class="fa fa-print"></i> Print Score Sheet </button>
											
											<button title="View Class Biodata" onclick="location.href=\'view_class_biodata?cid=' . encrypt($class_id) . '&cat=' . encrypt($cat_id) . '\'" class="btn btn-primary btn-block btn-sm"><i class="fa fa-download"></i> View Class Biodata </button>
											
											<button title="Inactive Students" onclick="location.href=\'view_inactive_stu?cid=' . encrypt($class_id) . '&cat=' . encrypt($cat_id) . '\'" class="btn btn-primary btn-block btn-sm"><i class="fa fa-times"></i> Inactive Students </button> 
										</div>
									</div>
								</div>';
							} else {
    echo '
    <div class="sticky-top mb-3">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title"><b>'.getClass($class_id).' '.getCategory($cat_id).'</b></h3>
            </div>
            <div class="card-body">
                <div id="external-events" style="font-size:12px;">
                    <div class="external-event bg-danger"><i class="fa fa-plus"></i> Total stu. in Class: '. getTotal_in_class($sch_id, $class_id, $cat_id).'</div>
                    <div class="external-event bg-success"><i class="fa fa-server"></i> No. Reg Stu: '.  getTotalNumStuPerSubj($sch_id, $class_id, $cat_id, $subj_id).'</div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body">    
                <form action="" method="post">
                    <style> .btn-block{font-size:12px;}</style>
                    <button title="back" type="button" onclick="goBack()" class="btn btn-secondary btn-block btn-sm"><i class="fa fa-arrow-left"></i> Back</button>
                    
                    <button title="View_score_sheet" type="button" onclick="location.href=\'view_score_sheet?cid='.encrypt($class_id).'&cat='.encrypt($cat_id).'&sid='.encrypt($subj_id).'&tid='.encrypt($ctid).'&sesid='.encrypt($csid).'\'" class="btn btn-primary btn-block btn-sm"><i class="fa fa-eye"></i> Print Score Sheet</button>
                    
                    <button type="submit" name="download_csv" class="btn btn-primary btn-block btn-sm"><i class="fa fa-download"></i> Download CSV Format</button>
                    
                    <button title="Preview Entered Score" type="button" onclick="location.href=\'preview_score?cid='.encrypt($class_id).'&did='.encrypt($cat_id).'&sid='.encrypt($subj_id).'&tid='.encrypt($ctid).'&sesid='.encrypt($csid).'\'" class="btn btn-primary btn-block btn-sm"><i class="fa fa-eye"></i> Preview Entered Score</button>
                    
                    <button title="Instrutions" type="button" class="btn btn-primary btn-block btn-sm" data-toggle="modal" data-target="#instructions-default"><i class="fa fa-list"></i> Instructions</button>
                    <button type="button" onclick="location.href=\'enter_score?cid='.encrypt($class_id).'&did='.encrypt($cat_id).'&sid='.encrypt($subj_id).'&tid='.encrypt($ctid).'&sesid='.encrypt($csid).'\'" class="btn btn-primary btn-block btn-sm"><i class="fa fa-percent">&nbsp;&nbsp;</i>Back to Enter Score</button>
                </form>
            </div>
        </div>
    </div>';
}
?>
