  //Affichae des champ des informations administrative
  var nationalite = $("select[name='nationalite'] :selected")

  $("select[name='nationalite']").change(function() {
      var SelectedValue = $("option:selected", this).val();
      displayElement(SelectedValue)
  })

  displayElement("" + $("select[name='nationalite']").val())

  function displayElement(SelectedValue = 'FR') {
      if (SelectedValue == 'FR') {
          //Show
          $("#div_carteidentite").show(500)
          $("#div_numerocarteidentite").show(500)
              //Hide
          $("#div_numeroetranger").hide(500)
          $("#div_lieudelivrancecs").hide(500)
          $("#div_etablissementcartedesejour").hide(500)
          $("#div_cartedesejour").hide(500)
          $("#div_expirationcartedesejour").hide(500)
      } else {
          //Show
          $("#div_numeroetranger").show(500)
          $("#div_lieudelivrancecs").show(500)
          $("#div_etablissementcartedesejour").show(500)
          $("#div_cartedesejour").show(500)
          $("#div_expirationcartedesejour").show(500)
              //Hide
          $("#div_carteidentite").hide(500)
          $("#div_numerocarteidentite").hide(500)
      }
  }

  //Affichage des champ de la qualification
  var ads = $("input[name='ads']")
  var maitrechien = $("input[name='maitrechien']")

  ads.change(function() {
      if ($(this).is(':checked')) {
          $("#div_numeroads").show(500)
      } else {
          $("#div_numeroads").hide(500)
      }
  })

  maitrechien.change(function() {
      if ($(this).is(':checked')) {
          $("#div_nomchien").show(500)
          $("#div_datevaliditevaccin").show(500)
      } else {
          $("#div_nomchien").hide(500)
          $("#div_datevaliditevaccin").hide(500)
      }
  })

  //Affichae des champ des informations administrative
//   var nationalite = $("select[name='typecontrat'] :selected")
  var div_dureeducontrat = $("#div_dureeducontrat")

  $("select[name='typecontrat']").change(function() {
          var SelectedValue = $("option:selected", this).val();
          displayDureeElement(SelectedValue)
      })
      // alert($("select[name='typecontrat']").val())
  displayDureeElement("" + $("select[name='typecontrat']").val())

  function displayDureeElement(SelectedValue = 'cdi') {
      if (SelectedValue === 'cdi' || SelectedValue === '') {
          //Hide
          div_dureeducontrat.hide(500)
      } else {
          //Show
          div_dureeducontrat.show(500)
      }
  }