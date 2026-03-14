<?php

require_once "../../config.php";
require_once "../lib/tcpdf/tcpdf.php";

/* DATABASE CONNECTION */

$conn = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME, DB_PORT);

if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}

/* VALIDATE ID */

$slip_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

/*if($slip_id <= 0){
    die("Invalid Slip ID");
}*/
if(!$slip_id){
    die("Missing slip id parameter");
}

/* GET SLIP HEADER */

$stmt = $conn->prepare("
SELECT 
    s.id,
    s.slip_no,
    s.issuance_date,
    c.name AS client_name,
    s.division,
    s.section
FROM program_issuance_slips s
LEFT JOIN clients c ON c.id = s.client_id
WHERE s.id = ?
");

$stmt->bind_param("i", $slip_id);
$stmt->execute();
$result = $stmt->get_result();

if($result->num_rows == 0){
    die("Issuance slip not found");
}

$slip = $result->fetch_assoc();

/* GET SLIP ITEMS */

$stmt = $conn->prepare("
SELECT * FROM vw_print_issuance_slip d
WHERE d.issuance_id = ?");

if(!$stmt){
    die("Prepare failed: " . $conn->error);
}

$stmt->bind_param("i", $slip_id);
$stmt->execute();
$items = $stmt->get_result();

/* CREATE PDF */

$pdf = new TCPDF();

$pdf->SetCreator("DHLIMS");
$pdf->SetAuthor("Department of Health");
$pdf->SetTitle("Issuance Slip");

$pdf->SetMargins(15,20,15);
$pdf->AddPage();


$pdf->SetFont('times', '', 12); // Times New Roman for header

/* BUILD HTML */

$html = '


<table border="0" width="100%" cellpadding="4">
    <tr>
        <td width="15%" align="right">
            <img src="ph_logo.png" width="60" height="60">
        </td>
        <td width="15%" align="left">
            <img src="doh_logo.png" width="60" height="60">
        </td>

        <td width="50%" align="center">
            <span style="font-size:11px;">Republic of the Philippines</span><br>
            <span style="font-size:16px; font-weight:bold;">DEPARTMENT OF HEALTH</span><br>
            <span style="font-size:13px; font-style:italic;">
            Davao Center for Health Development
            </span>
        </td>

        <td width="20%" align="left">
            <img src="bagong_pilipinas.png" width="80" height="60">
        </td>
    </tr>
</table>

<hr>


<h2 style="text-align:center;">ISSUANCE SLIP</h2>

<table cellpadding="4">
<tr>
<td width="50%"><b>Slip No:</b> '.$slip['slip_no'].'</td>
<td width="50%"><b>Date:</b> '.$slip['issuance_date'].'</td>
</tr>

<tr>
<td width="50%"><b>Client:</b> '.$slip['client_name'].'</td>
<td width="50%"><b>Division:</b> '.$slip['division'].'</td>
</tr>

<tr>
<td width="100%"><b>Section:</b> '.$slip['section'].'</td>
</tr>
</table>

<br>

<table border="1" cellpadding="5">
<tr style="font-weight:bold;background-color:#eeeeee;">
<td width="10%">#</td>
<td width="60%">Item</td>
<td width="30%">Quantity</td>
</tr>

';

$i = 1;

while($row = $items->fetch_assoc()){

$html .= '

<tr>
<td>'.$i.'</td>
<td>'.$row['item_name'].'</td>
<td>'.$row['qty'].'</td>
</tr>

';

$i++;

}

$html .= '

</table>

<br><br>

<table cellpadding="10">
<tr>
<td width="33%" align="center">Prepared By</td>
<td width="33%" align="center">Released By</td>
<td width="33%" align="center">Received By</td>
</tr>

<tr>
<td align="center">_____________________</td>
<td align="center">_____________________</td>
<td align="center">_____________________</td>
</tr>
</table>

';

/* WRITE PDF */

$pdf->writeHTML($html);

#$pdf->Output("issuance_slip.pdf","I");
$pdf->Output("IssuanceSlip_".$slip['slip_no'].".pdf","I");

?>