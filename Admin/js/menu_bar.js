$(document).ready(function () {
	$(function () {
	    $("#subscribers").on("click", function () {
	        $("#the_page").load("Email.php");
	    });

	    $("#newsletter").on("click", function () {
	        $("#the_page").load("Newsletters.php");
	    });

	    $("#bylaws").on("click", function () {
	        $("#the_page").load("Bylaws.php");
	    });
	})
});