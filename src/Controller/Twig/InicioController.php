<?php

namespace App\Controller\Twig;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class InicioController extends AbstractController
{
    public function __invoke(): Response {
        return $this->render('Twig/inicio.html.twig',[
            'secciones' => [
                ['id' => 'variables-globales', 'titulo' => 'Variables globales', 'contenido' => 'Twig/includes/variables-globales.html.twig', 'mas' => ''],
                ['id' => 'variables', 'titulo' => 'Declaracion de variables', 'contenido' => 'Twig/includes/declaracion-varibles.html.twig', 'mas' => ''],
                ['id' => 'filtros', 'titulo' => 'Filtros', 'contenido' => 'Twig/includes/filtros.html.twig', 'mas' => ''],
                ['id' => 'funciones', 'titulo' => 'Funciones', 'contenido' => 'Twig/includes/funciones.html.twig', 'mas' => ''],
                ['id' => 'estructuras-control', 'titulo' => 'Estructuras de control', 'contenido' => 'Twig/includes/estructuras-control.html.twig', 'mas' => ''],
                ['id' => 'incluir-plantillas', 'titulo' => 'Incluir plantillas', 'contenido' => 'Twig/includes/incluir-plantillas.html.twig', 'mas' => ''],
                ['id' => 'herencia-plantillas', 'titulo' => 'Herencia plantillas', 'contenido' => 'Twig/includes/herencia-plantillas.html.twig', 'mas' => ''],
                ['id' => 'escape', 'titulo' => 'Escape', 'contenido' => 'Twig/includes/escape.html.twig', 'mas' => ''],
                ['id' => 'macros', 'titulo' => 'Macros', 'contenido' => 'Twig/includes/macros.html.twig', 'mas' => ''],
                ['id' => 'expresiones', 'titulo' => 'Expresiones', 'contenido' => 'Twig/includes/expresiones.html.twig', 'mas' => ''],
            ]
        ]);
    }

}
