<?php

namespace App\Events;

use App\Models\BlogPost;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;

class BlogPostCreatedEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $blogPost;

    public function __construct(BlogPost $blogPost)
    {

        $this->blogPost = $blogPost;
    }
}
