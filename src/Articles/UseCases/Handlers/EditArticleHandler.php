<?php namespace Lio\Articles\UseCases\Handlers;

use Lio\Articles\ArticleRepository;
use Lio\Articles\UseCases\Responses\EditArticleResponse;
use Lio\CommandBus\Handler;

class EditArticleHandler implements Handler
{
    private $articleRepository;

    public function __construct(ArticleRepository $articleRepository)
    {
        $this->articleRepository = $articleRepository;
    }

    public function handle($command)
    {
        $article = $this->articleRepository->requireById($command->articleId);
        $article->edit($command->title, $command->content, $command->laravelVersion, $command->tagIds);
        $this->articleRepository->save($article);
        return new EditArticleResponse($article);
    }
}
