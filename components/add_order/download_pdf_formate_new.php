 <?php
 //common::user_access_only("admin");
$login_id=common::get_session(ADMIN_LOGIN_USER_ID);
if(!$login_id)
{
  common::redirect_to(common::get_component_link(array("home","home")));die();
}
common::load_model("db");
//echo $login_id;die();
$id = common::get_control_value("id");
$data_order = getOrderById($id,$login_id);
$invice_number =$data_order['recipt_no'];
$customer_name=$data_order['name'];
$customer_number=$data_order['number'];
$customer_billing_address=$data_order['billing_address'];
$customer_shipping_address=$data_order['shipping_address'];
$customer_state=$data_order['state'];

$other_details=getOtherDetails($id);
$invice_date=$other_details['invoice_date'];
$invoce_formate=date("d-M-Y",strtotime($invice_date));

$reverse_charge=$other_details['reverse_charge'];
$content_type=$other_details['content_type'];
$sv_number=$other_details['sv_number'];
$consumer_number=$other_details['consumer_number'];
$date_of_supply=$other_details['date_of_supply'];
$payment_mode=$other_details['payment_mode'];
if($date_of_supply)
{
	$supply_formate=date("d-M-Y",strtotime($date_of_supply));
}
else
{
	$supply_formate="";
}
$payment_mode=$other_details['payment_mode'];

$data1 = getOrderByDetails($id);

//$converter = new Encryption;
$data = getAddress($login_id);
$converter = new Encryption;
$companyname = $converter->decode($data["companyname"]);
$address = $converter->decode($data["address"]);
$city = $converter->decode($data["city"]);
$statezip = $converter->decode($data["statezip"]);
$phone = $converter->decode($data["phone"]);
$gst_num = $converter->decode($data["gst_number"]);



$total_qty=0;
$sum_amount=0;
$sum_cgst_amount=0;
$sum_sgst_amount=0;
$sum_total_amount=0;
$count=1;

$product_details="";
//print_r($data1);die();
foreach($data1 as $d)
{
	
	
	$title=$d["title"];
	$qty=$d["qty"];
	$rate=$d["rate"];
	$cgst_tax=$d["cgst_tax"];
	$cgst_amount=$d["cgst_amount"];
	$sgst_tax=$d["sgst_tax"];
	$sgst_amount=$d["sgst_amount"];
	
	$amount=$qty*$rate;
	$total_amount=$amount+$d["cgst_amount"]+$d["sgst_amount"];
	
	$product_details.="<tr class='odd gradeX'>
		<td>$count</td>
		<td>$title</td>
		<td>$qty</td>
		<td >$rate</td> 
		<td >$amount</td>
		<td>$amount</td>
		<td>$cgst_tax%</td>
		<td>$cgst_amount</td>
		<td>$sgst_tax%</td>
		<td>$sgst_amount</td>
		<td >$total_amount</td> 
		 
	</tr>";
 
	$total_qty=$total_qty+$d["qty"];
	$sum_amount=$sum_amount+$amount;
	$sum_cgst_amount=$sum_cgst_amount+$d["cgst_amount"];
	$sum_sgst_amount=$sum_sgst_amount+$d["sgst_amount"];
	$sum_total_amount=$sum_total_amount+$total_amount;
	$count++;
}

$total_tax_amount=$sum_sgst_amount+$sum_cgst_amount;
$total_amount_after_tax=$sum_amount+$total_tax_amount;

$boost_css=ADMIN_THEME."css/bootstrap.min.css";
$css2=ADMIN_THEME."css/plugins/morris/morris-0.4.3.min.css";
$css3=ADMIN_THEME."css/plugins/timeline/timeline.css";
$css4=ADMIN_THEME."css/sb-admin.css";
$css5=ADMIN_THEME."css/style.css";
$image_path=ADMIN_THEME."images/logo_top.png";


