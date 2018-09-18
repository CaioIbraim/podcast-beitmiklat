

 <div class="container">

    <div class="well"> <h1>Junte-se a nós.</h1></div>


    {erros}


   <?php echo form_open('account'); ?>
   <h4>Nome</h4>
   <?php echo form_error('name'); ?>
   <input type="text" class="form-control" name="name" value="<?php echo set_value('name'); ?>" size="50" />

   <h4>Email</h4>
   <?php echo form_error('email'); ?>
   <input type="email" class="form-control" name="email" value="<?php echo set_value('email'); ?>" size="50" />

   <h4>Senha</h4>
   <?php echo form_error('password'); ?>
   <input type="password" class="form-control" name="password" value="<?php echo set_value('password'); ?>" size="50" />

   <h4>Confirmar Senha</h4>
   <?php echo form_error('passconf'); ?>
   <input type="password" class="form-control" name="passconf" value="<?php echo set_value('passconf'); ?>" size="50" />

   <hr>
   <div><button type="submit" class="btn btn-primary">Enviar</button></div>

   </form>
</div>
