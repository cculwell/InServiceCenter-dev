
/*
window.onload = function() {
    document.getElementById('General').style.display = 'none';
    document.getElementById('BookStudy').style.display = 'none';
}
*/

function selectRequestType() {
    if(document.getElementById('General').checked) {
        // alert("You selected General");
        document.getElementById('request_desc_row').style.display = 'block';
    }
    else if (document.getElementById('BookStudy').checked) {
        // alert("You selected BookStudy");
        document.getElementById('request_desc_row').style.display = 'none';
    }
    else{
        //document.getElementById('request_desc_row').style.display = 'inline';
    }
}

