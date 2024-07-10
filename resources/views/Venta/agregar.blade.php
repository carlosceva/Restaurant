<div class="modal fade" id="agregarModal" tabindex="-1" aria-labelledby="agregarModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg ">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="agregarModalLabel">Agregar Venta</h5>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('venta.store') }}" method="POST" id="ventaForm">
                    @csrf
                    <div class="form-group row">
                        <div class="col-md-4">
                            <label for="cliente_id" class="form-label">Cliente</label>
                            <select class="form-select" id="cliente_id" name="cliente_id">
                                <option value="">Seleccionar cliente</option>
                                @foreach ($clientes as $cliente)
                                    <option value="{{ $cliente->id }}">{{ $cliente->nombre }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-4">
                            <label for="promocion_id" class="form-label">Promoción</label>
                            <select class="form-select" id="promocion_id" name="promocion_id">
                                <option value="">Seleccionar promocion</option>
                                @foreach ($promociones as $promocion)
                                    <option value="{{ $promocion->id }}">{{ $promocion->descuento }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-4">
                            <label for="servicio_id" class="form-label">Servicio</label>
                            <select class="form-select" id="servicio_id" name="servicio_id">
                                <option value="">Seleccionar etapa</option>
                                @foreach ($servicios as $servicio)
                                    <option value="{{ $servicio->id }}">{{ $servicio->descripcion }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>  

                    <div class="form-group row">
                        <div class="col-md-4">
                            <label for="producto_id" class="form-label">Producto</label>
                            <select class="form-select" id="producto_id">
                                <option value="">Selecciona un producto</option>
                                @foreach ($productos as $producto)
                                    <option value="{{ $producto->id }}" data-precio="{{ $producto->precio }}">{{ $producto->nombre }} - {{ $producto->precio }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="cantidad" class="form-label">Cantidad</label>
                            <input type="number" class="form-control" id="cantidad" value="1" min="1">
                        </div>
                        <div class="col-md-4 align-self-end">
                            <button type="button" class="btn btn-success" id="agregar-detalle"><i class="fa fa-shopping-cart"></i>&nbsp;Agregar Detalle</button>
                        </div>
                    </div>

                    <table id="detalles-venta" class="table">
                        <thead>
                            <tr>
                                <th>Producto</th>
                                <th>Cantidad</th>
                                <th>Precio Unitario</th>
                                <th>Subtotal</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan="3">Total:</th>
                                <th id="total-venta">0.00</th>
                                <th></th>
                            </tr>
                        </tfoot>
                    </table>

                    <input type="hidden" name="detalles" id="detalles-input">
                <button type="submit" class="btn btn-primary">Guardar Venta</button>
            </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    const agregarDetalleBtn = document.getElementById('agregar-detalle');
    const productoSelect = document.getElementById('producto_id');
    const cantidadInput = document.getElementById('cantidad');
    const detallesVentaTable = document.getElementById('detalles-venta').getElementsByTagName('tbody')[0];
    const totalVentaCell = document.getElementById('total-venta');
    const detallesInput = document.getElementById('detalles-input');

    let detalles = [];

    agregarDetalleBtn.addEventListener('click', () => {
        const productoId = productoSelect.value;
        const productoNombre = productoSelect.options[productoSelect.selectedIndex].text;
        const cantidad = parseInt(cantidadInput.value);
        const precio = parseFloat(productoSelect.options[productoSelect.selectedIndex].dataset.precio);

        if (productoId && cantidad > 0) {
            const newRow = detallesVentaTable.insertRow();
            newRow.innerHTML = `
                <td>${productoNombre}</td>
                <td><input type="number" class="form-control cantidad" value="${cantidad}" min="1"></td>
                <td>${precio.toFixed(2)}</td>
                <td class="subtotal">${(cantidad * precio).toFixed(2)}</td>
                <td><button type="button" class="btn btn-danger eliminar-detalle">X</button></td>
            `;

            // Agregar el detalle al array
            detalles.push({
                producto_id: productoId,
                cantidad: cantidad
            });

            // Limpiar campos
            productoSelect.value = '';
            cantidadInput.value = '1';

            attachDeleteEvent(newRow);
            calcularTotal();
        }
    });

    function attachDeleteEvent(row) {
        const deleteBtn = row.querySelector('.eliminar-detalle');
        deleteBtn.addEventListener('click', () => {
            const rowIndex = row.rowIndex - 1;
            detalles.splice(rowIndex, 1);
            row.remove();
            calcularTotal();
        });
    }

    function calcularTotal() {
        let total = 0;
        const subtotales = document.querySelectorAll('.subtotal');
        subtotales.forEach(subtotal => {
            total += parseFloat(subtotal.textContent);
        });
        totalVentaCell.textContent = total.toFixed(2);
        detallesInput.value = JSON.stringify(detalles);
    }

    document.getElementById('ventaForm').addEventListener('submit', function(event) {
        event.preventDefault(); // Evita el envío por defecto del formulario
        detallesInput.value = JSON.stringify(detalles); // Actualiza el valor del campo oculto
        this.submit(); // Envía el formulario
    });
</script>





