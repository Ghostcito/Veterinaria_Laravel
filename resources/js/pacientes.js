// Datos simulados de pacientes
let pacientes = [
    {
        id: 1,
        nombre: "Rex",
        especie: "Perro",
        raza: "Golden Retriever",
        edad: 3,
        dueno: "María González",
        telefono: "555-0123",
        email: "maria.gonzalez@email.com",
        direccion: "Av. Principal 123",
        fechaRegistro: "2024-01-15",
    },
    {
        id: 2,
        nombre: "Mimi",
        especie: "Gato",
        raza: "Persa",
        edad: 2,
        dueno: "Carlos Rodríguez",
        telefono: "555-0124",
        email: "carlos.rodriguez@email.com",
        direccion: "Calle Secundaria 456",
        fechaRegistro: "2024-02-10",
    },
    {
        id: 3,
        nombre: "Luna",
        especie: "Perro",
        raza: "Labrador",
        edad: 5,
        dueno: "Ana Martínez",
        telefono: "555-0125",
        email: "ana.martinez@email.com",
        direccion: "Jr. Los Pinos 789",
        fechaRegistro: "2024-01-20",
    },
    {
        id: 4,
        nombre: "Pipo",
        especie: "Ave",
        raza: "Canario",
        edad: 1,
        dueno: "Luis Fernández",
        telefono: "555-0126",
        email: "luis.fernandez@email.com",
        direccion: "Av. Las Flores 321",
        fechaRegistro: "2024-03-05",
    },
];

// Cargar pacientes desde localStorage o usar datos por defecto
function cargarPacientes() {
    const pacientesGuardados = localStorage.getItem("pacientes");
    if (pacientesGuardados) {
        pacientes = JSON.parse(pacientesGuardados);
    } else {
        guardarPacientes();
    }
}

// Guardar pacientes en localStorage
function guardarPacientes() {
    localStorage.setItem("pacientes", JSON.stringify(pacientes));
}

// Mostrar pacientes en la tabla
function mostrarPacientes(pacientesFiltrados = pacientes) {
    const tbody = document.getElementById("tablaPacientes");
    tbody.innerHTML = "";

    if (pacientesFiltrados.length === 0) {
        tbody.innerHTML = `
            <tr>
                <td colspan="7" class="text-center text-muted py-4">
                    <i class="fas fa-search fa-2x mb-2"></i>
                    <br>No se encontraron pacientes
                </td>
            </tr>
        `;
        return;
    }

    pacientesFiltrados.forEach((paciente) => {
        const fila = document.createElement("tr");
        fila.innerHTML = `
            <td><span class="badge bg-primary">#${paciente.id}</span></td>
            <td>
                <div class="d-flex align-items-center">
                    <div class="avatar-sm me-2">
                        <i class="fas fa-paw text-primary"></i>
                    </div>
                    <div>
                        <strong>${paciente.nombre}</strong>
                        <br><small class="text-muted">${paciente.edad} años</small>
                    </div>
                </div>
            </td>
            <td>
                <span class="badge bg-info">${paciente.especie}</span>
            </td>
            <td>${paciente.raza}</td>
            <td>
                <div>
                    <strong>${paciente.dueno}</strong>
                    <br><small class="text-muted">${paciente.email}</small>
                </div>
            </td>
            <td>
                <i class="fas fa-phone me-1"></i>${paciente.telefono}
            </td>
            <td>
                <div class="btn-group" role="group">
                    <button class="btn btn-info btn-sm" onclick="verTratamientos(${paciente.id})" title="Ver tratamientos">
                        <i class="fas fa-stethoscope"></i>
                    </button>
                    <button class="btn btn-warning btn-sm" onclick="editarPaciente(${paciente.id})" title="Editar">
                        <i class="fas fa-edit"></i>
                    </button>
                    <button class="btn btn-danger btn-sm" onclick="eliminarPaciente(${paciente.id})" title="Eliminar">
                        <i class="fas fa-trash"></i>
                    </button>
                </div>
            </td>
        `;
        tbody.appendChild(fila);
    });
}

