<!DOCTYPE html>
<html lang="sk">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Predpoveď počasia</title>

    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

    <link href="css/base.css" rel="stylesheet">
</head>

<body>
    <div class="container main-container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h2>Predpoveď počasia</h2>
                    </div>
                    <div class="card-body">
                        <form action="post_handler.php" method="POST">
                            <div class="form-group">
                                <label for="city">Mesto:</label>
                                <input type="text" class="form-control" id="city" name="city"
                                    placeholder="Zadajte mesto" required>
                            </div>

                            <div class="form-group">
                                <label for="date">Dátum:</label>
                                <input type="date" class="form-control" id="date" name="date" required>
                            </div>

                            <button type="submit" class="btn btn-primary btn-block">Odoslať</button>
                        </form>

                        <?php if (isset($_GET['status'])): ?>
                            <?php if ($_GET['status'] === 'success'): ?>
                                <div class="alert alert-success">
                                    Predpoveď bola úspešne získaná. <a href="download.php" class="alert-link">Stiahnuť Excel
                                        súbor môžete tu</a>
                                </div>
                            <?php else: ?>
                                <div class="alert alert-danger">
                                    Došlo k chybe pri získavaní údajov. Pozri log API volaní.
                                </div>
                            <?php endif; ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script src="js/base.js"></script>
</body>

</html>