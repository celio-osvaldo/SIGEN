
 <div class="jumbotron jumbotron-fluid">

  <div class=" col-md-12 card bg-card" >     
    <div class="container">
      <div class="row">
        <?php 
        $id_usuario=$this->session->userdata('id_usuario');
        $list_companies=$this->Login_model->UserCompanies($id_usuario);

        if ($type==1) {
          ?>
          <div class="card text-center" style="width: 15rem;">
            <div class="card-header"><b>Administrador</b></div>
            <div class="card-body">
              <a href="<?php echo base_url() ?>Welcome/LogSuperUser"><img class="img-fluid" src="<?php echo base_url() ?>Resources/Logos/Super_user.ico"></a>
            </div>
          </div>
          <?php
        }

        if (isset($list_companies)) {
          foreach ($list_companies as $key) {
       // echo $key['empresa_nom'];
            switch ($key['empresa_nom']) {
              case 'DASA':
              ?>
              <div style="width: 2em;"></div>
              <div class="card text-center" style="width: 15rem;">
                <div class="card-header"><b>DASA</b></div>
                <div class="card-body">

                    <a href="<?php echo base_url() ?>Welcome/Dasa"><img class="img-fluid" src="<?php echo base_url() ?>Resources/Logos/DASA_logo.png"></a>
                </div>
                  <div class="card-footer">
                    <a href="<?php echo base_url() ?>Dasa/Configuracion"><img class="img-fluid" src="<?php echo base_url() ?>Resources/Logos/system2.ico"><label><b>Configuración</b></label></a>
                  </div>               
                </div>

              <?php
              break;
              case 'ILUMINACION':
              ?>

              <div style="width: 2rem;"></div>
              <div class="card text-center" style="width: 15rem;">
                <div class="card-header"><b>ILUMINACIÓN</b></div>
                <div class="card-body">
                     <a href="<?php echo base_url() ?>Welcome/Iluminacion"><img class="img-fluid" src="<?php echo base_url() ?>Resources/Logos/Logo_ISA.png"></a>
                </div>
                  <div class="card-footer">
                    <a href="<?php echo base_url() ?>Iluminacion/Configuracion"><img class="img-fluid" src="<?php echo base_url() ?>Resources/Logos/system2.ico"><label><b>Configuración</b></label></a>
                  </div>
              </div>

              <?php
              break;
              case 'SALINAS':
              ?>
              <div style="width: 2rem;"></div>
              <div class="card text-center" style="width: 15rem;">
                <div class="card-header"><b>SALINAS</b></div>
                <div class="card-body">
                  <a href="<?php echo base_url() ?>Welcome/Salinas"><img class="img-fluid" src="<?php echo base_url() ?>Resources/Logos/SALINAS.png"></a>                
                </div>
                  <div class="card-footer">
                     <a href="<?php echo base_url() ?>Salinas/Configuracion"><img class="img-fluid" src="<?php echo base_url() ?>Resources/Logos/system2.ico"><label><b>Configuración</b></label></a>
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
