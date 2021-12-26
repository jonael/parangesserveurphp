<?php
    class Commentbean {
        private $idComment;
        private $commentText;
        private $commentDate;
        private $idArticle;
        private $idUser;

        public function getIdComment(){
            return $this->idComment;
        }
        public function setIdComment($idComment){
            $this->idComment = $idComment;
        }
    
        public function getCommentText(){
            return $this->commentText;
        }
        public function setCommentText($commentText){
            $this->commentText = $commentText;
        }
    
        public function getCommentDate(){
            return $this->commentDate;
        }
        public function setCommentDate($commentDate){
            $this->commentDate = $commentDate;
        }
    
        public function getIdArticle(){
            return $this->idArticle;
        }
        public function setIdArticle($idArticle){
            $this->idArticle = $idArticle;
        }
    
        public function getIdUser(){
            return $this->idUser;
        }
        public function setIdUser($idUser){
            $this->idUser = $idUser;
        }
    }
?>