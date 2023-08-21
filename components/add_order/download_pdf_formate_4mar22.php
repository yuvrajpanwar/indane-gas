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
$user_type = common::get_control_value("type");
if($user_type=="General")
{
	$data_order = getOrderById($id,$login_id);
	$other_details=getOtherDetails($id);
	$data1 = getOrderByDetails($id);
	$data2 = getOtherDataItem($id);
}

if($user_type=="Registered")
{
	$data_order = getRegisterOrderById($id,$login_id);
	$other_details=getRegisterOtherDetails($id);
	$data1 = getRegisterOrderByDetails($id);
	$data2 = getRegisterOtherDataItem($id);
	
	
}
//$data_order = getOrderById($id,$login_id);
$invice_number =$data_order['recipt_no'];
$customer_name=$data_order['name'];
$customer_number=$data_order['number'];
$customer_billing_address=$data_order['billing_address'];
$customer_shipping_address=$data_order['shipping_address'];
$customer_state=$data_order['state'];
$discount=$data_order['discount'];

//$other_details=getOtherDetails($id);
$invoice_date=$other_details['invoice_date'];
if($invoice_date!="0000-00-00"  && $invoice_date!="")
{
	//$date_display=date("d-M-Y",strtotime($invoice_date));
	$invoice_formate=date("d-M-Y",strtotime($invoice_date));
}
else
{
	$invoice_formate=$invoice_date;
}

$reverse_charge=$other_details['reverse_charge'];
$content_type=$other_details['content_type'];
$sv_number=$other_details['sv_number'];
$consumer_number=$other_details['consumer_number'];
$date_of_supply=$other_details['date_of_supply'];
$payment_mode=$other_details['payment_mode'];
$cash_payment=$other_details['cash_amount'];
$bank_payment=$other_details['bank_amount'];
$customer_gst=$other_details['user_gst'];


if($date_of_supply!="0000-00-00")
{
	$supply_formate=date("d-M-Y",strtotime($date_of_supply));
}
else
{
	$supply_formate="";
}
$payment_mode=$other_details['payment_mode'];
if($payment_mode=="Both")
{
	$payment_content="<br><br><span>Cash: $cash_payment</span><br><span>Bank: $bank_payment</span>";
}
else
{
	$payment_content=ucfirst($payment_mode);
}

//$data1 = getOrderByDetails($id);
//$data2 = getOtherDataItem($id);

//$converter = new Encryption;
$data = getAddress($login_id);
$converter = new Encryption;
$companyname = $converter->decode($data["companyname"]);
$address = $converter->decode($data["address"]);
$city = $converter->decode($data["city"]);
$statezip = $converter->decode($data["statezip"]);
$phone = $converter->decode($data["phone"]);
$gst_num = $converter->decode($data["gst_number"]);
$email_id = $converter->decode($data["email"]);


$total_qty=0;
$total_rate1=0;
					$total_rate2=0;	
					$final_total_rate=0;
					$taxable_amount2=0;
					$less_discount_amount=0;
$sum_amount=0;
$sum_cgst_amount=0;
$sum_sgst_amount=0;
$sum_total_amount=0;
$taxable_amount=0;
$youSaved=0;
$count=1;

$product_details="";
//print_r($data1);die();
foreach($data2 as $details)
{
	$product_name=$details["product_name"];
	$pro_qty=$details["pro_qty"];
	$rate_oth=$details["rate"];
	$amount_oth=$details["amount"];
	$product_details.="<tr class='odd gradeX'>
		<td style='text-align: center;'>$count</td>
		<td style='text-align: center;'>$product_name</td>
		<td style='text-align: center;'></td>
		<td style='text-align: center;'>$pro_qty</td>
		<td style='text-align: center;'>$rate_oth</td> 
		<td style='text-align: center;'>$amount_oth</td>
		<td colspan='5' style='text-align:center;'> Exempted for GST</td>
		<td style='text-align: center;'>$amount_oth</td> 
		 
	</tr>";
	$total_rate1=$total_rate1+$details["rate"];
	$count++;
	$sum_amount=$sum_amount+$amount_oth;
	$sum_total_amount=$sum_total_amount+$amount_oth;
	$total_qty=$total_qty+$pro_qty;
}

