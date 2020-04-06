<?php

    class Stock
    {

        public static function loadPage() {
            if(isset($_GET['url'])) {
                $url = explode('/',$_GET['url']);
                if(file_exists('pages/includes/'.$url[0].'.php')) {
                    include('pages/includes/'.$url[0].'.php');
                }else {
                    header('Location: '.MAIN_PATH);
                    die();
                }
            }
        }

        public static function validImage($image) {
            if($image['type'] == 'image/JPEG' ||
              $image['type'] == 'image/jpeg' ||
              $image['type'] == 'image/png' ||
              $image['type'] == 'image/gif') {
    
              $size = intval($image['size'] / 1024);
              if($size < 1000){
                return true;
              }else {
                return false;
              }
            }else {
                return false;
            }
        }

        public static function Alert($type,$msg) {
            if($type == 'success') {
                echo '<div class="box-success">'.$msg.'.</div>';
            }else if($type == 'error') {
                echo '<div class="box-error">'.$msg.'.</div>';
            }
        }

        public static function uploadFile($file) {
            $fileFormat = explode('.', $file['name']);
            $imageName = uniqid().'.'.$fileFormat[count($fileFormat) - 1];
            if(move_uploaded_file($file['tmp_name'],DIR.'/uploads/'.$imageName)){
              return $imageName;
            }else {
              return false;
            }
            
          }

        public function RegisterP() {
            if(isset($_POST['action'])) {
                $name = $_POST['name'];
                $description = $_POST['description'];
                $provider = $_POST['provider'];
                $manufacturer = $_POST['manufacturer'];
                $amount = $_POST['amount'];
                $image = $_FILES['image'];

                $success = true;

                if($name == '' || $description == '' || $provider == '' || $manufacturer == '' || $amount == '' || $image == '') {
                    $success = false;
                    Stock::Alert('error','Fill in all fields');
                }else if($success) {
                    $sql = Sql::connect()->prepare("INSERT INTO `products` VALUES(null,?,?,?,?,?,?)");
                    $image = Stock::uploadFile($image);
                    if($sql->execute(array($name,$description,$provider,$manufacturer,$amount,$image))) {
                        Stock::Alert('success','the product has been successfully registered');
                                   
                    }
                }
            }
        }

        public static function Select($tb, $query = '', $arr = '') {
            if($query != false){
                $sql = Sql::connect()->prepare("SELECT * FROM `$tb` WHERE $query");
                $sql->execute($arr); 
                return $sql->fetch();
            }else {
                $sql = Sql::connect()->prepare("SELECT * FROM `$tb`");
                $sql->execute();
                return $sql->fetchAll();
            }
        }

        public static function Delete() {
            if(isset($_GET['delete'])) {
                $id = (int)$_GET['delete'];
                $produ = Sql::connect()->prepare("SELECT `image` FROM `products` WHERE id = $id");
                $produ->execute();
                $produ = $produ->fetch();
                @unlink(DIR.'/uploads/'.$produ['image']);
                Sql::connect()->exec("DELETE FROM `products` WHERE id = $id");
                Stock::Alert('success','product successfully deleted');
            }
        }

        public static function Edit($id) {
            if(isset($_POST['action'])) {
                $name = $_POST['name'];
                $description = $_POST['description'];
                $provider = $_POST['provider'];
                $manufacturer = $_POST['manufacturer'];
                $amount = $_POST['amount'];
                $img = $_POST['img'];
                $image = $_FILES['image'];
                
                if($image['name'] != ''){
                    if(Stock::validImage($image)) {
                        @unlink(DIR.'/uploads/'.$img);
                        $image = Stock::uploadFile($image);
                        $sql = Sql::connect()->prepare("UPDATE `products` SET name = ?, description = ?, provider = ?, manufacturer = ?, amount = ?, image = ? WHERE id = ?");
                        $sql->execute(array($name,$description,$provider,$manufacturer,$amount,$image,$id));
                        Stock::Alert('success','Product updated successfully');
                    }else {
                        Stock::Alert('error','Error');
                    }
                }else {
                    $image = $img;
                    $sql = Sql::connect()->prepare("UPDATE `products` SET name = ?, description = ?, provider = ?, manufacturer = ?, amount = ?, image = ? WHERE id = ?");
                    $sql->execute(array($name,$description,$provider,$manufacturer,$amount,$image,$id));
                    Stock::Alert('success','Product updated successfully');
                }
                
            }
        }

        public static function Search($tb) {
            $name = $_POST['search'];
            $query = "WHERE (name LIKE '%$name%') AND amount > 0";
            $sql = Sql::connect()->prepare("SELECT * FROM `$tb` $query");
            $sql->execute();
            return $sql->fetchAll();

        }
    }

?>