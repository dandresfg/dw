<aside class="aside-styles d-flex flex-column flex-shrink-0 text-dark">
    <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-dark text-decoration-none p-2">
        <span class="fs-4">Centro del laboratorio</span>
    </a>
    <hr />
    <ul class="nav nav-pills flex-column mb-auto p-2">
        <li class="nav-item text-left mb-4">
            <a href="/laboratorio/" class="nav-link d-flex gap-2 text-dark">
                <span class="material-icons-outlined">person</span>
                Pacientes
            </a>
        </li>
        <li class="text-left mb-4">
            <a href="/laboratorio/paciente/create.php" class="nav-link d-flex gap-2 text-dark">
                <span class="material-icons-outlined">add</span>
                Agregar Paciente
            </a>
        </li>
        <li class="text-left mb-4">
            <a href="/laboratorio/analysis/index.php" class="nav-link d-flex gap-2 text-dark">
                <span class="material-icons-outlined">format_list_bulleted</span>
                Examenes
            </a>
        </li>
        <li class="text-left mb-4">
            <form action="/laboratorio/auth/logout.php" method="POST" class="nav-link d-flex gap-2 text-dark"">
                <button class="btn btn-outline-danger" type="submit">
                    <span class="material-icons-outlined">
                        logout
                    </span>
                    Salir
                </button>
            </form>
        </li>
    </ul>
</aside>