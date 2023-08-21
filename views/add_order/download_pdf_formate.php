<?php
$boost_css=ADMIN_THEME."css/bootstrap.min.css";
$css2=ADMIN_THEME."css/plugins/morris/morris-0.4.3.min.css";
$css3=ADMIN_THEME."css/plugins/timeline/timeline.css";
$css4=ADMIN_THEME."css/sb-admin.css";
$css5=ADMIN_THEME."css/style.css";
?>
<html>
	<head>
		<meta charset='utf-8'>
		 <title></title>
		<link rel='license' href='http://www.opensource.org/licenses/mit-license/'>
		<link rel='icon' type='image/png' href='<?php echo ADMIN_THEME ?>images/favicon.png'> 

    <link href='<?php echo ADMIN_THEME ?>css/bootstrap.min.css' rel='stylesheet'>
     


    <link href='<?php echo ADMIN_THEME ?>css/plugins/morris/morris-0.4.3.min.css' rel='stylesheet'>
    <link href='<?php echo ADMIN_THEME ?>css/plugins/timeline/timeline.css' rel='stylesheet'>


    <link href='<?php echo ADMIN_THEME ?>css/sb-admin.css' rel='stylesheet'>
    <link href='<?php echo ADMIN_THEME ?>css/style.css' rel='stylesheet'>
<style>
		*
{
	border: 0;
	box-sizing: content-box;
	color: inherit;
	font-family: inherit;
	font-size: inherit;
	font-style: inherit;
	font-weight: inherit;
	line-height: inherit;
	list-style: none;
	margin: 0;
	padding: 0;
	text-decoration: none;
	vertical-align: top;
}



*[contenteditable] { border-radius: 0.25em; min-width: 1em; outline: 0; }

*[contenteditable] { cursor: pointer; }

