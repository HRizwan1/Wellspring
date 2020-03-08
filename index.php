<?php
$conn = mysqli_connect("localhost", "username", "password", "website");
if (isset($_POST["import"])) {
    
    $fileName = $_FILES["file"]["tmp_name"];
    
    if ($_FILES["file"]["size"] > 0) {
        
        $file = fopen($fileName, "r");
        while (($column = fgetcsv($file, 10000, ",")) !== FALSE) {
            if ($column[0] !== "TRAIN_LINE" &&  $column [0] !== " " &&  $column [1] !== " " &&  $column [2] !== " " &&  $column [3] !== " "){
            $sqlInsert = "INSERT into trains (train_line,route_name,run_number,operator_id)
                values ('" . $column[0] . "','" . $column[1] . "','" . $column[2] . "','".$column[3]."')";
            $result = mysqli_query($conn, $sqlInsert);
            }
            if (! empty($result)) {
                $type = "success";
                $message = "Success!";
            } else {
                $type = "error";
                $message = "Error Processing File!";
            }
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="css/cssreset.css">
<link rel="stylesheet" href="css/css.css">
</head>
<body>    
    <div id="response" class="<?php if(!empty($type)) { echo $type . " display-block"; } ?>"><?php if(!empty($message)) { echo $message; } ?></div>
    <div class="outer-scontainer">
        <div class="row">

            <form class="form-horizontal" action="" method="post"
                name="frmCSVImport" id="frmCSVImport" enctype="multipart/form-data">
                <div class="input-row">
                    <label class="col-md-4 control-label">Choose CSV
                        File</label> <input type="file" name="file"
                        id="file" accept=".csv">
                    <button type="submit" id="submit" name="import"
                        class="btn-submit">Import</button>
                    <br />

                </div>

            </form>

        </div>
               <?php
            $sqlSelect = "SELECT * FROM trains";
            $result = mysqli_query($conn, $sqlSelect);
            
            if (mysqli_num_rows($result) > 0) {
                ?>
            <table id='trainsTable'>
            <thead>
                <tr>
                    <th>Train Line</th>
                    <th>Route</th>
                    <th>Run Number</th>
                    <th>Operator ID</th>

                </tr>
            </thead>
<?php
                
                while ($row = mysqli_fetch_array($result)) {
                    ?>
                    
                <tbody>
                <tr>
                    <td><?php  echo $row['train_line']; ?></td>
                    <td><?php  echo $row['route_name']; ?></td>
                    <td><?php  echo $row['run_number']; ?></td>
                    <td><?php  echo $row['operator_id']; ?></td>
                </tr>
                    <?php
                }
                ?>
                </tbody>
        </table>
        <?php } ?>
    </div>

</body>

</html>