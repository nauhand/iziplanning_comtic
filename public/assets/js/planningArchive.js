// $('#search').click(function() {

//     $.ajax({
//         url: $('#form-search').data('action'),
//         type: 'POST',
//         data: $('#form-search').serialize(),
//         dataType: 'json',
//         beforeSend: function() {
//             $("div.close").show();
//         },
//         success: function(data) {
//             console.log(data.message);
//             $('#div_table_planning').html(data.table_provisoire);
//             $("div.close").hide();
//         },
//         error: function(xhr) {
//             $.each(xhr.responseJSON, function(key, value) {
//                 $('div.form-group.' + key).addClass('has-error');
//                 $('div.form-group.' + key).append('<label class="control-label text-danger" for="inputError"><i class="fa fa-times-circle-o"></i>' + value + '</label>');
//                 $("div.close").hide();
//             });
//         }
//     });

// });

$('#mois').change(function() {

    $.ajax({
        url: $('#form-search').data('action'),
        type: 'POST',
        data: $('#form-search').serialize(),
        dataType: 'json',
        beforeSend: function() {
            $("div.close").show();
        },
        success: function(data) {
            console.log(data.message);
            $('#div_table_planning').html(data.table_provisoire);
            $("div.close").hide();
        },
        error: function(xhr) {
            $.each(xhr.responseJSON, function(key, value) {
                $('div.form-group.' + key).addClass('has-error');
                $('div.form-group.' + key).append('<label class="control-label text-danger" for="inputError"><i class="fa fa-times-circle-o"></i>' + value + '</label>');
                $("div.close").hide();
            });
        }
    });

});

$('#idMois').change(function() {

    search();
});

$('#idAnnee').change(function() {
    search();
});

$('#retourArchive').click(function () {
    search();
})
$(document).on('click', '#retourArchive', function() {
    search();
});

$('#datalist_agent_name').change(function () {
    search()
});

$('#datalist_site_name').change(function () {
    search()
});

function search() {

    const idSite    = $("#list_site_name option[value='"+ $('#datalist_site_name').val() +"']").data('value');
    const idMois    = $('#idMois').val();
    const idAgent   = $("#list_agent_name option[value='"+ $('#datalist_agent_name').val() +"']").data('value');
    const idAnnee    = $('#idAnnee').val();

    console.log(idSite);
    console.log(idMois);
    console.log(idAgent);
    console.log(idAnnee);
    console.log($("#form-search").data("route"));
    

    $.ajax({
        url: $("#form-search").data("route"),
        type: 'GET',
        data: {
            idAgent : idAgent,
            idSite  : idSite,
            idMois  : idMois,
            idAnnee : idAnnee
        },
        dataType: 'json',
        beforeSend: function() {
        $("div.close").show();
        },
        success: function(data) {
        $('#div_table_planning').html(data.content);
        $("div.close").hide();
            console.log(data);
        },
        error: function (xhr, ajaxOptions, thrownError) {
            console.log(xhr);
            console.log(thrownError);
            $("div.close").hide();
        }
    });

}

$(document).on('click', '.afficher', function() {

    const idSite    = $("#list_site_name option[value='"+ $('#datalist_site_name').val() +"']").data('value');
    const idMois    = $('#idMois').val();
    const idAgent   = $(this).data('idagent');
    const idAnnee   = $('#idAnnee').val();

    console.log(idSite);
    console.log(idMois);
    console.log(idAgent);
    console.log(idAnnee);
    console.log($("#form-search").data("route"));
    

    $.ajax({
        url: $("#form-search").data("route"),
        type: 'GET',
        data: {
            id      : idAgent,
            idSite  : idSite,
            idMois  : idMois,
            idAnnee : idAnnee
        },
        dataType: 'json',
        beforeSend: function() {
        $("div.close").show();
        },
        success: function(data) {
        $('#div_table_planning').html(data.content);
        $("div.close").hide();
            console.log(data);
        },
        error: function (xhr, ajaxOptions, thrownError) {
            console.log(xhr);
            console.log(thrownError);
            $("div.close").hide();
        }
    });

});


$(document).on('click', '.generer-excelIndiv', function(e) {

    const idSite    = $("#list_site_name option[value='"+ $('#datalist_site_name').val() +"']").data('value');
    const idMois    = $('#idMois').val();
    const idAgent   = $("#list_agent_name option[value='"+ $('#datalist_agent_name').val() +"']").data('value');

    const params = {
        id      : $(this).data('id'),
        idSite  : idSite,
        idMois  : idMois,
        idAgent : idAgent
    }
    const href = $.param(params);
    let url = $(this).data('excelroute') + "?" + href
    url         = url.replace(/\s/g,'');
    $(this).attr( 'href', url );

});

$('#annee').change(function() {

    $.ajax({
        url: $('#form-search').data('action'),
        type: 'POST',
        data: $('#form-search').serialize(),
        dataType: 'json',
        beforeSend: function() {
            $("div.close").show();
        },
        success: function(data) {
            console.log(data.message);
            $('#div_table_planning').html(data.table_provisoire);
            $("div.close").hide();
        },
        error: function(xhr) {
            $.each(xhr.responseJSON, function(key, value) {
                $('div.form-group.' + key).addClass('has-error');
                $('div.form-group.' + key).append('<label class="control-label text-danger" for="inputError"><i class="fa fa-times-circle-o"></i>' + value + '</label>');
                $("div.close").hide();
            });
        }
    });

});

$('#searchZone').change(function() {

    $.ajax({
        url: $('#form-search').data('action'),
        type: 'POST',
        data: $('#form-search').serialize(),
        dataType: 'json',
        beforeSend: function() {
            $("div.close").show();
        },
        success: function(data) {
            console.log(data.message);
            $('#div_table_planning').html(data.table_provisoire);
            $("div.close").hide();
        },
        error: function(xhr) {
            $.each(xhr.responseJSON, function(key, value) {
                $('div.form-group.' + key).addClass('has-error');
                $('div.form-group.' + key).append('<label class="control-label text-danger" for="inputError"><i class="fa fa-times-circle-o"></i>' + value + '</label>');
                $("div.close").hide();
            });
        }
    });

});

$(document).on('click', '.afficher', function() {

    $.ajax({
        url: $('#form-search').data('action'),
        type: 'GET',
        data: {
            id: $(this).data('agent'),
            month: $('#month').val()
        },
        dataType: 'json',
        beforeSend: function() {
            $("div.close").show();
        },
        success: function(data) {

            $('#div_table_planning').html(data.table_provisoire);
            $("div.close").hide();
        },
        error: function(xhr) {
            $.each(xhr.responseJSON, function(key, value) {
                $('div.form-group.' + key).addClass('has-error');
                $('div.form-group.' + key).append('<label class="control-label text-danger" for="inputError"><i class="fa fa-times-circle-o"></i>' + value + '</label>');
                $("div.close").hide();
            });
        }
    });

});