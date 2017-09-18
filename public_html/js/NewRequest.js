


window.onload = initPage();

function initPage() {
    // do noting placeholder
};


// Function to manipulate dom after content is loaded.
window.addEventListener("load", function(){
    document.getElementById('General').checked = true;
    selectRequestType();
});


function selectRequestType() {
    if (document.getElementById('General').checked) {
        $("#school_system_row").show();
        $("#request_desc_row").show();
        $("#book_title_row").hide();
        $("#format_method_row").show();
        $("#study_format_sec").hide();
        $("#eval_method_sec").show();
        $("#company_panel").show();
        $("#faciliator_panel").hide();
    }
    else if (document.getElementById('BookStudy').checked) {
        $("#school_system_row").show();
        $("#request_desc_row").hide();
        $("#book_title_row").show();
        $("#format_method_row").show();
        $("#study_format_sec").show()
        $("#eval_method_sec").hide();
        $("#company_panel").hide();
        $("#faciliator_panel").show();
    }
    else{
        // do nothing at the moment
    }
};


$(document).ready(function() {

    // Ajax call to pass form to php
    $('#submitRequest').click(function() {
        var form = $('form');
        //var formData = new FormData(document.querySelector('#RequestForm'));
        var url = "php/add_request.php"; // the script where you handle the form input.
        //var test_data = { foo: [], bar: [ 'baz' ] };
        var form_data =form.serialize();
        //alert(form_data);


        $.ajax({
            type: "POST",
            url: url,
            //data: $("#RequestForm").serialize(), // serializes the form's elements.
            data: form_data,
            success: function(data)
            {
                //alert(data); // show response from the php script.
                console.log(data);
            },
            error: function () {
                alert("error");
            }
        });

        event.preventDefault(); // avoid to execute the actual submit of the form.
    });

    $('.datepicker').datepicker();

});


// jQuery Code to Add , Delete rows

$(document).ready(function(){
    var i=1;
    $("#add_date_row").click(function(){
        $('#addr'+i).html("<td>"+ (i+1) + "</td>" +
            "<td><input  name='date"+i+"'  type='text' placeholder='MM/DD/YYYY'   class='form-control input-md datepicker'/></td>"+
            "<td><input  name='sTime"+i+"' type='text' placeholder='00:00 AM/PM'  class='form-control input-md'></td>" +
            "<td><input  name='eTime"+i+"' type='text' placeholder='00:00 AM/PM'  class='form-control input-md'></td>");

        $('#tab_logic').append('<tr id="addr'+(i+1)+'"></tr>');
        i++;

        $('.datepicker').datepicker();
    });

    $("#delete_date_row").click(function(){
        if(i>1){
            $("#addr"+(i-1)).html('');
            i--;
        }
    });



});