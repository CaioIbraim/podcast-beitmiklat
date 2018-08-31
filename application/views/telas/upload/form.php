

 <div class="container">

    <div class="well"> <h1>Compartilhe.</h1></div>
<?php echo $error;?>
   <?php echo form_open_multipart('upload/do_upload'); ?>

   <h4>Arquivo MP3</h4>
   <?php echo form_error('mp3_url'); ?>
   <input type="file" class="form-control" name="mp3_url" />

   <hr>
   <div><button type="submit" name="submit" class="btn btn-primary">Enviar</button></div>

   <?php echo form_close(); ?>
</div>
