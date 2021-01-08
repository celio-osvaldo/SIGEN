
 <div class="jumbotron jumbotron-fluid">

  <div class=" col-md-12 card bg-card" >     

      <div class="row">
        <?php 
        $id_usuario=$this->session->userdata('id_usuario');
        $list_companies=$this->Login_model->UserCompanies($id_usuario);

        if ($type==1) {
          ?>
          <div class="card text-center col-md-2" >
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
              <div style="width: 1em;"></div>
              <div class="card text-center col-md-2">
                <div class="card-header"><b>DASA</b></div>
                <div class="card-body">

                    <a href="<?php echo base_url() ?>Welcome/Dasa"><img class="img-fluid" src="<?php echo base_url() ?>Resources/Logos/DASA_logo.png"></a>
                </div>
                  <div class="card-footer text-left">
                    <a href="<?php echo base_url() ?>Dasa/Configuracion"><img width="25px" class="img-fluid" src="<?php echo base_url() ?>Resources/Logos/system2.ico"><label style="font-size: 10pt;"><b>Configuración</b></label></a>
                  </div>               
                </div>

              <?php
              break;
              case 'ILUMINACION':
              ?>

              <div style="width: 1rem;"></div>
              <div class="card text-center col-md-2">
                <div class="card-header"><b>ILUMINACIÓN</b></div>
                <div class="card-body">
                     <a href="<?php echo base_url() ?>Welcome/Iluminacion"><img class="img-fluid" src="<?php echo base_url() ?>Resources/Logos/Logo_ISA.png"></a>
                </div>
                  <div class="card-footer text-left">
                    <a href="<?php echo base_url() ?>Iluminacion/Configuracion"><img width="25px" class="img-fluid" src="<?php echo base_url() ?>Resources/Logos/system2.ico"><label style="font-size: 10pt;"><b>Configuración</b></label></a>
                  </div>
              </div>

              <?php
              break;
              case 'SALINAS':
              ?>
              <div style="width: 1rem;"></div>
              <div class="card text-center col-md-2" >
                <div class="card-header"><b>SALINAS</b></div>
                <div class="card-body">
                  <a href="<?php echo base_url() ?>Welcome/Salinas"><img class="img-fluid"  src="<?php echo base_url() ?>Resources/Logos/SALINAS.png"></a>                
                </div>
                  <div class="card-footer text-left">
                     <a href="<?php echo base_url() ?>Salinas/Configuracion"><img width="25px" class="img-fluid" src="<?php echo base_url() ?>Resources/Logos/system2.ico"><label style="font-size: 10pt;"><b>Configuración</b></label></a>
                  </div>
              </div>
              <?php
              break;
               case 'QM':
              ?>
              <div style="width: 1rem;"></div>
              <div class="card text-center col-md-2">
                <div class="card-header"><b>Quinta Monticello</b></div>
                <div class="card-body">
                  <a href="<?php echo base_url() ?>Welcome/Quinta"><img class="img-fluid" width="100px" src="<?php echo base_url() ?>Resources/Logos/QM.png"></a>                
                </div>
                  <div class="card-footer text-left">
                     <a href="<?php echo base_url() ?>Quinta/Configuracion"><img width="25px" class="img-fluid" src="<?php echo base_url() ?>Resources/Logos/system2.ico"><label style="font-size: 10pt;"><b>Configuración</b></label></a>
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
    <?php 
  }
  ?>
</div>
