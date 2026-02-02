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

    public function update(array $data) {
    $this->dao->update(
        $data['id'],
        $data['title'],
        $data['author'],
        $data['year']
    );
}

}

?>