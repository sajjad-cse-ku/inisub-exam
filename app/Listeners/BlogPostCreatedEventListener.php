<?php

namespace App\Listeners;

use App\MailSendStatus;
use App\Models\SubscribedUser;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Events\BlogPostCreatedEvent;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class BlogPostCreatedEventListener implements ShouldQueue
{
    use InteractsWithQueue, Queueable;
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
    public function handle(BlogPostCreatedEvent $event): void
    {
        $blogPost = $event->blogPost;
        $subscribers = SubscribedUser::all();
        foreach ($subscribers as $subscriber) {
            DB::table('email_sending_statuses')->insert([
                'subscriber_id' => $subscriber->id,
                'blog_post_id' => $blogPost->id,
                'status' => MailSendStatus::DRAFT->value
            ]);
        }
        Artisan::call('mail:send-blog-post-emails', [
            'blog_post_id' => $blogPost->id
        ]);
    }
}
