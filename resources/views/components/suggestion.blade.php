<div class="my-2 shadow  text-white bg-dark p-1" id="">
  <div class="d-flex justify-content-between">

    <table class="ms-1">
      <td class="align-middle">{{$attributes['name']}}</td>
      <td class="align-middle"> - </td>
      <td class="align-middle">{{$attributes['email']}}</td>
        <td class="align-middle"></td>
    </table>
    <div>
      <button id="create_request_btn_" class="btn btn-primary me-1" onclick="sendRequest({{$attributes['id']}})">Connect</button>
    </div>
  </div>
</div>
