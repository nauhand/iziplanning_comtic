$('.hidden').removeClass('hidden')

function ajaxRequest(type, agent_id) {

    const idAgent   = $("#list_agent_name option[value='"+ $('#datalist_agent_name').val() +"']").data('value');
    const nameAgent = $('#datalist_agent_name').val();

    const idSite    = $("#list_site_name option[value='"+ $('#datalist_site_name').val() +"']").data('value');
    const nameSite  = $('#datalist_site_name').val();

    $.ajax({
        url: $("#route").data('route'),
        type: 'GET',
        data: {
            id      : agent_id,
            type    : type,
            idSite  : idSite,
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

$(document).on('click', '#retour', function() {
    ajaxRequest('retour', 0);
});

$(document).on('click', '.afficher', function() {
    var agent_id = $(this).data('agent');
    ajaxRequest('afficher', agent_id);
});

$(document).on('click', '.valider', function() {
    var agent_id = $(this).data('agent');
    ajaxRequest('valider', agent_id);
});

$(document).on('click', '.validerIndividuel', function() {
    var agent_id = $(this).data('agent');
    ajaxRequest('validerIndividuel', agent_id);
});

$(document).on('click', '.supprimer', function() {

    var agent_id = $(this).data('agent');
    ajaxRequest('supprimer', agent_id);
});

$(document).on('click', '.supprimerIndividuel', function() {
    var agent_id = $(this).data('agent');
    ajaxRequest('supprimerIndividuel', agent_id);
});

$('#action_alert').dialog({
    autoOpen: false
});

$('#user_dialog').dialog({
    autoOpen: false,
    width: 400
});

$(document).on('click', '.modifier', function() {
    id = $(this).data('id');
    var agent_id = $(this).data('agent_id');
    var agent_nom = $(this).data('agent_nom');
    var site_nom = $(this).data('site_nom');
    var site_id = $(this).data('site_id');
    var date_debut = $(this).data('date_debut');
    var heure_debut = $(this).data('heure_debut');
    var heure_fin = $(this).data('heure_fin');
    var heure_pause = $(this).data('heure_pause');

    $('#agent_option').val(agent_id);
    $('#agent_option').text(agent_nom);
    $('#site_name').val(site_id);
    $('#date_debut').val(date_debut);
    $('#heure_debut').val(heure_debut);
    $('#heure_fin').val(heure_fin);
    $('#heure_pause').val(heure_pause);

    var agent_name = $('#agent_name option:selected').text();

    $('#save').text('Modifier');
    $('#user_dialog').dialog('option', 'title', 'Modifier une vacation');
    $('#user_dialog').dialog('open');
});

$('#save').click(function() {
    var error_agent_name = '';
    var error_site_name = '';
    var error_date_debut = '';
    var error_heure_debut = '';
    var error_heure_fin = '';
    var error_heure_pause = '';

    if ($('#agent_option').val() == '') {
        error_agent_name = 'Nom de l\'agent requis';
        $('#error_agent_name').text(error_agent_name);
        $('#error_agent_name').css('border-color', '#cc0000');
        agent_id = '';
        agent_name = '';
    } else {
        error_agent_name = '';
        $('#error_agent_name').text(error_agent_name);
        $('#agent_name').css('border-color', '');
        agent_id = $('#agent_name').val();
        agent_name = $('#agent_name option:selected').text();
    }
    if ($('#site_name').val() == '') {
        error_site_name = 'Nom de l\'agent requis';
        $('#error_site_name').text(error_site_name);
        $('#error_site_name').css('border-color', '#cc0000');
        site_id = '';
        site_name = '';
    } else {
        error_site_name = '';
        $('#error_site_name').text(error_site_name);
        $('#error_site_name').css('border-color', '');
        site_id = $('#site_name').val();
        site_name = $('#site_name option:selected').text();
    }
    if ($('#date_debut').val() == '') {
        error_date_debut = 'Nom de l\'agent requis';
        $('#error_date_debut').text(error_date_debut);
        $('#error_date_debut').css('border-color', '#cc0000');
        date_debut = '';
    } else {
        error_date_debut = '';
        $('#error_date_debut').text(error_date_debut);
        $('#error_date_debut').css('border-color', '');
        date_debut = $('#date_debut').val();
    }
    if ($('#heure_debut').val() == '') {
        error_heure_debut = 'Nom de l\'agent requis';
        $('#error_heure_debut').text(error_heure_debut);
        $('#error_heure_debut').css('border-color', '#cc0000');
        heure_debut = '';
    } else {
        error_heure_debut = '';
        $('#error_heure_debut').text(error_heure_debut);
        $('#error_heure_debut').css('border-color', '');
        heure_debut = $('#heure_debut').val();
    }
    if ($('#heure_fin').val() == '') {
        error_heure_fin = 'Nom de l\'agent requis';
        $('#error_heure_fin').text(error_heure_fin);
        $('#error_heure_fin').css('border-color', '#cc0000');
        heure_fin = '';
    } else {
        error_heure_fin = '';
        $('#error_heure_fin').text(error_heure_fin);
        $('#error_heure_fin').css('border-color', '');
        heure_fin = $('#heure_fin').val();
    }
    if ($('#heure_pause').val() == '') {
        error_heure_pause = 'Nom de l\'agent requis';
        $('#error_heure_pause').text(error_heure_pause);
        $('#error_heure_pause').css('border-color', '#cc0000');
        heure_pause = '';
    } else {
        error_heure_fin = '';
        $('#error_heure_pause').text(error_heure_pause);
        $('#error_heure_pause').css('border-color', '');
        heure_pause = $('#heure_pause').val();
    }
    if (error_agent_name != '' || error_site_name != '' || error_date_debut != '' || error_heure_debut != '' || error_heure_fin != '' || error_heure_pause != '') {
        return false;
    } else {

        var site_id = $('#site_name').val();
        var date_debut = $('#date_debut').val();
        var heure_debut = $('#heure_debut').val();
        var heure_fin = $('#heure_fin').val();
        var heure_pause = $('#heure_pause').val();

        var agent_id = $('.modifier').data('agent_id');
        $.ajax({
            url: $("#route").data('route'),
            type: 'GET',
            data: {
                id: id,
                agent_id,
                site_id,
                date_debut,
                heure_debut,
                heure_fin,
                heure_pause,
                type: 'modifier'
            },
            dataType: 'json',
            beforeSend: function() {
                $("div.close").show()
            },
            success: function(data) {
                $('#div_table_planning').html(data.table_provisoire)
                $("div.close").hide()
            },
            error: function(xhr) {
                $.each(xhr.responseJSON, function(key, value) {
                    $('div.form-group.' + key).addClass('has-error');
                    $('div.form-group.' + key).append('<label class="control-label text-danger" for="inputError"><i class="fa fa-times-circle-o"></i>' + value + '</label>');
                    $("div.close").hide()
                });
            }
        });

        $('#user_dialog').dialog('close');
    }
});