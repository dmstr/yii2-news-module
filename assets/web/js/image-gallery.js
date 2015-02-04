/**
 * Created by cstebe on 22.12.14.
 *
 * function to change the images,headline, source and date in a image gallery view
 *
 * @param id
 */
$(document).on('click', '.image-wrapper-small > img', function () {

    var self = $(this);
    var id = self.data('id');
    var image_sm = self;
    var image_lg = $(this).closest('.row').find('.lg-image').html();
    var url = self.data('url');

    //console.log(self,id,image_sm,image_lg,url);return;
    var switchImages = function (data) {

        // load clicked image into large wrapper
        self.closest('.row').find('[id^=wrapper-large-]').html(data);

        // load previous large image into clicked small wrapper
        image_sm.closest("div.image-wrapper-small").html(image_lg);
    };

    $.ajax({
        type: 'GET',
        url: url,
        beforeSend: function () {
        },
        success: switchImages,
        error: function (data) { // if error occured
            alert("Gallerie: Es ist ein Fehler aufgetreten.");
        },
        dataType: 'html'
    });
});