<?php
    class Articlebean {
        private $idArticle;
        private $articleTitle;
        private $articleText1;
        private $articleText2;
        private $articleText3;
        private $articleText4;
        private $articleImg1;
        private $articleImg2;
        private $articleImg3;
        private $articleImg4;
        private $articleDate;
        private $idUser;

        public function getIdArticle(){
            return $this->idArticle;
        }
        public function setIdArticle($idArticle){
            $this->idArticle = $idArticle;
        }
    
        public function getArticleTitle(){
            return $this->articleTitle;
        }
        public function setArticleTitle($articleTitle){
            $this->articleTitle = $articleTitle;
        }
    
        public function getArticleText1(){
            return $this->articleText1;
        }
        public function setArticleText1($articleText1){
            $this->articleText1 = $articleText1;
        }
    
        public function getArticleText2(){
            return $this->articleText2;
        }
        public function setArticleText2($articleText2){
            $this->articleText2 = $articleText2;
        }
    
        public function getArticleText3(){
            return $this->articleText3;
        }
        public function setArticleText3($articleText3){
            $this->articleText3 = $articleText3;
        }
    
        public function getArticleText4(){
            return $this->articleText4;
        }
        public function setArticleText4($articleText4){
            $this->articleText4 = $articleText4;
        }
    
        public function getArticleImg1(){
            return $this->articleImg1;
        }
        public function setArticleImg1($articleImg1){
            $this->articleImg1 = $articleImg1;
        }
    
        public function getArticleImg2(){
            return $this->articleImg2;
        }
        public function setArticleImg2($articleImg2){
            $this->articleImg2 = $articleImg2;
        }
    
        public function getArticleImg3(){
            return $this->articleImg3;
        }
        public function setArticleImg3($articleImg3){
            $this->articleImg3 = $articleImg3;
        }
    
        public function getArticleImg4(){
            return $this->articleImg4;
        }
        public function setArticleImg4($articleImg4){
            $this->articleImg4 = $articleImg4;
        }

        public function getArticleDate(){
            return $this->articleDate;
        }
        public function setArticleDate($articleDate){
            $this->articleDate = $articleDate;
        }
    
        public function getIdUser(){
            return $this->idUser;
        }
        public function setIdUser($idUser){
            $this->idUser = $idUser;
        }
    }
?>