// Mostrar formulario para nuevo paciente
function mostrarFormularioNuevoPaciente() {
    Swal.fire({
        title: '<i class="fas fa-paw text-primary me-2"></i>Nuevo Paciente',
        html: `
            <form id="formPaciente" class="text-start">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Nombre del paciente</label>
                        <input type="text" class="form-control" id="nombre" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Edad (años)</label>
                        <input type="number" class="form-control" id="edad" min="0" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Especie</label>
                        <select class="form-select" id="especie" required>
                            <option value="">Seleccionar...</option>
                            <option value="Perro">Perro</option>
                            <option value="Gato">Gato</option>
                            <option value="Ave">Ave</option>
                            <option value="Conejo">Conejo</option>
                            <option value="Otro">Otro</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Raza</label>
                        <input type="text" class="form-control" id="raza" required>
                    </div>
                    <div class="col-12">
                        <label class="form-label">Nombre del dueño</label>
                        <input type="text" class="form-control" id="dueno" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Teléfono</label>
                        <input type="tel" class="form-control" id="telefono" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" required>
                    </div>
                    <div class="col-12">
                        <label class="form-label">Dirección</label>
                        <input type="text" class="form-control" id="direccion" required>
                    </div>
                </div>
            </form>
        `,
        showCancelButton: true,
        confirmButtonText: '<i class="fas fa-save me-1"></i>Guardar',
        cancelButtonText: '<i class="fas fa-times me-1"></i>Cancelar',
        confirmButtonColor: "#28a745",
        cancelButtonColor: "#6c757d",
        width: "600px",
        preConfirm: () => {
            const form = document.getElementById("formPaciente");
            const formData = new FormData(form);
            const data = Object.fromEntries(formData);

            // Validación
            if (
                !data.nombre ||
                !data.edad ||
                !data.especie ||
                !data.raza ||
                !data.dueno ||
                !data.telefono ||
                !data.email ||
                !data.direccion
            ) {
                Swal.showValidationMessage("Todos los campos son obligatorios");
                return false;
            }

            return {
                nombre: document.getElementById("nombre").value,
                edad: parseInt(document.getElementById("edad").value),
                especie: document.getElementById("especie").value,
                raza: document.getElementById("raza").value,
                dueno: document.getElementById("dueno").value,
                telefono: document.getElementById("telefono").value,
                email: document.getElementById("email").value,
                direccion: document.getElementById("direccion").value,
            };
        },
    }).then((result) => {
        if (result.isConfirmed) {
            const nuevoPaciente = {
                id: Math.max(...pacientes.map((p) => p.id)) + 1,
                ...result.value,
                fechaRegistro: new Date().toISOString().split("T")[0],
            };

            pacientes.push(nuevoPaciente);
            guardarPacientes();
            mostrarPacientes();

            Swal.fire({
                title: "¡Éxito!",
                text: `Paciente ${nuevoPaciente.nombre} registrado correctamente`,
                icon: "success",
                confirmButtonColor: "#28a745",
            });
        }
    });
}

