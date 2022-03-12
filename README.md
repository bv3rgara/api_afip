# AFIP CMC
### Vencimiento del certificado de seguridad emitido por AFIP
Seguir los siguientes pasos:
1. Desde la shell del servidor donde esta alojado el proyecto se debe ejecutar y generar lo siguiente:
    - Generar la key: ```openssl genrsa -out newPass 2048 ```
    - Generar el CSR: ```openssl req -new -key newPass -subj "/C=AR/O=CMC/CN=cmc/serialNumber=CUIT 3057XXX692" -out newCSR```
2. Ingresar a AFIP y acceder a "Administracion de Certificados Digitales" y luego click en el boton "Agregar certificado" y cargar el archivo newCSR generado anteriormente.
3. Descargar el CMC_736ce805617038c8.crt emitido por la AFIP y llevarlo junto con la newPass generado anteriormente dentro de la carpeta Afip_res del proyecto de la afip y renombrarlo correctamente.
4. Reiniciar los servicios y probar el funcionamiento del endpoint.