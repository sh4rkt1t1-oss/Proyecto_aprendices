<body>
    <form action="{{ url('/aprendices') }}" method="POST">
        <div>
            <input
                type="text"
                id="nombre"
                name="nombre"
                value="{{ old('nombre') }}"
                required
            >

            {{-- Si el nombre tiene un error, mostramos su mensaje. --}}
            @error('nombre')
                <p style="color: red;">{{ $message }}</p>
            @enderror
        </div>

        <br>

        <div>
            <label for="programa">Programa de formación:</label>

            {{-- Conservamos el programa para evitar escribirlo de nuevo. --}}
            <input
                type="text"
                id="programa"
                name="programa"
                value="{{ old('programa') }}"
                required
            >

            {{-- Si el programa tiene un error, mostramos su mensaje. --}}
            @error('programa')
                <p style="color: red;">{{ $message }}</p>
            @enderror
        </div>

        <br>

        <button type="submit">Presentar aprendiz</button>

        {{-- Abre el listado sin enviar el formulario. --}}
        <p><a href="{{ url('/aprendices') }}">Ver aprendices registrados</a></p>
    </form>
</body>
</html>