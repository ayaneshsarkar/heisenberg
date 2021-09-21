<?php 

    /**
     * User: Ayanesh Sarkar
     * Date: 31/12/2020
     */

    namespace App\Controllers;

    use App\Controllers\Controller;
    use App\Core\Request;
    use App\Core\Response;
    use App\Core\Validator;
    use App\Middlewares\AdminMiddleware;
    use App\Core\FileHandler;
    use App\Core\Application;
    

    /**
     * Class HomeController
     * @author Ayanesh Sarkar <ayaneshsarkar101@gmail.com>
     * @package App\Controllers
     */
    class BooksController extends Controller {

        public function setAllMiddlewares()
        {
            $this->registerMiddlewares(new AdminMiddleware([
                '/get-full-book'
            ]));
        }

        public function getBooks(Request $request, Response $response)
        {
            $books = $this->book->get();

            if(Application::$APP->user && (Application::$APP->user->type !== 'admin')) {
                foreach($books as $book) {
                    unset($book->bookfile);
                }
            }

            return $response->json($books);
        }

        public function getCategoryBooks(Request $request, Response $response)
        {
            $id = $request->getBody()->id;
            $books = $this->book->getCategoryBooks($id);

            foreach($books as $book) {
                unset($book->bookfile);
            }

            return $response->json($books);
        }

        public function getPopularBooks(Request $request, Response $response)
        {
            $books = $this->book->getPopularBooks();

            foreach($books as $book) {
                unset($book->bookfile);
            }

            return $response->json($books);
        }

        public function getFeaturedBooks(Request $request, Response $response)
        {
            $books = $this->book->getFeaturedBooks();

            foreach($books as $book) {
                unset($book->bookfile);
            }

            return $response->json($books);
        }

        public function getPremiumBooks(Request $request, Response $response)
        {
            $books = $this->book->getPremiumBooks();

            foreach($books as $book) {
                unset($book->bookfile);
            }

            return $response->json($books);
        }

        public function getBook(Request $request, Response $response)
        {
            $id = $request->getBody()->id ?? NULL;
            $slug = $request->getBody()->slug ?? NULL;
            $book = $this->book->first((int)$id, $slug);
            unset($book->bookfile);

            return $response->json($book);
        }

        public function getFullBook(Request $request, Response $response)
        {
            $id = $request->getBody()->id ?? NULL;
            $slug = $request->getBody()->slug ?? NULL;
            $book = $this->book->first((int)$id, $slug);

            return $response->json($book);
        }

        public function storeBook(Request $request, Response $response)
        {
            $data = $request->getBody();
            
            Validator::isInt($data->category_id ?? NULL, 'category', true);
            Validator::isString($data->title ?? NULL, 'title', true);
            Validator::isString($data->description ?? NULL, 'description', false);
            Validator::isString($data->author ?? NULL, 'author', true);
            Validator::isInt($data->price ?? NULL, 'price', true);
            Validator::isInt($data->type_id ?? NULL, 'type', true);
            Validator::isString($data->publish_date ?? NULL, 'publish date', true);
            Validator::isInt($data->popular ?? NULL, 'popular', false);
            Validator::isInt($data->featured ?? NULL, 'featured', false);
            Validator::isInt($data->premium ?? NULL, 'premium', false);
            Validator::isInt($data->inventory ?? NULL, 'inventory', false);

            //  Checkking valid Bookurl
            if($request->hasFile('bookurl')) {
                Validator::isImage($request->getFile('bookurl'), 'bookurl');
            } else {
                return 
                $response->json([ 'status' => FALSE, 'errors' => 'Bookurl is required.' ]);
            }

            //  Checking Valid Bookfile
            if($request->hasFile('bookfile')) {
                Validator::isPDF($request->getFile('bookfile'), 'bookfile');
            } else {
                return 
                $response->json([ 'status' => FALSE, 'errors' => 'Bookfile is required.' ]);
            }

            $errors = Validator::validate();
            
            if(empty($errors)) {
                $data->bookurl = FileHandler::moveFile($request->getFile('bookurl'));
                $data->bookfile = FileHandler::moveFile(
                    $request->getFile('bookfile'), 'bookfiles'
                );

                $id = $this->book->create($data);
                return $response->json([ 'status' => TRUE, 'errors' => NULL, 'id' => $id ]);
            } else {
                return $response->json([ 'status' => FALSE, 'errors' => $errors ]);
            }

        }

        public function updateBook(Request $request, Response $response)
        {
            $data = $request->getBody();

            Validator::isInt($data->id ?? NULL, 'id', true);
            Validator::isInt($data->category_id ?? NULL, 'category', true);
            Validator::isString($data->title ?? NULL, 'title', true);
            Validator::isString($data->description ?? NULL, 'description', false);
            Validator::isString($data->author ?? NULL, 'author', true);
            Validator::isInt($data->type_id ?? NULL, 'type', true);
            Validator::isInt($data->price ?? NULL, 'price', true);
            Validator::isString($data->publish_date ?? NULL, 'publish date', true);
            Validator::isInt($data->popular ?? NULL, 'popular', false);
            Validator::isInt($data->featured ?? NULL, 'featured', false);
            Validator::isInt($data->premium ?? NULL, 'premium', false);
            Validator::isInt($data->inventory ?? NULL, 'inventory', false);

            $errors = Validator::validate();

            if($request->hasFile('bookurl')) {
                Validator::isImage($request->getFile('bookurl'), 'bookurl');
            }

            if($request->hasFile('bookfile')) {
                Validator::isPDF($request->getFile('bookfile'), 'bookfile');
            }
            
            if(empty($errors)) {
                $book = $this->book->first($data->id);
                
                if(!empty($book)) {
                    $bookurlFile = $request->hasFile('bookurl') ?
                                    $request->getFile('bookurl') : '';
                    
                    $bookMainFile = $request->hasFile('bookfile') ? 
                                    $request->getFile('bookfile') : '';
                    
                    if($bookurlFile) {
                        FileHandler::deleteFile($book->bookurl);
                        $data->bookurl = FileHandler::moveFile($bookurlFile);
                    } else {
                        $data->bookurl = $book->bookurl;
                    }

                    if($bookMainFile) {
                        if($book->bookfile) {
                            FileHandler::deleteFile($book->bookfile);
                        }
                        
                        $data->bookfile = FileHandler::moveFile($bookMainFile, 'bookfiles');
                    } else {
                        $data->bookfile = $book->bookfile;
                    }

                    $this->book->update($data);
                    
                    return $response->json([ 
                        'status' => TRUE, 
                        'errors' => NULL, 
                        'id' => $book->id 
                    ]);
                } else {
                    return $response->json([ 'status' => TRUE, 'errors' => 'Invalid Id!' ]);
                }

            } else {
                return $response->json([ 'status' => FALSE, 'errors' => $errors ]);
            }

        }

        public function searchBooks(Request $request, Response $response)
        {
            $data = $request->getBody();

            $books = $this->book->searchBooks($data->term);

            if($books) {
                foreach($books as $book) {
                    unset($book->bookfile);
                }
            }

            return $response->json($books);
        }

        public function deleteBook(Request $request, Response $response)
        {
            $id = $request->getBody()->id ?? NULL;
            Validator::isInt($id, 'id', true);

            $errors = Validator::validate();

            if(empty($errors)) {
                $book = $this->book->first($id);

                if(empty($book)) {
                    return $response->json([ 'status' => false, 'errors' => 'Invalid Id!' ]);
                }

                FileHandler::deleteFile($book->bookurl);
                $this->book->delete($id);
                return $response->json([ 'status' => true, 'errors' => NULL ]);
            } else {
                return $response->json([ 'status' => false, 'errors' => $errors ]);
            }
        }

    }