<?php

namespace App\View\Components;

use App\Models\FriendRequest;
use App\Models\User;
use Illuminate\View\Component;

class Suggestion extends Component
{
    public $suggestions;

    public function __construct($suggestions = false)
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
            ->paginate(10);

        $this->suggestions = $nonConnectedUsers;

    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.suggestion', [
            'suggestions' => $this->suggestions->render(),
        ]);

        //return view('components.suggestion');

    }
}
