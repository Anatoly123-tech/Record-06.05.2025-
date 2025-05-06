<?php

namespace App\Console\Commands;

use App\Models\Post;
use App\Models\Comment;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class PostCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:posts';


    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Lorem ipsum';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        Post::truncate();
        Comment::truncate();

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $posts = Http::get('https://jsonplaceholder.typicode.com/posts')->json();
        $postCount = 0;

        foreach ($posts as $post) {
            Post::create([
                'title' => $post['title'],
                'body' => $post['body'],
            ]);
            $postCount++;
        }
        $comments = Http::get('https://jsonplaceholder.typicode.com/comments')->json();
        $commentsCount = 0;

        foreach ($comments as $comment) {
            Comment::create([
                'post_id' => $comment['postId'],
                'name' => $comment['name'],
                'email' => $comment['email'],
                'body' => $comment['body'],
            ]);
            $commentsCount++;
        }
        $this->info("$postCount записей, $commentsCount комментариев");

        return 0;
    }
}
