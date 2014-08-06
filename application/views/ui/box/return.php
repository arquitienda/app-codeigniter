<?php
  /**
   * Box para la mejorar la navegacion del sitio
   * 
   */

  $_data = array(
    'link'  => false,
    'title' => null,
    'class' => 'btn btn-primary'
  );

  if( isset ( $box_data ) ) {
      $_data = array_merge( $_data, $box_data );
  }

  if( $_data['link'] != false ) {

?>
<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title">Navegacion</h3>
  </div>
  <div class="panel-body">
    <a href="<?echo $_data['link'] ?>" class="<?php echo $_data['class']?>"> <?echo $_data['title'] ?> </a>
  </div>
</div>

<?php
  }