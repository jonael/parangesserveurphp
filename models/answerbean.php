<?php
    class Answerbean {
        private $idAnswer;
        private $answerText;
        private $answerDate;
        private $idPost;
        private $idUser;

        public function getIdAnswer(){
            return $this->idAnswer;
        }
        public function setIdAnswer($idAnswer){
            $this->idAnswer = $idAnswer;
        }
    
        public function getAnswerText(){
            return $this->answerText;
        }
        public function setAnswerText($answerText){
            $this->answerText = $answerText;
        }
    
        public function getAnswerDate(){
            return $this->answerDate;
        }
        public function setAnswerDate($answerDate){
            $this->answerDate = $answerDate;
        }
    
        public function getIdPost(){
            return $this->idPost;
        }
        public function setIdPost($idPost){
            $this->idPost = $idPost;
        }
    
        public function getIdUser(){
            return $this->idUser;
        }
        public function setIdUser($idUser){
            $this->idUser = $idUser;
        }
    }
?>