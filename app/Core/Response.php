<?php 

    /**
     * User: Ayanesh Sarkar
     * Date: 04/01/2021
     */

    namespace App\Core;

    use App\Core\Application;

    /**
     * Class Response
     * @author Ayanesh Sarkar <ayaneshsarkar101@gmail.com>
     * @package App\Core
     */
    Class Response {

        public function setStatusCode(int $code)
        {
            http_response_code($code);
        }

        public function redirect(string $url)
        {
            header("Location: $url");
        }

        public function json($data)
        {
            return json_encode($data);
        }

        /**
         * function loadView
         * @param string $view
         * @param array $params
         */
        public function loadView(string $view, array $params = [])
        {
            foreach($params as $key => $value) {
                $$key = $value;
            }

            $path = Application::$APPPATH . "/resources/views/$view.php";

            \ob_start();
            include $path;
            return \ob_get_clean();
        }

    }