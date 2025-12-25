<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Article;
use Illuminate\Support\Facades\Log;

class PublishScheduledArticles extends Command
{
    protected $signature = 'app:publish-articles';
    protected $description = 'Публикация статей, время которых наступило';

    public function handle()
    {
        $articles = Article::where('is_published', false)
            ->whereNotNull('published_at')
            ->where('published_at', '<=', now())
            ->get();

        $count = 0;
        foreach ($articles as $article) {
            $article->update(['is_published' => true]);
            $count++;
        }

        if ($count > 0) {
            $this->info("Опубликовано статей: $count");
            Log::info("Scheduler published $count articles.");
        } else {
            $this->info("Нет статей для публикации.");
        }
    }
}