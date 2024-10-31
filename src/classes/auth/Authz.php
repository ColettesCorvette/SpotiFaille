<?php

namespace iutnc\deefy\auth;

use iutnc\deefy\exception\AuthzException;
use iutnc\deefy\repository\DeefyRepository;

class Authz
{
    public static function checkRole(string $expectedRole): void
    {
        $user = AuthnProvider::getSignedInUser();
        if ($user->getRole() !== $expectedRole) {
            throw new AuthzException("Access denied: insufficient role");
        }
    }

    public static function checkPlaylistOwner(int $playlistId): void
    {
        $user = AuthnProvider::getSignedInUser();
        $pdo = DeefyRepository::getInstance()->getPdo();

        $query = "SELECT owner_id FROM playlist WHERE id = :id";
        $stmt = $pdo->prepare($query);
        $stmt->execute(['id' => $playlistId]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$result || ($result['owner_id'] !== $user->getId() && $user->getRole() !== 'ADMIN')) {
            throw new AuthzException("Access denied: not the owner or admin");
        }
    }
}