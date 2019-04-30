<?php

namespace App\Helper;

use Carbon\Carbon;
use Illuminate\Support\Facades\Redis;

class Article
{
    const ONE_WEEK_IN_SECONDS = 7 * 86400;
    const VOTE_SCORE = 432;
    const ARTICLES_PER_PAGE = 25;

    public static function postArticle($user, $title, $link)
    {
        // 生成新的articleId
        $articleId = Redis::incr('article:');

        $voted = 'voted:' . $articleId;
        Redis::sadd($voted, $user); // 发布用户默认点赞
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

    public static function getArticles($page, $order = 'score:')
    {
        $start = ($page - 1) * self::ARTICLES_PER_PAGE;
        $end = $start + self::ARTICLES_PER_PAGE - 1;

        $ids = Redis::zrevrange($order, $start, $end); // 获取多个文章
        $articles = [];
        foreach ($ids as $id) {
            $article_data = Redis::hgetall($id);
            $article_data['id'] = $id;
            array_push($articles, $article_data);
        }

        return $articles;
    }

}