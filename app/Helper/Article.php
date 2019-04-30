<?php

namespace App\Helper;

use Illuminate\Support\Facades\Redis;

class Article
{
    const ONE_WEEK_IN_SECONDS = 7 * 86400;
    const VOTE_SCORE = 432;

    public static function postArticle($user, $title, $link)
    {
        // 生成新的articleId
        $articleId = Redis::incr('article:');

        $voted = 'voted:' . $articleId;
        Redis::sadd($voted, $user);
        Redis::expire($voted, self::ONE_WEEK_IN_SECONDS);
        $article = 'article:' . $articleId;
        Redis::hmset($article, [
            'title' => $title,
            'link' => $link,
            'poster' => $user,
            'time' => time(),
            'votes' => 1
        ]);
        Redis::zadd('score:', time() + self::VOTE_SCORE, $article);
        Redis::zadd('time:', time(), $article);
        return $articleId;
    }
}