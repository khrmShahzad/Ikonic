<?php

namespace App\View\Components;

use App\Models\FriendRequest;
use App\Models\User;
use Illuminate\View\Component;
use DB;

class Connections extends Component
{
    /**
     * The button text.
     *
     * @var string
     */
    public $connections;

    /**
     * Create a new component instance.
     *
     * @param  string  $text
     * @return void
     */
    public function __construct($connections = false)
    {

        $connections = FriendRequest::where('accepted', 1)
            ->where(function ($query) {
                $query->where('sender_id', auth()->user()->id)
                    ->orWhere('recipient_id', auth()->user()->id);
            })
            ->with(['sender', 'recipient'])
            ->paginate(10); // Specify the number of items per page

        // Retrieve common connections with each user
        foreach ($connections as $connection) {

            $connection['common_connections'] = DB::table('friend_requests')
                ->where('sender_id', auth()->id())
                ->where('recipient_id', $connection->id)
                ->orWhere(function ($query) use ($connection) {
                    $query->where('sender_id', $connection->id)
                        ->where('recipient_id', auth()->id());
                })
                ->where('accepted', 1)
                ->join('users', 'users.id', '=', 'friend_requests.sender_id')
                ->select('users.name','users.email')
                ->get();
        }

        $this->connections = $connections;

    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        //return view('components.suggestion');

        return view('components.connections', [
            'connections' => $this->connections->render(),
        ]);
    }
}