foreach($data1 as $d)
{
	
	
	$title=$d["title"];
	$hsn_code=$d["hsn_code"];
	$qty=$d["qty"];
	$rate=$d["rate"];
	$cgst_tax=$d["cgst_tax"];
	$cgst_amount=$d["cgst_amount"];
	$sgst_tax=$d["sgst_tax"];
	$sgst_amount=$d["sgst_amount"];
	
	$amount=$qty*$rate;
	$total_amount=$amount+$d["cgst_amount"]+$d["sgst_amount"];
	//$total_amount=round($total_amount,2);
	$youSaved=number_format($youSaved+$d["qty"]*$d["discount"],2);
	
	$product_details.="<tr class='odd gradeX'>
		<td style='text-align: center;'>$count</td>
		<td style='text-align: center; width: 140px; font-size: 10px;'>$title</td>
		<td style='text-align: center;'>$hsn_code</td>
		<td style='text-align: center;'>$qty</td>
		<td style='text-align: center;'>$rate</td> 
		<td style='text-align: center;'>$amount</td>
		<td style='text-align: center;'>$amount</td>
		<td style='text-align: center;'>$cgst_tax%</td>
		<td style='text-align: center;'>$cgst_amount</td>
		<td style='text-align: center;'>$sgst_tax%</td>
		<td style='text-align: center;'>$sgst_amount</td>
		<td style='text-align: center;'>$total_amount</td>		 
	</tr>";
	$total_rate2=$total_rate2+$d["rate"];
	$total_qty=$total_qty+$d["qty"];
	$sum_amount=$sum_amount+$amount;
	$sum_cgst_amount=$sum_cgst_amount+$d["cgst_amount"];
	$sum_sgst_amount=$sum_sgst_amount+$d["sgst_amount"];
	$sum_total_amount=$sum_total_amount+$total_amount;
	$taxable_amount=$taxable_amount+$amount;
	$count++;
}
//$sum_cgst_amount=round($sum_cgst_amount);
//$taxable_amount=round($taxable_amount);
//$sum_amount=round($sum_amount);
//$sum_sgst_amount=round($sum_sgst_amount);
//$sum_total_amount=round($sum_total_amount);

$final_total_rate=$total_rate1+$total_rate2;				
$less_discount_amount=$youSaved;
$taxable_amount2=$sum_amount-$less_discount_amount;
$final_amount=round(($taxable_amount2+$sum_cgst_amount+$sum_sgst_amount)-($discount));
$word_amount= getStringOfAmount($final_amount);

// $total_tax_amount=$sum_sgst_amount+$sum_cgst_amount;
// $total_amount_after_tax=$sum_amount+$total_tax_amount;
// $net_amount_payable=$total_amount_after_tax-$discount;
// $net_amount_payable=round($net_amount_payable);
// //$word_amount= numberTowords($net_amount_payable);
// $word_amount= getStringOfAmount($net_amount_payable);
//$total_tax_amount=round($total_tax_amount);
//$total_tax_amount=round($total_tax_amount);

$boost_css=ADMIN_THEME."css/bootstrap.min.css";
$css2=ADMIN_THEME."css/plugins/morris/morris-0.4.3.min.css";
$css3=ADMIN_THEME."css/plugins/timeline/timeline.css";
$css4=ADMIN_THEME."css/sb-admin.css";
$css5=ADMIN_THEME."css/style.css";
$image_path_first=ADMIN_THEME."images/Jpegformat/cylinderimage.jpeg";
$image_path_second=ADMIN_THEME."images/Jpegformat/indianoil.jpeg";

/*

<address class='contenteditable' style='border:4px solid; width: 100%;
    text-align: center;'>
				<h2 class='semibold nm'><img alt='' style='float:left; height: 120px;' src='$image_path'></h2>
				<h2 class='semibold nm'><strong>$companyname</strong></h2>
				
				<p>$address</p>
				<p>$city- $statezip</p>
				<p> Phone- $phone</p>
				<p> Phone- indiangasservice@yahoo.in</p>
				<p> GSTIN- $gst_num</p>


			</address>
*/

$html_content="<html>
	<head>
		<meta charset='utf-8'>
		 <title></title>
		  

	
    
    <link href='$css4' rel='stylesheet'>
    <link href='$css5' rel='stylesheet'>

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
table { border-collapse: separate; border-spacing: 0px; }
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
header address p { margin: 0 0 0.25em; font-size:12px; }
header span, header img { display: block; float: right; }
header span { margin: 0 0 1em 1em; max-height: 25%; max-width: 60%; position: relative; }
header img { max-height: 100%; max-width: 100%; }
header input { cursor: pointer; -ms-filter:'progid:DXImageTransform.Microsoft.Alpha(Opacity=0)'; height: 100%; left: 0; opacity: 0; position: absolute; top: 0; width: 100%; }



article, article address, table.meta, table.inventory { margin: 0 0 1em; }
article:after { clear: both; content: ''; display: table; }
article h1 { clip: rect(0 0 0 0); position: absolute; }

