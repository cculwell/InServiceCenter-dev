


window.onload = initPage();

function initPage() {
    // do noting placeholder
}


// Function to manipulate dom after content is loaded.
window.addEventListener("load", function(){
    document.getElementById('school_system_row').style.display = 'none';
    document.getElementById('request_desc_row').style.display = 'none';
    document.getElementById('book_title_row').style.display = 'none';
    document.getElementById('format_method_row').style.display = 'block';

    document.getElementById('General').checked = true;
    selectRequestType();


});


function selectRequestType() {
    if(document.getElementById('General').checked) {
        // alert("You selected General");
        document.getElementById('school_system_row').style.display = 'block';
        document.getElementById('request_desc_row').style.display = 'block';
        document.getElementById('book_title_row').style.display = 'none';
        document.getElementById('format_method_row').style.display = 'block';
        document.getElementById('study_format_sec').style.display = 'none';
        document.getElementById('eval_method_sec').style.display = 'block';
    }
    else if (document.getElementById('BookStudy').checked) {
        // alert("You selected BookStudy");
        document.getElementById('school_system_row').style.display = 'block';
        document.getElementById('request_desc_row').style.display = 'none';
        document.getElementById('book_title_row').style.display = 'block';
        document.getElementById('format_method_row').style.display = 'block';
        document.getElementById('study_format_sec').style.display = 'block';
        document.getElementById('eval_method_sec').style.display = 'none';

    }
    else{
        // do nothing at the moment
    }
}

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