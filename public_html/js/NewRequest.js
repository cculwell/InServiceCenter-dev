


window.onload = initPage();

function initPage() {


}


// Function to manipulate dom after content is loaded.
window.addEventListener("load", function(){
    document.getElementById('school_system_row').style.display = 'none';
    document.getElementById('request_desc_row').style.display = 'none';
    document.getElementById('book_title_row').style.display = 'none';
    document.getElementById('format_method_row').style.display = 'block';

    //document.getElementById('book_title_row').style.display = 'none';


});


function selectRequestType() {
    if(document.getElementById('General').checked) {
        // alert("You selected General");
        document.getElementById('school_system_row').style.display = 'block';
        document.getElementById('request_desc_row').style.display = 'block';
        document.getElementById('book_title_row').style.display = 'none';
        document.getElementById('format_method_row').style.display = 'block';
    }
    else if (document.getElementById('BookStudy').checked) {
        // alert("You selected BookStudy");
        document.getElementById('school_system_row').style.display = 'block';
        document.getElementById('request_desc_row').style.display = 'none';
        document.getElementById('book_title_row').style.display = 'block';
        document.getElementById('format_method_row').style.display = 'block';

    }
    else{
        // do nothing at the moment
    }
}

