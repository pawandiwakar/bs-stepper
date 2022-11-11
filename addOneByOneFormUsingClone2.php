<div id="phone_number_form" class="hidden">
    <p>
        Phone number : <input type="text" name="phone_number"> 
         <input type="button" id="remove_phone_number" value="Remove">
    </p>
     
</div>
<form>
    <p>
         <input type="button" value="Add phone number" id="add_phone_number">
    </p>
</form>
<script>
$(document).ready(function(){
    var phone_number_form_index=0;
    $("#add_phone_number").click(function(){
        phone_number_form_index++;
        $(this).parent().before($("#phone_number_form").clone().attr("id","phone_number_form" + phone_number_form_index));
        
		$("#phone_number_form" + phone_number_form_index).css("display","inline");
		
        $("#phone_number_form" + phone_number_form_index + " :input").each(function(){
            $(this).attr("name",$(this).attr("name") + phone_number_form_index);
            $(this).attr("id",$(this).attr("id") + phone_number_form_index);
            });
        $("#remove_phone_number" + phone_number_form_index).click(function(){
            $(this).closest("div").remove();
        });
    }); 
});
</script>