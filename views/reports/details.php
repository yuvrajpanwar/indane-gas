<html>
	<head>
		<meta charset="utf-8">
		 <title></title>
		<link rel="license" href="http://www.opensource.org/licenses/mit-license/">
		<link rel="icon" type="image/png" href="<?php echo ADMIN_THEME ?>images/favicon.png"> 
    <!-- Core CSS - Include with every page -->
	<link href="<?php echo ADMIN_THEME ?>css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo ADMIN_THEME ?>css/plugins/morris/morris-0.4.3.min.css" rel="stylesheet">
    <link href="<?php echo ADMIN_THEME ?>css/plugins/timeline/timeline.css" rel="stylesheet">
    <link href="<?php echo ADMIN_THEME ?>css/sb-admin.css" rel="stylesheet">
    <link href="<?php echo ADMIN_THEME ?>css/style.css" rel="stylesheet">
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

/* content editable */

*[contenteditable] { border-radius: 0.25em; min-width: 1em; outline: 0; }

*[contenteditable] { cursor: pointer; }

*[contenteditable]:hover, *[contenteditable]:focus, td:hover *[contenteditable], td:focus *[contenteditable], img.hover { background: #DEF; box-shadow: 0 0 1em 0.5em #DEF; }

span[contenteditable] { display: inline-block; }

/* heading */

h1 { font: bold 100% sans-serif; letter-spacing: 0.5em; text-align: center; text-transform: uppercase; }

/* table */

table { font-size: 75%; table-layout: fixed; width: 100%; border: 1px solid #ddd;}
table { border-collapse: separate; border-spacing: 2px; }
th, td {  padding: 0.3em; position: relative; }
th, td { border-radius: 0.25em; border-style: solid; }
th { background: #EEE; border-color: #BBB; }
td { border-color: #DDD; }

/* page */

html { font: 16px/1 'Open Sans', sans-serif; overflow: auto; padding: 0.5in; }
html { background: #999; cursor: default; }

body { box-sizing: border-box;  margin: 0 auto; overflow: hidden; padding: 0.5in; width: 8.5in; }
body { background: #FFF; border-radius: 1px; box-shadow: 0 0 1in -0.25in rgba(0, 0, 0, 0.5); }

/* header */

/*header { margin: 0 0 3em; }*/
header:after { clear: both; content: ""; display: table; }

header h1 { background: #000; border-radius: 0.25em; color: #FFF; margin: 0 0 1em; padding: 0.5em 0; }
header address { float: left; font-size: 75%; font-style: normal; line-height: 1.25; margin: 0 1em 1em 0; }
header address p { margin: 0 0 0.25em; font-size:15px; }
header span, header img { display: block; float: right; }
header span { margin: 0 0 1em 1em; max-height: 25%; max-width: 60%; position: relative; }
header img { max-height: 100%; max-width: 100%; }
header input { cursor: pointer; -ms-filter:"progid:DXImageTransform.Microsoft.Alpha(Opacity=0)"; height: 100%; left: 0; opacity: 0; position: absolute; top: 0; width: 100%; }

/* article */

article, article address, table.meta, table.inventory { margin: 0 0 1em; }
article:after { clear: both; content: ""; display: table; }
article h1 { clip: rect(0 0 0 0); position: absolute; }

article address { float: left; font-size: 125%; font-weight: bold; }

/* table meta & balance */

table.meta, table.balance { float: right; width: 36%; font-size:14px; }
table.meta:after, table.balance:after { clear: both; content: ""; display: table; }

/* table meta */

table.meta th { width: 60%; font-size:14px;}
table.meta td { width: 80%; font-size:14px; }

/* table items */

table.inventory { clear: both; width: 100%; font-size:14px;}

table.inventory th { font-weight: bold; text-align: center; }
table.inventory td:nth-child(1) { width: 26%; }
table.inventory td:nth-child(2) { width: 38%; }
table.inventory td:nth-child(3) {  width: 12%; }
table.inventory td:nth-child(4) { width: 12%; }
table.inventory td:nth-child(5) { width: 12%; }
/*table.inventory td:nth-child(4) { text-align: right; width: 12%; }
table.inventory td:nth-child(5) { text-align: right; width: 12%; }*/

/* table balance */

table.balance th, table.balance td { width: 50%; }
table.balance td { text-align: right; }

/* aside */

aside h1 { border: none; border-width: 0 0 1px; margin: 0 0 1em; }
aside h1 { border-color: #999; border-bottom-style: solid; }

/* javascript */

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
 <script src="<?php echo ADMIN_THEME ?>js/jquery-1.10.2.js"></script>
 <script>
/*$("#print_link").click(function(){
	alert("hello");
});*/
function myFunction() {
	$("#print_link").hide();
	window.print();
	var count=0;
	var auto_refresh = setInterval(function() 
	{ 
		//alert("hello");
		if(count<1)
		{
			window.location.href = "<?php echo common::get_component_link(array("reports","sale_report")); ?>";
			//$(".main_div").css('z-index', 11);
		}
		count++;
	}, 3000);
}
</script>
</head>
	<body>
		
		<header>
				<?php 
				
				/*$q = new Query();
					$q->select()
				->from(TBL_ADDRESS)
				->where_equal_to(array('admin_id'=>$login_id))
				->limit(1)
				->run();
				$address =  $q->get_selected();
				//$state_zipcode=statezip
				$converter = new Encryption;
				$companyname = $converter->decode($address["companyname"]);
				$address = $converter->decode($address["address"]);
				//$city = $converter->decode($address["city"]);
				//$statezip = $converter->decode($address["statezip"]);
				//$phone = $converter->decode($address["phone"]);
				*/
				?>
			<h1>Sale Reports</h1>
			
			
			
			<div style="width:200px; float:right;">
			<a onclick="myFunction()" class="btn btn-default" id="print_link" style="float:right; background:#001F46; color:white;">Print</a>
			</div>
		</header>
		<article>
			
			
			<table class="inventory">
				<thead>
					<tr>
						<th><span contenteditable>Invoice Date</span></th>
						<th><span contenteditable>Invoice No.</span></th>
						<th><span contenteditable>HSN code</span></th>
						 <?php
							 $pro_id_bulk="";
							 $product = new Query();
								$product->select()
								->from(TBL_PRODUCTS)
								->run();
								$product_bulck=$product->get_selected();
								foreach($product_bulck as $prodata)
								{
									$product_name=$prodata['title'];
									$product_id=$prodata['id'];
									$pro_id_bulk.=$product_id."-";
									echo"<th><span contenteditable>$product_name</span></th>";
								}
								
						?>
						<th>Total Amount</th> 
					</tr>
				</thead>
				<tbody>
				<?php 
				$old_date="";
				
				foreach($data as $d)
				{
					$total_amount=0;
					
						$order_id=$d['id'];
						$total_amount=$d["totalprice"];
						$invoice_date=$d["invice_date"];
						$invoice_number=$d['recipt_no'];
						
						if($invoice_date!="0000-00-00")
						{
							$date_display=date("d-M-Y",strtotime($invoice_date));
						}
						else
						{
							$date_display=$invoice_date;
						}
						
						$sel_secuirty= new Query();
						$sel_secuirty->select("SUM(`amount`) as today_sv")
						->from(TBL_OTHER_ORDER_ITEM)
						->where_equal_to(array('order_id'=>$order_id))
						->limit(1)
						->run(); 
						$secuirt_data=$sel_secuirty->get_selected();
						$sv_amount=$secuirt_data['today_sv'];
						
						$total_amount=$sv_amount;
						
						
						$id_array=explode("-",$pro_id_bulk);
						$size_array=sizeof($id_array);
						//echo $size_array;die();
						$item_content="";
						
						for($i=0;$i<$size_array-1;$i++)
						{
							$product_id=$id_array[$i];
							
							$order_item = new Query();
							$order_item->select("price")
							->from(TBL_ORDER_ITEM)
							->where_equal_to(array('order_id'=>$order_id,'product_id'=>$product_id))
							->limit(1)
							->run();
							
							$item_bulck=  $order_item->get_selected();
							if($item_bulck)
							{
								$amount=$item_bulck['price'];
								$total_amount=$total_amount+$amount;
							}
							else
							{
								$amount="";
							}
							
							$item_content.="<td style='text-align: center;'>$amount</td>";
						}
						
					
						
						echo"<tr>
								<td style='text-align: center;'>$date_display</td>									  
								<td style='text-align: center;'>$invoice_number</td>
								<td style='text-align: center;'>$sv_amount</td>
								$item_content
								<td style='text-align: center;'>$total_amount</td>
								</tr>";
						
					$old_date=$invoice_date;
				}	
			?>
				
				</tbody>
			</table>
			
		</article>
		<aside>
			<h1><span contenteditable></span></h1>
			<div contenteditable>
				<!--<p>A finance charge of 1.5% will be made on unpaid balances after 30 days.</p>-->
			</div>
		</aside>
	</body>
</html>