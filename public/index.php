<?php

class Article
{
    public $id;
    public $title;
    protected $content;
    private $author;

    public static $maxLife;

    const TYPE_BLOG = 'blog';
    const TYPE_NEWS = 'news';

    public static $types = [
        self::TYPE_BLOG,
        self::TYPE_NEWS
    ];

    public static function addType(string $type)
    {
        self::$types[] = $type;
    }

    public function display()
    {
        $this->displayTitle();
        $this->displayContent();
    }

    protected function displayTitle()
    {
        echo "<h1>" . $this->title . "</h1>";
    }

    private function displayContent()
    {
        echo "<p>" . $this->content . "</p>";
    }

    public static function getMaxLife()
    {
        return self::$maxLife;
    }

    public function __construct($id, $title, $content, $author)
    {
        $this->id = $id;
        $this->title = $title;
        $this->content = $content;
        $this->author = $author;
    }

    public function getContent()
    {
        return $this->content;
    }

    public function setContent($content)
    {
        $this->content = $content;
    }
}

class News extends Article {
    public $date;

    public function __construct($id, $title, $content, $author, $date)
    {
        parent::__construct($id, $title, $content, $author);
        $this->date = $date;
    }

    public function display()
    {
        parent::display();
        $this->displayDate();
    }

    public function displayDate()
    {
        echo "<p>{$this->date}</p>";
    }
}

$article = new Article(1, 'article 1', 'l;k;lk;l;lk', 'Vasya Pupkin');
$article->display();

$article2 = new News(2, 'article 2', '222222222222', 'Petya Vasechkin', date('Y-m-d'));
$article2->display();