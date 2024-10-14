<?php

    namespace iutnc\deefy\dispatch;
    
    use iutnc\deefy\action\DefaultAction;
    use iutnc\deefy\action\DisplayPlaylistAction;
    use iutnc\deefy\action\AddPlaylistAction;
    use iutnc\deefy\action\AddPodcastTrackAction;

    class Dispatcher
    {
        private string $action;

        public function __construct()
        {
            $this->action = $_GET['action'] ?? 'default';
        }
        public function run(): void
        {
            switch ($this->action)
            {
                case 'playlist':
                    $action = new DisplayPlaylistAction();
                    break;
                case 'add-playlist':
                    $action = new AddPlaylistAction();
                    break;
                case 'add-track':
                    $action = new AddPodcastTrackAction();
                    break;
                case 'default':
                default:
                    $action = new DefaultAction();
                    break;
            }
            $html = $action->execute();
            $this->renderPage($html);
        }

        private function renderPage(string $html): void
        {
            $fullDocument = "<!DOCTYPE html>
            <html lang='en'>
            <head>
                <meta charset='UTF-8'>
                <meta name='viewport' content='width=device-width, initial-scale=1.0'>
                <title>Document</title>
            </head>
            <body>
            $html
            </body>
            </html>";
            echo $fullDocument;
        }
    }