// Editar paciente
function editarPaciente(id) {
    const paciente = pacientes.find((p) => p.id === id);
    if (!paciente) return;

    Swal.fire({
        title: '<i class="fas fa-edit text-warning me-2"></i>Editar Paciente',
        html: `
            <form id="formPaciente" class="text-start">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Nombre del paciente</label>
                        <input type="text" class="form-control" id="nombre" value="${
                            paciente.nombre
                        }" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Edad (años)</label>
                        <input type="number" class="form-control" id="edad" value="${
                            paciente.edad
                        }" min="0" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Especie</label>
                        <select class="form-select" id="especie" required>
                            <option value="Perro" ${
                                paciente.especie === "Perro" ? "selected" : ""
                            }>Perro</option>
                            <option value="Gato" ${
                                paciente.especie === "Gato" ? "selected" : ""
                            }>Gato</option>
                            <option value="Ave" ${
                                paciente.especie === "Ave" ? "selected" : ""
                            }>Ave</option>
                            <option value="Conejo" ${
                                paciente.especie === "Conejo" ? "selected" : ""
                            }>Conejo</option>
                            <option value="Otro" ${
                                paciente.especie === "Otro" ? "selected" : ""
                            }>Otro</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Raza</label>
                        <input type="text" class="form-control" id="raza" value="${
                            paciente.raza
                        }" required>
                    </div>
                    <div class="col-12">
                        <label class="form-label">Nombre del dueño</label>
                        <input type="text" class="form-control" id="dueno" value="${
                            paciente.dueno
                        }" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Teléfono</label>
                        <input type="tel" class="form-control" id="telefono" value="${
                            paciente.telefono
                        }" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" value="${
                            paciente.email
                        }" required>
                    </div>
                    <div class="col-12">
                        <label class="form-label">Dirección</label>
                        <input type="text" class="form-control" id="direccion" value="${
                            paciente.direccion
                        }" required>
                    </div>
                </div>
            </form>
        `,
        showCancelButton: true,
        confirmButtonText: '<i class="fas fa-save me-1"></i>Actualizar',
        cancelButtonText: '<i class="fas fa-times me-1"></i>Cancelar',
        confirmButtonColor: "#ffc107",
        cancelButtonColor: "#6c757d",
        width: "600px",
        preConfirm: () => {
            return {
                nombre: document.getElementById("nombre").value,
                edad: parseInt(document.getElementById("edad").value),
                especie: document.getElementById("especie").value,
                raza: document.getElementById("raza").value,
                dueno: document.getElementById("dueno").value,
                telefono: document.getElementById("telefono").value,
                email: document.getElementById("email").value,
                direccion: document.getElementById("direccion").value,
            };
        },
    }).then((result) => {
        if (result.isConfirmed) {
            const index = pacientes.findIndex((p) => p.id === id);
            pacientes[index] = { ...pacientes[index], ...result.value };
            guardarPacientes();
            mostrarPacientes();

            Swal.fire({
                title: "¡Actualizado!",
                text: "Los datos del paciente han sido actualizados",
                icon: "success",
                confirmButtonColor: "#28a745",
            });
        }
    });
}

// Eliminar paciente
function eliminarPaciente(id) {
    const paciente = pacientes.find((p) => p.id === id);
    if (!paciente) return;

    Swal.fire({
        title: "¿Estás seguro?",
        text: `Se eliminará el paciente "${paciente.nombre}" y todos sus tratamientos`,
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#d33",
        cancelButtonColor: "#3085d6",
        confirmButtonText: "Sí, eliminar",
        cancelButtonText: "Cancelar",
        reverseButtons: true,
    }).then((result) => {
        if (result.isConfirmed) {
            pacientes = pacientes.filter((p) => p.id !== id);
            guardarPacientes();
            mostrarPacientes();

            Swal.fire({
                title: "¡Eliminado!",
                text: `El paciente ${paciente.nombre} ha sido eliminado`,
                icon: "success",
                confirmButtonColor: "#28a745",
            });
        }
    });
}

// Ver tratamientos del paciente
function verTratamientos(id) {
    const paciente = pacientes.find((p) => p.id === id);
    if (!paciente) return;

    // Guardar el ID del paciente en sessionStorage para la otra página
    sessionStorage.setItem("pacienteSeleccionado", id);
    window.location.href = "tratamientos-paciente.html";
}

// Filtrar pacientes
function filtrarPacientes() {
    const busqueda = document
        .getElementById("buscarPaciente")
        .value.toLowerCase();
    const especies = document.getElementById("filtroEspecie").value;

    let pacientesFiltrados = pacientes.filter((paciente) => {
        const coincideBusqueda =
            paciente.nombre.toLowerCase().includes(busqueda) ||
            paciente.dueno.toLowerCase().includes(busqueda) ||
            paciente.raza.toLowerCase().includes(busqueda);

        const coincidenEspecies = !especies || paciente.especie === especies;

        return coincideBusqueda && coincidenEspecies;
    });

    mostrarPacientes(pacientesFiltrados);
}

// Limpiar filtros
function limpiarFiltros() {
    document.getElementById("buscarPaciente").value = "";
    document.getElementById("filtroEspecie").value = "";
    mostrarPacientes();
}

// Event listeners
document.addEventListener("DOMContentLoaded", function () {
    cargarPacientes();
    mostrarPacientes();

    // Configurar event listeners para filtros
    document
        .getElementById("buscarPaciente")
        .addEventListener("input", filtrarPacientes);
    document
        .getElementById("filtroEspecie")
        .addEventListener("change", filtrarPacientes);
});
