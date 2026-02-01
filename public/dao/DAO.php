<?php

class DAO {

    private string $bookDB = "books.json";

    public function read(){
        if(!file_exists($this->bookDB)) {
            return [];
        }

        $contents = file_get_contents($this->bookDB);
        return json_decode($contents, true) ?? [];
    }

    private function saveJson(array $books): void {
        file_put_contents(
        $this->bookDB,
        json_encode($books, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE)
        );
    }

    public function create(array $book): void {
        $books = $this->read();
        $books[] = $book;
        $this->saveJson($books);
    }


    public function update(array $editedBook): void {
        $books = $this->read();

        foreach ($books as $index => $book) {
            if ($book['id'] === $editedBook['id']) {
                $books[$index] = $editedBook;
            break;
            }
        }

    $this->saveJson($books);
}

    public function delete(int $id): void {
        $books = $this->read();

        $books = array_values(array_filter(
            $books,
            fn($l) => $l["id"] != $id
            ));

        $this->saveJson($books);
    }

    public function list(): array {
        return $this->read();
    }
}

?>