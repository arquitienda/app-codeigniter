<?php

$this->ui->box->add( $this->ui->box->load( 'ui/box/projects_action.php'), 2 );

?>
<div class="container">
    <div class="row">
        <div class="col-md-4" >
            <?php echo $this->load->view('users/box/actions.php')?>
        </div>
        <div class="col-md-8">
            <h1>Proyectos</h1>

            <table class="table">
                <thead>
                    <tr>
                        <th>id</th>
                        <th>Nombre del proyecto</th>
                        <th>Inicio</th>
                        <th>Presupuesto</th>
                        <th>Costo actual</th>
                        <th>Deadline</th>
                        <th>Estado</th>
                        <th>Acciones</th>

                    </tr>
                </thead>
                <tbody>
                    <?php 
                        if( !empty ( $results ) ) {
                            foreach( $results AS $row ) {
                                ?>
                                <tr>
                                    <td><?php echo $row->id ?></td>
                                    <td><?php echo $row->projectname ?></td>
                                    <td><?php echo $row->startdate ?></td>
                                    <td><?php echo $row->budget ?></td>
                                    <td><?php echo $row->actualcost ?></td>
                                    <td><?php echo $row->enddate ?></td>
                                    <td>
                                        <?php 
                                            if( $row->isfinished == 0 ) {
                                                $label = 'activo';
                                                $class = 'label label-success';
                                            } else {
                                                $label = 'cerrado';
                                                $class = 'label label-danger';
                                            }

                                        ?>
                                        <span class="<?php echo $class?>"><?php echo $label ?></span>

                                    </td>
                                    <td><a class="btn btn-success" href="<?php echo base_url()?>projects/edit/<?php echo $row->id ?>">editar</a></td>
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

