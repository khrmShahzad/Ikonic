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

  console.log(section_id);
  console.log(response);


    var newHtml = '';
    $('#'+section_id).html('');

    if (section_id == 'tbl_suggestion'){

      for (let i = 0; i< response['data'].length; i++){
          id = response['data'][i]['id'];
          name = response['data'][i]['name'];
          email = response['data'][i]['email'];
          newHtml += '<div class="d-flex justify-content-between">' +
              '<table class="ms-1" id="tbl_suggestion">' +
              '<td class="align-middle">'+name+'</td>' +
              '<td class="align-middle"> - </td>' +
              '<td class="align-middle">'+email+'</td>' +
              '<td class="align-middle"></td>' +
              '</table>' +
              '<div><button id="create_request_btn_" class="btn btn-primary me-1" onclick="sendRequest('+id+')">Connect</button></div>' +
              '</div>';
      }

      $('#SuggestionsCounter').text(response['total'])
    }

    if (section_id == 'tbl_requests'){

        console.log(response)
        for (let i = 0; i< response['requests']['data'].length; i++){
            id = response['requests']['data'][i]['id'];
            name = response['requests']['data'][i]['recipient']['name'];
            email = response['requests']['data'][i]['recipient']['email'];

            if (response['mode'] == 'sent'){
                btnHtml = '<button id="cancel_request_btn_" class="btn btn-danger me-1" onclick="deleteRequest('+id+')">Withdraw Request</button>';

                $('#RequestsCounter').text(response['requests']['total'])
            }else{
                btnHtml = '<button id="accept_request_btn_" class="btn btn-primary me-1" onclick="acceptRequest('+id+')">Accept</button>' ;

                $('#ReceivedCounter').text(response['requests']['total'])
            }

            newHtml += '<div class="d-flex justify-content-between">' +
                        '<table class="ms-1">' +
                        '<td class="align-middle">'+name+'</td>' +
                        '<td class="align-middle"> - </td>' +
                        '<td class="align-middle">'+email+'</td>' +
                        '<td class="align-middle">' +
                        '</table>' +
                        '<div> '+btnHtml+' ' +
                        '</div>' +
                        '</div>';
        }
    }

    if (section_id == 'tbl_connection'){

        console.log(response)
        for (let i = 0; i< response['data'].length; i++){
            id = response['data'][i]['id'];
            name = response['data'][i]['recipient']['name'];
            email = response['data'][i]['recipient']['email'];

            btnHtml = '<button style="width: 220px" id="get_connections_in_common_" class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#collapse_" aria-expanded="false" aria-controls="collapseExample"> Connections in common () </button>' +
                      '<button id="create_request_btn_" class="btn btn-danger me-1" onclick="removeConnection('+id+')">Remove Connection</button>';

            newHtml += '<div class="d-flex justify-content-between">\n' +
                        '<table class="ms-1">' +
                        '<td class="align-middle">'+name+'</td>' +
                        '<td class="align-middle"> - </td>' +
                        '<td class="align-middle">'+email+'</td>' +
                        '<td class="align-middle">' +
                        '</table>' +
                        '<div> '+btnHtml+' ' +
                        '</div>' +
                        '</div>';
        }

        $('#ConnectionsCounter').text(response['total'])
    }


    $('#'+section_id).html(newHtml);
}
