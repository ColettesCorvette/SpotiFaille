<?php

    namespace iutnc\deefy\dispatch;
    
    use iutnc\deefy\action\AddUserAction;
    use iutnc\deefy\action\DefaultAction;
    use iutnc\deefy\action\DisplayPlaylistAction;
    use iutnc\deefy\action\AddPlaylistAction;
    use iutnc\deefy\action\AddPodcastTrackAction;

    class Dispatcher
    {
        public function run(): void
        {
            $action = $_GET['action'] ?? 'default';

            switch ($action)
            {
                case 'add-playlist':
                    $actionInstance = new AddPlaylistAction();
                    break;
                case 'add-track':
                    $actionInstance = new AddPodcastTrackAction();
                    break;
                case 'display-playlist':
                    $actionInstance = new DisplayPlaylistAction();
                    break;
                case 'add-user':
                    $actionInstance = new AddUserAction();
                    break;
                default:
                    $actionInstance = new DefaultAction();
                    break;
            }
            $this->renderPage($actionInstance->execute());
        }


        private function renderPage(string $html): void
        {
            $fullDocument = <<<HTML
            <!DOCTYPE html>
            <html lang='en'>
            <head>
                <meta charset='UTF-8'>
                <meta name='viewport' content='width=device-width, initial-scale=1.0'>
                <title>SpotiFail</title>
            </head>
            <body>
                <header>
                    <h1>SpotiFaille</h1>
                    <nav>
                        <ul>
                            <li><a href="?action=default">Accueil</a></li>
                            <li><a href="?action=add-user">S'identifier</a></li>
                            <li><a href="?action=add-playlist">Créer une playlist</a></li>
                            <li><a href="?action=display-playlist">Afficher la playlist</a></li>
                        </ul>
                    </nav>
                </header>
                <main>
                    $html
                </main>
            </body>
            </html>
            HTML;
            echo $fullDocument;
        }
    }