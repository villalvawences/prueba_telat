<?php echo $this->extend('partials/layout'); ?>

<?php echo $this->section('titulo'); ?>
Reportes
<?php echo $this->endSection(); ?>

<?php echo $this->section('estilos'); ?>
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
<?php echo $this->endSection(); ?>

<?php echo $this->section('contenido'); ?>
<div class="container py-4">
    <h1 class="text-center">Reportes</h1>
    <div id="export-buttons"></div>
    <table id="reporteTable" class="display">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Correo</th>
                <th>Status</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>

        </tbody>
    </table>
</div>
<?php echo $this->endSection(); ?>

<?php echo $this->section('scripts'); ?>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.68/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.68/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    $(document).ready(function() {
        let dataTable = $('#reporteTable').DataTable({
            ajax: {
                url: '<?= base_url('/usuarios/cargar_datos_reportes'); ?>',
                type: 'GET',
                dataSrc: ''
            },
            columns: [{
                    data: 'id_usuario'
                },
                {
                    data: null,
                    render: function(data, type, row) {
                        return row.nombre + ' ' + row.apellidos;
                    }
                },
                {
                    data: 'correo_electronico'
                },
                {
                    data: 'status',
                    render: function(data) {
                        return data == '1' ? 'Activo' : 'Inactivo';
                    }
                },
                {
                    data: null,
                    render: function(data, type, row) {
                        // Agregar botones de Editar y Eliminar
                        return '<button class="btn btn-info btn-sm m-2" onclick="editarUsuario(' + row.id_usuario + ')">Editar</button>' +
                            '<button class="btn btn-danger btn-sm m-2" onclick="eliminarUsuario(' + row.id_usuario + ')">Eliminar</button>';
                    }
                },
            ],
            dom: 'Bfrtip', // Habilita los botones de DataTables
            buttons: [{
                    extend: 'copy',
                    exportOptions: {
                        columns: [0, 1, 2, 3]
                    }
                },
                {
                    extend: 'csv',
                    exportOptions: {
                        columns: [0, 1, 2, 3]
                    }
                },
                {
                    extend: 'excel',
                    exportOptions: {
                        columns: [0, 1, 2, 3]
                    }
                },
                {
                    extend: 'pdf',
                    exportOptions: {
                        columns: [0, 1, 2, 3],
                        modifier: {
                            selected: null
                        } // Oculta las filas seleccionadas al exportar
                    }
                },
                {
                    extend: 'print',
                    exportOptions: {
                        columns: [0, 1, 2, 3]
                    }
                },
            ]
        });

        // Evento para la exportación
        dataTable.buttons().container().appendTo($('#export-buttons'));
    });

    // Función para editar un usuario
    function editarUsuario(idUsuario) {
        // Redirige a la página de edición con el ID del usuario
        window.location.href = '<?= base_url('/usuarios/') ?>' + idUsuario + '/editar';

    }

    // Función para eliminar un usuario
    function eliminarUsuario(idUsuario) {
        Swal.fire({
            title: "¿Estás seguro de que deseas eliminar este usuario?",
            text: "Si eliminas este usuario ya no se verá en tus reportes",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Si, eliminar",
            cancelButtonText: "Cancelar",
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    title: "Eliminado",
                    text: "El usuario ha sido eliminado correctamente",
                    icon: "success"
                });

                $.ajax({
                    url: '<?= base_url('/usuarios/eliminar/'); ?>' + idUsuario,
                    type: 'POST',
                    success: function(response) {
                        // Actualizar la tabla después de la eliminación
                        location.reload();
                    }
                });
            }
        });
    }
</script>

<?php echo $this->endSection(); ?>