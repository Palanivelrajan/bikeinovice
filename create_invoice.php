<link rel="stylesheet" href="styles/bootstrap.min.css">
<link rel="stylesheet" href="styles/style.css">
<script src="scripts/jquery-3.4.0.min.js"></script>
<script src="scripts/bootstrap.bundle.min.js"></script>
<!------ Include the above in your HEAD tag ---------->


<?php
   include("config.php");
   session_start();

   $sql = "SELECT * FROM customers";
   $result = mysqli_query($db,$sql);
   $row = mysqli_fetch_array($result,MYSQLI_ASSOC);


   $count = mysqli_num_rows($result);

   $incremental = $count;

   ?>

<form class="invoiceForm" action="generate_invoice.php"  method="post">


<div class="container">
	<h1 class="text-center invoice-title" >Invoice</h1>
	<div class="company-details">
		<div class="row">
			<div class="col-md-6 company-address">
				<h2>ROOBHAHEMA E-BIKES</h2>
				7/200-1st Main Road,<br>
				Vaigai Nagar,<br>
				Paramakudi - 623707.<br>
				Mobile - 9360316124, 9360326833.<br>
				E-Mail: roobhahemaebikes@gmail.com<br>
				<br>
				GSTIN: 33BQFPT6291N1Z4
			</div>
			<div class="col-md-6">
				<div class="text-right">
					Invoice Number: <?php $pre ="RHEB";
											$prefix = date('Y');
											echo $pre;
											echo sprintf("%s%05s", $prefix, $incremental); ?><br>
					Invoice Date: <?php echo date('Y-m-d'); ?>
				</div>
			</div>
		</div>
	</div>
	<div class="customer-details">
		<div class="row">
			<div class="col-md-6">
				<p><strong>Billing address</strong></p>
				<textarea name="customer_billing_address" id="customer_billing_address" rows="8" cols="80">
				Muneeswaran,
				7/200-1st Main Road,
				Vaigai Nagar,
				Paramakudi - 623707.
				Mobile - 9360316124, 9360326833.
				E-Mail: roobhahemaebikes@gmail.com
				</textarea>
			</div>
			<div class="col-md-6">
				<p><strong>Shipping address</strong></p>
				<textarea name="customer_shipping_address" id="customer_shipping_address" rows="8" cols="80">
				Muneeswaran,
				7/200-1st Main Road,
				Vaigai Nagar,
				Paramakudi - 623707.
				Mobile - 9360316124, 9360326833.
				E-Mail: roobhahemaebikes@gmail.com
				</textarea>
			</div>
		</div>
	</div>
	<div class="row clearfix">
		<div class="col-md-12">
			<table class="table table-bordered table-hover" id="tab_logic">
				<thead>
					<tr>
						<th class="text-center"> # </th>
						<th class="text-center"> Product </th>
						<th class="text-center"> Qty </th>
						<th class="text-center"> Price </th>
						<th class="text-center"> Total </th>
					</tr>
				</thead>
				<tbody>
					<tr id='addr0'>
						<td>1</td>
						<td><input type="text" name='product[]'  placeholder='Enter Product Name' class="form-control"/></td>
						<td><input type="number" name='qty[]' placeholder='Enter Qty' class="form-control qty" step="0" min="0"/></td>
						<td><input type="number" name='price[]' placeholder='Enter Unit Price' class="form-control price" step="0.00" min="0"/></td>
						<td><input type="number" name='total[]' placeholder='0.00' class="form-control total" readonly/></td>
					</tr>
					<tr id='addr1'></tr>
				</tbody>
			</table>
		</div>
	</div>
	<div class="row clearfix">
		<div class="col-md-12">
			<a id="add_row" class="btn btn-primary">Add Row</a>
			<a id='delete_row' class="btn btn-secondary">Delete Row</a>
		</div>
	</div>
	<div class="row clearfix" style="margin-top:20px">
		<div class="col-md-12">
			<table class="table table-bordered table-hover" id="tab_logic_total">
				<tbody>
					<tr>
						<th class="text-center">Sub Total</th>
						<td class="text-center"><input type="number" name='sub_total' placeholder='0.00' class="form-control" id="sub_total" readonly/></td>
					</tr>
					<tr>
						<th class="text-center">CGST %</th>
						<td class="text-center"><div class="input-group mb-2 mb-sm-0">
							<input type="number" class="form-control tax" name='tax1' step="any" id="tax1" placeholder="0">
							<div class="input-group-addon">%</div>
						</div></td>
					</tr>
					<tr>
						<th class="text-center">CGST Amount</th>
						<td class="text-center"><input type="number" name='tax_amount1' id="tax_amount1" placeholder='0.00' class="form-control" readonly/></td>
					</tr>
					<tr>
						<th class="text-center">SGST %</th>
						<td class="text-center"><div class="input-group mb-2 mb-sm-0">
							<input type="number" class="form-control tax" name="tax2" step="any" id="tax2" placeholder="0">
							<div class="input-group-addon">%</div>
						</div></td>
					</tr>
					<tr>
						<th class="text-center">SGST Amount</th>
						<td class="text-center"><input type="number" name='tax_amount2' id="tax_amount2" placeholder='0.00' class="form-control" readonly/></td>
					</tr>
					<tr>
						<th class="text-center">Grand Total</th>
						<td class="text-center"><input type="number" name='total_amount' id="total_amount" placeholder='0.00' class="form-control" readonly/></td>
					</tr>
					<tr>
						<th class="text-center">Deposit</th>
						<td class="text-center"><input type="number" name='deposit' id="deposit" placeholder='0.00' class="form-control" /></td>
					</tr>
					<tr>
						<th class="text-center">Balance Due</th>
						<td class="text-center"><input type="number" name='balance_due' id="balance_due" placeholder='0.00' class="form-control" readonly/></td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
	<div class="footer">
		<div class="row clearfix">
			<div class="col-md-12">
				<button type="submit" id="add_row" class="btn btn-primary btn-save">Save</button>
				<!-- <button id='delete_row' class="btn btn-secondary btn-print">Print</button> -->
			</div>
		</div>
	</div>
