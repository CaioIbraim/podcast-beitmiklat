

 <div class="container">

    <div class="well"> <h1>Acesso ao sistema.</h1></div>


    {erros}


   <?php echo form_open('login'); ?>

   <h4>Email</h4>
   <?php echo form_error('email'); ?>
   <input type="email" class="form-control" name="email" value="<?php echo set_value('email'); ?>" size="50" />

   <h4>Senha</h4>
   <?php echo form_error('password'); ?>
   <input type="password" class="form-control" name="password" value="<?php echo set_value('password'); ?>" size="50" />


   <hr>
   <div><button type="submit" class="btn btn-primary">Enviar</button></div>

   </form>
</div>
