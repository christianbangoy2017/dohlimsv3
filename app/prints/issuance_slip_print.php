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

if(!$slip_id){
    die("Missing slip id parameter");
}

/* GET SLIP HEADER */

$stmt = $conn->prepare("
SELECT * FROM vw_print_issuance_slip_1header s WHERE s.id = ?
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
SELECT * FROM vw_print_issuance_slip_2items WHERE issuance_id = ?
");

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

$pdf->SetFont('times','',11);

/* HTML HEADER */

$html = '

<table border="0" width="100%" cellpadding="4">
<tr>
<td width="15%" align="right">
<img src="ph_logo.png" width="60">
</td>

<td width="15%" align="left">
<img src="doh_logo.png" width="60">
</td>

<td width="50%" align="center">
<span style="font-size:11px;">Republic of the Philippines</span><br>
<span style="font-size:16px;"><b>DEPARTMENT OF HEALTH</b></span><br>
<span style="font-size:13px;"><i>Davao Center for Health Development</i></span>
</td>

<td width="20%" align="left">
<img src="bagong_pilipinas.png" width="80">
</td>
</tr>
</table>


<table cellpadding="4">
<tr>
<td colspan="6" align="center"></td>
<td colspan="6" align="center"></td>
</tr>

<table border="1" cellpadding="4">

<tr>
<td colspan="6" align="center"><b>ISSUANCE SLIP</b></td>
</tr>

<tr>
<td colspan="4">
Division : '.$slip['division'].'<br>
Section : '.$slip['section'].'
</td>

<td colspan="2" align="right">
Date : '.date("m/d/Y",strtotime($slip['issuance_date'])).'
</td>
</tr>

<tr align="center">
<td width="10%"><b>Stock</b></td>
<td width="10%"><b>Qty</b></td>
<td width="15%"><b>Unit</b></td>
<td width="40%"><b>Item Description</b></td>
<td width="12%"><b>Unit Cost</b></td>
<td width="13%"><b>Total Cost</b></td>
</tr>
';

$i = 1;
$grand_total = 0;

while($item = $items->fetch_assoc()){

$total = $item['qty'] * $item['unit_cost'];
$grand_total += $total;

$html .= '

<tr>
<td align="center">'.$i.'</td>
<td align="center">'.$item['qty'].'</td>
<td align="center">'.$item['unit'].'</td>
<td>'.$item['item_description'].'</td>
<td align="right">'.number_format($item['unit_cost'],2).'</td>
<td align="right">'.number_format($total,2).'</td>
</tr>
';

$i++;
}

$html .= '

<tr>
<td colspan="5" align="right"><b>Total</b></td>
<td align="right"><b>'.number_format($grand_total,2).'</b></td>
</tr>

<tr>
<td colspan="6">
<b>Purpose :</b> '.$slip['purpose'].'
</td>
</tr>

<tr>

<td colspan="3" width="50%" height="45" align="center">

<b>OK for Issue</b><br><br>

<b>'.$slip['approved_by'].'</b><br>
Printed Name & Signature

<br><br><br>

_______________________________<br>
Date

</td>

<td colspan="3" width="50%" height="45" align="center">

<b>Received by</b><br><br>

<b>'.$slip['received_by'].'</b><br>
Printed Name & Signature

<br><br><br>

_______________________________<br>
Date

</td>

</tr>

</table>
';

/* WRITE PDF */

$pdf->writeHTML($html,true,false,true,false,'');

$pdf->Output("IssuanceSlip_".$slip['slip_no'].".pdf","I");

?>