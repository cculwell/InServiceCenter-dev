


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
        $("#study_format_sec").show();
        $("#eval_method_sec").hide();
    }
    else if (document.getElementById('BookStudy').checked) {
        $("#school_system_row").show();
        $("#request_desc_row").hide();
        $("#book_title_row").show();
        $("#format_method_row").show();
        $("#study_format_sec").show()
        $("#eval_method_sec").hide();
    }
    else{
        // do nothing at the moment
    }
};



$("#RequestForm").submit(function (event) {
    // Stops the normal submission of form
    event.preventDefault();
    // Call custom submit function
    submitRequest();
    alert("test1");
});

function submitRequest() {
    //var values = $(this).serialize();
    //alert(values);
    alert("test");
};



/*
$("#submit_form").click(function() {
    alert("test");
});
*/


// jQuery Code to Add , Delete rows

$(document).ready(function(){
    var i=1;
    $("#add_date_row").click(function(){
        $('#addr'+i).html("<td>"+ (i+1) + "</td>" +
            "<td><input  name='date"+i+"'  type='text' placeholder='MM/DD/YYYY'   class='form-control input-md'/></td>"+
            "<td><input  name='sTime"+i+"' type='text' placeholder='00:00 AM/PM'  class='form-control input-md'></td>" +
            "<td><input  name='eTime"+i+"' type='text' placeholder='00:00 AM/PM'  class='form-control input-md'></td>");

        $('#tab_logic').append('<tr id="addr'+(i+1)+'"></tr>');
        i++;
    });

    $("#delete_date_row").click(function(){
        if(i>1){
            $("#addr"+(i-1)).html('');
            i--;
        }
    });


});