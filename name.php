<?php
class WordPaginator {
    private $words;


    public function __construct($name) {
        $this->words = explode(" ", $name);
    }


    public function getWord($page) {
        if ($page < 1) $page = 1;
        if ($page > count($this->words)) $page = count($this->words);

        return $this->words[$page - 1];
    }


    public function getTotalPages() {
        return count($this->words);
    }
}


$name = "sam jebas jeswin";
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;

$paginator = new WordPaginator($name);
echo $paginator->getWord($page);
?>