<div class="my-2 shadow text-white bg-dark p-1" id="">
  <div class="d-flex justify-content-between">
    <table class="ms-1">
      <td class="align-middle">{{$attributes['name']}}</td>
      <td class="align-middle"> - </td>
      <td class="align-middle">{{$attributes['email']}}</td>
      <td class="align-middle">
    </table>
    <div>
      @if ($attributes['mode'] == 'sent')
        <button id="cancel_request_btn_" class="btn btn-danger me-1"
            onclick="deleteRequest({{$attributes['id']}})">Withdraw Request</button>
      @else
        <button id="accept_request_btn_" class="btn btn-primary me-1"
          onclick="acceptRequest({{$attributes['id']}})">Accept</button>
      @endif
    </div>
  </div>
</div>
