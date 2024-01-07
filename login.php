<!DOCTYPE html>
<html lang="en">
<?php
session_start();
include('./db_connect.php');
?>

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Login | EMSI QUIZ</title>
    <?php include('./header.php'); ?>
    <?php
    if (isset($_SESSION['login_id']))
        header("location:index.php?page=home");
    ?>
    <style>
        body {
            width: 100%;
            height: calc(100%);
            position: fixed;
            top: 0;
            left: 0;
        }

        main#main {
            width: 100%;
            height: calc(100%);
            display: flex;
        }

        body {
            width: 100%;
            height: calc(100%);
            position: fixed;
            top: 0;
            left: 0;
        }

        main#main {
            width: 100%;
            height: calc(100%);
            display: flex;
        }

        .login-btn {
            font-size: 20px; /* Ajoutez la taille de police souhaitée */
        }
    </style>
</head>

<body class="bg-dark">
    <main id="main">
        <div class="container-fluid h-100 d-flex align-items-center">
            <div class="mx-auto col-md-4">
                <div class="card">
                    <div class="logo-container">
                        <img src="emsi quiz log.png" alt="Logo" class="img-fluid">
                    </div>
                    <div class="card-header text-center">
                        <!-- Votre code existant pour le logo va ici -->
                    </div>
                    <div class="card-body">
                        <h4 class="card-title text-center text-dark"><b> EMSI QUIZ</b> <BR></h4>
                        <form id="login-form">
                            <div class="form-group">
                                <label for="email" class="control-label text-dark">Email</label>
                                <input type="text" id="email" name="email" class="form-control form-control-sm">
                            </div>
                            <div class="form-group">
                                <label for="password" class="control-label text-dark">Password</label>
                                <input type="password" id="password" name="password" class="form-control form-control-sm">
                            </div>
                            <button class="btn-sm btn-block btn-wave btn-primary login-btn">Login</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <a href="#" class="back-to-top"><i class="icofont-simple-up"></i></a>
</body>
<script>
	$('#login-form').submit(function (e) {
		e.preventDefault()
		$('#login-form button[type="button"]').attr('disabled', true).html('Logging in...');
		if ($(this).find('.alert-danger').length > 0)
			$(this).find('.alert-danger').remove();
		$.ajax({
			url: 'ajax.php?action=login',
			method: 'POST',
			data: $(this).serialize(),
			error: err => {
				console.log(err)
				$('#login-form button[type="button"]').removeAttr('disabled').html('Login');

			},
			success: function (resp) {
				if (resp == 1) {
					location.href = 'index.php?page=home';
				} else {
					$('#login-form').prepend('<div class="alert alert-danger">Username or password is incorrect.</div>')
					$('#login-form button[type="button"]').removeAttr('disabled').html('Login');
				}
			}
		})
	})
	$('.number').on('input', function () {
		var val = $(this).val()
		val = val.replace(/[^0-9 \,]/, '');
		$(this).val(val)
	})
</script>

</html>