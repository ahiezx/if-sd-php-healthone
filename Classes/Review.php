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

    public function __construct()
    {
        settype($this->id, 'integer');
        settype($this->product_id, 'integer');
        settype($this->user_id, 'integer');
    }

    public function save()
    {
        global $pdo;
        if ($this->id == 0) {
            $statement = $pdo->prepare('INSERT INTO reviews (name, date, description, stars, user_id, product_id) VALUES (:name, :date, :description, :stars, :user_id, :product_id)');
            $statement->execute([
                'name' => $this->name,
                'date' => $this->date,
                'description' => $this->description,
                'stars' => $this->stars,
                'user_id' => $this->user_id,
                'product_id' => $this->product_id
            ]);
            $this->id = $pdo->lastInsertId();
        } else {
            $statement = $pdo->prepare('UPDATE reviews SET name = :name, date = :date, description = :description, stars = :stars, user_id = :user_id, product_id = :product_id WHERE id = :id');
            $statement->execute([
                'name' => $this->name,
                'date' => $this->date,
                'description' => $this->description,
                'stars' => $this->stars,
                'user_id' => $this->user_id,
                'product_id' => $this->product_id,
                'id' => $this->id
            ]);
        }
    }
}