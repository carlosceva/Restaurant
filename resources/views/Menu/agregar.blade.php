<div class="modal fade" id="agregarModal" tabindex="-1" aria-labelledby="agregarModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="agregarModalLabel">Agregar Menú</h5>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('menu.store') }}" method="POST" id="menuForm">
                    @csrf
                    <div class="form-group row">
                        <div class="col-md-12">
                            <label for="descripcion" class="form-label">Descripción</label>
                            <input type="text" class="form-control" id="descripcion" name="descripcion" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-md-4">
                            <label for="producto_id" class="form-label">Producto</label>
                            <select class="form-select" id="producto_id">
                                <option value="">Selecciona un producto</option>
                                @foreach ($productos as $producto)
                                    <option value="{{ $producto->id }}">{{ $producto->nombre }} - {{ $producto->precio }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4 align-self-end">
                            <button type="button" class="btn btn-success" id="agregar-detalle"><i class="fa fa-shopping-cart"></i>&nbsp;Agregar Detalle</button>
                        </div>
                    </div>

                    <table id="detalles-menu" class="table">
                        <thead>
                            <tr>
                                <th>Producto</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>

                    <input type="hidden" name="detalles" id="detalles-input">
                    <button type="submit" class="btn btn-primary">Guardar Menú</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    const agregarDetalleBtn = document.getElementById('agregar-detalle');
    const productoSelect = document.getElementById('producto_id');
    const detallesMenuTable = document.getElementById('detalles-menu').getElementsByTagName('tbody')[0];
    const detallesInput = document.getElementById('detalles-input');

    let detalles = [];

    agregarDetalleBtn.addEventListener('click', function() {
        const selectedOption = productoSelect.options[productoSelect.selectedIndex];
        if (selectedOption.value === "") return;

        const detalle = {
            producto_id: selectedOption.value,
            producto_nombre: selectedOption.text
        };

        detalles.push(detalle);
        renderDetalles();
    });

    function renderDetalles() {
        detallesMenuTable.innerHTML = "";
        detalles.forEach((detalle, index) => {
            const row = detallesMenuTable.insertRow();
            row.innerHTML = `
                <td>${detalle.producto_nombre}</td>
                <td><button type="button" class="btn btn-danger btn-sm eliminar-detalle" data-index="${index}">Eliminar</button></td>
            `;
        });

        const eliminarDetalleBtns = document.getElementsByClassName('eliminar-detalle');
        for (let btn of eliminarDetalleBtns) {
            btn.addEventListener('click', function() {
                const index = this.getAttribute('data-index');
                detalles.splice(index, 1);
                renderDetalles();
            });
        }

        detallesInput.value = JSON.stringify(detalles);
    }
</script>
