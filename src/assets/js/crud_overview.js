function setOverviewHandlers(overview, route) {
    // Onclick for pagination
    $(overview).on('click', '.pagination a', function (e) {
        e.preventDefault();

        var page = $(this).attr('href').split('page=')[1];
        var column = $(overview).find('th.asc, th.desc').first();
        fillOverview($(this), route, page, $(column).data('id'), $(column).data('order'));
    });

    // Onclick for column header sorting
    $(overview).on('click', 'th a', function (e) {
        e.preventDefault();

        var page = $(overview).find('.pagination li.active span').text();
        var column = $(this).closest('th');
        fillOverview($(this), route, page, $(column).data('id'), $(column).data('new-order'));
    });
}

function fillOverview(element, route, page, orderby, order) {
    page = page || 1;
    orderby = orderby || 'id';
    order = order || 'desc';
    var url = route + '?page=' + page;

    if (typeof orderby !== 'undefined') {
        url += '&order=' + order + '&orderby=' + orderby;
    }

    var overview = $(element).closest('.overview');

    if (typeof extendOverviewUrl === "function") {
        url += extendOverviewUrl(overview);
    }

    $.ajax({
        url: url
    }).done(function(data){
        $(overview).empty().html(data);
    });
}
