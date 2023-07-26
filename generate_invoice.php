<?php
   include("config.php");
   session_start();

   $sql = "SELECT * FROM customers";
   $result = mysqli_query($db,$sql);
   $row = mysqli_fetch_array($result,MYSQLI_ASSOC);


   $count = mysqli_num_rows($result);

   $incremental = $count;

   // $invoice_number =;
   // $invoice_date =;
   $customer_billing_address =$_POST['customer_billing_address'];
   $customer_shipping_address =$_POST['customer_shipping_address'];
   $product = $_POST['product'];
   $qty = $_POST['qty'];
   $price = $_POST['price'];
   $total = $_POST['total'];
   $sub_total = $_POST['sub_total'];
   $tax1 = $_POST['tax1'];
   $tax2 = $_POST['tax2'];
   $tax_amount1 = $_POST['tax_amount1'];
   $tax_amount2 = $_POST['tax_amount2'];
   $total_amount = $_POST['total_amount'];
   $deposit = $_POST['deposit'];
   $balance_due = $_POST['balance_due']
?>
<?php
$dvalue = date('Y-m-d H:i:s');
$ivalue = 'RHEB'.''.sprintf("%s%05s", $prefix, $incremental);
$sql = "INSERT INTO customers ".
          "(invoice_id,customer_address, date) "."VALUES ".
          "('$ivalue','$customer_billing_address','$dvalue')";
          $result1 = mysqli_query($db,$sql);

 ?>
<?php

$html = '
<html>
<head>
<style>
body {font-family: sans-serif;
	font-size: 10pt;
}
p {	margin: 0pt; }
table.items {
	border: 0.1mm solid #000000;
}
td { vertical-align: top; }
.items td {
	border-left: 0.1mm solid #000000;
	border-right: 0.1mm solid #000000;
}
table thead td { background-color: #EEEEEE;
	text-align: center;
	border: 0.1mm solid #000000;
	font-variant: small-caps;
}
.items td.blanktotal {
	background-color: #EEEEEE;
	border: 0.1mm solid #000000;
	background-color: #FFFFFF;
	border: 0mm none #000000;
	border-top: 0.1mm solid #000000;
	border-right: 0.1mm solid #000000;
}
.items td.totals {
	text-align: right;
	border: 0.1mm solid #000000;
}
.items td.cost {
	text-align: "." center;
}
</style>
</head>
<body>

<!--mpdf
<htmlpageheader name="myheader">
<table width="100%"><tr>
<td width="50%" style="color:#0000BB; "><h2>ROOBHAHEMA E-BIKES</h2>
7/200-1st Main Road,<br>
Vaigai Nagar,<br>
Paramakudi - 623707.<br>
Mobile - 9360316124, 9360326833.<br>
E-Mail: roobhahemaebikes@gmail.com<br>
<br>
GSTIN: 33BQFPT6291N1Z4</td>
<td width="50%" style="text-align: right;">Invoice No.: ';
?><?php $pre ="RHEB";
						$prefix = date("Y");
						$html .= $pre.''.sprintf("%s%05s", $prefix, $incremental).'<div style="text-align: right">Date: '.date("Y-m-d").'</div></td>
</tr></table>
</htmlpageheader>

<htmlpagefooter name="myfooter">
<div style="border-top: 1px solid #000000; font-size: 9pt; text-align: center; padding-top: 3mm; ">
Page {PAGENO} of {nb}
</div>
</htmlpagefooter>

<sethtmlpageheader name="myheader" value="on" show-this-page="1" />
<sethtmlpagefooter name="myfooter" value="on" />
mpdf-->



<table width="100%" style="font-family: serif;" cellpadding="10"><tr>
<td width="45%" style="border: 0.1mm solid #888888; "><span style="font-size: 7pt; color: #555555; font-family: sans;">Billing Address:</span><br /><br />'.$customer_billing_address.'</td>
<td width="10%">&nbsp;</td>
<td width="45%" style="border: 0.1mm solid #888888;"><span style="font-size: 7pt; color: #555555; font-family: sans;">Shipping Address</span><br /><br />'.$customer_billing_address.'</td>
</tr></table>

<br />

<table class="items" width="100%" style="font-size: 9pt; border-collapse: collapse; " cellpadding="8">
<thead>
<tr>
<td width="15%">S.No.</td>
<td width="45%">Description</td>
<td width="10%">Quantity</td>
<td width="15%">Price</td>
<td width="15%">Amount</td>
</tr>
</thead>
<tbody>';
?>
<?php
$i = 0;
foreach ($_POST['product'] as $key=>$val) {
    //xyz
    $i++;


    $html.= '<tr>
    <td align="center">'.$i.'</td>
    <td>'.$_POST['product'][$key].'</td>
    <td align="center">'.$qty[$key].'</td>
    <td class="cost">'.$price[$key].'</td>
    <td class="cost">'.$total[$key].'</td>
    </tr>';

}
?>
<?php
$html.='
<tr>
<td class="blanktotal" colspan="3" rowspan="6"></td>
<td class="totals">Subtotal:</td>
<td class="totals cost">'.$sub_total.'</td>
</tr>
<tr>
<td class="totals">CGST %:</td>
<td class="totals cost">'.$tax1.'</td>
</tr>
<tr>
<td class="totals">CGST Amount:</td>
<td class="totals cost">'.$tax_amount1.'</td>
</tr>
<tr>
<td class="totals">SGST %:</td>
<td class="totals cost">'.$tax2.'</td>
</tr>
<tr>
<td class="totals">SGST Amount:</td>
<td class="totals cost">'.$tax_amount2.'</td>
</tr>
<tr>
<td class="totals"><b>TOTAL:</b></td>
<td class="totals cost"><b>'.$total_amount.'</b></td>
</tr>
<tr>
<td class="totals">Deposit:</td>
<td class="totals cost">'.$deposit.'</td>
</tr>
<tr>
<td class="totals"><b>Balance due:</b></td>
<td class="totals cost"><b>'.$balance_due.'</b></td>
</tr>
</tbody>
</table>


<div style="text-align: center; font-style: italic;">Payment terms: payment due in 30 days</div>


</body>
</html>';

$location = __DIR__ .'/assets/invoices/';
require_once __DIR__ . '/lib/vendor/autoload.php';



$mpdf = new \Mpdf\Mpdf([
	'margin_left' => 20,
	'margin_right' => 15,
	'margin_top' => 48,
	'margin_bottom' => 25,
	'margin_header' => 10,
	'margin_footer' => 10
]);

$mpdf->SetProtection(array('print'));
$mpdf->SetTitle("ROOBAHEMA E-BIKES");
$mpdf->SetAuthor("ROOBAHEMA E-BIKES");
$mpdf->SetWatermarkText("ROOBAHEMA E-BIKES");
$mpdf->showWatermarkText = true;
$mpdf->watermark_font = 'DejaVuSansCondensed';
$mpdf->watermarkTextAlpha = 0.1;
$mpdf->SetDisplayMode('fullpage');

$mpdf->WriteHTML($html);


$prefix = date("Y");
$filename= 'RHEB'.sprintf("%s%05s", $prefix, $incremental).'.pdf';
$mpdf->Output($filename,'D');
