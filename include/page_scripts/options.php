<script type="text/javascript">
	document.getElementById('sel_class').value = "<?php if (isset($_POST['class_id'])) { echo $_POST['class_id']; } else { echo ''; }?>";
</script>
<script type="text/javascript">
	document.getElementById('sel_cat').value = "<?php if (isset($_POST['cat_id'])) { echo $_POST['cat_id']; } else { echo ''; }?>";
</script>	
<script type="text/javascript">
	document.getElementById('sel_subj').value = "<?php if (isset($_POST['subj_id'])) { echo $_POST['subj_id']; } else { echo ''; }?>";
</script>
<script type="text/javascript">
	document.getElementById('sel_term').value = "<?php if (isset($_POST['term_id'])) { echo $_POST['term_id']; } else { echo ''; }?>";
</script>
<script type="text/javascript">
	document.getElementById('sel_session').value = "<?php if (isset($_POST['session_id'])) { echo $_POST['session_id']; } else { echo ''; }?>";
</script>
<script type="text/javascript">
	document.getElementById('exam_type').value = "<?php if (isset($_POST['exam_type'])) { echo $_POST['exam_type']; } else { echo ''; }?>";
</script>
<script type="text/javascript">
	document.getElementById('duration').value = "<?php if (isset($_POST['duration'])) { echo $_POST['duration']; } else { echo ''; }?>";
</script>
<script type="text/javascript">
	document.getElementById('noquestion').value = "<?php if (isset($_POST['no_of_question'])) { echo $_POST['no_of_question']; } else { echo ''; }?>";
</script>
<script>
if ( window.history.replaceState ) {
  window.history.replaceState( null, null, window.location.href );
}
</script>
