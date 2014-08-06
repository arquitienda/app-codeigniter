<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title">Acciones Rapidas</h3>
  </div>
  <div class="panel-body">

    <div class="list-group">
        <a class="list-group-item" href="<?php echo base_url()?>users/add">Crear usuarios</a>
    </div>      
    <form action="#" data-redirect="<?php echo base_url()?>projects/%id">
    
        <label for="_box_switch_user_id">
            Ver proyectos de un usuario
        </label>

        <input type="text" class="form-control" name="id" placeholder="Id de usuario">

    </form>

  </div>
</div>