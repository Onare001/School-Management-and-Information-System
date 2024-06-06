<?php $page_title = "Check System Health"; ?>
<?php include ('include/connection.php'); include ('functions/functions.php'); include ('include/lock_web.php');?>

<!DOCTYPE html>
<html lang="en">
<?php include('include/styles.php');?>

<?php include('include/header.php');?>
<?php include('include/side_nav.php');?>

<?php include('include/page_title.php');?> 

			<div class="col-12">
				<div class="card">
					<div class="card-header">
						<h3 class="card-title">
						<i class="fa fa-recycle">&nbsp;&nbsp;</i> Check System Health</h3>
						<?php if (isset($msg)){echo $msg_toastr;}?>
						<div class="card-tools">
							<div class="input-group input-group-sm" style="width: 150px;">
								<input type="text" name="table_search" class="form-control float-right" placeholder="Search">
								<div class="input-group-append">
									<button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
								</div>
							</div>
						</div>
					</div>
<?php
// Database connection parameters for Database 1
$hostname1 = "localhost";
$username1 = "root";
$password1 = "";
$database1 = "goldspring_sms_junior";

// Create connections for both databases
$conn1 = new mysqli($hostname1, $username1, $password1, $database1);
$conn2 = $conn;

// Function to get the list of tables in a database
function getTables($conn) {
    $tables = array();
    $result = mysqli_query($conn,"SHOW TABLES");
    
    while ($row = mysqli_fetch_row($result)) {
        $tables[] = $row[0];
    }

    return $tables;
}

// Function to get the list of columns for a table
function getColumns($conny, $table) {
    $columns = array();
    $result = mysqli_query($conny,"SHOW COLUMNS FROM $table");

    while ($row = mysqli_fetch_assoc($result)) {
        $columns[] = $row['Field'];
    }

    return $columns;
}

// Get the list of tables for each database
$tables1 = getTables($conn1);
$tables2 = getTables($conn2);

// Compare tables
$missingTables1 = array_diff($tables2, $tables1);
$missingTables2 = array_diff($tables1, $tables2);

// Output missing tables
if (!empty($missingTables1)) {
    echo "Tables missing in Database 1: <br>" . implode(', ', $missingTables1) . "<br> \n";
}

if (!empty($missingTables2)) {
    echo '<div style="background-color:red;color:white;padding:10px;">'.'Tables missing in '.$_SESSION['selected_database'].':  <br>' . implode(', ', $missingTables2).'</div>';
}

// Compare columns for each table
foreach ($tables1 as $table) {
    $columns1 = getColumns($conn1, $table);
    $columns2 = getColumns($conn2, $table);

    $missingColumns1 = array_diff($columns2, $columns1);
    $missingColumns2 = array_diff($columns1, $columns2);

    // Output missing columns
    if (!empty($missingColumns1)) {
        echo "Columns missing in Database 1 for table '$table': " . implode(', ', $missingColumns1) . "\n";
    }

    if (!empty($missingColumns2)) {
        echo '<div style="background-color:red;color:white;padding:10px;">'.'Columns missing in '.$_SESSION['selected_database'].' for table '.$table.': ' . implode(', ', $missingColumns2) . '</div>';
    }
}
?>








<?php
// Function to create a table with columns
function createTable($conn, $tableName, $columns) {
    $sql = "CREATE TABLE $tableName (";
    foreach ($columns as $column) {
        $sql .= "$column VARCHAR(255), ";
    }
    $sql = rtrim($sql, ', ') . ")";
    
    if ($conn->query($sql) === TRUE) {
        echo "Table '$tableName' created successfully.\n";
    } else {
        echo "Error creating table '$tableName': " . $conn->error . "\n";
    }
}

// Function to add missing columns to a table
function addColumns($conn, $tableName, $missingColumns) {
    foreach ($missingColumns as $column) {
        $sql = "ALTER TABLE $tableName ADD $column VARCHAR(255)";
        
        if ($conn->query($sql) === TRUE) {
            echo "Column '$column' added to table '$tableName' successfully.\n";
        } else {
            echo "Error adding column '$column' to table '$tableName': " . $conn->error . "\n";
        }
    }
}

// Check if the button is pressed
if (isset($_POST['create_missing_tables'])) {
    // Define expected tables and columns
    $expectedStructure = array(
        'table1' => array('column1', 'column2', 'column3'),
        'table2' => array('column4', 'column5'),
        // Add more tables and columns as needed
    );

    // Get the list of existing tables
    $existingTables = getTables($conn);

    // Compare existing tables and columns with the expected structure
    foreach ($expectedStructure as $table => $columns) {
        if (!in_array($table, $existingTables)) {
            createTable($conn, $table, $columns);
        } else {
            // Get the list of existing columns for the table
            $existingColumns = getColumns($conn, $table);

            // Compare columns
            $missingColumns = array_diff($columns, $existingColumns);
            if (!empty($missingColumns)) {
                addColumns($conn, $table, $missingColumns);
            }
        }
    }
}
?>
		<form method="post">
			<button type="submit" name="create_missing_tables">Create Missing Tables</button>
		</form>
	</div>
</div>
<?php include ('include/footer.php');?>
<?php include ('include/page_scripts/general_script.php');?>
</html>