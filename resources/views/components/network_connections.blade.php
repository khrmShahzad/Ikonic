<div class="row justify-content-center mt-5">
  <div class="col-12">
    <div class="card shadow  text-white bg-dark">
      <div class="card-header">Coding Challenge - Network connections</div>
      <div class="card-body">
        <div class="btn-group w-100 mb-3" role="group" aria-label="Basic radio toggle button group">
          <input type="radio" class="btn-check" name="btnradio" id="btnradio1" autocomplete="off" checked>
          <label class="btn btn-outline-primary" for="btnradio1" id="get_suggestions_btn" onclick="getSuggestions()">Suggestions ({{$suggestions->suggestions->total()}})</label>

          <input type="radio" class="btn-check" name="btnradio" id="btnradio2" autocomplete="off">
          <label class="btn btn-outline-primary" for="btnradio2" id="get_sent_requests_btn" onclick="getRequests()">Sent Requests ({{$sent->sent->total()}})</label>

          <input type="radio" class="btn-check" name="btnradio" id="btnradio3" autocomplete="off">
          <label class="btn btn-outline-primary" for="btnradio3" id="get_received_requests_btn" onclick="getReceived()">Received Requests({{$received->received->total()}})</label>

          <input type="radio" class="btn-check" name="btnradio" id="btnradio4" autocomplete="off">
          <label class="btn btn-outline-primary" for="btnradio4" id="get_connections_btn" onclick="getConnections()">Connections ({{$connections->connections->total()}})</label>
        </div>
        <hr>
        <div id="content" {{--class="d-none"--}}>
          {{-- Display data here --}}

            <div id="skeleton" >
                <x-skeleton />
            </div>

            <div id="sent_section">
                <span class="fw-bold">Sent Request Blade</span>
                @foreach($sent->sent as $sen)
                    <x-request :mode="'sent'" :name="$sen['recipient']['name']" :email="$sen['recipient']['email']" :id="$sen['id']"/>
                @endforeach
            </div>

            <div id="received_section">
                <span class="fw-bold">Received Request Blade</span>
{{--                @dd($received->received)--}}
                @foreach($received->received as $rec)
                    <x-request :mode="'received'" :name="$rec['sender']['name']" :email="$rec['sender']['email']" :id="$rec['id']"/>
                @endforeach
            </div>

            <div id="suggestion_section">
                <span class="fw-bold">Suggestion Blade</span>
                @foreach($suggestions->suggestions as $suggestion)
                    <x-suggestion :name="$suggestion['name']" :email="$suggestion['email']" :id="$suggestion['id']"/>
                @endforeach
            </div>

            <div id="connection_section">
                <span class="fw-bold">Connection Blade (Click on "Connections in common" to see the connections in common component)</span>
{{--                @dd($connections->connections)--}}

                @foreach($connections->connections as $connection)
                    @if($connection['sender']['id'] != auth()->id())
                        <x-connection :name="$connection['sender']['name']" :email="$connection['sender']['email']" :total="count($connection->common_connections)" :id="$connection['id']" :common="$connection->common_connections"/>
                    @elseif($connection['recipient']['id'] != auth()->id())
                        <x-connection :name="$connection['recipient']['name']" :email="$connection['recipient']['email']" :total="count($connection->common_connections)" :id="$connection['id']" :common="$connection->common_connections"/>
                    @endif
                @endforeach

            </div>

        </div>

{{--        <span class="fw-bold">"Load more"-Button</span>--}}
        <div class="d-flex justify-content-center mt-2 py-3  d-none " id="load_more_btn_parent">
          <button class="btn btn-primary" onclick="" id="load_more_btn">Load more</button>
        </div>
      </div>
    </div>
  </div>
</div>

{{-- Remove this when you start working, just to show you the different components --}}

<div id="connections_in_common_skeleton" class=" d-none ">
  <br>
  <span class="fw-bold text-white">Loading Skeletons</span>
  <div class="px-2">
    @for ($i = 0; $i < 10; $i++)
      <x-skeleton />
    @endfor
  </div>
</div>
