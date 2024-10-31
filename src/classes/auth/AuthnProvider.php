<?php

namespace iutnc\deefy\auth;
use iutnc\deefy\exception\AuthnException;
use iutnc\deefy\repository\DeefyRepository;
use PDO;

class AuthnProvider
{
    private static PDO $pdo;

    public static function init(PDO $pdo): void
    {
        self::$pdo = $pdo;
    }

    /**
     * @throws AuthnException
     */
    public static function signin(string $email, string $passwd2check): void
    {
        $query = "SELECT passwd FROM user WHERE email = :email";
        $stmt = self::$pdo->prepare($query);
        $stmt->execute(['email' => $email]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$result || !password_verify($passwd2check, $result['passwd'])) {
            throw new AuthnException("Auth error: invalid credentials");
        }
    }

    public static function getSignedInUser( ): User {
        if ( !isset($_SESSION['user']))
            throw new AuthException("Auth error : not signed in");
        return unserialize($_SESSION['user'] ) ;
    }

    /**
     * @throws AuthnException
     */
    public static function register(string $email, string $passwd): void
    {
        // Check password strength
        if(!self::checkPasswordStrength($passwd, 10))
            throw new AuthnException("Password too weak");

        // Check email validity
        if (!filter_var($email, FILTER_VALIDATE_EMAIL))
            throw new AuthnException(" error : invalid user email");

        // Check if email already exists
        $query = "SELECT COUNT(*) FROM user WHERE email = :email";
        $stmt = self::$pdo->prepare($query);
        $stmt->execute(['email' => $email]);
        if ($stmt->fetchColumn() > 0) {
            throw new AuthnException("An account with this email already exists");
        }

        // Hash the password
        $hashedPasswd = password_hash($passwd, PASSWORD_DEFAULT, ['cost' => 12]);

        // Insert new user into the database
        $query = "INSERT INTO user (email, passwd, role) VALUES (:email, :passwd, 1)";
        $stmt = self::$pdo->prepare($query);
        $stmt->execute([
            'email' => $email,
            'passwd' => $hashedPasswd
        ]);
    }

    private static function checkPasswordStrength(string $pass, int $minimumLength): bool {
        $length = (strlen($pass) >= $minimumLength); // longueur minimale
        $digit = preg_match("#[\d]#", $pass); // au moins un digit
        $special = preg_match("#[\W]#", $pass); // au moins un car. spécial
        $lower = preg_match("#[a-z]#", $pass); // au moins une minuscule
        $upper = preg_match("#[A-Z]#", $pass); // au moins une majuscule
        if (!$length || !$digit || !$special || !$lower || !$upper)return false;
        return true;
    }
}