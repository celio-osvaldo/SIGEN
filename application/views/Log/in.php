<!DOCTYPE html>
  <html>
    <head>
      <title> <?php echo $title ?> | Inico de sesión</title>
      <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
      <link rel="shortcut icon" href="./Resources/icons/Boo_24669.ico">
      <link rel="stylesheet" type="text/css" href=".\assets\bootstrap_4.4\css\bootstrap.min.css">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
      <link rel="stylesheet" type="text/css" href="./assets/Personalized/css/LoginStyles.css">
      <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
      <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
      </head>

  <body>
      <div class="modal-dialog text-center">
        <div class="col-sm-8 main-section">
          <div class="modal-content">
      
            <div class="col-12 user-img">
              <img src="./Resources/Icons/user_84308.png">
            </div>
            <form method="post" action="<?php echo base_url() ?>Welcome/SetSession" class="col-12">
              <div class="form-group">
                <input type="text" id="user" name="user" class="form-control" placeholder="Usuario" required>
              </div>
              <div class="form-group">
                <input type="password" id="pass" name="pass" class="form-control" placeholder="Contraseña" required>
              </div>
              <input type="submit" value="Entrar" class="btn btn-outline-success" >
            </form>
            <br>
            <div class="col-12 forgot">
              <label class="control-label" style="color: red; font-size: 16px;"><?php if ($error): ?> 
                <p> <?php echo $error ?> </p>
                    <?php endif; ?>
              </label>
            </div>
            <div class="col-12 forgot">
              <a href="<?php echo base_url() ?>Welcome/Dasa/">SiGeN</a>
            </div>
          </div> <!-- END-MODAL-->
        </div>
      </div>
      <script type="text/javascript" href=".\assets\bootstrap_4.4\js\bootstrap.min.js"></script>
    </body>
    </html>