<div class="panel panel-default">
  <div class="panel-heading">Painel para upload</div>
  <div class="panel-body">
    <div class="container">
        {erros}
       <?php echo form_open_multipart('admin/uploadPodcast'); ?>

       <h4>Titulo</h4>
       <?php echo form_error('title'); ?>
       <input type="text" class="form-control" name="title" />

       <h4>Categoria</h4>
       <?php echo form_error('id_category'); ?>

       <select id="id_category" name="id_category" class="form-control">
           <option value="">Selecione</option>
           {categories}
           <option value="{id_category}">{name}</option>
           {/categories}
       </select>

       <h4>Descrição</h4>
       <?php echo form_error('description'); ?>
       <textarea class="form-control" name="description"></textarea>

       <h4>Tags</h4>
       <?php echo form_error('tags'); ?>
       <input type="text" class="form-control" name="tags" />

       <h4>Arquivo MP3</h4>
       {error_mp3}
       <input type="file" class="form-control-file" name="mp3_url" />

       <h4>Imagem</h4>
       {error_img}
       <input type="file" class="form-control-file" name="img_url" />

       <hr>
       <div><button type="submit"  class="btn btn-primary">Enviar</button></div>
       <?php echo form_close(); ?>

    </div>


  </div>
</div>