*[contenteditable]:hover, *[contenteditable]:focus, td:hover *[contenteditable], td:focus *[contenteditable], img.hover { background: #DEF; box-shadow: 0 0 1em 0.5em #DEF; }

span[contenteditable] { display: inline-block; }



h1 { font: bold 100% sans-serif; letter-spacing: 0.5em; text-align: center; text-transform: uppercase; }


table { font-size: 75%; table-layout: fixed; width: 100%; border: 1px solid #ddd;}
table { border-collapse: separate; border-spacing: 2px; }
th, td {  padding: 0.3em; position: relative; }
th, td { border-radius: 0.25em; border-style: solid; }
th { background: #EEE; border-color: #BBB; }
td { border-color: #DDD; }



html { font: 16px/1 'Open Sans', sans-serif; overflow: auto; padding: 0.5in; }
html { background: #999; cursor: default; }

body { box-sizing: border-box;  margin: 0 auto; overflow: hidden; padding: 0.5in; width: 8.5in; }
body { background: #FFF; border-radius: 1px; box-shadow: 0 0 1in -0.25in rgba(0, 0, 0, 0.5); }


header:after { clear: both; content: ''; display: table; }

header h1 { background: #000; border-radius: 0.25em; color: #FFF; margin: 0 0 1em; padding: 0.5em 0; }
header address { float: left; font-size: 75%; font-style: normal; line-height: 1.25; margin: 0 1em 1em 0; }
header address p { margin: 0 0 0.25em; font-size:15px; }
header span, header img { display: block; float: right; }
header span { margin: 0 0 1em 1em; max-height: 25%; max-width: 60%; position: relative; }
header img { max-height: 100%; max-width: 100%; }
header input { cursor: pointer; -ms-filter:'progid:DXImageTransform.Microsoft.Alpha(Opacity=0)'; height: 100%; left: 0; opacity: 0; position: absolute; top: 0; width: 100%; }



article, article address, table.meta, table.inventory { margin: 0 0 1em; }
article:after { clear: both; content: ''; display: table; }
article h1 { clip: rect(0 0 0 0); position: absolute; }

article address { float: left; font-size: 125%; font-weight: bold; }



table.meta, table.balance { float: right; width: 36%; font-size:14px; }
table.meta:after, table.balance:after { clear: both; content: ''; display: table; }


table.meta th { width: 60%; font-size:14px;}
table.meta td { width: 80%; font-size:14px; }


table.inventory { clear: both; width: 100%; font-size:14px;}
table.inventory th { font-weight: bold; text-align: center; }

table.inventory td:nth-child(1) { width: 26%; }
table.inventory td:nth-child(2) { width: 38%; }
table.inventory td:nth-child(3) {  width: 12%; }
table.inventory td:nth-child(4) { width: 12%; }
table.inventory td:nth-child(5) { width: 12%; }




table.balance th, table.balance td { width: 50%; }
table.balance td { text-align: right; }



aside h1 { border: none; border-width: 0 0 1px; margin: 0 0 1em; }
aside h1 { border-color: #999; border-bottom-style: solid; }



.add, .cut
{
	border-width: 1px;
	display: block;
	font-size: .8rem;
	padding: 0.25em 0.5em;	
	float: left;
	text-align: center;
	width: 0.6em;
}

.add, .cut
{
	background: #9AF;
	box-shadow: 0 1px 2px rgba(0,0,0,0.2);
	background-image: -moz-linear-gradient(#00ADEE 5%, #0078A5 100%);
	background-image: -webkit-linear-gradient(#00ADEE 5%, #0078A5 100%);
	border-radius: 0.5em;
	border-color: #0076A3;
	color: #FFF;
	cursor: pointer;
	font-weight: bold;
	text-shadow: 0 -1px 2px rgba(0,0,0,0.333);
}

.add { margin: -2.5em 0 0; }

.add:hover { background: #00ADEE; }

.cut { opacity: 0; position: absolute; top: 0; left: -1.5em; }
.cut { -webkit-transition: opacity 100ms ease-in; }

tr:hover .cut { opacity: 1; }

@media print {
	* { -webkit-print-color-adjust: exact; }
	html { background: none; padding: 0; }
	body { box-shadow: none; margin: 0; }
	span:empty { display: none; }
	.add, .cut { display: none; }
}

@page { margin: 0; }
</style>

</head>
	<body>
		
		<header>

			<address contenteditable style='margin-top:10px; border:4px solid; width: 100%;
    text-align: center;'>
				<h2 class='semibold nm'><img alt='' style='float:left; height:20px;' src='images/logo_top.png'></h2>
				<h2 class='semibold nm'><strong>$companyname</strong></h2>
				
				<p>$address</p>
				<p>$city- $statezip</p>
				<p> Phone- $phone</p>
				<p> GSTIN- $gst_num</p>


			</address>
			
			
		</header>
		<article>
			<h1>Recipient</h1>
			<table class='inventory'>
				
				<tr>
					<th colspan='2'><span contenteditable>Invoice</span></th>
				</tr>
				<tr>
					<td><span contenteditable>Invoice No: $invice_number</span></td>
					<td><span contenteditable>Connection type: $content_type</span></td>
				</tr>
				<tr>
					<td><span id='prefix' contenteditable>Invoice date: $invoce_formate</span></td>
					<td><span id='prefix' contenteditable>SV No.: $sv_number</span></td>
				</tr>
				<tr>
					<td><span id='prefix' contenteditable>Reverse Charge (Y/N): $reverse_charge</span></td>
					<td><span id='prefix' contenteditable>Consumer No.: $consumer_number</span></td>
				</tr>
				<tr>
					<td><span contenteditable>State: U.K</span></td>
					<td><span contenteditable>Date of Supply: $supply_formate</span></td>
				</tr>
				
				<tr>
					<th><span contenteditable>Billing Address</span></th>
					<th><span contenteditable>Shipping Address</span></th>
				</tr>
				<tr>
					<td><span contenteditable>Name: $customer_name</span></td>
					<td><span contenteditable>Name: $customer_name</span></td>
				</tr>
				<tr>
					<td><span contenteditable>Address: $customer_billing_address</span></td>
					<td><span contenteditable>Address: $customer_shipping_address</span></td>
				</tr>
				<tr>
					<td><span contenteditable>Mobile Number:- $customer_number</span></td>
					<td><span contenteditable>Mobile Number:- $customer_number</span></td>
				</tr>
				<tr>
					<td><span contenteditable>State: $customer_state</span></td>
					<td><span contenteditable>State: $customer_state</span></td>
				</tr>
				

			</table>
			<table class='inventory'>
				<thead>
					<tr>
						<th><span contenteditable>S.No.</span></th>
						<th><span contenteditable>Product Name</span></th>
						<th><span contenteditable>Qty</span></th>
						<th><span contenteditable>Rate</span></th>
						<th><span contenteditable>Amount</span></th>
						<th><span contenteditable>Taxable Value</span></th>
						<th><span contenteditable>CGST Rate</span></th>
						<th><span contenteditable>CGST Amount</span></th>
						<th><span contenteditable>SGST Rate</span></th>
						<th><span contenteditable>SGST Amount</span></th>
						<th><span contenteditable>Total</span></th>
					</tr>
				</thead>
				<tbody>
				$product_details
				<tr>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
					</tr>
					<tr>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
					</tr>
					<tr>
						<td colspan='2'>Total</td>
						<td><b>$total_qty</b></td>
						<td></td>
						<td><b>$sum_amount</b></td>
						<td><b>$sum_amount</b></td>
						<td></td>
						<td><b>$sum_cgst_amount</b></td>
						<td></td>
						<td><b>$sum_sgst_amount</b></td>
						<td><b>$sum_total_amount</b></td>
					</tr>
				</tbody>
			</table>
			
			<div style='width:100%; height:300px;'>
			<table class='meta' style='width:48%; height:280px;'>
				<tr><td>Total Amount before Tax: $sum_amount</td></tr>
				<tr><td>Add CGST: $sum_cgst_amount</td></tr>
				<tr><td>Add SGST: $sum_sgst_amount</td></tr>
				<tr><td>Total Tax Amount: $total_tax_amount</td></tr>
				<tr><td>Total Amount after Tax: $total_amount_after_tax</td></tr>
				<tr><td>Less schemes: </td></tr>
				<tr><td>Less Loan: </td></tr>
				<tr><td>Net amount payable: </td></tr>
			</table>
			<table class='meta' style='width:48%; height:280px;'>
							<tr><td>Schemes (HPCL/Government/others):</td></tr>
							<tr><td>Loan (HPCL/Government/others):</td></tr>
							<tr><td>Bank A/C: </td></tr>
							<tr><td>Terms & conditions :</td></tr>
			</table>
			</div>
			<div style='width:100%; height:200px; margin-top:20px;'>
			<table class='meta' style='width:24%; height: 150px;'>
				<tr style=' '>
				<td>Ceritified that the particulars given above are true and correct For Mittal HP Gas Service</td>
				</tr>
				<tr style=' '>
				<td>Authorised signatory</td>
				</tr>
			</table>
			<table class='meta' style='width:24%;  height: 150px;'>
				<tr><td>Coman Sale</td></tr>
			</table>
			<table class='meta' style='width:24%;  height: 150px;'>
				<tr><td>Payment Type:-</td></tr>
				<tr><td>Cash</td></tr>
			</table>
			<table class='meta' style='width:24%; height: 150px;'>
				<tr><td>Customer'r signature</td></tr>
			</table>
			</div>			
			
		</article>
		<aside>
			<h1><span contenteditable></span></h1>
			<div contenteditable>
			</div>
		</aside>
	</body>
</html>