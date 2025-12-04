<?php
    require_once __DIR__ . "/../utils/Conexao.php";
    require_once __DIR__ ."/../models/Usuario.php";


    class UsuarioDAO {
        private $pdo;
        public function __construct() {
            $this->pdo = Conexao::conectar();
        }

        public function criarUsuarioDAO(Usuario $usuario) {
            try {
                $SQL = "INSERT INTO usuario(
                id_usuario,
                nome_usuario,
                sobrenome_usuario,
                email_usuario,
                senha_usuario,
                data_nascimento_usuario,
                data_contratacao_usuario,
                ativo_usuario, adm_usuario,
                matricula_usuario,
                cpf_usuario,
                telefone_usuario,
                codigo_voto_usuario,
                data_codigo_expiracao,
                ultimo_acesso) VALUES (
                    :nome,
                    :sobrenome,
                    :email,
                    :senha,
                    :data_nascimento,
                    :data_contratacao,
                    :ativo,
                    :adm,
                    :matricula,
                    :cpf,
                    :telefone,
                    :codigo_voto,
                    :ultimo_acesso
                )";

                $stmt = $this->pdo->prepare($SQL);
                $stmt->bindValue(":nome", $usuario->getNomeUsuario(), PDO::PARAM_STR);
                $stmt->bindValue(":sobrenome", $usuario->getSobrenomeUsuario(), PDO::PARAM_STR);
                $stmt->bindValue(":email", $usuario->getEmailUsuario(), PDO::PARAM_STR);
                $stmt->bindValue(":senha", $usuario->getSenhaUsuario(), PDO::PARAM_STR);
                $stmt->bindValue(":data_nascimento", $usuario->getDatadeNascimentoUuario(), PDO::PARAM_STR);
                $stmt->bindValue(":data_contratacao", $usuario->getDataContratacaoUsuario(), PDO::PARAM_STR);
                $stmt->bindValue(":ativo", $usuario->getAtivoUsuario(), PDO::PARAM_BOOL);
                $stmt->bindValue(":adm", $usuario->getAdmUsuario(), PDO::PARAM_STR);
                $stmt->bindValue(":matricula", $usuario->getMatriculaUsuario(), PDO::PARAM_STR);
                $stmt->bindValue(":cpf", $usuario->getCpfUsuario(), PDO::PARAM_STR);
                $stmt->bindValue(":telefone", $usuario->getTelefoneUsuario(), PDO::PARAM_STR);
                $stmt->bindValue(":codigo_voto", $usuario->getCodigoVotoUsuario(), PDO::PARAM_STR);
                $stmt->bindValue(":ultimo_acesso", $usuario->getUltimoAcessoUsuario(), PDO::PARAM_STR);

                $stmt->execute();
            }catch (PDOException $e) {
                error_log("Erro ao instanciar um usuário: " . $e->getMessage());
            }
        }
        public function getUsuarioPorId(int $id) {
            try {
                $SQL = "SELECT * FROM usuario WHERE id_usuario = :id";
                $stmt = $this->pdo->prepare($SQL);
                $stmt->bindValue(":id", $id, PDO::PARAM_INT);
                $stmt->execute();
                $result = $stmt->fetch(PDO::FETCH_ASSOC);
                if ($result) {
                    $usuario = new Usuario();
                    $usuario->setIdUsuario($result['id_usuario']);
                    $usuario->setNomeUsuario($result['nome_usuario']);
                    $usuario->setSobrenomeUsuario($result['sobrenome_usuario']);
                    $usuario->setEmailUsuario($result['email_usuario']);
                    $usuario->setSenhaUsuario($result['senha_usuario']);
                    $usuario->setDataDeNascimentoUsuario($result['data_nascimento_usuario']);
                    $usuario->setDataContratacaoUsuario($result['data_contratacao_usuario']);
                    $usuario->setAtivoUsuario($result['ativo_usuario']);
                    $usuario->setAdmUsuario($result['adm_usuario']);
                    $usuario->setMatriculaUsuario($result['matricula_usuario']);
                    $usuario->setCpfUsuario($result['cpf_usuario']);
                    $usuario->setTelefoneUsuario($result['telefone_usuario']);
                    $usuario->setCodigoVotoUsuario($result['codigo_voto_usuario']);
                    $usuario->setDataCodigoExpiracao($result['data_codigo_expiracao']);
                    $usuario->setUltimoAcessoUsuario($result['ultimo_acesso']);
                    return $usuario;
                }
                return null;
            } catch (PDOException $e) {
                error_log("Erro ao buscar usuário por ID: " . $e->getMessage());
                return null;
            }
        }

        
    }
?>