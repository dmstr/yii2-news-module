/**
 * Created by cstebe on 22.12.14.
 *
 * function to change the videos ,headline and date in a videogallery view
 *
 * @param id
 */
$(document).on('click', '.video-wrapper-small', function () {

    var self = $(this);

    var url_lg = self.data('url');
    var url_sm = self.closest('.row').find('.lg-video').data('url');

    $.ajax({
        type: 'GET',
        url: url_lg,
        beforeSend: function () {
        },
        success: function (data) {

            // load clicked video into large wrapper
            self.closest('.row').find('[id^=wrapper-large-]').html(data);

            // load previous large video into clicked small wrapper
            $.ajax({
                type: 'GET',
                url: url_sm,
                beforeSend: function () {
                },
                success: function (data) {
                    self.closest("div.video-wrapper-small").replaceWith(data);
                },
                error: function (data) { // if error occured
                    alert("Gallerie: Es ist ein Fehler aufgetreten.");
                },
                dataType: 'html'
            });
        },
        error: function (data) { // if error occured
            alert("Gallerie: Es ist ein Fehler aufgetreten.");
        },
        dataType: 'html'
    });
});