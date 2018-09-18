
<div class="panel panel-default">
  <div class="panel-heading">Painel de pesquisa</div>
  <div class="panel-body"><form class="form-horizontal" method="post" id="frmFormulario" action="">
      <div class="form-group">
          <label for="pesquisa_nip" class="col-md-1 control-label">Titulo</label>
          <div class="col-md-2">
              <input id="pesquisa_titulo" name="pesquisa_nip" value="" placeholder="Titulo do podcast" class="form-control" type="text">
          </div>

          <label for="pesquisa_nip" class="col-md-1 control-label">Categoria</label>
          <div class="col-md-2">
              <select id="pesquisa_cat" name="pesquisa_cat" class="form-control">

                  <option value="">Todos</option>
                  {categories}
                  <option value="{id_category}">{name}</option>
                  {/categories}
              </select>

          </div>

          <label for="pesquisa_status" class="col-md-1 control-label">status:</label>
          <div class="col-md-2">
              <select id="pesquisa_status" name="pesquisa_status" class="form-control">
                  <option value="">Todos</option>
                  <option value="1">Habilitado</option>
                  <option value="0">Desabilitado</option>
              </select>
          </div>
      </div>
      <hr>
      <div class="form-group" id="btnBoxFooter">
          <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-right">
              <button type="reset" id="btnLimpar" class="btn btn-primary"><span class="fa fa-refresh"></span> Limpar </button>
              <button type="button" id="btnConfirmar" class="btn btn-primary"><span class="fa fa-search"></span> Pesquisar </button>
          </div>
      </div>
  </form></div>
</div>


<hr>

<div id="exibetabela"></div>
 <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.13/datatables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.13/js/dataTables.bootstrap.min.js"></script>
<script>

$('#btnConfirmar').bind('click',function(){
   buscaTabela();
});

function buscaTabela(){
    $( "#exibetabela" ).html();
    var title   = $("#pesquisa_titulo").val();
    var cat     = $("#pesquisa_cat").val();
    var status  = $("#pesquisa_status").val();

    if(title.trim() === ""){
       title = "0";
    }
    if(cat.trim() === ""){
       cat = "0";
    }

    $.post("tabela", {title : title, status : status, cat : cat}, function(data, status){
         $( "#exibetabela" ).html(data);
    });
}
</script>
