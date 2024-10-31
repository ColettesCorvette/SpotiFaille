<?php

namespace iutnc\deefy\repository;
use Exception;
use iutnc\deefy\audio\lists\Playlist;
use iutnc\deefy\audio\tracks\AlbumTrack;
use iutnc\deefy\audio\tracks\AudioTrack;
use iutnc\deefy\audio\tracks\PodcastTrack;
use PDO;

class DeefyRepository 
{
    private PDO $pdo;
    private static ?DeefyRepository $instance = null;
    private static array $conf = [];

    private function __construct(array $conf)
    {
        $this->pdo = new \PDO($conf['dsn'], $conf['user'], $conf['pass'],
        [\PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION]);
    }
    public static function getInstance(): ?DeefyRepository
    {
        if (is_null(self::$instance)){
            self::$instance = new DeefyRepository(self::$conf);
        }
        return self::$instance;
    }

    public static function setConfig(string $file) : void
    {
        $conf = parse_ini_file($file);
        if(!$conf)
            throw new \Exception("Erreur lecture fichier de configuration");

        self::$conf = [
            'dsn' => "{$conf['driver']}:host={$conf['host']};dbname={$conf['dbname']}",
            'user' => $conf['username'],
            'pass' => $conf['password']
        ];
    }

    /**
     * @throws Exception
     */
    public function findPlaylistById(int $id) : Playlist
    {
        $query = "SELECT * FROM playlist WHERE id = :id";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute(['id' => $id]);
        $row = $stmt->fetch();
        if (!$row) {
            throw new \Exception("Playlist non trouvée");
        }

        $playlist = new Playlist($row['nom'], []);
        $playlist->setID($row['id']);

        // Récupérer les pistes associées à la playlist
        $trackQuery = "SELECT t.* FROM track t 
                   JOIN playlist2track p2t ON t.id = p2t.id_track 
                   WHERE p2t.id_pl = :id";
        $trackStmt = $this->pdo->prepare($trackQuery);
        $trackStmt->execute(['id' => $id]);
        $tracks = $trackStmt->fetchAll();

        foreach ($tracks as $trackRow) {
            if ($trackRow['type'] === 'A') {
                $track = new AlbumTrack(
                    $trackRow['artiste_album'],
                    $trackRow['titre'],
                    $trackRow['annee_album'],
                    $trackRow['genre'],
                    $trackRow['filename'],
                    $trackRow['duree'],
                    $trackRow['numero_album'] ?? 0,
                    0
                );
            } else {
                $track = new PodcastTrack(
                    $trackRow['auteur_podcast'],
                    $trackRow['titre'],
                    $trackRow['genre'],
                    $trackRow['duree'],
                    $trackRow['filename'],
                    $trackRow['numero_album'] ?? 0,
                    $trackRow['date_podcast']
                );
            }
            $track->setID($trackRow['id']);
            $playlist->ajout($track);
        }

        return $playlist;
    }
    public function saveEmptyPlaylist(Playlist $p) : Playlist
    {
        $this->pdo->exec("ALTER TABLE playlist AUTO_INCREMENT = 1");
        $query = "INSERT INTO playlist (nom) VALUES (:nom)";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute(['nom' => $p->nom]);
        $p->setID($this->pdo->lastInsertId());
        return $p;
    }

    public function getAllPlaylists(): array
    {
        $query = "SELECT * FROM playlist";
        $statement = $this->pdo->query($query);
        $playlists = [];
        while ($row = $statement->fetch()) {
            $playlist = new Playlist($row['nom'],[]);
            $playlist->setID($row['id']);
            $playlists[] = $playlist;
        }
        return $playlists;
    }

    public function addTrackToPlaylist(int $trackId, int $playlistId): void
    {
        $query = "INSERT INTO playlist2track (id_pl, id_track, no_piste_dans_liste) VALUES (:id_pl, :id_track, :no_piste_dans_liste)";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute([
            'id_pl' => $playlistId,
            'id_track' => $trackId,
            'no_piste_dans_liste' => DeefyRepository::getInstance()->findPlaylistById($playlistId)->nombrePistes+1
        ]);
    }

    public function saveTrack(AudioTrack $track): AudioTrack
    {
        $this->pdo->exec("ALTER TABLE track AUTO_INCREMENT = 1");
        $albumName = null;
        $artiste = null;
        $filePath = $track->nomFichier;
        $audioFile = str_replace("audio/", "", $filePath);

        if($track instanceof AlbumTrack) {
            $type = 'A';
            $albumName = $track->album;
            $dateAlbum = (int)$track->annee;
            $artiste = $track->artiste;
        }
        else if($track instanceof PodcastTrack) {
            $type = 'P';
            $datePodcast = $track->date;
            $auteur = $track->auteur;
            $dateAlbum = null;
        }
        $query = "INSERT INTO track (titre, genre, duree, filename, type, artiste_album, 
                   titre_album, annee_album, numero_album, auteur_podcast, date_podcast) 
                    VALUES (:titre, :genre, :duree, :filename, :type, :artiste_album, :titre_album, 
                            :annee_album, :numero_album, :auteur_podcast, :date_podcast)";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute([
            'titre' => $track->titre,
            'genre' => $track->genre,
            'duree' => $track->duree,
            'filename' => $audioFile,
            'type' => $type,
            'artiste_album' => $artiste,
            'titre_album' => $albumName,
            'annee_album' => $dateAlbum,
            'numero_album' => $track->numero,
            'auteur_podcast' => $auteur,
            'date_podcast' => $datePodcast
        ]);
        $track->setID($this->pdo->lastInsertId());
        return $track;
    }
}


