<?php

namespace App\Console\Commands;

use App\Models\Tenant;
use App\MailSendStatus;
use App\Mail\BlogPostMail;
use App\Models\SubscribedUser;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class SendSubscriberEmails extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mail:send-subscriber-emails';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send blog post emails to subscribers';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        Tenant::chunk(50, function ($websites) {
            foreach ($websites as $website) {
                tenancy()->initialize($website->id);
                SubscribedUser::chunk(10, function ($subscribers) use ($website) {
                    foreach ($subscribers as $subscriber) {
                        $statuses = DB::table('email_sending_statuses')
                            ->where('subscriber_id', $subscriber->id)
                            ->where('status', MailSendStatus::DRAFT->value)
                            ->get();
                        foreach ($statuses as $status) {
                            $blogPost = DB::table('blog_posts')->find($status->blog_post_id);
                            if ($blogPost) {
                                Mail::to($subscriber->email)
                                    ->queue(new BlogPostMail($blogPost));
                                DB::table('email_sending_statuses')
                                    ->where('id', $status->id)
                                    ->update(['status' => MailSendStatus::SENT->value]);
                            }
                        }
                    }
                });

                tenancy()->end();
            }
        });

        $this->info('Emails for sending successfully.');
    }
}
