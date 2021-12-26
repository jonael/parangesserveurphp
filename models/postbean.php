<?php
    class Postbean {
        private $idPost;
        private $postTitle;
        private $postText;
        private $postDate;
        private $idCategory;
        private $idUser;

        public function getIdPost(){
            return $this->idPost;
        }
        public function setIdPost($idPost){
            $this->idPost = $idPost;
        }
    
        public function getPostTitle(){
            return $this->postTitle;
        }
        public function setPostTitle($postTitle){
            $this->postTitle = $postTitle;
        }
    
        public function getPostText(){
            return $this->postText;
        }
        public function setPostText($postText){
            $this->postText = $postText;
        }
    
        public function getPostDate(){
            return $this->postDate;
        }
        public function setPostDate($postDate){
            $this->postDate = $postDate;
        }
    
        public function getIdCategory(){
            return $this->idCategory;
        }
        public function setIdCategory($idCategory){
            $this->idCategory = $idCategory;
        }
    
        public function getIdUser(){
            return $this->idUser;
        }
        public function setIdUser($idUser){
            $this->idUser = $idUser;
        }
    }
?>