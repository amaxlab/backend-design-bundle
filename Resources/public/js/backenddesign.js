/**
 * Created by ezyuskin on 26.08.15.
 */

(function($){
    $(function () {
        $('[data-toggle="tooltip"]').tooltip({
            container: 'body'
        });

        $('.nicescroll').niceScroll();

        $('tr.clickable-row[data-href]').on('dblclick', function() {
            window.document.location = $(this).data('href');
        });
    });
})(window.jQuery);

