<?php

namespace App\View\Components;

use App\Models\FriendRequest;
use App\Models\User;
use Illuminate\View\Component;

class Sent extends Component
{
    public $sent;
    public function __construct($sent = false)
    {
        $sentRequests = FriendRequest::with(['sender', 'recipient'])
            ->where('sender_id', auth()->id())
            ->where('accepted', 0)
            ->paginate(10);

        $this->sent = $sentRequests;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        //return view('components.suggestion');

        return view('components.request', [
            'sent' => $this->sent->render(),
        ]);
    }
}