$html_content="<html>
	<head>
		<meta charset='utf-8'>
		 <title></title>
		  


    <link href='$css4' rel='stylesheet'>
    <link href='$css5'>

<style>
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
	
.contenteditable { border-radius: 0.25em; min-width: 1em; outline: 0; }

.contenteditable{ cursor: pointer; }	

span[contenteditable] { display: inline-block; }



h1 { font: bold 100% sans-serif; letter-spacing: 0.5em; text-align: center; text-transform: uppercase; }



table { font-size: 75%; table-layout: fixed; width: 100%; border: 1px solid #ddd;}
table { border-collapse: separate; border-spacing: 2px; }
th, td {  padding: 0.3em; position: relative; }

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



table.meta, table.balance { float: left; width: 80%; font-size:14px; }
table.meta:after, table.balance:after { clear: both; content: ''; display: table; }


table.meta th { width: 60%; font-size:8px;}
table.meta td { width: 80%; font-size:8px; }



table.inventory { clear: both; width: 80%; font-size:14px;}
table.inventory th { font-weight: bold; text-align: center; }

table.inventory td:nth-child(1) { width: 8%; }
table.inventory td:nth-child(2) { width: 8%; }
table.inventory td:nth-child(3) {  width: 8%;}
table.inventory td:nth-child(4) { width: 8%; }
table.inventory td:nth-child(5) { width: 8%; }




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


</style>

</head>
	<body>
		
		<header>

			<address class='contenteditable' style='margin-top:10px; border:4px solid; width: 80%;
    text-align: center;'>
				<h2 class='semibold nm'><img alt='' style='float:left; height:20px;' src='$image_path'></h2>
				<h2 class='semibold nm'><strong>$companyname</strong></h2>
				
				<p>$address</p>
				<p>$city- $statezip</p>
				<p> Phone- $phone</p>
				<p> GSTIN- $gst_num</p>


			</address>
			
			
		</header>
		<article>
			<table class='inventory'>
				
				<tr>
					<th colspan='2'><span class='contenteditable'>Invoice</span></th>
				</tr>
				<tr>
					<td><span class='contenteditable'>Invoice No: $invice_number</span></td>
					<td><span class='contenteditable'>Connection type: $content_type</span></td>
				</tr>
				<tr>
					<td><span id='prefix' class='contenteditable'>Invoice date: $invoce_formate</span></td>
					<td><span id='prefix' class='contenteditable'>SV No.: $sv_number</span></td>
				</tr>
				<tr>
					<td><span id='prefix' class='contenteditable'>Reverse Charge (Y/N): $reverse_charge</span></td>
					<td><span id='prefix' class='contenteditable'>Consumer No.: $consumer_number</span></td>
				</tr>
				<tr>
					<td><span class='contenteditable'>State: U.K</span></td>
					<td><span class='contenteditable'>Date of Supply: $supply_formate</span></td>
				</tr>
				
				<tr>
					<th><span class='contenteditable'>Billing Address</span></th>
					<th><span class='contenteditable'>Shipping Address</span></th>
				</tr>
				<tr>
					<td><span class='contenteditable'>Name: $customer_name</span></td>
					<td><span class='contenteditable'>Name: $customer_name</span></td>
				</tr>
				<tr>
					<td><span class='contenteditable'>Address: $customer_billing_address</span></td>
					<td><span class='contenteditable'>Address: $customer_shipping_address</span></td>
				</tr>
				<tr>
					<td><span class='contenteditable'>Mobile Number:- $customer_number</span></td>
					<td><span class='contenteditable'>Mobile Number:- $customer_number</span></td>
				</tr>
				<tr>
					<td><span class='contenteditable'>State: $customer_state</span></td>
					<td><span class='contenteditable'>State: $customer_state</span></td>
				</tr>
				

			</table>
			<table class='inventory'>
				<thead>
					<tr>
						<th><span class='contenteditable'>S.No.</span></th>
						<th><span class='contenteditable'>Product Name</span></th>
						<th><span class='contenteditable'>Qty</span></th>
						<th><span class='contenteditable'>Rate</span></th>
						<th><span class='contenteditable'>Amount</span></th>
						<th><span class='contenteditable'>Taxable Value</span></th>
						<th><span class='contenteditable'>CGST Rate</span></th>
						<th><span class='contenteditable'>CGST Amount</span></th>
						<th><span class='contenteditable'>SGST Rate</span></th>
						<th><span class='contenteditable'>SGST Amount</span></th>
						<th><span class='contenteditable'>Total</span></th>
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
			<p style='width:200px; height:200px; float:left;'>
								<span>Total Amount before Tax: $sum_amount</span>
				<span>Add CGST: $sum_cgst_amount</span>
				<span>Add SGST: $sum_sgst_amount</span>
				<span>Total Tax Amount: $total_tax_amount</span>
				<span>Total Amount after Tax: $total_amount_after_tax</span>
				<span>Less schemes: </span>
				<span>Less Loan: </span>
				<span>Net amount payable: </span>
			</p>
			<p style='width:200px; height:200px; float:left;'>
								<span>Total Amount before Tax: $sum_amount</span>
				<span>Add CGST: $sum_cgst_amount</span>
				<span>Add SGST: $sum_sgst_amount</span>
				<span>Total Tax Amount: $total_tax_amount</span>
				<span>Total Amount after Tax: $total_amount_after_tax</span>
				<span>Less schemes: </span>
				<span>Less Loan: </span>
				<span>Net amount payable: </span>
			</p>
			<table class='meta'>
				<tr><td>Total Amount before Tax: $sum_amount</td></tr>
				<tr><td>Add CGST: $sum_cgst_amount</td></tr>
				<tr><td>Add SGST: $sum_sgst_amount</td></tr>
				<tr><td>Total Tax Amount: $total_tax_amount</td></tr>
				<tr><td>Total Amount after Tax: $total_amount_after_tax</td></tr>
				<tr><td>Less schemes: </td></tr>
				<tr><td>Less Loan: </td></tr>
				<tr><td>Net amount payable: </td></tr>
			</table>
			<table class='meta' style='float:left;'>
							<tr><td>Schemes (HPCL/Government/others):</td></tr>
							<tr><td>Loan (HPCL/Government/others):</td></tr>
							<tr><td>Bank A/C: </td></tr>
							<tr><td>Terms & conditions :</td></tr>
			</table>
			<p style='width:140px; height:200px; float:left; border:1px solid; padding:20px 0px 0px 20px; margin-top:40px;'><strong>Customer'r signature</strong></p>
			<p style='width:140px; height:200px; float:left; border:1px solid; padding:20px 0px 0px 20px; margin-top:-0px;'><strong>Payment Type:-</strong></br>$payment_mode</p>
			<p style='width:140px; height:200px; float:left; border:1px solid; padding:20px 0px 0px 20px; margin-top:-0px;'><strong>Coman Sale</strong></p>
			<p style='width:140px; height:200px; float:left; border:1px solid; padding:20px 0px 0px 20px; margin-top:-0px;'><strong>Authorised signatory</strong></p>
			
						
			
		</article>
		<aside>
			<h1><span class='contenteditable'></span></h1>
			<div class='contenteditable'>
			</div>
		</aside>
	</body>
</html>";
//require_once '../../dompdf/autoload.inc.php';
echo $html_content;die();

use Dompdf\Dompdf;
// instantiate and use the dompdf class
$dompdf = new Dompdf();
$dompdf->loadHtml("$html_content");

// (Optional) Setup the paper size and orientation
$dompdf->setPaper('A4', 'portrait');
//$dompdf->setPaper('A4', 'landscape');
// Render the HTML as PDF
$dompdf->render();

// Output the generated PDF to Browser
$dompdf->stream("$invice_number.pdf");
die();

?> 
