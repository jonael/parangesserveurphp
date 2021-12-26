<?php
    class Categorybean {
        private $idCategory;
        private $categoryName;

        public function getIdCategory(){
            return $this->idCategory;
        }
        public function setIdCategory($idCategory){
            $this->idCategory = $idCategory;
        }
    
        public function getCategoryName(){
            return $this->categoryName;
        }
        public function setCategoryName($categoryName){
            $this->categoryName = $categoryName;
        }
    }
?>