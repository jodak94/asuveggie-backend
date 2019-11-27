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
                <th width="5%" style="text-align:center"></th>
                <th>Nombre</th>
                <th>Teléfono</th>
                <th>Email</th>
                <th data-sortable="false">{{ trans('core::core.table.actions') }}</th>
            </tr>
            </thead>
            <tbody>

            </tbody>
            <tfoot>
            <tr>
              <th></th>
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
