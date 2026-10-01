# PMC Consultora

<p align="center">
  <img src="media/capturaBanner.png" alt="PMC Consultora" width="100%">
</p>

Sitio web desarrollado para **PMC Consultora**, empresa especializada en consultoría para la industria de alimentos y gastronomía.

Es una landing comercial orientada a presentar los servicios de la consultora, generar consultas de potenciales clientes y medir las principales acciones de conversión.

[pmcconsultora.com.ar](https://www.pmcconsultora.com.ar/)

![Status](https://img.shields.io/badge/STATUS-EN%20PRODUCCIÓN-2EA44F)
![HTML5](https://img.shields.io/badge/HTML5-E34F26?logo=html5&logoColor=white)
![CSS3](https://img.shields.io/badge/CSS3-1572B6?logo=css&logoColor=white)
![JavaScript](https://img.shields.io/badge/JavaScript-F7DF1E?logo=javascript&logoColor=000)
![PHP](https://img.shields.io/badge/PHP-777BB4?logo=php&logoColor=white)
![Google Ads](https://img.shields.io/badge/Google%20Ads-4285F4?logo=googleads&logoColor=white)

## Sobre la web

La web es completamente responsive y está adaptada para escritorio, tablet y dispositivos móviles.

Incluye múltiples secciones de contenido, navegación responsive con menú hamburguesa, llamados a la acción (CTA), formulario de contacto y botones de contacto para Whatsapp y email.

Además del desarrollo del sitio, configuré la campaña de **Google Ads** asociada al proyecto e implementé la medición de conversiones mediante `gtag.js`.

También incorporé optimizaciones de SEO para mejorar el posicionamiento de la web.

### Formulario de contacto

El formulario utiliza un backend en PHP para procesar las consultas.

Incluye:

- Validación de campos.
- Sanitización de los datos recibidos.
- Protección básica contra bots mediante honeypot.
- Envío de consultas por correo electrónico.

### Medición de conversiones

El sitio integra Google Ads mediante `gtag.js`.

Se registran de forma independiente las siguientes acciones:

- Envío del formulario.
- Contacto por WhatsApp.
- Contacto por email.
- Descarga del checklist de autodiagnóstico.

Esto permite diferenciar las conversiones principales de otras interacciones secundarias y analizar con mayor precisión el rendimiento de las campañas.

## Autor

| [<img src="https://github.com/PabloBottinelli.png" width="115"><br><sub>Pablo Bottinelli</sub>](https://github.com/PabloBottinelli) |
| :---: |