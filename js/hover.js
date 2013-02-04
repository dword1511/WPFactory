$(document).ready(function() {
    $(".thumb").mouseenter(function() {
               $(".hint").show();
    });
    $(".thumb").mouseleave(function() {
               $(".hint").hide();
    });
});