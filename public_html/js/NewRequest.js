


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
        $("#cost_per_book_div").hide();
    }
    else if (document.getElementById('BookStudy').checked) {
        $("#school_system_row").show();
        $("#request_desc_row").hide();
        $("#book_title_row").show();
        $("#format_method_row").show();
        $("#study_format_sec").show();
        $("#eval_method_sec").hide();
        $("#company_panel").hide();
        $("#faciliator_panel").show();
        $("#cost_per_book_div").show();
    }
    else{
        // do nothing at the moment
    }
};


$(document).ready(function() {

    // Ajax call to pass form to php
    $('#submitRequest').click(function() {
        // $('#submitRequest').checkValidity();
        var form = $('form');
        var url = "php/add_request.php"; // the script where you handle the form input.

        var captcha = $("#captcha").val();
        var captcha_hash = $("#captcha").realperson('getHash');
        var settings = $("#captcha").realperson('option');
        console.log(settings);
        console.log(captcha);
        console.log(captcha_hash);

        var form_data = form.serialize();

        // form_data.push({name: "captcha_hash", value: captcha_hash});

        // $('#debug').html(form_data);

        $.ajax({
            type: "POST",
            url: url,
            // data: form_data,
            data: {
                captcha: captcha,
                captcha_hash: captcha_hash
            },
            success: function(data)
            {
                // alert("Request Successfully Submitted"); // show response from the php script.
                // $('#RequestForm').trigger("reset");
                // $('#debug').html(data);
                console.log("Ajax Success");
            },
            error: function (data) {
                // alert("error");
            },
            complete: function (data) {
                // alert("complete");
                // location.reload();

            }
        });

        event.preventDefault(); // avoid to execute the actual submit of the form.
    });

    $('.datepicker').datepicker();
    $('.timepicker').timepicker({
        disableTimeRanges: [['12:00am', '8:00am'], ['9:30pm', '11:59pm']],
        disableTextInput: true
    });








});


// jQuery Code to Add , Delete rows

$(document).ready(function(){
    var i=1;
    $("#add_date_row").click(function(){
        $('#addr'+i).html("<td>"+ (i+1) + "</td>" +
            "<td><input  name='date"+i+"'  type='text' placeholder='mm/dd/yyyy' class='form-control input-md datepicker'/></td>"+
            "<td><input  name='sTime"+i+"' type='text' placeholder='00:00am/pm' class='form-control input-md timepicker'></td>" +
            "<td><input  name='eTime"+i+"' type='text' placeholder='00:00am/pm' class='form-control input-md timepicker'></td>" +
            "<td><input  name='bTime"+i+"' type='number' placeholder='' class='form-control input-md'></td>" //+
            // "<td><input  name='note"+i+"' type='text' placeholder=''  class='form-control input-md'></td>"
        );

        $('#tab_logic').append('<tr id="addr'+(i+1)+'"></tr>');
        i++;

        $('.datepicker').datepicker();
        $('.timepicker').timepicker({
            disableTimeRanges: [['12:00am', '8:00am'], ['9:30pm', '11:59pm']],
            disableTextInput: true
        });
    });

    $("#delete_date_row").click(function(){
        if(i>1){
            $("#addr"+(i-1)).html('');
            i--;
        }
    });

});