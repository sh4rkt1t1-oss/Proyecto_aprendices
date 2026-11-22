<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Listado de aprendices</title>
</head>
<body>
    <h1>Aprendices registrados</h1>

    <table>
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Nombre</th>
                <th scope="col">Programa de formación</th>
            </tr>
        </thead>
        <tbody>
            {{-- Cada aprendiz que envía el controlador ocupa una fila. --}}
            @forelse ($aprendices as $aprendiz)
                <tr>
                    <td>{{ $aprendiz->id }}</td>
                    <td>{{ $aprendiz->nombre }}</td>
                    <td>{{ $aprendiz->programa }}</td>
                </tr>
            @empty
                {{-- Este mensaje aparece cuando la consulta no devuelve registros. --}}
                <tr>
                    <td colspan="3">Aún no hay aprendices registrados.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <p><a href="{{ url('/aprendices/crear') }}">Registrar otro aprendiz</a></p>
</body>
</html>