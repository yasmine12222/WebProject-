<?php
require_once(__DIR__ . '/../config.php');
require_once(__DIR__ . '/../Models/Book.php');

class BookController
{
    // ── CREATE ─────────────────────────────────────────────────────────
    public function addBook(Book $book)
    {
        $sql = "INSERT INTO book (title, author, publication_date, language, status, number_of_copies, category_id)
                VALUES (:title, :author, :publication_date, :language, :status, :number_of_copies, :category_id)";
        $db = Config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute([
                'title'            => $book->getTitle(),
                'author'           => $book->getAuthor(),
                'publication_date' => $book->getPublicationDate(),
                'language'         => $book->getLanguage(),
                'status'           => $book->getStatus() ? 1 : 0,
                'number_of_copies' => $book->getNumberOfCopies(),
                'category_id'      => $book->getCategoryId(),
            ]);
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    // ── READ ALL (avec jointure catégorie) ────────────────────────────
    public function listBooks()
    {
        $sql = "SELECT b.*, c.title AS category_title
                FROM book b
                LEFT JOIN category c ON b.category_id = c.id
                ORDER BY b.id DESC";
        $db = Config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute();
            $rows = $query->fetchAll();

            $books = [];
            foreach ($rows as $row) {
                $book = new Book(
                    $row['title'],
                    $row['author'],
                    $row['publication_date'],
                    $row['language'],
                    $row['status'],
                    $row['number_of_copies'],
                    $row['category_id']
                );
                $book->setId($row['id']);
                $book->setCategoryTitle($row['category_title'] ?? '—');
                $books[] = $book;
            }
            return $books;
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
            return [];
        }
    }

    // ── READ ONE ──────────────────────────────────────────────────────
    public function getBookById($id)
    {
        $sql = "SELECT b.*, c.title AS category_title
                FROM book b
                LEFT JOIN category c ON b.category_id = c.id
                WHERE b.id = :id";
        $db = Config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute(['id' => $id]);
            $row = $query->fetch();

            if ($row) {
                $book = new Book(
                    $row['title'],
                    $row['author'],
                    $row['publication_date'],
                    $row['language'],
                    $row['status'],
                    $row['number_of_copies'],
                    $row['category_id']
                );
                $book->setId($row['id']);
                $book->setCategoryTitle($row['category_title'] ?? '—');
                return $book;
            }
            return null;
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
            return null;
        }
    }

    // ── UPDATE ────────────────────────────────────────────────────────
    public function updateBook(Book $book)
    {
        $sql = "UPDATE book
                SET title = :title,
                    author = :author,
                    publication_date = :publication_date,
                    language = :language,
                    status = :status,
                    number_of_copies = :number_of_copies,
                    category_id = :category_id
                WHERE id = :id";
        $db = Config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute([
                'title'            => $book->getTitle(),
                'author'           => $book->getAuthor(),
                'publication_date' => $book->getPublicationDate(),
                'language'         => $book->getLanguage(),
                'status'           => $book->getStatus() ? 1 : 0,
                'number_of_copies' => $book->getNumberOfCopies(),
                'category_id'      => $book->getCategoryId(),
                'id'               => $book->getId(),
            ]);
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    // ── DELETE ────────────────────────────────────────────────────────
    public function deleteBook($id)
    {
        $sql = "DELETE FROM book WHERE id = :id";
        $db = Config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute(['id' => $id]);
            return true;
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
            return false;
        }
    }
}