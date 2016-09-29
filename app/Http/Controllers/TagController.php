<?php

namespace App\Http\Controllers;

use App\Article;
use App\Tag;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\DB;

class TagController extends Controller
{
    protected $tags;
    protected $newTags;
    protected $oldTags;
    protected $allArticleTags;
    protected $removedTags;
    protected $articleId;

    function __construct (array  $tags)
    {
        $this->tags = $tags;
        $this->newTags = array();
        $this->oldTags = array();
        $this->allArticleTags = array();
        $this->removedTags = array();
    }

    public function cadastro()
    {
        $this->separa();

        if(!empty($this->newTags)) {
            $ids = Tag::insertGetId($this->newTags);
        }

    }

    public function separa()
    {
        foreach ( $this->tags as $tag) {

            if(!is_numeric($tag))
                array_add($this->newTags, 'name', $tag);
            else
                array_add($this->oldTags, 'tag_id', $tag);
        }
    }

    public function  remove() {

        if(!empty($this->removedTags)) {

            $result = DB::table('article_tag')
                ->where('article_id','=', $this->articleId)
                ->whereIn('tag_id', array_values($this->removedTags))
                ->delete();

        } else {
            $result = false;
        }

        return $result;
    }

    public function setRemovedTags()
    {
        $tempTags = array();

        foreach ($this->allArticleTags as $art)
            array_add($tempTags, 'tag_id', $art->tag_id);

        $this->removedTags = array_diff($tempTags, $this->oldTags);
    }

    /**
     * @return array
     */
    public function getRemovedTags()
    {
        return $this->removedTags;
    }

    public function setAllArticleTags()
    {
        $this->allArticleTags = DB::table('article_tag')
            ->where('article_id','=', $this->articleId)->get();

    }

    /**
     * @return array
     */
    public function getAllArticleTags()
    {
        return $this->allArticleTags;
    }
    /**
     * @param array $tags
     */
    public function setTags($tags)
    {
        $this->tags = $tags;
    }

    /**
     * @return array
     */
    public function getTags()
    {
        return $this->tags;
    }

    /**
     * @return array
     */
    public function getNewTags()
    {
        return $this->newTags;
    }

    /**
     * @return array
     */
    public function getOldTags()
    {
        return $this->oldTags;
    }

    /**
     * @param mixed $articleId
     */
    public function setArticleId($articleId)
    {
        $this->articleId = $articleId;
    }

    /**
     * @return mixed
     */
    public function getArticleId()
    {
        return $this->articleId;
    }
}
