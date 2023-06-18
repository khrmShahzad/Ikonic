function ajaxForm(formItems) {
  var form = new FormData();
  formItems.forEach(formItem => {
    form.append(formItem[0], formItem[1]);
  });
  return form;
}



/**
 *
 * @param {*} url route
 * @param {*} method POST or GET
 * @param {*} functionsOnSuccess Array of functions that should be called after ajax
 * @param {*} form for POST request
 */
function ajax(url, method, functionsOnSuccess, form) {
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  })

  if (typeof form === 'undefined') {
    form = new FormData;
  }

  if (typeof functionsOnSuccess === 'undefined') {
    functionsOnSuccess = [];
  }

    $("#skeleton").show();

  $.ajax({
    url: url,
    type: method,
    async: true,
    data: form,
    processData: false,
    contentType: false,
    dataType: 'json',
    error: function(xhr, textStatus, error) {
      console.log(xhr.responseText);
      console.log(xhr.statusText);
      console.log(textStatus);
      console.log(error);
    },
    success: function(response) {
         //console.log(functionsOnSuccess)
      /*for (var j = 0; j < functionsOnSuccess.length; j++) {
        for (var i = 0; i < functionsOnSuccess[j][1].length; i++) {
          if (functionsOnSuccess[j][1][i] == "response") {
            functionsOnSuccess[j][1][i] = response;
          }
        }
          console.log(functionsOnSuccess[j][1])
        functionsOnSuccess[j][0].apply(this, functionsOnSuccess[j][1]);
      }*/

        exampleOnSuccessFunction(functionsOnSuccess[0][1] , response)
    }
  });
}

function exampleUseOfAjaxFunction(exampleVariable) {
  // show skeletons
  // hide content

  var form = ajaxForm([
    ['exampleVariable', exampleVariable],
  ]);

  var functionsOnSuccess = [
    [exampleOnSuccessFunction, [exampleVariable, 'response']]
  ];

  // POST
  ajax('/example_route', 'POST', functionsOnSuccess, form);

  // GET
  ajax('/example_route/' + exampleVariable, 'POST', functionsOnSuccess);
}

function exampleOnSuccessFunction(section_id , response) {
  // hide skeletons
  // show content

  /*console.log(section_id);
  console.log(response);*/

  if(section_id == 'x-suggestion'){
      $('x-suggestion').replaceWith(response['suggestions']);
  }else if(section_id == 'x-request'){
      $(section_id).replaceWith(response['request']);
  }else if(section_id == 'x-connection'){
      $(section_id).replaceWith(response['connection']);
  }

  $("#skeleton").hide();
}
