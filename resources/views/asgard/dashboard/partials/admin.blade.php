<div class="box-header">
  <h3 class="box-title">
    Contactos
  </h3>
</div>
@php
  $contactos = \Contacto::all();
@endphp
<div class="box-body">
    <div class="table-responsive">
        <table class="data-table table table-bordered table-hover">
            <thead>
            <tr>
                <th>Nombre</th>
                <th>Teléfono</th>
                <th>Email</th>
                <th data-sortable="false">{{ trans('core::core.table.actions') }}</th>
            </tr>
            </thead>
            <tbody>
            <?php if (isset($contactos)): ?>
            <?php foreach ($contactos as $c): ?>
            <tr>
                <td>{{ $c->nombre }}</td>
                <td>{{ $c->telefono }}</td>
                <td>{{ $c->email }}</td>
                <td>
                    <div class="btn-group">
                        {{-- <a href="{{ route('admin.locales.local.edit', [$local->id]) }}" class="btn btn-default btn-flat" title="Editar"><i class="fa fa-pencil"></i></a> --}}
                        <button class="btn btn-primary btn-flat" onclick="openModal({{$c->id}}, {{$c->message}})" data-toggle="modal" id="" >Ver Mensaje</button>
                    </div>
                </td>
            </tr>
            <?php endforeach; ?>
            <?php endif; ?>
            </tbody>
            <tfoot>
            <tr>
              <th>Nombre</th>
              <th>Teléfono</th>
              <th>Email</th>
              <th data-sortable="false">{{ trans('core::core.table.actions') }}</th>
          </tr>
            </tr>
            </tfoot>
        </table>
    </div>
</div>
@push('js-stack')
  <script>
    console.log("script")
    function openModal(contacto_id, message){
      console.log(contacto_id)
      console.log(message)
    }
  </script>
@endpush
