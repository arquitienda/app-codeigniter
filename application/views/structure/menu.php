<nav class="navbar navbar-inverse navbar-fixed-top bs-docs-nav" role="navigation">
  
    <div class="navbar-header">

        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>

        <span class="navbar-brand" href="#">Test Aptitud PHP - Pablo Samudia</span>

    </div>

  <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <div class="container">
            <ul class="nav navbar-nav">
            
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Usuarios <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                      <li><a href="<?php echo base_url()?>users">Listado</a></li>
                      <li><a href="<?php echo base_url()?>users/add">Crear nuevo usuario</a></li>
                      <li role="presentation" class="divider"></li>
                      <li>
                        <form action="#" data-redirect="<?php echo base_url()?>users/edit/%id">
                            <div class="col-md-12">
                            <label for="_nav_id_usario">Editar usuario</label>
                            <input id="_nav_id_usario"type="text" class="form-control" name="id" placeholder="id de usuario">
                            </div>
                        </form>
                      </li>  
                    </ul>
                </li>
            </ul>
        </div>
  </div><!-- /.navbar-collapse -->
</nav>