</div>

</form>

<script type="text/javascript">
$(document).ready(function(){
var i=1;
$("#add_row").click(function(){b=i-1;
    $('#addr'+i).html($('#addr'+b).html()).find('td:first-child').html(i+1);
    $('#tab_logic').append('<tr id="addr'+(i+1)+'"></tr>');
    i++;
});
$("#delete_row").click(function(){
    if(i>1){
    $("#addr"+(i-1)).html('');
    i--;
    }
    calc();
});

$('#tab_logic tbody').on('keyup change',function(){
    calc();
});
$('.tax').on('keyup change',function(){
    calc_total();
});

$('#deposit').on('keyup change',function(){
	balance_due = $("#total_amount").val() - $(this).val();;
    $('#balance_due').val(balance_due)
});

});

function calc()
{
$('#tab_logic tbody tr').each(function(i, element) {
    var html = $(this).html();
    if(html!='')
    {
        var qty = $(this).find('.qty').val();
        var price = $(this).find('.price').val();
        $(this).find('.total').val(qty*price);

        calc_total();
    }
});
}

function calc_total()
{
total=0;
$('.total').each(function() {
    total += parseInt($(this).val());
});
$('#sub_total').val(total.toFixed(2));
tax_sum1=total/100*$('#tax1').val();
$('#tax_amount1').val(tax_sum1.toFixed(2));
tax_sum2=total/100*$('#tax2').val();
$('#tax_amount2').val(tax_sum2.toFixed(2));
total_tax = tax_sum1 + tax_sum2;
$('#total_amount').val((total_tax+total).toFixed(2));
}
</script>
