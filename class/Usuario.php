<?php

    class Usuario{
        //ATRIBUTOS
        private $idusuario;
        private $login;
        private $senha;
        private $dtcadastro;

        //MÉTODOS
        public function getIdUsuario(){
            return $this->idusuario;
        }

        public function setIdUsuario($value){
            $this->idusuario = $value;
        }

        public function getLogin(){
            return $this->login;
        }

        public function setLogin($value){
            $this->login = $value;
        }

        public function getSenha(){
            return $this->senha;
        }

        public function setSenha($value){
            $this->senha = $value;
        }

        public function getDtCadastro(){
            return $this->dtcadastro;
        }

        public function setDtCadastro($value){
            $this->dtcadastro = $value;
        }

        //CARREGAR 1 USUARIO POR ID
        public function loadById($id){
            $sql = new Sql();
            $results = $sql->select("SELECT * FROM tb_usuarios WHERE idusuario = :ID", array(
                ":ID"=>$id));
            if(isset($results[0])){
                $row = $results[0];
                $this->setIdUsuario($row["idusuario"]);
                $this->setLogin($row["login"]);
                $this->setSenha($row["senha"]);
                $this->setDtCadastro(new DateTime($row["dtcadastro"]));
            }
        }

        //CARREGAR TODOS OS USUARIOS
        public static function getList(){
            $sql = new Sql();
            return $sql->select("SELECT * FROM tb_usuarios ORDER BY login");
        }

        //BUSCAR POR USUARIO PELO LOGIN
        public static function search($login){
            $sql = new Sql();
            return $sql->select("SELECT * FROM tb_usuarios WHERE login LIKE :SEARCH ORDER BY login", array(
                ':SEARCH'=>"%".$login."%"
            ));
        }

        //BUSCAR USUARIO AUTENTICANDO LOGIN E SENHA
        public function login($login, $senha){
            $sql = new Sql();
            $results = $sql->select("SELECT * FROM tb_usuarios WHERE login = :LOGIN AND senha = :SENHA", array(
                ":LOGIN"=>$login,
                ":SENHA"=>$senha
            ));
            if(isset($results[0])){
                $row = $results[0];
                $this->setIdUsuario($row["idusuario"]);
                $this->setLogin($row["login"]);
                $this->setSenha($row["senha"]);
                $this->setDtCadastro(new DateTime($row["dtcadastro"]));
            }else{
                throw new Exception("Login e/ou senha inválidos");
            }
        }

        public function __toString(){
            return json_encode(array(
                "idusuario"=>$this->getIdUsuario(),
                "login"=>$this->getLogin(),
                "senha"=>$this->getSenha(),
                "dtcadastro"=>$this->getDtCadastro()->format("d/m/Y H:i:s")
            ));
        }


    }

?>