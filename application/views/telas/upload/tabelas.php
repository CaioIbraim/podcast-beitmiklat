

<div class="panel panel-default">
  <div class="panel-heading">Administração de podcast</div>
  <div class="panel-body">{table}</div>
</div>

<script>
$(document).ready(function(){

    $('#big_table').DataTable({
        "pageLength" : 10,
        "serverSide":  true,
        "processing":  true,
        "columns": [
           {columns}
        ],
           "language": {
           "sEmptyTable": "Nenhum registro encontrado",
           "sInfo": "Mostrando de _START_ até _END_ de _TOTAL_ registros",
           "sInfoEmpty": "Mostrando 0 até 0 de 0 registros",
           "sInfoFiltered": "(Filtrados de _MAX_ registros)",
           "sInfoPostFix": "",
           "sInfoThousands": ".",
           "sLengthMenu": "_MENU_  Resultados por Página",
           "sLoadingRecords": "Carregando...",
           "sProcessing": "Processando...",
           "sZeroRecords": "Nenhum registro encontrado",
           "sSearch": "Pesquisar : ",
           "oPaginate": {
               "sNext": "Próximo",
               "sPrevious": "Anterior",
               "sFirst": "Primeiro",
               "sLast": "Último"
           },
           "oAria": {
               "sSortAscending": ": Ordenar colunas de forma ascendente",
               "sSortDescending": ": Ordenar colunas de forma descendente"
           }
       },
        "ajax": {
            dataType: 'json',
            url  : "<?php echo site_url("{controller}/dtable") ?>",
            type : 'POST',
            data : {title : '{title}', cat : '{cat}', status : '{status}' }
        }
  });

   });


</script>
