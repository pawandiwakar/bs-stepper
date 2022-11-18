<?php
session_start();

if(isset($_SESSION['user']) && $_SESSION['user']!=''){
    $logged_in_user = $_SESSION['uid'];
	include_once 'db.php';
	include_once 'head.php';
    
	if(isset($_GET['sid']) && $_GET['sid']!=''){
		$sid = $_GET['sid'];
		$q = "SELECT * FROM invoice WHERE id='$sid'";
		$r = mysqli_query($db,$q);
		$res = mysqli_fetch_assoc($r);
		
		$company_id = $res['company_id'];
		$currency = $res['currency'];
		$edoc_id = $res['edoc_id'];
		$invoice_stage = $res['invoice_stage'];
		
		if($invoice_stage == 0){
			$invoice_stage = "Awaiting Approval";
		} else if($invoice_stage == 1){
			$invoice_stage = "Approved";
		}
		
		$erp_ref = $res['erp_ref'];
		$invoice_type = $res['invoice_type'];
		if($invoice_type == 0){
			$invoice_type = "Invoice";
		}else{
			$q6 = "SELECT * FROM document_type WHERE id='$invoice_type'";
			$r6 = mysqli_query($db, $q6);
			
			$re6 = mysqli_fetch_assoc($r6);
			
			$invoice_type = $re6['name'];
		}
		$location = $res['location'];
		$vendor_name = $res['vendor_name'];
		$customer_account = $res['customer_account'];
		
		$q7 = "SELECT * FROM gl_accounts WHERE id='$customer_account'";
		$r7 = mysqli_query($db,$q7);
		
		$re7 = mysqli_fetch_assoc($r7);
		
		$customer_account = $re7['account_no'] . ' - ' . $re7['account_name'];
		
		
		$transaction_type = $res['transaction_type'];
		$purchase_invoice_number = $res['purchase_invoice_number'];
		$invoice_date = $res['invoice_date'];
		$purchase_order = $res['purchase_order'];
		$week = $res['week'];
		$week_dates = $res['week_dates'];
		$transaction_period = $res['transaction_period'];
		$ship_via = $res['ship_via'];
		$exchange_rate = $res['exchange_rate'];
		$description = $res['description'];
		$class = $res['class'];
		$is_paid = $res['is_paid'] == 0? 'No': 'Yes';
		$payment_mode = $res['payment_mode'];
		$cheque_number = $res['cheque_number'];
		$terms = $res['terms'];
		$due_date = $res['due_date'];
		$sub_total = $res['sub_total'];
		$tax_amount = $res['tax_amount'];
		$invoice_total = $res['invoice_total'];
		$is_proforma = $res['is_proforma'] == 0? 'No': 'Yes';
		$awaiting_credit_note = $res['awaiting_credit_note'] == 0? 'No': 'Yes';
		$created_by = $res['created_by'];
		
		$q2 = "SELECT * FROM company WHERE id='$company_id'";
		$r2 = mysqli_query($db, $q2);
	
		$re2 = mysqli_fetch_assoc($r2);
	
		$company_name = $re2['name'];
	
		$q3 = "SELECT * FROM user WHERE id='$created_by'";
		$r3 = mysqli_query($db, $q3);
	
		$re3 = mysqli_fetch_assoc($r3);
	
		$created_by = $re3['fname'] . ' ' . $re3['lname'];
		
		$q4 = "SELECT * FROM currency WHERE id='$currency'";
		$r4 = mysqli_query($db, $q4);
		
		$re4 = mysqli_fetch_assoc($r4);
		
		$symbol = $re4['symbol'];
		$currency_name = $re4['name'];
		
		
	}else{
		echo <<<_END
		<meta http-equiv='refresh' content='0;url=invoice.php'>
_END;
	}
	
    echo <<<_END
        <!-- Page Content -->
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Invoice #$sid</h1>
                </div>
            </div>
			
			<div class="row">
_END;

if(isset($_GET['msg'])){
	$msg = $_GET['msg'];
	echo <<<_END
	<div class="col-lg-12">
		<div class="alert alert-info" role="alert">
		$msg
		</div>
	</div>
_END;
}

echo <<<_END
				<div class="col-lg-12">
					<div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <tr>
								<th>Company</th><td>$company_name</td>
								<th>Currency</th><td>$currency_name</td>
							<tr>
							<tr>
								<th>Invoice Stage</th><td>$invoice_stage</td>
								<th>ERP Ref</th><td>$erp_ref</td>
							<tr>
							<tr>
								<th>Invoice Type</th><td>$invoice_type</td>
								<th>Location</th><td>$location</td>
							<tr>
							<tr>
								<th>Vendor</th><td>$vendor_name</td>
								<th>GL Account</th><td>$customer_account</td>
							<tr>
							<tr>
								<th>Category Type</th><td>$transaction_type</td>
								<th>Purchase Invoice No.</th><td>$purchase_invoice_number</td>
							<tr>
							<tr>
								<th>Invoice Date</th><td>$invoice_date</td>
								<th>Purchase Order</th><td>$purchase_order</td>
							<tr>
							<tr>
								<th>Week</th><td>$week</td>
								<th>Week Start Date</th><td>$week_dates</td>
							<tr>
							<tr>
								<th>Accounting Period</th><td>$transaction_period</td>
								<th>Ship Via</th><td>$ship_via</td>
							<tr>
							<tr>
								<th>Exchange Rate</th><td>$exchange_rate</td>
								<th>Description</th><td>$description</td>
							<tr>
							<tr>
								<th>Class</th><td>$class</td>
								<th>Is Paid</th><td>$is_paid</td>
							<tr>
							<tr>
								<th>Payment Mode</th><td>$payment_mode</td>
								<th>Cheque Number</th><td>$cheque_number</td>
							<tr>
							<tr>
								<th>Terms</th><td>$terms</td>
								<th>Due Date</th><td>$due_date</td>
							<tr>
							<tr>
								<th>Is Proforma</th><td>$is_proforma</td>
								<th>Sub-Total</th><td>$symbol $sub_total</td>
							<tr>
							<tr>
								<th>Tax Amount</th><td>$symbol $tax_amount</td>
								<th>Invoice Total</th><td>$symbol $invoice_total</td>
							<tr>
							<tr>
								<th>Awaiting Credit Note</th><td>$awaiting_credit_note</td>
								<th>Created By</th><td>$created_by</td>
							<tr>
						</table>
					</div>
					<br>
                </div>
            
			</div>
			
			<div class="row">
                        <div class="col-lg-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    Items
                                </div>
                                <!-- /.panel-heading -->
                                <div class="panel-body">
								<form role="form" action="invoice_additem.php" method="post">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered table-hover">
                                            <thead>
                                                <tr>
													<th>S. No.</th>
													<th>Location</th>
													<th>Item Name</th>
                                                    <th>GL Account</th>
													<th>Rate</th>
													<th>Quantity</th>
													<th>UOM</th>
													<th>Tax Percent</th>
													<th>Net Amount</th>
													<th>Discount</th>
													<th>Subtotal Amount</th>
                                                    <th>Tax Amount</th>
													<th>Gross Amount</th>
													<th>Adjustment Amount</th>
													<th>Remarks</th>
													<th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
_END;

$q = "SELECT * FROM invoice_items WHERE invoice_id='$sid' ORDER BY id desc";
$r = mysqli_query($db,$q);

$sn = 0;
while($res = mysqli_fetch_assoc($r)){
	$rate = number_format($res['rate'], 2, ".", ",");
	$net_amount = number_format($res['net_amount'], 2, ".", ",");
	$discount = number_format($res['discount'], 2, ".", ",");
	$subtotal_amt = number_format($res['subtotal_amt'], 2, ".", ",");
	$tax_amt = number_format($res['tax_amt'], 2, ".", ",");
	$gross_amount = number_format($res['gross_amount'], 2, ".", ",");
	$adjustment_amount = number_format($res['adjustment_amount'], 2, ".", ",");
	$sn = $sn+1;
	
	$doe = $res['doe'];
	$location = $res['location'];
	$item_name = $res['item_name'];
	$gl_account = $res['gl_account'];
	$q7 = "SELECT * FROM gl_accounts WHERE id='$gl_account'";
	$r7 = mysqli_query($db,$q7);
	$re7 = mysqli_fetch_assoc($r7);
	$gl_account = $re7['account_no'] . ' - ' . $re7['account_name'];
	
	
	$qty = $res['qty'];
	$unit_of_material = $res['unit_of_material'];
	$tax_percent = $res['tax_percent'];
	$remarks = $res['remarks'];
	
	echo <<<_END
	 <tr id="remove_div">
                <td></td>
                <td><div class="form-group">
                        <label>Location</label>
                        <input class="form-control" placeholder="Location" name="location[]" value="">

                    </div></td>
                <td><div class="form-group">
                        <label>Item Name</label>
                        <input class="form-control" placeholder="item name" name="item_name[]">
                    </div>
                </td>
		<td><div class="form-group">
									<label>GL Account</label>
									
									<select class="form-control" name="gl_account">
                                <option value="">--Select GL Account--</option>
_END;

$q = "SELECT * FROM gl_accounts WHERE is_deleted=0";
$r = mysqli_query($db,$q);

while($res = mysqli_fetch_assoc($r)){
	$name = $res['account_no'] . ' - ' . $res['account_name'];;
	$sn = $res['id'];
	
	if($sn != $sn){
		echo <<<_END
		<option value="$sn" selected="selected">$name</option>
_END;
	}else{
		echo <<<_END
		<option value="$sn">$name</option>
_END;
	}
}

echo <<<_END
                            </select>
								</div>
								</td>
				<td>
                    <div class="form-group">
                        <input class="form-control" placeholder="Rate" name="rate[]" value="">
                    </div>
                </td>
                <td>
                    <div class="form-group">
                        <input class="form-control" placeholder="Quantity" name="qty[]" value="1">
                    </div>
                </td>
                <td>
                    <div class="form-group">
                        <input class="form-control" placeholder="Unit Of Material" value="" name="unit_of_material[]">
                    </div></td>
                <td>
                    <div class="form-group">
                        <input class="form-control" placeholder="Tax Percent" name="tax_percent[]" value='0'>
                    </div></td>
                <td>
                    <div class="form-group">

                        <input class="form-control" placeholder="Net Amount" name="net_amount[]" value="0">
                    </div></td>
                <td>
                    <div class="form-group">

                        <input class="form-control" placeholder="Discount" name="discount[]" value="0">
                    </div></td>
                <td>
                    <div class="form-group">

                        <input class="form-control" placeholder="Sub-Total Amount" name="subtotal_amt[]" value="0">
                    </div></td>
                <td>
                    <div class="form-group">

                        <input class="form-control" placeholder="Tax Amount" name="tax_amt[]" value="0">
                    </div></td>
                <td>
                    <div class="form-group">

                        <input class="form-control" placeholder="Gross Amount" name="gross_amount[]" value="0">
                    </div></td>
                <td>
                    <div class="form-group">

                        <input class="form-control" placeholder="Adjustment Amount" name="adjustment_amount[]" value="0">
                    </div></td>
                <td>
                    <div class="form-group">
                        <input class="form-control" placeholder="Remarks" name="remarks">
                    </div></td>
                <td><input type="button" id="remove_details" value="X"></td>
    </tr>
_END;
}


echo <<<_END
                                            </tbody>
                                        </table>
                                    </div>
									</form>
                                    <!-- /.table-responsive -->
                                </div>
                                <!-- /.panel-body -->
                            </div>
                            <!-- /.panel -->
                        </div>
                        <!-- /.col-lg-12 -->
                    </div>
_END;
//--Multi insertion query

//if(isset($_POST['sbmt'])){
  //  $a=$_POST['location'];
    //$b=$_POST['item_name'];
    //$c=$_POST['gl_account'];
   // $array = array($a, $b, $c);
    //foreach ($array as $k=> $abc){
      //  $data= array("scf_status"=>$a[$k],"scf_record_title"=>$b[$k], "scf_section_type" => $c[$k]);
       // $ds[] = "(" . implode (', ', $data) . ")";
       // $key = "(" . implode (', ', array_keys($data)) . ")";
    //}
    //$query = "INSERT INTO table_name $key VALUES (" . implode (', ', $ds) . ")";
   // debug_results($query);
}




$q5 = "SELECT * FROM edocs WHERE id='$edoc_id'";
$r5 = mysqli_query($db, $q5);

$re5 = mysqli_fetch_assoc($r5);

$file_path = $re5['file_path'];
$file_name = $re5['file_name'];

echo <<<_END
					
					<div class="row">
						<div class="col-lg-12">
							<h3>Add Item</h3>
							<hr>
							<div class="form-group">
								<label>File</label>
								<p>Preview File :<a href="$file_path" target="blank"> $file_name</a></p>
							</div>
						</div>
						<form role="form" action="invoice_additem.php" method="post">
							<div class="col-lg-12">
								<input type="hidden" name="invoice_id" value="$sid">
								<button type="submit" class="btn btn-default">Add Item</button>
							</div>
						</form>
					</div>
			<br>
			<br>
			<br>
			<br>
        </div>
    </div>
_END;


    include_once 'foot.php';    
}
else{
    echo <<<_END
    <meta http-equiv='refresh' content='0;url=login.php'>
_END;
}

?>