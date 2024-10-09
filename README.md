> # UDG - CUCEI 2024B
### Proyecto Modular: Rumble GYM
* Integrantes
  * Fernandez de Lara Hernandez Juan Emmanuel
  * Del Rio Gómez Paola Vanessa
  * Torres Gutiérrez Diego
### Asesor 
  * Morales Castañeda Juan Bernardo


# CUENTAS DE ACCESO

#### Cuenta empleado de prueba
Código: 1111
Contraseña: 1234

#### Cuentas usuarios de prueba
Código: 12345
Fecha de nacimiento: 21/02/2000

Código: 46741
Fecha de nacimiento: 04/06/2001

# Descripción del proyecto
Rumble GYM consiste en un sistema de gestión de gimnasios en el cual permite el manejo de usuairos, empleados, productos, ventas y accesos. Además, permiten que usuarios del gimnasio generen su propio perfil para la recomendación de rutinas basado en el tipo de rutina a realizar, los días y el tiempo disponible de entrenamiento, y el equipo de entrenamiento que tenga el usuario a su alcance. Dicha recomendación se realiza en base a un árbol de decisión, en el cúal elige entre más de 1300 ejercicios provenientes de un archivo CSV, en donde dependiendo de los criterios ingresados por el usuario al momento de crear la rutina, el arbol se encarga de realizar la recomendación más precisa posible. El proyecto modular "Rumble GYM" fue diseñado con el objetivo de optimizar la gestión y el seguimiento de los datos personales y de entrenamiento de los clientes, ofreciendo una experiencia personalizada, amigable y accesible para entornos de gimnasios.
<p align="center"> <img src="https://github.com/Jeflh/rumble_gym/blob/main/Imagenes%20README/2.png"/> </p>
<br><br><br>

# Módulo 1: Arquitectura y Programación de Sistemas
La aplicación fue creada principalmente con la del lenguaje php, en donde se organizó el código y las carpetas del proyecto con una estructura organizada para los recursos de nuestro proyecto (Modelo Vista Controlador). El uso de Boostrap son indispensables para que nuestro sitio sea atractivo e intuitivo. Para la realización de la base de datos se usó MySql, y para el entrenamiento y el uso de los modelos de IA se usa el lenguaje de Python.
<p align="center"> <img src="https://github.com/Jeflh/rumble_gym/blob/main/Imagenes%20README/4.png"/> </p>
<br><br>

El servidor principal es el que tiene la aplicación con PHP y Boostrap que se le muestra al usuario, después se tiene un servidor el cual cumple la función de contener a la base de datos de donde se obtendrán y guardaran datos sobre todo lo relacionado sobre la gestión del gimnasio y rutinas de usuarios. El tercer servidor el cual es descentralizado sólo interactúa con el servidor que cuenta con la aplicación principal para realizar los cálculos relacionados con Inteligencia Artificial.
<p align="center"> <img src="https://github.com/Jeflh/rumble_gym/blob/main/Imagenes%20README/6.png"/> </p>
<br><br>

Se utilizó la metodología ágil Scrum para el desarrollo de nuestro proyecto, se contaron con 3 sprints cada uno de 2 meses en los cuales se realizaron investigaciones, desarrollo y pruebas del proyecto.
<p align="center"> <img src="https://github.com/Jeflh/rumble_gym/blob/main/Imagenes%20README/7.png"/> </p>
<br><br>

<p align="center"> <img src="https://github.com/Jeflh/rumble_gym/blob/main/Imagenes%20README/8.png"/> </p>
<br><br>

<p align="center"> <img src="https://github.com/Jeflh/rumble_gym/blob/main/Imagenes%20README/22.png"/> </p>
<br><br>
<p align="center"> <img src="https://github.com/Jeflh/rumble_gym/blob/main/Imagenes%20README/23.png"/> </p>
<br><br>
<p align="center"> <img src="https://github.com/Jeflh/rumble_gym/blob/main/Imagenes%20README/24.png"/> </p>
<br><br>
<p align="center"> <img src="https://github.com/Jeflh/rumble_gym/blob/main/Imagenes%20README/25.png"/> </p>
<br><br>



# Módulo 2: Sistemas Inteligentes
Para el entrenamiento del árbol de decisiones, se tomaron en cuenta más de 1300 ejercicios almacenados en un archivo CSV. Los ejercicios se dividen principalmente en tres categorias: Fuerza, Cardio y Flexibilidad. En donde adicionalmente, para la recomendación de dichos ejercicios, las variables principales de selección consisten en el Equipamiento, el IMC y la Duración de cada sesión de entrenamiento.
<p align="center"> <img src="https://github.com/Jeflh/rumble_gym/blob/main/Imagenes%20README/10.png"/> </p>
<br><br>

La implementación del árbol de decisiones se bado principalmente en 4 pasos. Para el entrenamiento del modelo se utilizo el índice de pureza de Entropía para buscar la caracteristica que mejor separa a los usuarios en categorías de rutina recomendada. Dicho método se implemento dentro del algoritmo de recomendación, en la estructura del árbol de deciciones. Una vez se completa el recorrido del árbol hasta dar con la hoja o el ejercicio recomendado, se almacena el ID del ejercicio en dentro de la sección asignada al dia de entrenamiento, dentro de un archivo JSON. Dependiendo de la cantidad de ejercicios por día, sera la cantidad de recorridos que realice el árbol para la recomendación de ejercicios.
<p align="center"> <img src="https://github.com/Jeflh/rumble_gym/blob/main/Imagenes%20README/11.png"/> </p>
<br><br>
<p align="center"> <img src="https://github.com/Jeflh/rumble_gym/blob/main/Imagenes%20README/12.png"/> </p>
<br><br>

Para que la recomendación se ajuste a las necesidades especificas del usuario, incluimos criterios o condiciones para la elección de ejercicios en donde las tres principales variables de decision se ven involucradas (Duración de Sesiones, IMC y Equipamiento).
<p align="center"> <img src="https://github.com/Jeflh/rumble_gym/blob/main/Imagenes%20README/13.png"/> </p>
<br><br>


La entropía incluida en este árbol de recomendación nos permite visualizar la presición del modelo actual. En la gráfica se muestran ejemplos de parámetros ingresados por el usuario (eje X) y la cantidad de entropía que se tiene en la recomendación al ingresar dichas variables (eje Y). Los puntos altos en la gráfica, significa que la combinación de parámetros tiene una gran variedad de ejercicios disponibles. Los puntos bajos indican que los ejercicios recomendados son más homogéneos y específicos.
<p align="center"> <img src="https://github.com/Jeflh/rumble_gym/blob/main/Imagenes%20README/14.png"/> </p>
<br><br>
<p align="center"> <img src="https://github.com/Jeflh/rumble_gym/blob/main/Imagenes%20README/15.png"/> </p>
<br><br>



# Módulo 3: Sistemas Distribuidos
En este módulo se realizó un sistema distribuido para la realización de los cálculos con los modelos de inteligencia artificial, primeramente se introducen las respuestas por parte del usuario al momento del llenado del formulario para la generación de la rutina, y al accionar el botón de "Generar Rutina" se mandan todas las frases que el usuario escribió. Las frases llegaran al segundo servidor mediante una solicitud HTTP en donde se recibira dicha solicitud gracias a la ayuda de la biblioteca flask, ya ahi se realizarán los cálculos correspondientes para obtener la mejor carrera respecto a las respuestas del usuario, tal resultado se devolverá al servidor principal en donde se mostrarán los ejercicios recomendados.
<p align="center"> <img src="https://github.com/Jeflh/rumble_gym/blob/main/Imagenes%20README/18.png"/> </p>







