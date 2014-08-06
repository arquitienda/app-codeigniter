<?php
    $_formData = array(
        "projectname" => '',
        "iduser" => '',
        "actualcost" => '',
        "budget" => '',
        "startdate" => '',
        "enddate" => '',
        "isfinished" => ''
    );

    $action = 'add';

    $title = 'Crear nuevo';

    $this->ui->box->add( 
        $this->ui->box->load(
            'ui/box/return.php', 
            array(
                'box_data' => array(
                    'link' => base_url() .'projects',
                    'title' => 'volver',
                    //'class' => ''
                )
            )
        ), 5
    );

    if( isset( $data ) ) {
        $_formData = array_merge( $_formData, $data );
        if( isset ( $_formData['id'] ) ) {
            $action = 'edit/' . $_formData['id'];
            $title = 'Editar';
            
        }
    }
?>

<div class="container">
    <div class="row">
        <div class="col-md-4">
            <?php echo $this->load->view('users/box/actions.php')?>
        </div>

        <div class="col-md-8">
            <h1><?php echo $title ?> proyecto</h1>
            <form action="<?php echo base_url()?>projects/<?php echo $action ?>" method="POST" role="form">
                <?php 
                    // Agrego el input para el fk
                    if( isset ( $_formData['id'] ) ) {
                        ?>
                        <input type="hidden" name="id" value="<?php echo $_formData['id'] ?>" />
                        <?php
                    }
                ?>

                <div class="form-group <?php if( isset( $errors['projectname'] ) ) echo 'has-error' ?>">
                   
                    <label for="inp_name">Nombre del proyecto:</label>

                    <input id="inp_name" type="text" name="projectname" class="form-control" value="<?php echo $_formData['projectname'] ?>" >
                   
                    <?php 
                        // Mostrar el error si hubo
                        if( isset( $errors['projectname'] ) ) {
                            foreach( $errors['projectname'] AS $info ) : ?>
                                <span class="help-block"><?php echo $info ?></span>
                            <?php endforeach;
                        } 
                    ?>

                </div>

                <div class="form-group <?php if( isset( $errors['budget'] ) ) echo 'has-error' ?>">
                   
                    <label for="inp_budget">Presupuesto:</label>
                    
                    <input id="inp_budget" type="text" name="budget" class="form-control" value="<?php echo $_formData['budget'] ?>" >
                 
                    <?php 
                        // Mostrar el error si hubo
                        if( isset( $errors['budget'] ) ) {
                            foreach( $errors['budget'] AS $info ) : ?>
                                <span class="help-block"><?php echo $info ?></span>
                            <?php endforeach;
                        } 
                    ?>

                </div>

                <div class="form-group <?php if( isset( $errors['iduser'] ) ) echo 'has-error' ?>">
                   
                    <label for="inp_iduser">Usuario:</label>
                    <select id="inp_iduser" type="text" name="iduser" class="form-control">
                        <?php 

                            if ( isset ( $this->users ) ) {
                                foreach( $this->users AS $userObj ) {
                                    $chk = ( $userObj->id == $_formData['userid'] ) ? ' selected ' : '';
                                    ?>
                                        <option value="<?php echo $userObj->id?>" <?php echo $chk?> > <?php echo $userObj->name ?></option>
                                    <?php
                                }
                            }

                        ?>
                    </select>
                    <?php 
                        // Mostrar el error si hubo
                        if( isset( $errors['iduser'] ) ) {
                            foreach( $errors['iduser'] AS $info ) : ?>
                                <span class="help-block"><?php echo $info ?></span>
                            <?php endforeach;
                        } 
                    ?>

                </div>

                <div class="form-group <?php if( isset( $errors['actualcost'] ) ) echo 'has-error' ?>">
                    
                    <label for="inp_actualcost">Costo actual:</label>
                   
                    <input id="inp_actualcost" type="text" name="actualcost" class="form-control" value="<?php echo $_formData['actualcost'] ?>" >
                   
                    <?php 
                        // Mostrar el error si hubo
                        if( isset( $errors['actualcost'] ) ) {
                            foreach( $errors['actualcost'] AS $info ) : ?>
                                <span class="help-block"><?php echo $info ?></span>
                            <?php endforeach;
                        } 
                    ?>

                </div>
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group <?php if( isset( $errors['startdate'] ) ) echo 'has-error' ?>">
                    
                            <label for="inp_startdate">Fecha de inicio:</label>
                           
                            <input id="inp_startdate" type="text" name="startdate" class="form-control date-picker" value="<?php echo $_formData['startdate'] ?>" data-format="YYYY/MM/DD">
                           
                            <?php 
                                // Mostrar el error si hubo
                                if( isset( $errors['startdate'] ) ) {
                                    foreach( $errors['startdate'] AS $info ) : ?>
                                        <span class="help-block"><?php echo $info ?></span>
                                    <?php endforeach;
                                } 
                            ?>

                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group <?php if( isset( $errors['enddate'] ) ) echo 'has-error' ?>">
                    
                            <label for="inp_enddate">Deadline:</label>
                           
                            <input id="inp_enddate" type="text" name="enddate" class="form-control date-picker" value="<?php echo $_formData['enddate'] ?>"  data-format="YYYY/MM/DD HH:mm:ss">

                            <?php 
                                // Mostrar el error si hubo
                                if( isset( $errors['enddate'] ) ) {
                                    foreach( $errors['enddate'] AS $info ) : ?>
                                        <span class="help-block"><?php echo $info ?></span>
                                    <?php endforeach;
                                } 
                            ?>

                        </div>
                    </div>
                </div>

                 <div class="row">
                    <div class="col-md-12">
                        <p>
                            <label class="radio-inline">
                                <input type="radio" name="isfinished" value="0" <?php if ( $_formData['isfinished'] == "0" ) echo ' checked ' ; ?>> Activo
                            </label>
                            <label class="radio-inline">
                              <input type="radio"  name="isfinished" value="1" <?php if ( $_formData['isfinished'] == "1" ) echo ' checked ' ; ?>> Cerrado
                            </label>
                        </p>
                    </div>
                </div>

               <div class="row">
                    <div class="col-md-12">
                        <input type="submit" value="<?php echo  $title ?> proyecto" class="btn btn-primary">
                    </div>
                </div>

            </form>

        </div>
    </div>


</div>






