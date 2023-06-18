<?php

namespace App\View\Components;

use App\Models\FriendRequest;
use App\Models\User;
use Illuminate\View\Component;

class Received extends Component
{
    /**
     * The button text.
     *
     * @var string
     */
    public $received;

    /**
     * Create a new component instance.
     *
     * @param  string  $text
     * @return void
     */
    public function __construct($suggestions = false)
    {

        $receivedRequests = FriendRequest::with(['sender', 'recipient'])
            ->where('recipient_id', auth()->id())
            ->where('accepted', 0)
            ->paginate(10);

        $this->received = $receivedRequests;

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
            'received' => $this->received->render(),
        ]);
    }
}
