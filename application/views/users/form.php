
<?php 

    $_formData = array(
        'name' => '',
        'email' => '',
        'password' => '',
        'confirm_password' => '',
        'level' => 5,
        'isEnabled' => 1
    );

    $action = 'add';

    $title = 'Crear nuevo';

    $this->ui->box->add( 
        $this->ui->box->load(
            'ui/box/return.php', 
            array(
                'box_data' => array(
                    'link' => base_url() .'users',
                    'title' => 'volver',
                    //'class' => ''
                )
            )
        ), 5
    );

    if( isset( $data ) ) {

        $_formData = array_merge( $_formData , $data);

        if( isset ( $_formData['id'] ) ) {
            $action = 'edit/' . $_formData['id'];
            $title = 'Editar';
            
        }

    }

    // debug
    
    /*
        if( isset( $errors ) ) {
            ?>

            <pre>
            
                <?php print_r($errors) ; ?>
            </pre> 

            <?php 
        } 
    */

?>

<div class="container">
    <div class="row">
        <div class="col-md-4">
             <?php echo $this->load->view('users/box/actions.php')?>
        </div>
        
        <div class="col-md-8">
            <h1><?php echo $title ?> usuario</h1>

            <form action="<?php echo base_url()?>users/<?php echo $action ?>" method="POST" role="form">

                <?php 
                    // Agrego el input para el fk
                    if( isset ( $_formData['id'] ) ) {
                        ?>
                        <input type="hidden" name="id" value="<?php echo $_formData['id'] ?>" />
                        <?php
                    }
                ?>

                <div class="form-group <?php if( isset( $errors['name'] ) ) echo 'has-error' ?>">
                    <label for="inp_name">Nombre:</label>
                    <input id="inp_name" type="text" name="name" class="form-control" value="<?php echo $_formData['name'] ?>" >
                    <?php 
                        // Mostrar el error si hubo
                        if( isset( $errors['name'] ) ) {
                            foreach( $errors['name'] AS $info ) : ?>
                                <span class="help-block"><?php echo $info ?></span>
                            <?php endforeach;
                        } 
                    ?>
                </div>

                <div class="form-group <?php if( isset( $errors['email'] ) ) echo 'has-error' ?>">
                    <label for="inp_email">Email:</label>
                    <input id="inp_email" type="text" name="email" class="form-control" value="<?php echo $_formData['email'] ?>">

                    <?php 
                        // Mostrar el error si hubo
                        if( isset( $errors['email'] ) ) {
                            foreach( $errors['email'] AS $info ) : ?>
                                <span class="help-block"><?php echo $info ?></span>
                            <?php endforeach;
                        } 
                    ?>
                </div>

                <div class="form-group <?php if( isset( $errors['password'] ) ) echo 'has-error' ?>">    
                    <label for="inp_password">Password:</label>
                    <input id="inp_password" type="password" name="password" class="form-control" value="<?php echo $_formData['password'] ?>" >

                    <?php 
                        // Mostrar el error si hubo
                        if( isset( $errors['password']['required'] ) ) {
                            ?>
                            <span class="help-block"><?php echo $errors['password']['required'] ?></span>
                            <?php 
                        } 
                    ?>
                </div>

                <div class="form-group <?php if( isset( $errors['password']['equal_data'] ) ) echo 'has-error' ?>">
                    <label for="inp_confirm_password">Repetir contraseña:</label>
                    <input id="inp_confirm_password" type="password" name="confirm_password" class="form-control" value="<?php echo $_formData['confirm_password'] ?>">

                    <?php 
                        // Mostrar el error si hubo
                        if( isset( $errors['password']['equal_data'] ) ) {
                            ?>
                            <span class="help-block"><?php echo $errors['password']['equal_data'] ?></span>
                            <?php 
                        } 
                    ?>
                </div>

                <div class="form-group <?php if( isset( $errors['level'] ) ) echo 'has-error' ?>">
                    <label for="inp_level">Nivel:</label>
                    <select id="inp_level" name="level" class="form-control">
                        <?php
                            foreach( range(1,5) AS $level_num ) {
                                ?>
                                    <option 
                                        value="<?php echo $level_num ?>" 
                                        <?php if ( $level_num == $_formData['level']) echo ' selected '; 
                                    ?>> Nivel <?php echo $level_num ?> </option>
                                <?php
                            }
                        ?>
                    </select>
                </div>

                <div class="radio">
                    <label for="isEneable_no"> <input type="radio" name="isEnabled" value="0" <?php if ( $_formData['isEnabled'] == 0 ) echo ' checked '; ?> id="isEneable_no"> No</label>
                </div>
                <div class="radio">
                   <label for="isEneable_si"> <input type="radio" name="isEnabled" value="1" <?php if ( $_formData['isEnabled'] == 1 ) echo ' checked '; ?> id="isEneable_si"> Si</label> 
                </div>

                <div class="form-group">
                    <input type="submit" value="<?php echo  $title ?> proyecto" class="btn btn-primary">
                </div>
            </form>
        </div>
    </div>
</div>