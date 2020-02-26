 <title> <?php echo $title ?>  </title>
  <br>
  <div class="jumbotron jumbotron-fluid">

      <div class=" col-lg-12 card bg-card">
        <br>        
        <div class="container">
          <div class="row">


    <?php 
    $id_usuario=$this->session->userdata('id_usuario');
    $list_companies=$this->Login_model->UserCompanies($id_usuario);


    if (isset($list_companies)) {
      foreach ($list_companies as $key) {
       // echo $key['empresa_nom'];
        switch ($key['empresa_nom']) {
          case 'DASA':
          ?>
            <div class="col-sm-1"></div>
            <div class="card text-center" style="width: 15rem;">
              <div class="card-header"></div>
              <div class="card-body">
                <a href="<?php echo base_url() ?>Welcome/Dasa"><img class="img-fluid" src="<?php echo base_url() ?>Resources/Logos/DASA_logo.png"></a>
              </div>
            </div>
            <?php
            break;
          case 'ILUMINACION':
          ?>

            <div class="col-md-1"></div>
            <div class="card text-center" style="width: 15rem;">
              <div class="card-header"></div>
              <div class="card-body">
                <a href="<?php echo base_url() ?>Welcome/Iluminacion"><img class="img-fluid" src="<?php echo base_url() ?>Resources/Logos/Logo_ISA.png"></a> 
              </div>
            </div>

          <?php
          break;
          case 'SALINAS':
          ?>
            <div class="col-md-1"></div>
            <div class="card text-center" style="width: 15rem;">
              <div class="card-header"></div>
              <div class="card-body">
                <a href="<?php echo base_url() ?>Welcome/Salinas"><img class="img-fluid" src="<?php echo base_url() ?>Resources/Logos/SALINAS.png"></a>
              </div>
            </div>


          <?php
          break;
          default:
            # code...
            break;
        }
      }
      ?>            


          </div> 
        </div>
        <br>
      </div>
      <?php 
    }

    ?>


  </div>
