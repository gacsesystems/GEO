<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  {{-- <-- INYECTA AQUI LA PREAMBLE DE REACT REFRESH --}}
  @viteReactRefresh
  {{-- luego tus bundles --}}
  @vite(['resources/css/app.css', 'resources/js/app.jsx'])
  <title>GeoEncuestas</title>
</head>
<body>
  <div id="app"></div>
</body>
</html>