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
    protected $addTags;
    protected $articleId;
    protected $idTags;

    function __construct (array  $tags)
    {
        $this->tags = $tags;
        $this->newTags = array();
        $this->oldTags = array();
        $this->allArticleTags = array();
        $this->removedTags = array();
        $this->addTags = array();
        $this->idTags = array();
    }

    public function insert()
    {

        if(!empty($this->newTags)) {
            foreach ($this->newTags as $tag) {
                $this->idTags[] = Tag::insertGetId($tag);
            }
            
        }

    }

    public function separate()
    {
        foreach ( $this->tags as $tag) {

            if(!is_numeric($tag))
                $this->newTags[] = array('name' => $tag);
            else
                $this->oldTags[] = array('tag_id' => $tag);
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

    public static function removeAllTagsArticle($articleId)
    {
         return DB::table('article_tag')
                ->where('article_id','=', $articleId)
                ->delete();
    }

    public function insertArticleTag()
    {
        $addArticleTag = array();
        
        foreach ($this->addTags as $tag) {
            $addArticleTag[] = array(
                'article_id' => $this->articleId,
                'tag_id' => $tag['tag_id']
            );
        }
        
        // var_dump($this->idTags);
        foreach ($this->idTags as $tag) {
             $addArticleTag[] = array(
                'article_id' => $this->articleId,
                'tag_id' => $tag
            );
        }
        return DB::table('article_tag')->insert($addArticleTag);
    }

    

    public function setAddRemoved()
    {
        $comparaTags = function ($a,$b)
        {
            return ($a['tag_id'] - $b['tag_id']);
        };

        $tempTags = array();

        foreach ($this->allArticleTags as $art)
            $tempTags[] = array('tag_id' => $art->tag_id);
        // var_dump($tempTags);
        $this->removedTags = array_udiff($tempTags, $this->oldTags, $comparaTags);

        $this->addTags = array_udiff($this->oldTags, $tempTags, $comparaTags);
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
    public function setAddTags()
    {
        $this->addTags = $this->oldTags;
    } 
    /**
     * @return array
     */
    public function getAddTags()
    {
        return $this->addTags;
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

    /**
     * @return array
     */
    public function getIdTags()
    {
        return $this->idTags;
    }
}
