$(document).ready(function () {
    var index = 1;
    $('.datepicker').datepicker();
    //Add Date and time to html
 $("#addDate").click(function () {
     $("#add" + index).html("<td>" + (index + 1) + "</td>" +
     "<td><input type='text' placeholder='DD/MM/YYYY' class='datepicker' id='date" + index + "' required> </td>" +
         "<td><input type='text' placeholder='HH:MMam/pm' class='timepicker' id='start" + index + "' required> </td>" +
         "<td><input type='text' placeholder='HH:MMam/pm' class='timepicker' id='end" + index + "' required> </td>" );

     $('.datepicker').datepicker();
     //Add index
     index++;
     $(".table_body").append("<tr id='add" + index + "'</tr>");
 });
 //Delete Date and time row if clicked
 $("#deleteDate").click(function () {
     //if on the first  date and time do nothing
     if(index === 1)
     {
         index = 1;
     }
     //delete
     else
     {
         index-=1;
         $("#add" + index).html('');
     }
 })
});