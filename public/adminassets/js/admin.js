$(document).ready(function () {
    $(".sidebarCollapse").on("click", function (e) {
        e.preventDefault();

        $("#sidebar").toggleClass("active");

        // arrow icon direction change
        $(this).find("i").toggleClass("fa-long-arrow-left fa-long-arrow-right");
    });
});
