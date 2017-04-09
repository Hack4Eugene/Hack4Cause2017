// create jQuery object to be initialized after DOM is loaded
var $;

// check for DOM load completion same as jQuery's .ready()
// but we don't have jQuery available till it's done
document.addEventListener('DOMContentLoaded', function () {
    init();
});

function init() {
    $ = jQuery;
    roundImageCornersBetter();
}

function roundImageCornersBetter() {
    $(".img-round img").css("border-radius", "8px");
}
