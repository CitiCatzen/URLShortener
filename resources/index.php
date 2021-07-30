<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>URL Shortener</title>
</head>
<body class="d-flex h-100 text-center text-white bg-dark">
<div class="cover-container d-flex w-100 h-100 p-3 mx-auto flex-column">
<main class="px-3">
    <?php
    if (isset($_SESSION['data'])):
        if (isset($_SESSION['data']['error'])): ?>
            <div class="alert alert-danger" role="alert">
                <?=$_SESSION['data']['error']?>
            </div>
    <?php elseif (isset($_SESSION['data']['short_url'])): ?>
            <div class="alert alert-success" role="alert">
                WOW, it's your link -
                <a class="link-success" href="<?='/api/' . $_SESSION['data']['short_url']?>">
                    <?='http://' . $_SERVER['HTTP_HOST'] . '/api/' . $_SESSION['data']['short_url']?>
                </a>
                !
            </div>
    <?php endif;
    endif?>

    <form class="container lead" method="post" action="/">
        <h1 class="main">URL Shortener</h1>
        <div class="field">
            <label class="label">Enter your link</label>
            <div class="control">
                <input type="url" class="input" name="url" placeholder="Enter link">
            </div>
        </div>
        <div class="field">
            <label class="label">You can set a custom link in format: <i>test or test/test-section</i></label>
            <div class="control">
                <input type="text" class="input" name="custom_url" placeholder="Enter custom link">
            </div>
        </div>
        <button class="btn btn-primary">Shorten my link!</button>
    </form>
</main>
</div>
</body>
</html>
