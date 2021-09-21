<?php 

    /**
     * User: Ayanesh Sarkar
     * Date: 01/01/2021
     */

    namespace App\Models;

    use App\Helpers\Helper;
    /**
     * Class Book
     * @author Ayanesh Sarkar <ayaneshsarkar101@gmail.com>
     * @package App
     */
    class Book extends Model {

        public function primaryKey()
        {
            return 'id';
        }

        public function tableName()
        {
            return 'books';
        }

        public function get()
        {
            return $this->select('books.*, categories.name AS category, book_types.type')
                    ->join('categories', 'id', 'category_id')
                    ->join('book_types', 'id', 'type_id')
                    ->orderBy('created_at', true)
                    ->getAll();
        }

        public function first(?int $id, ?string $slug = null)
        {
            if($id) {
                return $this->select('books.*, categories.name AS category, book_types.type')
                    ->join('categories', 'id', 'category_id')
                    ->join('book_types', 'id', 'type_id')
                    ->where('id', $id)
                    ->orderBy('created_at', true)
                    ->getFirst();
            } elseif($slug) {
                return $this->select('books.*, categories.name AS category, book_types.type')
                    ->join('categories', 'id', 'category_id')
                    ->join('book_types', 'id', 'type_id')
                    ->where('book_code', $slug)
                    ->orderBy('created_at', true)
                    ->getFirst();
            } else {
                return NULL;
            }
            
        }

        public function getFeaturedBooks()
        {
            return $this->select('*')
                    ->where('featured', 1)
                    ->getAll();
        }

        public function getPopularBooks()
        {
            return $this->select('*')
                    ->where('popular', 1)
                    ->getAll();
        }

        public function getPremiumBooks()
        {
            return $this->select('*')
                    ->where('premium', 1)
                    ->getAll();
        }

        public function searchBooks(?string $term)
        {
            $query = "SELECT books.*, categories.name as category FROM books 
                JOIN categories ON books.category_id = categories.id
                WHERE title ILIKE :term 
                OR author ILIKE :term";
            $statement = $this->db->prepare($query);
            $statement->execute([ 'term' => "%$term%" ]);

            return $statement->fetchAll();
        }

        public function getCategoryBooks($id)
        {
            $query = "SELECT books.*, categories.name as category FROM books 
                JOIN categories ON books.category_id = categories.id
                WHERE category_id = :id";
                
            $statement = $this->db->prepare($query);
            $statement->execute([ 'id' => $id ]);

            return $statement->fetchAll();
        }

        public function create(object $data)
        {
            $bookArr = [
                'category_id' => $data->category_id,
                'title' => $data->title,
                'description'  => $data->description,
                'author' => $data->author,
                'bookurl' => $data->bookurl,
                'type_id' => $data->type_id,
                'price' => $data->price,
                'publish_date' => date('Y-m-d H:i:s', strtotime($data->publish_date)),
                'book_code' => Helper::randomString(100),
                'popular' => $data->popular ?? 0,
                'featured' => $data->featured ?? 0,
                'premium' => $data->premium ?? 0,
                'inventory' => $data->inventory ?? 1,
                'bookfile' => $data->bookfile ?? NULL
            ];

            return $this->insert($bookArr);
        }

        public function update(object $data)
        {
            $updateArr = [
                'category_id' => $data->category_id,
                'title' => $data->title,
                'description'  => $data->description,
                'author' => $data->author,
                'bookurl' => $data->bookurl,
                'type_id' => $data->type_id,
                'price' => $data->price,
                'publish_date' => date('Y-m-d H:i:s', strtotime($data->publish_date)),
                'popular' => $data->popular ?? 0,
                'featured' => $data->featured ?? 0,
                'premium' => $data->premium ?? 0,
                'inventory' => $data->inventory ?? 1,
                'bookfile' => $data->bookfile ?? NULL
            ];

            return $this->updateOne($updateArr, $data->id);
        }

        public function delete(?int $id)
        {
            if($id) {
                $query = "DELETE FROM books WHERE id = :id";
                $statement = $this->db->prepare($query);
                $statement->execute([ 'id' => $id ]);
            }
        }

    }