<script type="text/javascript">
  $( document ).ready(function(){
    var table  = $('.data-table').DataTable({
      dom: "<'row'<'col-xs-12'<'col-xs-6'l><'col-xs-6'p>>r>"+
        "<'row'<'col-xs-12't>>"+
        "<'row'<'col-xs-12'<'col-xs-6'i><'col-xs-6'p>>>",
      processing: false,
      serverSide: true,
      "ordering": false,
      "paginate": true,
      "lengthChange": true,
      "iDisplayLength": 50,
      "filter": true,
      "sort": true,
      "info": true,
      "autoWidth": true,
      "paginate": true,
      ajax:{
        url: '{!! route('admin.contacto.contacto.index_ajax') !!}',
        type: "GET",
        data: function (d){
            d.local = $("#local").val();
            d.fecha_desde = $("#fecha_desde").val();
            d.fecha_hasta = $("#fecha_hasta").val();
        },
        headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}'},
      },
      columns:[
        { data: 'leido_format', name: 'leido_format' },
        { data: 'nombre', name: 'nombre' },
        { data: 'telefono', name: 'telefono' },
        { data: 'email', name: 'email' },
        { data: 'acciones', name: 'acciones' },
      ],
      columnDefs: [
        {targets: -1, className: 'center'},
      ],
      language: {
        processing:     "Procesando...",
        search:         "Buscar",
        lengthMenu:     "Mostrar _MENU_ Elementos",
        info:           "Mostrando de _START_ a _END_ registros de un total de _TOTAL_ registros",
        infoFiltered:   ".",
        infoPostFix:    "",
        loadingRecords: "Cargando Registros...",
        zeroRecords:    "No existen registros disponibles",
        emptyTable:     "No existen registros disponibles",
        paginate: {
          first:      "Primera",
          previous:   "Anterior",
          next:       "Siguiente",
          last:       "Ultima"
        }
      },
    });
    //filtros
    $("#local").keyup(function(){
        table.ajax.reload();
    });
    $(".fecha").change(function(){
        table.ajax.reload();
    });
  })

  function openModal(id, message, leido){
    if(!leido)
      marcarLeido(id, message)
    else{
      showModal(message)
    }

  }

  function marcarLeido(id, message){
    $.ajax({
      url: '{!! route('admin.contactos.contacto.leido') !!}',
      type: 'POST',
      data: {
        'id': id,
        "_token": "{{ csrf_token() }}",
      },
      success: function(data){
        showModal(message)
      },
      error: function(error){
        console.log(error)
      }
    })
  }

  function showModal(mensaje){
    $("#modalContactoBody").html(mensaje);
    $("#modalContacto").modal('show');
  }
</script>
