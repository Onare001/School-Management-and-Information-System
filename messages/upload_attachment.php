<?php
/*
if (isset($_POST['submit'])){
	$sch_id = addslashes($_POST['sch_id']);
	$sender = addslashes($_POST['user_id']);
	$receiver = addslashes($_POST['receiver']);
	
	$recrid = getUserid($receiver);
	
	$subject = addslashes($_POST['subject']);
	$content = addslashes($_POST['content']);
	$message = "INSERT INTO `messages`(sch_id, sender, receiver, subject, content) VALUES ('$sch_id','$sender','$recrid','$subject','$content')";
	$result = mysqli_query($conn,$message);
	if ($result){
		echo ('<script>alert("Message Sent")</script>');
	}
}
*/
?>

<?php
			
	include 'include/connection.php';
 
	if (isset($_POST['submit'])){
			$sch_id = addslashes($_POST['sch_id']);
			$sender = addslashes($_POST['user_id']);
			$receiver = addslashes($_POST['receiver']);
			
			$recrid = getUserid($receiver);
			
			$subject = addslashes($_POST['subject']);
			$content = addslashes($_POST['content']);

            $maxsize = 1000000000000000; // 1TB#  
            $file_name = $_FILES['file_name']['name'];
			//$book_title = substr("$file_name", 0,-4);
            $target_dir = "attachment/";
            $target_file = $target_dir . $_FILES["file_name"]["name"];

            // Select file type
            $fileFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

            // Valid file extensions
            $extensions_arr = array("doc","docx","pdf","txt","zip","xlsx","apk","mhtml","html","php");

            // Check extension
            if( in_array($fileFileType,$extensions_arr) ){
                
                // Check file size
                if(($_FILES['file_name']['size'] >= $maxsize) || ($_FILES["file_name"]["size"] == 0)) {
                    echo "file too large. file must be less than 1TB.";
                }else{
                    // Upload
                    if(move_uploaded_file($_FILES['file_name']['tmp_name'],$target_file)){
                        // Insert record
$query = "INSERT INTO `messages`(sch_id, sender, receiver, subject, content, attachment) VALUES ('$sch_id','$sender','$recrid','$subject','$content', '$file_name')";
                        mysqli_query($conn,$query);
                        echo "Upload successfully.";
                    }
                }

            }else{
                echo "Invalid file_name extension.";
            }
        
        }
        ?>