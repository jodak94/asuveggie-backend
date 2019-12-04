<script type="text/javascript">
  $( document ).ready(function(){
    var importante_filtro = 0;
    $('#importante_filtro').iCheck({
        checkboxClass: 'icheckbox_flat-blue',
        radioClass: 'iradio_flat-blue'
    });

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
            d.importante = importante_filtro;
            d.tipo = $("#tipo_filtro").val();
        },
        headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}'},
      },
      columns:[
        { data: 'leido_format', name: 'leido_format' },
        { data: 'nombre', name: 'nombre' },
        { data: 'telefono', name: 'telefono' },
        { data: 'email', name: 'email' },
        { data: 'created_at_format', name: 'created_at_format' },
        { data: 'tipo_format', name: 'tipo_format' },
        { data: 'importante_format', name: 'importante_format' },
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
    $("#tipo_filtro").change(function(){
        table.ajax.reload();
    });
    $("#importante_filtro").on('ifChecked', function(){
        importante_filtro = 1;
        table.ajax.reload();
    });
    $("#importante_filtro").on('ifUnchecked', function(){
        importante_filtro = 0;
        table.ajax.reload();
    });

    $(".data-table").on('change', '.tipo', function(){
      let id = $(this).attr('cid');
      let tipo = $(this).val();
      $.ajax({
        url: '{!! route('admin.contacto.contacto.change_contacto_tipo') !!}',
        type: 'PUT',
        data: {
          'id': id,
          'tipo': tipo,
          "_token": "{{ csrf_token() }}",
        },
        success: function(data){

        },
        error: function(error){
          console.log(error)
        }
      })
    })

    $(".data-table").on('change', '.importante', function(){
      let id = $(this).attr('cid');
      $.ajax({
        url: '{!! route('admin.contacto.contacto.change_contacto_importante') !!}',
        type: 'PUT',
        data: {
          'id': id,
          "_token": "{{ csrf_token() }}",
        },
        success: function(data){

        },
        error: function(error){
          console.log(error)
        }
      })
    })
  })

  function openModal(id, message, leido, dom){
    if(!leido){
      marcarLeido(id, message)
      $($(dom).closest('tr').children()[0]).html('')
    }else{
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
