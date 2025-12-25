<?php

namespace App\Listeners;

use App\Events\CommentReceived;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;
class NotifyAdminOfNewComment
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(CommentReceived $event): void
    {
        Log::info("Новый комментарий ожидает модерации. ID: " . $event->comment->id);
    }
}
