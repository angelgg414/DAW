<?php
/* Anuncios de ejemplo indexados por id. Solo datos. Precio numérico y fecha ISO. */
return [
    1 => [
        'id'              => 1,
        'tipo_anuncio'    => 'Venta',
        'tipo_vivienda'   => 'Vivienda',
        'titulo'          => 'Ático con terraza en el centro',
        'precio'          => 245000,
        'texto'           => 'Luminoso ático de 110 m² situado en pleno centro de Alicante, a cinco minutos a pie de la Explanada y del Mercado Central. La vivienda se distribuye en un amplio salón-comedor con salida a terraza, cocina independiente totalmente equipada, tres dormitorios y dos baños completos. La terraza de 40 m² ofrece vistas despejadas al castillo de Santa Bárbara.',
        'fecha'           => '2026-09-27',
        'ciudad'          => 'Alicante',
        'pais'            => 'España',
        'usuario'         => 'mariagarcia',
        'foto'            => ['ruta' => 'img/anuncio1.jpg', 'alt' => 'Fachada del edificio del ático en Alicante'],
        'caracteristicas' => [
            'superficie'   => 110,
            'habitaciones' => 3,
            'banos'        => 2,
            'planta'       => '7.ª (ático)',
            'anio'         => 1998,
        ],
        'fotos' => [
            ['ruta' => 'img/anuncio1salon.jpg',   'alt' => 'Salón-comedor con ventanal', 'titulo' => 'Salón-comedor'],
            ['ruta' => 'img/anuncio1cocina.jpg',  'alt' => 'Cocina equipada',            'titulo' => 'Cocina'],
            ['ruta' => 'img/anuncio1terraza.jpg', 'alt' => 'Terraza con vistas',         'titulo' => 'Terraza'],
        ],
    ],
    2 => [
        'id'              => 2,
        'tipo_anuncio'    => 'Alquiler',
        'tipo_vivienda'   => 'Vivienda',
        'titulo'          => 'Piso reformado a 200 m de la playa',
        'precio'          => 950,
        'texto'           => 'Piso completamente reformado a 200 metros de la playa de San Juan. Dispone de salón-comedor con balcón, cocina abierta equipada, dos dormitorios y un baño. Zona tranquila con supermercados, colegios y parada de TRAM a pocos minutos.',
        'fecha'           => '2026-09-26',
        'ciudad'          => 'San Juan de Alicante',
        'pais'            => 'España',
        'usuario'         => 'jlopez',
        'foto'            => ['ruta' => 'img/anuncio2.jpg', 'alt' => 'Edificio de apartamentos junto a la playa de San Juan'],
        'caracteristicas' => [
            'superficie'   => 85,
            'habitaciones' => 2,
            'banos'        => 1,
            'planta'       => '3.ª',
            'anio'         => 2004,
        ],
        'fotos' => [
            ['ruta' => 'img/anuncio2.jpg', 'alt' => 'Fachada del edificio junto a la playa', 'titulo' => 'Vista exterior'],
        ],
    ],
];
