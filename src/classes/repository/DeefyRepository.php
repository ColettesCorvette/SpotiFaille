<?php

namespace iutnc\deefy\repository;

use DateTime;
use Exception;
use iutnc\deefy\audio\lists\Playlist;
use iutnc\deefy\audio\tracks\AlbumTrack;
use iutnc\deefy\audio\tracks\AudioTrack;
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
        if(!$row)
            throw new \Exception("Playlist non trouvée");

        $playlist = new Playlist($row['nom'],[]);
        $playlist->setID($row['id']);
        return $playlist;
    }
    public function saveEmptyPlaylist(Playlist $p) : Playlist
    {
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
            'playlist_id' => $playlistId,
            'track_id' => $trackId,
            'no_piste_dans_liste' => DeefyRepository::getInstance()->findPlaylistById($playlistId)->nombrePistes+1
        ]);
    }

    public function saveTrack(AudioTrack $track): AudioTrack
    {
        $albumName = '';
        $dateAlbum = 0;
        $artiste = '';
        if($track instanceof AlbumTrack) {
            $type = 'A';
            $albumName = $track->album;
            $dateAlbum = (int) $track->annee;
            $artiste = $track->artiste;
        }
        else{
            $type = 'P';
            $datePodcast = $track->date;
            $auteur = $track->auteur;
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
            'filename' => $track->nomFichier,
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