article address { float: left; font-size: 125%; font-weight: bold; }



table.meta, table.balance { float: right; width: 100%; font-size:14px; }
table.meta:after, table.balance:after { clear: both; content: ''; display: table; }


table.meta th { width: 60%; font-size:8px;}
table.meta td { width: 80%; font-size:8px; }

table.inventory { clear: both; width: 100%; font-size:12px;}
table.inventory th { font-weight: bold; text-align: center; border:1px solid black;}
table.inventory td{border:1px solid black;}
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

			<address class='contenteditable' style='border:4px solid; width: 100%;
    text-align: center;'>
				<div style='width:100px; float:left;padding-left: 20px; padding-top: 10px;'>
				<img alt='' style='float:left; height:80px;' src='$image_path_first'>
				</div>
				<div style='width:500px; float:left; margin-left:150px;'>
					<h4 class='semibold nm'><strong>$companyname</strong></h4>
				
				<p>$address, $city</p>
				<p> Phone- $phone, Email- $email_id </p>
				<p> GSTIN- $gst_num</p>
				</div>
				<div style='width:100px; float:right; padding-top: 10px;'>
				<img alt='' style='float:left; height:80px;' src='$image_path_second'>
				</div>


			</address>
			
			
		</header>
		<article style=\"margin-top:20px;\">
			<table class='inventory'>
				
				<tr>
					<th colspan='2'><span class='contenteditable'>Invoice</span></th>
				</tr>
				<tr>
					<td><span class='contenteditable'>Invoice No: $invice_number</span></td>
					<td><span class='contenteditable'>Connection type: $content_type</span></td>
				</tr>
				<tr>
					<td><span id='prefix' class='contenteditable'>Invoice date: $invoice_formate</span></td>
					<td><span id='prefix' class='contenteditable'>SV No.: $sv_number</span></td>
				</tr>
				<tr>
					<td><span id='prefix' class='contenteditable'>Reverse Charge (Y/N): $reverse_charge</span></td>
					<td><span id='prefix' class='contenteditable'>Consumer No.: $consumer_number</span></td>
				</tr>
				<tr>
					<td><span class='contenteditable'>State: U.K</span></td>
					<td><span class='contenteditable'>Cust. GST: $customer_gst</span></td>
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
						<th style='width: 15px;'><span class='contenteditable'>S.No.</span></th>
						<th style='width: 140px;'><span class='contenteditable'>Product Name</span></th>
						<th><span class='contenteditable'>HSN code</span></th>
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
						<td></td>
					</tr>
					<tr>
						<td colspan='3'>Total</td>
						<td style='text-align: center;'><b>$total_qty</b></td>
						<td style='text-align: center;'></td>
						<td style='text-align: center;'><b>$sum_amount</b></td>
						<td style='text-align: center;'><b>$taxable_amount</b></td>
						<td style='text-align: center;'></td>
						<td style='text-align: center;'><b>$sum_cgst_amount</b></td>
						<td style='text-align: center;'></td>
						<td style='text-align: center;'><b>$sum_sgst_amount</b></td>
						<td style='text-align: center;'><b>$sum_total_amount</b></td>
					</tr>
				</tbody>
			</table>
			
			<table class='meta' style='width:100%; height:180px;'>
			<tr>
				<td style='border-right:1px solid #eee;width:112px !important;' ><strong>Description of Goods</strong></td>
				<td style='border-right:1px solid #eee;text-align: center;'><strong>HSN/SAC</strong></td>
				<td style='border-right:1px solid #eee;text-align: center;'><strong>Quantity</strong></td>
				<td style='border-right:1px solid #eee;text-align: center;'><strong>Rate</strong></td>
				<td style='border-right:1px solid #eee;text-align: center;'><strong>Per</strong></td>
				<td style='border-right:1px solid #eee;text-align: center;'><strong>Amount</strong></td>
			</tr>
			<tr>
				<td style='border-right:1px solid #eee;border-top:1px solid #eee;'></td>
				<td style='border-right:1px solid #eee;border-top:1px solid #eee;'></td>
				<td style='border-right:1px solid #eee;border-top:1px solid #eee;'>$total_qty</td>
				<td style='border-right:1px solid #eee;border-top:1px solid #eee;'>$final_total_rate</td>
				<td style='border-right:1px solid #eee;border-top:1px solid #eee;'></td>
				<td style='border-right:1px solid #eee;border-top:1px solid #eee;text-align:right;'>$sum_amount</td>
			</tr>
			<tr>
				<td style='border-right:1px solid #eee;'>Less: Discount</td>
				<td style='border-right:1px solid #eee;'>15/KG ON</td>
				<td style='border-right:1px solid #eee;'></td>
				<td style='border-right:1px solid #eee;'>$youSaved</td>
				<td style='border-right:1px solid #eee;'></td>
				<td style='border-right:1px solid #eee;text-align:right;'>$less_discount_amount</td>
			</tr>
			<tr>
				<td style='border-right:1px solid #eee;'>Taxable Amount</td>
				<td style='border-right:1px solid #eee;'></td>
				<td style='border-right:1px solid #eee;'></td>
				<td style='border-right:1px solid #eee;'></td>
				<td style='border-right:1px solid #eee;'></td>
				<td style='border-right:1px solid #eee;border-top:1px solid #eee;text-align:right;'>$taxable_amount2</td>
			</tr>
			<tr>
				<td style='border-right:1px solid #eee;'>Output CGST</td>
				<td style='border-right:1px solid #eee;'></td>
				<td style='border-right:1px solid #eee;'></td>
				<td style='border-right:1px solid #eee;'></td>
				<td style='border-right:1px solid #eee;'>%</td>
				<td style='border-right:1px solid #eee;text-align:right;'>$sum_cgst_amount</td>
			</tr>
			<tr>
				<td style='border-right:1px solid #eee;'>Output SGST</td>
				<td style='border-right:1px solid #eee;'></td>
				<td style='border-right:1px solid #eee;'></td>
				<td style='border-right:1px solid #eee;'></td>
				<td style='border-right:1px solid #eee;'>%</td>
				<td style='border-right:1px solid #eee;text-align:right;'>$sum_sgst_amount</td>
			</tr>
			<tr>
				<td style='border-right:1px solid #eee;'>Bill Discount</td>
				<td style='border-right:1px solid #eee;'></td>
				<td style='border-right:1px solid #eee;'></td>
				<td style='border-right:1px solid #eee;'></td>
				<td style='border-right:1px solid #eee;'></td>
				<td style='border-right:1px solid #eee;text-align:right;'>$discount</td>
			</tr>
			<tr>
				<td style='border-right:1px solid #eee;border-top:1px solid #eee;'>Total (Round off.)</td>
				<td style='border-right:1px solid #eee;border-top:1px solid #eee;'></td>
				<td style='border-right:1px solid #eee;border-top:1px solid #eee;'></td>
				<td style='border-right:1px solid #eee;border-top:1px solid #eee;'></td>
				<td style='border-right:1px solid #eee;border-top:1px solid #eee;'></td>
				<td style='border-right:1px solid #eee;border-top:1px solid #eee;text-align:right;'>$final_amount</td>
			</tr>
			<tr>
				<td style='border-right:1px solid #eee;border-top:1px solid #eee;'>Amount in words:</td>
				<td colspan='5' style='border-right:1px solid #eee;border-top:1px solid #eee;'>$word_amount</td>				
			</tr>
			</table>
			<table class='meta' style='float:left;'>
							<tr><td style='font-size: 10px;'>Schemes:</td></tr>
							<tr><td style='font-size: 10px;'>Loan:</td></tr>
							<tr><td style='font-size: 10px;'>Bank A/C: </td></tr>
							<tr><td style='font-size: 10px;'>Terms & Conditions :</td></tr>
			</table>
			<p style='width:170px; height:150px; float:left; border:1px solid; padding:20px 0px 0px 20px; margin-top:40px;'><strong>Customer's Signature</strong></p>
			<p style='width:170px; height:150px; float:left; border:1px solid; padding:20px 0px 0px 20px; margin-top:-0px;'><strong>Payment Type:-</strong>$payment_content</p>
			<p style='width:170px; height:150px; float:left; border:1px solid; padding:20px 0px 0px 20px; margin-top:-0px;'><strong>Common Seal</strong></p>
			<p style='width:170px; height:150px; float:left; border:1px solid; padding:20px 0px 0px 20px; margin-top:-0px;'><strong>Authorised Signatory</strong></p>
			
						
			
		</article>
		<aside>
			<h1><span class='contenteditable'></span></h1>
			<div class='contenteditable'>
			</div>
		</aside>
	</body>
</html>";
//require_once '../../dompdf/autoload.inc.php';
//echo $html_content;die();

use Dompdf\Dompdf;
// instantiate and use the dompdf class
$dompdf = new Dompdf();
$dompdf->loadHtml("$html_content");

// (Optional) Setup the paper size and orientation
$dompdf->setPaper('A3', 'portrait');
//$dompdf->setPaper('A4', 'landscape');
// Render the HTML as PDF
$dompdf->render();

// Output the generated PDF to Browser
$dompdf->stream("$invice_number.pdf");
die();

?> 
