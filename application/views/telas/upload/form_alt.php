<div class="panel panel-default">
  <div class="panel-heading">Painel para upload</div>
  <div class="panel-body">
    <div class="container">
        {erros}
       <?php $d = $formData[0]['id_podcast']; $url = "admin/alterarPodcast/$d";   echo  form_open_multipart($url); ?>

       <h4>Titulo</h4>
       <?php echo form_error('title'); ?>
       <input type="text" class="form-control" name="title"  value="<?= $formData[0]['title']; ?>"/>

       <h4>Categoria</h4>
       <?php echo form_error('id_category'); ?>

       <select id="id_category" name="id_category" class="form-control">
           <option value="">Selecione</option>
           <?php foreach ($categories as $key => $value) {  ?>
           <option value="<?= $value['id_category']; ?>"  <?php if($value['id_category'] == $formData[0]['id_category'] ){ echo "selected='selected'"; } ?>    > <?= $value['name']; ?> </option>
           <?php } ?>
       </select>

       <h4>Status</h4>
       <?php echo form_error('status'); ?>
       <select id="status" name="status" class="form-control">
           <option value="0" <?php if($formData[0]['status'] == '0'){ echo "selected='selected'"; } ?>  >Desabilitado</option>
           <option value="1" <?php if($formData[0]['status'] == '1'){ echo "selected='selected'"; } ?>  >Habilitado</option>
       </select>
       <h4>Descrição</h4>
       <?php echo form_error('description'); ?>
       <textarea class="form-control" name="description"><?= $formData[0]['description']; ?></textarea>

       <h4>Tags</h4>
       <?php echo form_error('tags'); ?>
       <input type="text" class="form-control" name="tags" value="<?= $formData[0]['tags']; ?>"/>

       <h4>Arquivo MP3</h4>
       {error_mp3}
       <input type="file" class="form-control-file" name="mp3_url" value=""/>

       <h4>Imagem</h4>
       {error_img}
       <input type="file" class="form-control-file" name="img_url" value=""/>

       <input type="hidden" class="form-control-file" name="id_podcast" value="<?= $formData[0]['id_podcast']; ?>"/>
       <hr>
       <div><button type="submit"  class="btn btn-primary">Enviar</button></div>
       <?php echo form_close(); ?>

    </div>


  </div>
</div>
