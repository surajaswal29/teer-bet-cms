<?php
function redirect($rd){
?>
    <script>
      window.location.href='<?php echo $rd?>';
    </script>
<?php
  die();
  }
?>