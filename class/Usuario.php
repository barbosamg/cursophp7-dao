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

        public function __construct($login="", $senha=""){
            $this->setLogin($login);
            $this->setSenha($senha);
        }

        //CARREGAR 1 USUARIO POR ID
        public function loadById($id){
            $sql = new Sql();
            $results = $sql->select("SELECT * FROM tb_usuarios WHERE idusuario = :ID", array(
                ":ID"=>$id));
            if(isset($results[0])){
                $this->setDados($results[0]);
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
                $this->setDados($results[0]);
            }else{
                throw new Exception("Login e/ou senha inválidos");
            }
        }

        //INSERIR USUARIO
        public function insert(){
            $sql = new Sql();
            $results = $sql->select("CALL sp_usuarios_insert(:LOGIN, :SENHA)", array(
                ':LOGIN'=>$this->getLogin(),
                ':SENHA'=>$this->getSenha()
            ));

            if(count($results) > 0){
                $this->setDados($results[0]);
            }
        }

        //ATUALIZAR USUARIO
        public function update($login, $senha){

            $this->setLogin($login);
            $this->setSenha($senha);

            $sql = new Sql();
            $sql->query("UPDATE tb_usuarios SET login = :LOGIN, senha = :SENHA WHERE idusuario = :ID", array(
                ":LOGIN"=>$this->getLogin(),
                ":SENHA"=>$this->getSenha(),
                ":ID"=>$this->getIdUsuario()
            ));
        }

        //DELETAR USUARIO
        public function delete(){
            $sql = new Sql();

            $sql->query("DELETE FROM tb_usuarios WHERE idusuario = :ID", array(
                ":ID"=>$this->getIdUsuario()
            ));

            $this->setIdUsuario(0);
            $this->setLogin("");
            $this->setSenha("");
            $this->setDtCadastro(new DateTime());
        }

        public function setDados($dados){
            $this->setIdUsuario($dados["idusuario"]);
            $this->setLogin($dados["login"]);
            $this->setSenha($dados["senha"]);
            $this->setDtCadastro(new DateTime($dados["dtcadastro"]));
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