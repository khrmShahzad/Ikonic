<?php

namespace App\Http\Controllers;

use App\Models\FriendRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $currentUser = auth()->user();

        $connectedUserIds = FriendRequest::where('sender_id', $currentUser->id)
            ->orWhere('recipient_id', $currentUser->id)
            ->pluck('sender_id')
            ->concat(FriendRequest::where('sender_id', $currentUser->id)
                ->orWhere('recipient_id', $currentUser->id)
                ->pluck('recipient_id'))
            ->unique();

        $nonConnectedUserIds = User::whereNotIn('id', $connectedUserIds->push($currentUser->id))
            ->pluck('id');

        $nonConnectedUsers = User::whereIn('id', $nonConnectedUserIds)
            ->paginate(10); // Specify the number of items per page


        return json_encode($nonConnectedUsers);
    }

    public function getConnections()
    {
        $connections = FriendRequest::where('accepted', 1)
            ->where(function ($query) {
                $query->where('sender_id', auth()->user()->id)
                    ->orWhere('recipient_id', auth()->user()->id);
            })
        ->with(['sender', 'recipient'])
        ->paginate(10); // Specify the number of items per page

        return json_encode($connections);
    }

    public function getSentRequests()
    {
        $sentRequests = FriendRequest::with(['sender', 'recipient'])
            ->where('sender_id', auth()->id())
            ->where('accepted', 0)
            ->paginate(10);

        return json_encode(['requests' => $sentRequests , 'mode' => 'sent']);
    }

    public function getReceivedRequests()
    {
        $receivedRequests = FriendRequest::with(['sender', 'recipient'])
            ->where('recipient_id', auth()->id())
            ->where('accepted', 0)
            ->paginate(10);

        return json_encode(['requests' => $receivedRequests , 'mode' => 'received']);
    }

    public function deleteRequest(Request $request)
    {

        FriendRequest::find($request['requestId'])->delete();

        $sentRequests = FriendRequest::with(['sender', 'recipient'])
            ->where('sender_id', auth()->id())
            ->paginate(10);

        return json_encode($sentRequests);
    }

    public function removeConnection(Request $request)
    {

        FriendRequest::find($request['connectionId'])->delete();

        $connections = FriendRequest::where('accepted', 1)
            ->where(function ($query) {
                $query->where('sender_id', auth()->user()->id)
                    ->orWhere('recipient_id', auth()->user()->id);
            })
            ->with(['sender', 'recipient'])
            ->paginate(10); // Specify the number of items per page

        return json_encode($connections);
    }

    public function acceptRequest(Request $request)
    {
        $requestData = FriendRequest::find($request['requestId'])->get();
        $requestData->accpted = 1;
        $requestData->save();

        $sentRequests = FriendRequest::with(['sender', 'recipient'])
            ->where('sender_id', auth()->id())
            ->paginate(10);

        return json_encode($sentRequests);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        FriendRequest::create([
            'sender_id' => Auth::user()->id,
            'recipient_id' => $request['suggestionId'],
            'accepted' => 0
        ]);

        $nonConnectedUsers = $this->index();
        return json_encode($nonConnectedUsers);
//        return true;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
