$(document).ready(function () {
    var success = $('#Show_Success');
    if(success.is(":visible"))
        success.hide();


    var index = 1;
    $('.datepicker').datepicker();
    $('.timepicker').timepicker({'minTime': '7:30am',
        'maxTime': '11:30pm'
    });

    $("#add_date_btn").click(function(){

        $('#add_row' + index).html("<td>" + (index + 1)+ "</td>" +
            "<td><input type='text' name='requesteddatefrom" + index + "' class='form-control datepicker' placeholder='MM/DD/YYYY' required/></td>" +
            "<td><input type='text' class='timepicker form-control' name='starttime" + index + "' placeholder='HH:MM AM/PM' required/></td>" +
            "<td><input type='text' class='timepicker form-control' name='endtime" + index + "' placeholder='HH:MM AM/PM' required></td>" +
            "<td><input type='text' class='timepicker form-control' name='preeventsetup" + index + "' placeholder='HH:MM AM/PM' required></td>"

        );
        $('.datepicker').datepicker();
        $('.timepicker').timepicker({'minTime': '7:30am',
            'maxTime': '11:30pm'
        });
        index+=1;
        $('#table_body').append("<tr id='add_row"+index+"'></tr>");
    });
    $('#delete_date_btn').click(function(){
        if(index===1)
        {
            index=1;
        }
        else
        {
            index-=1;
            $("#add_row"+index).html('');
        }


    });
    $('#form_submit').click(function(){
        var form = $("#form_reservation");

        var url = "php/ReservationRequest.php";
        var formData = form.serialize();

        $.ajax({
            url: url,
            type: 'POST',
            data: formData,
            success:function()
            {
                console.log("Success on AJAX");
                $('#Show_Success').toggle();
                form.reset();
            },
            error:function () {
                alert("ERROR FORM NOT SUBMITTED")
            }
            });
        event.preventDefault();
        });

});
function CheckInput()
{
    $('input[type=text]').each()
}