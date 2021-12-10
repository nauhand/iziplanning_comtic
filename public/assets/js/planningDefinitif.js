function ajaxRequest(type, agent_id) {

    $.ajax({
        url: $("#route").data('route'),
        type: 'GET',
        data: {
            type: type
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

}


$('#site').change(function() {

    $.ajax({
        url: $('#form-search').data('action'),
        type: 'POST',
        data: $('#form-search').serialize(),
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

$('#agent_name').change(function() {

    $.ajax({
        url: $('#form-search').data('action'),
        type: 'POST',
        data: $('#form-search').serialize(),
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

$(document).on('click', '.afficher', function() {
    console.log($(this).data('agent'))
    const idSite    = $("#list_site_name option[value='"+ $('#datalist_site_name').val() +"']").data('value');
    
    $.ajax({
        url: $("#route").data("route"),
        type: 'GET',
        data: {
            id      : $(this).data('agent'),
            idSite  : idSite,
            idMois  : $('#idMois').val(),
            type    : "afficher"
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

$(document).on('click', '#retour', function() {
    search();
    // $.ajax({
    //     url: $('#form-search').data('action'),
    //     type: 'GET',
    //     data: {
    //         agent_name: $('#agent_name').val(),
    //         site: $('#site').val(),
    //         annee: $('#annee').val()
    //     },
    //     dataType: 'json',
    //     beforeSend: function() {
    //         $("div.close").show();
    //     },
    //     success: function(data) {

    //         $('#div_table_planning').html(data.table_provisoire);
    //         $("div.close").hide();
    //     },
    //     error: function(xhr) {
    //         $.each(xhr.responseJSON, function(key, value) {
    //             $('div.form-group.' + key).addClass('has-error');
    //             $('div.form-group.' + key).append('<label class="control-label text-danger" for="inputError"><i class="fa fa-times-circle-o"></i>' + value + '</label>');
    //             $("div.close").hide();
    //         });
    //     }
    // });

});

// $(document).on('click', '#retour', function() {
//     ajaxRequest('retour', 0);
// });

$(document).on('click', '#retourArchive', function() {

    $.ajax({
        url: $('#form-search').data('action'),
        type: 'GET',
        data: {
            id: $(this).data('agent'),
            mois: $('#mois').val(),
            agent_name: $('#agent_name').val(),
            agent_statut: $('#agent_statut').val(),
            annee: $('#annee').val()
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

$(document).on('click', '.generer-excel', function() {

    const idSite    = $("#list_site_name option[value='"+ $('#datalist_site_name').val() +"']").data('value');
    const idMois    = $('#idMois').val();
    const idAgent   = $("#list_agent_name option[value='"+ $('#datalist_agent_name').val() +"']").data('value');

    const params = {
        idSite  : idSite,
        idMois  : idMois,
        idAgent : idAgent
    }
    const href = $.param(params);
    let url = $(this).data('excelroute') + "?" + href
    url         = url.replace(/\s/g,'');
    $(this).attr( 'href', url );

});

$(document).on('click', '.generer-pdf', function() {

    const idSite    = $("#list_site_name option[value='"+ $('#datalist_site_name').val() +"']").data('value');
    const idMois    = $('#idMois').val();
    const idAgent   = $("#list_agent_name option[value='"+ $('#datalist_agent_name').val() +"']").data('value');

    const params = {
        idSite  : idSite,
        idMois  : idMois,
        idAgent : idAgent
    }
    const href = $.param(params);
    let url = $(this).data('pdfroute') + "?" + href
    url         = url.replace(/\s/g,'');
    $(this).attr( 'href', url );

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

$(document).on('click', '.generer-pdfIndiv', function() {

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
    console.log($(this).data('pdfroute'));
    
    let url = $(this).data('pdfroute') + "?" + href
    url         = url.replace(/\s/g,'');
    $(this).attr( 'href', url );

});

function search() {

const idAgent   = $("#list_agent_name option[value='"+ $('#datalist_agent_name').val() +"']").data('value');
const nameAgent = $('#datalist_agent_name').val();

const idSite    = $("#list_site_name option[value='"+ $('#datalist_site_name').val() +"']").data('value');
const nameSite  = $('#datalist_site_name').val();
const idMois    = $('#idMois').val();

// const idQualif    = $("#list_qualification_name option[value='"+ $('#datalist_qualification_name').val() +"']").data('value');
// const nameQualif  = $('#datalist_qualification_name').val();

console.log("id :" + idAgent);
console.log("name : "+nameAgent);

$('#generer_agent_name').val(idAgent);
$('#generer_agent_name_text').val(nameAgent);
console.log($('#generer_agent_name').val(idAgent));
console.log($('#generer_agent_name_text').val(nameAgent));

console.log($("#route").data("route"));
console.log("---------------------------------------");
console.log("idAgent :"+idAgent);
console.log("nameAgent :"+nameAgent);
console.log("idSite :"+idSite);
console.log("nameSite :"+nameSite);
console.log("idMois :"+idMois);
// console.log("idQualif :"+idQualif);
// console.log("nameQualif :"+nameQualif);
console.log($("#route").data("route"));
// return
$.ajax({
    url: $("#route").data("route"),
    type: 'GET',
    data: {
        idAgent : idAgent,
        idSite  : idSite,
        idMois  : idMois
    // idQualif    : idQualif,
    // nameQualif  : nameQualif
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
$('#datalist_agent_name').change(function () {
    search();
});
$('#datalist_site_name').change(function () {
    search();
});
$('#idMois').change(function () {
    search();
});
