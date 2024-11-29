<?php

namespace App\Controller;

use App\Repository\UtilisateurRepository;

class UtilisateurController{
    const ROOT = __DIR__ . '/../../';
    private $utilisateurRepository;

    public function __construct()
    {
        $this->utilisateurRepository = new UtilisateurRepository();
    }

    public function register(){
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $nom = $_POST['nom'];
            $email = $_POST['email'];
            $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
            $this->utilisateurRepository->create([
                'nom' => $nom,
                'email' => $email,
                'motDePasse' => $password,
                'type' => 'client'
            ]);
            header('Location: /login');
            exit;
        }
        include self::ROOT . 'src/View/Utilisateurs/register.php';
    }
    public function login()
    {   
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $email = $_POST['email'];
            $password = $_POST['password'];
            $utilisateur = $this->utilisateurRepository->findBy(['search' => ['email' => $email]])[0];
            
            if($utilisateur && password_verify($password, $utilisateur['motDePasse'])){
                $_SESSION['utilisateur'] = $utilisateur;
                header('Location: /');
                exit;
            }
        }
        include self::ROOT . 'src/View/Utilisateurs/login.php';
    }

    public function logout(){
        session_destroy();
        header('Location: /login');
        exit;
    }
}