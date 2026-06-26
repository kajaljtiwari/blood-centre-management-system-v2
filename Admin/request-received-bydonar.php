

<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0)
	{	
header('location:index.php');
}
else{


 ?>

<!doctype html>
<html lang="en" class="no-js">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">
	<meta name="theme-color" content="#3e454c">

  <style>
	/* --- Main Content Wrapper --- */
    
    body {
            font-family: Arial, sans-serif;
            background: #f8f9fa;
            margin top: 300;
            padding: 20px;
            margin-left: -20px;        
           margin-top: 50px;


        }
        .container {
    width: 80%;
    margin: 0 auto;
    padding: 20px;
    background: #f8f9fa;
    border-radius: 8px;
    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);

    /* ADD THIS TO ACCOUNT FOR SIDEBAR */
    margin-left: 250px; /* or whatever your sidebar width is */
    margin-top: 50px;
}

.content-wrapper {
    padding: 20px;
    background: #f5f5f5;
}

/* --- Search Form Styling --- */
.form-horizontal {
    background: #fff;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
    max-width: 500px;
    margin: auto;
	margin-top: 200px;

}

/* Input Field */
.form-control {
    width: 100%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 6px;
    font-size: 14px;
    background-color: #f9f9f9;
    transition: all 0.3s ease-in-out;
}

.form-control:focus {
    background-color: #fff;
    border-color: #007bff;
    outline: none;
    box-shadow: 0 0 6px rgba(0, 123, 255, 0.3);
}

/* Search Button */
.btn-primary {
    background-color: #007bff;
    border: none;
    padding: 10px 24px;
    font-size: 15px;
    font-weight: 600;
    border-radius: 6px;
    color: #fff;
    cursor: pointer;
    transition: background 0.3s ease;
    width: 100%;
}

.btn-primary:hover {
    background-color: #0056b3;
}

/* --- Results Table --- */
.table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
    background: #fff;
    border-radius: 8px;
    box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
    overflow: hidden;
}

.table th {
    background: #007bff;
    color: #fff;
    padding: 12px;
    text-align: left;
    font-size: 15px;
}

.table td {
    padding: 10px;
    border-bottom: 1px solid #ddd;
    font-size: 14px;
}

/* Alternate row background */
.table tbody tr:nth-child(even) {
    background: #f9f9f9;
}

/* No Record Found Styling */
.no-record {
    color: red;
    font-size: 16px;
    font-weight: bold;
    text-align: center;
    padding: 10px;
}

/* --- Success & Error Messages --- */
.succWrap, .errorWrap {
    padding: 12px 15px;
    margin: 20px 0;
    border-radius: 6px;
    font-size: 15px;
    font-weight: 500;
    text-align: center;
}

.succWrap {
    background-color: #d1f0d1;
    color: #2e7d32;
    border-left: 5px solid #28a745;
}

.errorWrap {
    background-color: #f8d7da;
    color: #c0392b;
    border-left: 5px solid #dc3545;
}

		</style>

</head>
<body>
	<?php include('includes/header2.php');?>


	<div class="ts-main-content">
		<?php include('includes/leftbar.php');?>
		<div class="content-wrapper">
			<div class="container-fluid">

				

						<div class="panel-body">
										<form method="post" name="search" class="form-horizontal" onSubmit="return valid();">
											<div class="form-group">
												<label class="col-sm-4 control-label">Search by Donor or Requirer Name / Phone Number</label>
												<div class="col-sm-8">
													<input type="text" class="form-control" name="searchdata" id="searchdata" required>
												</div>
											</div>
											<div class="hr-dashed"></div>
											
										
								
											
											<div class="form-group">
												<div class="col-sm-8 col-sm-offset-4">
								
													<button class="btn btn-primary" name="search" type="submit">Search</button>
												</div>
											</div>

										</form>

									</div>
					<div class="col-md-12">

						<?php
if(isset($_POST['search']))
{ 

$sdata=$_POST['searchdata'];
  ?>
  <h4 align="center">Result against "<?php echo $sdata;?>" keyword </h4>

						<!-- Zero Configuration Table -->
						<div class="panel panel-default">
							<div class="panel-heading">Blood Info</div>
							<div class="panel-body">
							
								<table border="1" class="table table-responsive">
                                    <thead>
                                         <tr>
                                         	<th>S.No</th>
                                          <th>Name of Donar</th>
                                          <th>Conatact Number of Donar</th>
                                            <th>Name of Requirer</th>
                                            <th>Mobile Number of Requirer</th>
                                            <th>Email of Requirer</th>
                                            <th>Blood Require For</th>
                                            <th>Message of Requirer</th>
                                            <th>Apply Date</th>
                                        </tr>
                                    </thead>
                                   
                                    <tbody>
                                       
                                        <tr><?php
                                          
$sql="SELECT tblbloodrequirer.BloodDonarID,tblbloodrequirer.name,tblbloodrequirer.EmailId,tblbloodrequirer.ContactNumber,tblbloodrequirer.BloodRequirefor,tblbloodrequirer.Message,tblbloodrequirer.ApplyDate,tblblooddonars.id as donid,tblblooddonars.FullName,tblblooddonars.MobileNumber from  tblbloodrequirer join tblblooddonars on tblblooddonars.id=tblbloodrequirer.BloodDonarID where tblblooddonars.FullName like '%$sdata%' || tblblooddonars.MobileNumber like '%$sdata%' || tblbloodrequirer.name like '%$sdata%' || tblbloodrequirer.ContactNumber like '%$sdata%'";
$query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $row)
{               ?>
                                            <td><?php echo htmlentities($cnt);?></td>
                                            <td><?php  echo htmlentities($row->FullName);?></td>
                                            <td><?php  echo htmlentities($row->MobileNumber);?></td>
                                        <td><?php  echo htmlentities($row->name);?></td>
                                             <td><?php  echo htmlentities($row->ContactNumber);?></td>
                                             <td><?php  echo htmlentities($row->EmailId);?></td>
                                          <td><?php  echo htmlentities($row->BloodRequirefor);?></td>
                                          
                     
                 <td><?php  echo htmlentities($row->Message);?> 
                  </td>
                               
                                            <td>
                                              <?php  echo htmlentities($row->ApplyDate);?>  
                                            </td>
                                        </tr>
                                    <?php $cnt=$cnt+1;}} else {?>
                                        <tr>
                                            <th colspan="8" style="color:red;"> No Record found</th>
                                        </tr>
                                    <?php } }?>
                                    </tbody>
                                </table>

						

							</div>
						</div>

					

					</div>
				</div>

			</div>
		</div>
	</div>


</body>
</html>
<?php } ?>
