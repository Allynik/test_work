$('.grid-view tr.filters td:last-child').each(function() {
    var self = $(this);
    self.html('<a href="?" style="margin:0;" class="btn btn-default btn-block text-center"><i class="fa fa-times-circle"></i></a>');
});

$(document).on('click', 'a[href*=".jpg"], a[href*=".jpeg"], a[href*=".png"], a[href*=".gif"]', function(event) {
    event.preventDefault();
    $(this).ekkoLightbox();
});