<?php
require_once 'Database.php';
require_once 'User.php';
require_once 'DAO.php';
require_once 'UserDao.php';

// Obtém a rota da URL
$url = $_SERVER['REQUEST_URI'];

// Verifica se a rota solicitada é "teste/hello"
if (strpos($url, '/teste/hello') !== false) {
    echo "Hello";
} else if (strpos($url, '/teste/users') !== false) {
    $db = new Database('localhost', 'root', 'root', 'teste');
    $usuario = new UserDao($db);

    // Verifica o método da requisição
    $method = $_SERVER['REQUEST_METHOD'];

    switch ($method) {
        case 'GET':
            $users = $usuario->read();
            foreach ($users as $user) {
                echo "ID: " . $user->getId() . "<br>";
                echo "Nome: " . $user->getName() . "<br>";
                echo "Email: " . $user->getEmail() . "<br>";
                echo "Senha: " . $user->getSenha() . "<br>";
                echo "<br>";
            }
            break;

        case 'POST':
            // Extrai os dados do formulário enviado
            $nome = $_POST['name'];
            $email = $_POST['email'];
            $senha = $_POST['password'];

            // Cria um array com os dados do novo usuário
            $data = array(
                'name' => $nome,
                'email' => $email,
                'password' => $senha
            );

            // Chama o método de criação do UserDao
            $createdUser = $usuario->create($data);

            // Exibe uma mensagem de sucesso ou erro
            if ($createdUser) {
                echo "Usuário criado com sucesso!";
            } else {
                echo "Erro ao criar usuário.";
            }
            break;

        case 'PATCH':
            $id=$_GET['id'];
            $data = file_get_contents('php://input');
            $parsedData = json_decode($data, true); // Converter JSON para array associativo

            // Acessar os valores individualmente
            $name = $parsedData['name'];
            $email = $parsedData['email'];
            // Cria um array com os dados a serem atualizados
            $dados = array(
                'name' => $name,
                'email' => $email
            );
            var_dump($dados);
            // Chama o método de atualização do UserDao
            $updated = $usuario->update($id, $dados);

            // Exibe uma mensagem de sucesso ou erro
            if ($updated) {
                echo "Usuário atualizado com sucesso!";
            } else {
                echo "Erro ao atualizar usuário.";
            }
            break;


        case 'DELETE':
            // Obtém o ID do usuário a ser deletado
            $id = $_GET['id'];

            // Chama o método de deleção do UserDao
            $deleted = $usuario->delete($id);

            // Exibe uma mensagem de sucesso ou erro
            if ($deleted) {
                echo "Usuário deletado com sucesso!";
            } else {
                echo "Erro ao deletar usuário.";
            }
            break;

        default:
            // Método de requisição não suportado
            http_response_code(405); // Código de status 405 - Método não permitido
            echo "Método não permitido.";
            break;
    }
}