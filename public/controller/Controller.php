<?php
include_once "dao/DAO.php";

class Controller {

    private DAO $dao;

    public function __construct(DAO $dao) {
        $this->dao = $dao;
    }

    public function store(array $data): void {
        $book = [
            'id'     => (int) $data['id'],
            'title'  => $data['title'],
            'author' => $data['author'],
            'year'   => (int) $data['year']
        ];

        $this->dao->create($book);
    }

    public function delete(int $id): void {
        $this->dao->delete($id);
    }
}

if(isset($_POST["insert"])) {

    $book->setTitle($d["title"]);
    $book->setAuthor($d["author"]);
    $book->setYear($d["year"]);

    $dao->create($book);

} else if (isset($_POST["edit"])) {

    $book->setTitle($d["title"]);
    $book->setAuthor($d["author"]);
    $book->setYear($d["year"]);

    $dao->update($book);

} else if (isset($_GET["delete"])) {

    $book->setID($d["del"]);

    $dao->delete($book);
}

?>