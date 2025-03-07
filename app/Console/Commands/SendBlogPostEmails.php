<?php

namespace App\Console\Commands;

use App\MailSendStatus;
use App\Mail\BlogPostMail;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class SendBlogPostEmails extends Command
{
    protected $signature = 'mail:send-blog-post-emails {blog_post_id}';
    protected $description = 'Send emails to all subscribed users for a blog post';

    public function handle()
    {
        $blogPostId = $this->argument('blog_post_id');

        $statuses = DB::table('email_sending_statuses')
            ->select('subscriber_id', 'id')
            ->where('blog_post_id', $blogPostId)
            ->where('status', MailSendStatus::DRAFT->value)
            ->distinct()
            ->get();
        // Log::info($statuses);

        $blogPost = DB::table('blog_posts')->find($blogPostId);
        if (!$blogPost) {
            $this->error("Blog post not found.");
            return;
        }

        foreach ($statuses as $status) {
            $subscriber = DB::table('subscribed_users')->find($status->subscriber_id);
            if ($subscriber) {
                Mail::to($subscriber->email)->queue(new BlogPostMail($blogPost));

                DB::table('email_sending_statuses')
                    ->where('id', $status->id)
                    ->update(['status' => MailSendStatus::SENT->value]);
            }
        }

        $this->info('Emails queued successfully for Blog Post ID: ' . $blogPostId);
    }
}
