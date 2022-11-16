<!DOCTYPE html>
<html>
<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

</head>
<body>
<!DOCTYPE html>
<html>
<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>
<body>
<div class="panel-body">
<form action="#">
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
                                            <div>
              <tbody id="phone_number_form" class="hidden">
                <tr id="remove_div">
                    <td></td>
                    <td>
                    <div class="form-group">
                            <input class="form-control" placeholder="Location" name="location" value="">
                    </div>
                    </td>
                    <td>
                    <div class="form-group">
                        <input class="form-control" placeholder="item name" name="item_name">
                    </div>
                    </td>
                    <td>
                        <div class="form-group">
                            <select class="form-control" name="gl_account">
                            <option value="">--Select GL Account--</option>
                            <option value="">--Select GL Account--</option>
                            </select>
                        </div>
                     </td>
                    <td>
                    <div class="form-group">

                                                <input class="form-control" placeholder="Rate" name="rate" value="">
                                            </div>
                    </td>
                    <td>
                    <div class="form-group">

                                                <input class="form-control" placeholder="Quantity" name="qty" value="1">
                                            </div>
                    </td>
                    <td>
                    <div class="form-group">

                                                <input class="form-control" placeholder="Unit Of Material" value="" name="unit_of_material">
                                            </div></td>
                    <td>
                    <div class="form-group">

                                                <input class="form-control" placeholder="Tax Percent" name="tax_percent" value='0'>
                                            </div></td>
                    <td>
                    <div class="form-group">

                                                <input class="form-control" placeholder="Net Amount" name="net_amount" value="0">
                                            </div></td>
                    <td>
                    <div class="form-group">

                                                <input class="form-control" placeholder="Discount" name="discount" value="0">
                                            </div></td>
                    <td>
                    <div class="form-group">

                                                <input class="form-control" placeholder="Sub-Total Amount" name="subtotal_amt" value="0">
                                            </div></td>
                    <td>
                    <div class="form-group">

                                                <input class="form-control" placeholder="Tax Amount" name="tax_amt" value="0">
                                            </div></td>
                    <td>
                    <div class="form-group">

                                                <input class="form-control" placeholder="Gross Amount" name="gross_amount" value="0">
                                            </div></td>
                    <td>
                    <div class="form-group">

                                                <input class="form-control" placeholder="Adjustment Amount" name="adjustment_amount" value="0">
                                            </div></td>
                    <td>
                    <div class="form-group">

                                                <input class="form-control" placeholder="Remarks" name="remarks">
                                            </div></td>
                    <td><input type="button" id="remove_details" value="X"></td>
                </tr>
   </tbody>
   </div>
 </table>
</div>
 <p><input type="button" value="Add +" id="add_details"> <input type="submit" value="submit"></p><!-- /.table-responsive -->
</div>
</body>

 <script>
    $(document).ready(function(){
        var form_index=0;
        $("#add_details").click(function(){
            form_index++;
            $(this).parent().before($("#phone_number_form").clone().attr("id","phone_number_form" + form_index));
            $("#phone_number_form" + form_index).css("display","inline");

            $("#phone_number_form" + form_index + " :input").each(function(){

                $(this).attr("name",$(this).attr("name") + form_index);

                $(this).attr("id",$(this).attr("id") + form_index);
                });
            $("#remove_details" + form_index).click(function(){
                $(this).closest("#remove_div").remove();
            });
        });
    });
 </script>
</html>

