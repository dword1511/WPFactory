// Written by Chris McClean
// Fetched from http://css-tricks.com/snippets/jquery/smooth-scrolling/#comment-85066
// The original one on the top of the page has some glitches, so I used this.

$(document).ready(function() {
  $('a[href*=#]').bind('click', function(e) {
    e.preventDefault(); //prevent the "normal" behaviour which would be a "hard" jump

    var target = $(this).attr("href"); //Get the target

    // perform animated scrolling by getting top-position of target-element and set it as scroll target
    $('html, body').stop().animate({ scrollTop: $(target).offset().top }, 500, function() {
      location.hash = target;  //attach the hash (#jumptarget) to the pageurl
    });

    return false;
  });
});
