<div class="container">
  <div class="row well">
    <div class="col-sm-3">
      <img src="img/robot1.png" class="img-responsive" alt="Image" width="300" height="200">
    </div>
    <div class="col-sm-9 lead">
      <h2 class="text-info">Bienvenido al Centro de Soporte Tecnico</h2>
      <p>Al usar nuestro sistema de gestión de levantamiento de tickets nos ayudas a que podamos brindarte un mejor servicio para tus operaciones, te recomendamos leer la tabla de. lista de procesos para que sepas con quien tienes que acudir. <strong>Gracias</strong>.</p>

      
    </div>
  </div><!--fin row 1-->

  <div class="row">
    <div class="col-sm-6">
      <div class="panel panel-info">
        <div class="panel-heading text-center"><i class="fa fa-file-text"></i>&nbsp;<strong>Nuevo Ticket</strong></div>
        <div class="panel-body text-center">
          <img src="./img/new_ticket.png" alt="">
          <h4>Abrir un nuevo ticket</h4>
          <p class="text-justify">Si Tienes algun problema de Soporte Técnico Redes o de Sistemas, Ayudanos levantando un ticket recuerda que para esta plataforma se recomienda levantar un ticket de algo relevante y nuestros colaboradores llevaran el seguimiento y solución  a tu problema.   <em>Comprobar estado de Ticket</em>, solamente los <strong>usuarios registrados</strong> pueden abrir un nuevo ticket.</p>
          <p>Para abrir un nuevo <strong>ticket</strong> has click en el siguiente boton</p>
          <a type="button" class="btn btn-info" href="./index.php?view=ticket">Nuevo Ticket</a>
        </div>
      </div>
    </div><!--fin col-md-6-->
    
    <?php 
    if(isset($_SESSION['nombre'])){
    if($_SESSION['nombre'] != ""){ ?>
    <input type="hidden" value=" <?php echo $_SESSION['nombre'];?>" id="nombre_usuario">
    <div class="col-sm-6">
      <div class="panel panel-danger">
        <div class="table-responsive">
            <?php
                $mysqli = mysqli_connect(SERVER, USER, PASS, BD);
                mysqli_set_charset($mysqli, "utf8");
                $nombre_usuario = $_SESSION['nombre'];

                $pagina = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
                $regpagina = 15;
                $inicio = ($pagina > 1) ? (($pagina * $regpagina) - $regpagina) : 0;

                
                if(isset($_GET['ticket'])){
                    if($_GET['ticket']=="pending"){
                        $consulta="SELECT SQL_CALC_FOUND_ROWS * FROM ticket WHERE estado_ticket='Pendiente' or estado_ticket='En proceso'  and nombre_usuario like'$nombre_usuario'";
                    }else{
                        $consulta="SELECT SQL_CALC_FOUND_ROWS * FROM ticket where estado_ticket='Pendiente' or estado_ticket='En proceso' and nombre_usuario like'$nombre_usuario' ";
                    }
                }else{
                    $consulta="SELECT SQL_CALC_FOUND_ROWS * FROM ticket where estado_ticket='Pendiente' or estado_ticket='En proceso' and nombre_usuario like'$nombre_usuario'";
                }


                $selticket=mysqli_query($mysqli,$consulta);

                $totalregistros = mysqli_query($mysqli,"SELECT FOUND_ROWS()");
                $totalregistros = mysqli_fetch_array($totalregistros, MYSQLI_ASSOC);
        
                $numeropaginas = ceil($totalregistros["FOUND_ROWS()"]/$regpagina);

                if(mysqli_num_rows($selticket)>0):
            ?>
            <table class="table table-hover table-striped table-bordered">
                <thead>
                    <tr>
                        <th class="text-center">#</th>
                        <th class="text-center">Fecha</th>
                        <th class="text-center">Serie</th>
                        <th class="text-center">Estado</th>
                        <th class="text-center">Agente</th>
                        
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $ct=$inicio+1;
                        while ($row=mysqli_fetch_array($selticket, MYSQLI_ASSOC)): 
                    ?>
                    <tr>
                        <td class="text-center"><?php echo $ct; ?></td>
                        <td class="text-center"><?php echo $row['fecha']; ?></td>
                        <td class="text-center"><?php echo $row['serie']; ?></td>
                        <td class="text-center"><?php echo $row['estado_ticket']; ?></td>
                        <td class="text-center"><?php echo $row['agente']; ?></td>
                        
                            <form action="" method="POST" style="display: inline-block;">
                                <input type="hidden" name="id_del" value="<?php echo $row['id']; ?>">
                                
                            </form>
                        </td>
                    </tr>
                    <?php
                        $ct++;
                        endwhile; 
                    ?>
                </tbody>
            </table>
            <?php else: ?>
                <h2 class="text-center">No hay tickets registrados en el sistema</h2>
            <?php endif; ?>
          </div>
      </div>
    </div><!--fin col-md-6-->

    <?php } } else { ?>
      <div class="col-sm-6">
      <div class="panel panel-danger">
        <div class="panel-heading text-center"><i class="fa fa-link"></i>&nbsp;<strong>Comprobar estado de Ticket</strong></div>
        <div class="panel-body text-center">
          <img src="./img/old_ticket.png" alt="">
          <h4>Colsultar estado de ticket</h4>
          <form class="form-horizontal" role="form" method="GET" action="./index.php">
            <input type="hidden" name="view" value="ticketcon">
            <div class="form-group">
              <label for="inputEmail3" class="col-sm-2 control-label">Email</label>
              <div class="col-sm-10">
                  <input type="email" class="form-control" name="email_consul" placeholder="Email" required="">
              </div>
            </div>
            <div class="form-group">
              <label  class="col-sm-2 control-label">ID Ticket</label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" name="id_consul" placeholder="ID Ticket" required="">
              </div>
            </div>
            <div class="form-group">
              <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-success">Colsultar</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div><!--fin col-md-6-->
  </div><!--fin row 2-->
    <?php } ?>
  </div><!--fin row 2-->
</div><!--fin container-->