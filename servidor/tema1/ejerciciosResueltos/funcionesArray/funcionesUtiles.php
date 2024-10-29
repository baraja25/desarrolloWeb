<?php

// Ejemplo de creación y manipulación de arrays
$frutas = array("manzana", "plátano", "naranja");  // Crear un array de frutas
array_push($frutas, "kiwi");  // Añadir "kiwi" al final del array
array_unshift($frutas, "fresa");  // Añadir "fresa" al inicio del array
array_pop($frutas);  // Eliminar el último elemento ("kiwi")
array_shift($frutas);  // Eliminar el primer elemento ("fresa")

print_r($frutas);  // Imprimir el array resultante

// Búsqueda en arrays
$colores = ["rojo", "verde", "azul", "amarillo"];  // Crear un array de colores
echo in_array("azul", $colores) ? "Color encontrado\n" : "Color no encontrado\n";  // Verificar si "azul" está en el array
echo "Posición de 'verde': " . array_search("verde", $colores) . "\n";  // Obtener la posición de "verde" en el array

$asociativo = ["nombre" => "Ana", "edad" => 30];  // Crear un array asociativo
echo array_key_exists("nombre", $asociativo) ? "Clave 'nombre' existe\n" : "Clave 'nombre' no existe\n";  // Verificar si existe la clave "nombre"

// Filtrado y extracción de datos
$numeros = [10, 20, 30, 40, 50];  // Crear un array de números
$numeros_filtrados = array_filter($numeros, fn($num) => $num > 25);  // Filtrar valores mayores a 25
print_r($numeros_filtrados);  // Imprimir los números filtrados

$numeros_mapeados = array_map(fn($num) => $num * 2, $numeros);  // Multiplicar cada valor por 2
print_r($numeros_mapeados);  // Imprimir el array resultante

$parte_numeros = array_slice($numeros, 1, 3);  // Extraer una porción del array desde el índice 1, con longitud 3
print_r($parte_numeros);  // Imprimir la porción extraída

array_splice($numeros, 2, 1, [100, 200]);  // Reemplazar un elemento a partir del índice 2 con 100 y 200
print_r($numeros);  // Imprimir el array modificado

// Ordenación de arrays
sort($colores);  // Ordenar los valores en orden ascendente
print_r($colores);  // Imprimir el array ordenado

rsort($colores);  // Ordenar en orden descendente
print_r($colores);  // Imprimir el array ordenado

$edades = ["Juan" => 25, "Ana" => 18, "Luis" => 35];  // Crear un array asociativo de edades
asort($edades);  // Ordenar el array por valores de menor a mayor, manteniendo las claves
print_r($edades);  // Imprimir el array ordenado por valores

arsort($edades);  // Ordenar el array por valores de mayor a menor, manteniendo las claves
print_r($edades);  // Imprimir el array ordenado por valores

ksort($edades);  // Ordenar el array por claves de menor a mayor
print_r($edades);  // Imprimir el array ordenado por claves

krsort($edades);  // Ordenar el array por claves de mayor a menor
print_r($edades);  // Imprimir el array ordenado por claves

// Transformación de datos
$otros_numeros = [5, 10, 15];
$mas_numeros = [20, 25];
$union = array_merge($otros_numeros, $mas_numeros);  // Combinar ambos arrays en uno solo
print_r($union);  // Imprimir el array combinado

$nombres = ["Ana", "Juan", "Pedro"];
$edades = [28, 34, 22];
$combinado = array_combine($nombres, $edades);  // Combinar los nombres como claves y las edades como valores
print_r($combinado);  // Imprimir el array combinado

$suma = array_reduce($numeros, fn($carry, $num) => $carry + $num);  // Sumar todos los elementos del array
echo "Suma de los números: $suma\n";  // Imprimir el resultado de la suma

// Obtener claves y valores
$claves = array_keys($asociativo);  // Obtener todas las claves del array asociativo
$valores = array_values($asociativo);  // Obtener todos los valores del array asociativo
print_r($claves);  // Imprimir las claves
print_r($valores);  // Imprimir los valores

// Operaciones con arrays multidimensionales
$alumnos = [
    ['nombre' => 'Ana', 'curso' => '2023'],
    ['nombre' => 'Luis', 'curso' => '2024'],
    ['nombre' => 'Marta', 'curso' => '2023']
];
$cursos = array_column($alumnos, 'curso');  // Extraer la columna "curso" de cada elemento
print_r($cursos);  // Imprimir la lista de cursos

array_walk_recursive($alumnos, function ($valor, $clave) {  // Imprimir cada clave y valor en el array multidimensional
    echo "$clave: $valor\n";
});

// Contar elementos en arrays
echo "Total elementos en frutas: " . count($frutas) . "\n";  // Contar el número de elementos en el array de frutas
$repetidos = ["manzana", "manzana", "pera", "pera", "pera"];
$conteo = array_count_values($repetidos);  // Contar la cantidad de veces que se repite cada valor
print_r($conteo);  // Imprimir el resultado del conteo
