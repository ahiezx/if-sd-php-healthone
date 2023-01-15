<?php


class Review
{
    public $id;
    public $name;
    public $date;
    public $description;
    public $stars;
    public $user_id;
    public $product_id;

    public $reviews = [];

    public function __construct()
    {
        settype($this->id, 'integer');
        settype($this->product_id, 'integer');
        settype($this->user_id, 'integer');
    }

    public function save()
    {
        global $pdo;
        $stmt = $pdo->prepare("SELECT * FROM reviews WHERE user_id = :user_id AND product_id = :product_id");
        $stmt->execute(["user_id" => $this->user_id, "product_id" => $this->product_id]);
        $review = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if (!$review) {
            // review doesn't exist, insert it
            $statement = $pdo->prepare('INSERT INTO reviews (name, date, description, stars, user_id, product_id) VALUES (:name, :date, :description, :stars, :user_id, :product_id)');
            $statement->execute([
                'name' => filter_var($this->name, FILTER_SANITIZE_STRING),
                'date' => $this->date,
                'description' => filter_var($this->description, FILTER_SANITIZE_STRING),
                'stars' => filter_var($this->stars, FILTER_SANITIZE_NUMBER_INT),
                'user_id' => filter_var($this->user_id, FILTER_SANITIZE_NUMBER_INT),
                'product_id' => filter_var($this->product_id, FILTER_SANITIZE_NUMBER_INT)
            ]);
            $this->id = $pdo->lastInsertId();
        } else {
            // review exists, update it
            $statement = $pdo->prepare('UPDATE reviews SET name = :name, date = :date, description = :description, stars = :stars WHERE user_id = :user_id AND product_id = :product_id');
            $statement->execute([
                'name' => filter_var($this->name, FILTER_SANITIZE_STRING),
                'date' => $this->date,
                'description' => filter_var($this->description, FILTER_SANITIZE_STRING),
                'stars' => filter_var($this->stars, FILTER_SANITIZE_NUMBER_INT),
                'user_id' => filter_var($this->user_id, FILTER_SANITIZE_NUMBER_INT),
                'product_id' => filter_var($this->product_id, FILTER_SANITIZE_NUMBER_INT)
            ]);
        }
    }

    public function getReviewsByProductId($id) {

        global $pdo;
        $statement = $pdo->prepare('SELECT * FROM reviews WHERE product_id = :id');
        $statement->execute(['id' => $id]);
        $reviews = $statement->fetchAll(PDO::FETCH_CLASS, 'Review');
        $this->reviews = $reviews;
        return $reviews;

    }
}