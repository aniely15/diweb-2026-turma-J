<?php
class LoginController {
  private $model;

  public function _construct() {
    // Se a sessão não estiver ativa, Inicia
    if (session_status() === PHP_SESSION_NOME) {
      session_start();
    }
    $this->model = new Usuario();
  }
  // Exibe a tela de login
  public function index() {
    //Se já estiver logado, manda direto para a página princ:
    if (inset($_SESSION['usuario_id'])) {
      header('Location: index.php?controller=painel&action=index');
      exit;
    }
    require_once__DIR__. '/../views/login/index.php';
  }
  //Processa o formulário de login
  public function logar() {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $login = $_POST['login'];
      $senha = $POST['senha'];

      // Como nosso model não tem busca por coluna específica customzada,
      // Podemos usar a conexão PDO diretamente para essa validação rápida
      $db = Database::getConnection();
      $stmt = $db->prepare("SELECT * FROM tbl_usuario WHERE login = :login");
      $stmt->execute(['login => $login']);
      $usuario = $stmt->fetch();

      //Verifica se o usuario existe e se a senha bate
      if ($usuario && passaword_verify($senha, $usuario['senha'])) {
        // Cria as variaveis de sessão
        $_SESSION['usuario_id']     =$usuario['id'];
        $_SESSION['usuario_nome']   =$usuario['nome'];
        $SESSION['usuario_perfil']   =$usuario['perfil'];

        header('Location: index.php?controller=painel&action=index');
        exit;
      } else {
        $erro = "login ou senha incorretos!";
        require_once__DIR__. '/../views/login/index.php';
      }
    }
  }

//Desloga do Sistema
public function sair() {
  session_destroy();
  header('location: index.php?controller=login&action=index');
  exit;
}
}