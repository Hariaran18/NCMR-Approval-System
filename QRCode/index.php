<html>
<head>
<title>Cross-Browser QRCode generator for Javascript</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=no" />
<script type="text/javascript" src="jquery.min.js"></script>
<script type="text/javascript" src="qrcode.js"></script>
</head>
<body>
<?php
    include ("../config/dbconnection.php");
    include ("../config/config.php");
    session_start();
   
    $ncmr_no = $_POST['ncmr_no'];
    $job_no = $_POST['job_no'];
    $part_no = $_POST['part_no'];
    $issue_date = $_POST['issue_date'];
    $nc_qty = $_POST['nc_qty'];
    $defect_desc = $_POST['defect_desc'];
    $issued_name = $_POST['issued_name'];


    $sql1 = "SELECT top 1 [Location Code]    FROM [dbo].[Wentel Engineering S_B\$Prod_ Order Component] where [Prod_ Order No_] = '" . $job_no ."'";
    foreach ($connNAV->query($sql1) as $row) {
         $location = $row["Location Code"];
  	 if ($row["Location Code"] =="58WIP") {
             	    $checkbin = '58SP';
     	 } else {
      	            $checkbin = '11SP';
       	 };
      }


//      $QRtext = "NCMR:281|SPRL-02-60-AGL1626ZI|4|CRATE|11WIP|1|1|1|PCS";
        $QRtext = "NCMR:" . $ncmr_no . "|" . $part_no . "|" . $nc_qty . "|CRATE|". $location . "|1|1|1|PCS";

?>

<table border = 1>
<tr><td colspan=2 align=center>NCMR KITTING LIST </td></tr>
<tr><td width = 300px>NCMR NO: </td><td width = 300px><?php echo $ncmr_no; ?></td></tr>
<tr><td>JOB NO: </td><td><?php echo $job_no; ?></td></tr>
<tr><td>ISSUE DATE: </td><td><?php echo $issue_date; ?></td></tr>
<tr><td>TRANSFER FROM: </td><td><?php echo $checkbin; ?></td></tr>
<tr><td>TRANSFER TO: </td><td><?php echo $location; ?></td></tr>
</table>
<br>
<br>
<table border = 1>
<tr><td width = 300px>ITEM: </td><td width = 100px>QUANTITY</td><td width = 300px>DEFECT DESCRIPTION</td><td width = 300px>QR CODE</td></tr>
<tr><td><?php echo $part_no; ?></td><td><?php echo $nc_qty; ?></td><td><?php echo $defect_desc; ?><td>




<input id="text" type="hidden" value="<?php echo $QRtext; ?>" style="width:80%" /><br />
<div id="qrcode" style="width:100px; height:100px; margin-top:15px;"></div>

<script type="text/javascript">
var qrcode = new QRCode(document.getElementById("qrcode"), {
	width : 100,
	height : 100
});

function makeCode () {		
	var elText = document.getElementById("text");
	
	if (!elText.value) {
		alert("Input a text");
		elText.focus();
		return;
	}
	
	qrcode.makeCode(elText.value);
}

makeCode();

$("#text").
	on("blur", function () {
		makeCode();
	}).
	on("keydown", function (e) {
		if (e.keyCode == 13) {
			makeCode();
		}
	});
</script>
</td>
</table>
<br>
<br>
<table border = 0>
<tr><td>Requested By</td></tr>
<tr><td>&nbsp</td></tr>
<tr><td>&nbsp</td></tr>
<tr><td>&nbsp</td></tr>
<tr><td>&nbsp</td></tr>
<tr><td style="border-top: thin solid;"><?php echo $issued_name ?></td></tr>
</table>


</body>