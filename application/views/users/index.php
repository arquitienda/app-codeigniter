<?php
    
    $this->ui->box->add( $this->ui->box->load( 'ui/box/users_action.php'), 2 );

?>
<div class="container">
    <div class="row">
        <div class="col-md-4" >
            <?php echo $this->load->view('users/box/actions.php')?>
        </div>
        <div class="col-md-8">
            <h1>Usuarios</h1>

            <table class="table">
                <thead>
                    <tr>
                        <th>id</th>
                        <th>Nombre</th>
                        <th>Email</th>
                        <th>Level</th>
                        <th>Activo</th>
                        <th colspan="2">Acciones</th>

                    </tr>
                </thead>
                <tbody>
                    <?php 
                        if( !empty ( $results ) ) {
                            foreach( $results AS $row ) {
                                ?>
                                <tr>
                                    <td><?php echo $row->id ?></td>
                                    <td><?php echo $row->name ?></td>
                                    <td><?php echo $row->email ?></td>
                                    <td>Nivel <?php echo $row->level ?></td>
                                    <td><?php echo ( $row->isEnabled === 1 ) ? 'Si' : 'No' ;?></td>
                                    <td><a href="<?php echo base_url()?>users/edit/<?php echo $row->id ?>">editar</a></td>
                                    <td><a class="btn btn-default" href="<?php echo base_url()?>projects/<?php echo $row->id ?>">ver projectos</a></td>
                                </tr>
                                <?php
                            }
                        }
                    ?>
                </tbody>
            </table >
            <?php echo $pagination ?>
        </div>
    </div>
</div>

