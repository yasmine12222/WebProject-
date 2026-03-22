<?php
class Book
{
    private $id;
    private $title;
    private $author;
    private $publication_date;
    private $language;
    private $status;
    private $number_of_copies;
    private $category_id;
    private $category_title; // pour la jointure (affichage)

    public function __construct(
        $title = null,
        $author = null,
        $publication_date = null,
        $language = null,
        $status = true,
        $number_of_copies = 1,
        $category_id = null
    ) {
        $this->title            = $title;
        $this->author           = $author;
        $this->publication_date = $publication_date;
        $this->language         = $language;
        $this->status           = $status;
        $this->number_of_copies = $number_of_copies;
        $this->category_id      = $category_id;
    }

    // --- Getters & Setters ---

    public function getId() { return $this->id; }
    public function setId($id) { $this->id = $id; }

    public function getTitle() { return $this->title; }
    public function setTitle($title) { $this->title = $title; }

    public function getAuthor() { return $this->author; }
    public function setAuthor($author) { $this->author = $author; }

    public function getPublicationDate() { return $this->publication_date; }
    public function setPublicationDate($date) { $this->publication_date = $date; }

    public function getLanguage() { return $this->language; }
    public function setLanguage($language) { $this->language = $language; }

    public function getStatus() { return $this->status; }
    public function setStatus($status) { $this->status = $status; }

    public function getNumberOfCopies() { return $this->number_of_copies; }
    public function setNumberOfCopies($n) { $this->number_of_copies = $n; }

    public function getCategoryId() { return $this->category_id; }
    public function setCategoryId($id) { $this->category_id = $id; }

    public function getCategoryTitle() { return $this->category_title; }
    public function setCategoryTitle($t) { $this->category_title = $t; }
}