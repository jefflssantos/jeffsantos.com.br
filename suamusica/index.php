<?php require 'app.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="referrer" content="no-referrer" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Sua Música Player Alternativo</title>

    <link rel="apple-touch-icon" sizes="57x57" href="https://jeffsantos.com.br/img/favicon/apple-touch-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="https://jeffsantos.com.br/img/favicon/apple-touch-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="https://jeffsantos.com.br/img/favicon/apple-touch-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="https://jeffsantos.com.br/img/favicon/apple-touch-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="https://jeffsantos.com.br/img/favicon/apple-touch-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="https://jeffsantos.com.br/img/favicon/apple-touch-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="https://jeffsantos.com.br/img/favicon/apple-touch-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="https://jeffsantos.com.br/img/favicon/apple-touch-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="https://jeffsantos.com.br/img/favicon/apple-touch-icon-180x180.png">
    <link rel="icon" type="image/png" href="https://jeffsantos.com.br/img/favicon/favicon-32x32.png" sizes="32x32">
    <link rel="icon" type="image/png" href="https://jeffsantos.com.br/img/favicon/android-chrome-192x192.png" sizes="192x192">
    <link rel="icon" type="image/png" href="https://jeffsantos.com.br/img/favicon/favicon-96x96.png" sizes="96x96">
    <link rel="icon" type="image/png" href="https://jeffsantos.com.br/img/favicon/favicon-16x16.png" sizes="16x16">
    <link rel="manifest" href="https://jeffsantos.com.br/img/favicon/manifest.json">
    <link rel="mask-icon" href="https://jeffsantos.com.br/img/favicon/safari-pinned-tab.svg" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="msapplication-TileImage" content="https://jeffsantos.com.br/img/favicon/mstile-144x144.png">
    <meta name="theme-color" content="#ffffff">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootswatch/4.0.0/darkly/bootstrap.min.css">
    <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
    <link href="app.css" rel="stylesheet">
</head>
<body>
    <div class="container music-list my-3">

        <div class="row">
            <div class="col-12 ">
                <form>
                    <div class="form-group">
                        <input type="text" id="ipt-url" class="form-control p-3" placeholder="Cole a url aqui. Ex.: https://www.suamusica.com.br/oficialavioes/xand-aviao-2018-modo-aviao">
                    </div>
                </form>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card mb-3 album-title" style="background-image: url(<?= $titleBgs[rand(0, count($titleBgs) - 1)]; ?>)">
                    <div class="card-body pt-5">
                        <h1 class="center-block pt-5"><strong><?= $album['title']; ?></strong></h1>
                    </div>
                    <div class="opacity"></div>
                </div>
                <div class="list-group">
                  <?php foreach ($album['musics'] as $i => $music): ?>
                    <button type="button" class="list-group-item list-group-item-action music-box <?= $i == 0 ? 'active' : '' ?>">
                        <?php
                            $number =  explode(' ', $music->titulo)[0];
                            $title = str_replace(["{$number}-", "{$number}- ", "{$number} -", "{$number} ", '.mp3'], '', $music->titulo);
                        ?>
                        <span class="mr-3"><?= $number ?></span><span><?= $title ?></span>
                        <div class="hidden music-data">
                            <input type="hidden" class="music-url" value="<?= getMusicUrl($music) ?>">
                        </div>
                    </button>
                  <?php endforeach ?>

                </div>
            </div>
        </div>

        <div class="mb-5 pb-3 px-3">
            <div class="row my-3">
                <div class="col-12">By Jefferson Santos <a href="https://jeffsantos.com.br/" target="_blank">@jefflssantos</a></div>
            </div>
            <?php if(isset($_GET['q'])): ?>
                <div class="row my-3">
                    <div class="col-12"><a href="<?= $_GET['q'] ?>" target="_blank">Abrir álbum no Sua Música</a></div>
                </div>
            <?php endif ?>
        </div>
    </div>

    <?php if(isset($_GET['q'])): ?>
        <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-bottom py-1 px-3">
            <img src="<?= $album['thumbnail'] ?>" class="img-fluid navbar-brand">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarText">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <span class="nav-link" id="btn-previous"><i class="fas fa-step-backward"></i></span>
                    </li>
                    <li class="nav-item">
                        <span class="nav-link" id="btn-play"><i class="fas fa-play"></i></span>
                    </li>
                    <li class="nav-item">
                        <span class="nav-link" id="btn-pause"><i class="fas fa-pause"></i></span>
                    </li>
                    <li class="nav-item">
                        <span class="nav-link" id="btn-next"><i class="fas fa-step-forward"></i></span>
                    </li>
                </ul>
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item">
                        <span class="nav-link" id="time-start"><i class="fas fa-spinner"></i></span>
                    </li>
                    <li class="nav-item">
                        <span class="nav-link mx-5 current-playing"></span>
                    </li>
                    <li class="nav-item">
                        <span class="nav-link" id="time-end"><i class="fas fa-spinner"></i></span>
                    </li>
                </ul>
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <span class="nav-link"><i class="fas fa-volume-up" id="btn-audio-up"></i></span>
                    </li>
                    <li class="nav-item">
                        <span class="nav-link"><i class="fas fa-volume-off" id="btn-audio-off"></i></span>
                    </li>

                    <li class="nav-item">
                        <span class="nav-link" id="options">opcões</span>
                    </li>
                </ul>
          </div>
        </nav>

<!--         <audio id="player" controls preload="none" class="d-none">
            <source src="<?= getMusicUrl($album['musics'][0]) ?>" id="mp3-source" type="audio/mp3">
        </audio>

        <audio id="player-buffer" class="d-none" controls preload="none">
            <source src="#" id="mp3-source-buffer" type="audio/mp3">
        </audio> -->

        <video id="player" player width="352" height="198" controls preload="none">
            <source src="https://web-stream.suamusica.com.br/373377/2277878/stream/04%20Sexo.m3u8" id="mp3-source" type="application/x-mpegURL">
            <!-- <source src="<?= getMusicUrl($album['musics'][0]) ?>" id="mp3-source" type="application/x-mpegURL"> -->
        </video>

        <video id="player-buffer" player width="352" height="198" controls preload="none">
            <source src="#" id="mp3-source-buffer" type="application/x-mpegURL">
        </video>
    <?php endif ?>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js" defer></script>
    <script src="app.js?v=2" defer></script>
</body>
</html>
