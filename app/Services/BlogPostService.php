<?php

namespace App\Services;

use App\Models\BlogPost;
use App\Events\BlogPostCreated;
use App\Events\BlogPostCreatedEvent;

class BlogPostService
{
    public function store($request)
    {
        try {
            $blogPost = BlogPost::create([
                'title' => $request->title,
                'description' => $request->description
            ]);
            event(new BlogPostCreatedEvent($blogPost));
            return response()->json([
                'message' => 'Blog post created successfully',
                'status' => 201
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'An error occurred while creating blog post',
                'error' => $e->getMessage(),
                'status' => 500
            ], 500);
        }
    }
}
