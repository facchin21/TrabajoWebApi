# TrabajoWebApi

# WEB 2 TPE entrega 3

## Descripcion:
Realizamos un proyecto de compra e información de motos.

## Integrantes:
- Fermin Facchin Quiroga.
- Pablo Andres Aguirre.
  
___________________________________________________________________________________________________
## Ejemplos y descripción de los endpoints:
api/motos (con método GET) trae todas las motos con sus características en formato JSON, ejemplo:
```[
    {
        "ModeloID": 4,
        "capacidadTanque": 1,
        "cinlindrada": 150,
        "fuerza": 21,
        "nombreProducto": "Pepe"
    },
    {
        "ModeloID": 2312313,
        "capacidadTanque": 10,
        "cinlindrada": 150,
        "fuerza": 23340,
        "nombreProducto": "wCarlos"
    }
]
```
___________________________________________________________________________________________________
api/motos:ID (con método GET)  trae la moto con la ID(ModeloID) que se pasa por parametro con sus características en formato JSON, ejemplo:
api/motos/4
```[
    {
        "ModeloID": 4,
        "capacidadTanque": 1,
        "cinlindrada": 150,
        "fuerza": 21,
        "nombreProducto": "Pepe"
    }
]
```
___________________________________________________________________________________________________
api/motos (con método POST) agrega una moto nueva cuando la reciba con un JSON, por ejemplo:
  ```  {
        "capacidadTanque": 1,
        "cinlindrada": 150,
        "fuerza": 21,
        "nombreProducto": "Pepe"
    }
```
___________________________________________________________________________________________________
api/motos:ID (con método PUT) modifica la moto con la ID(ModeloID) que se pasa por parametro con sus características en formato JSON, ejemplo:
api/motos/4
  ```  {
        "capacidadTanque": 9,
        "cinlindrada": 150,
        "fuerza": 25,
        "nombreProducto": "titan"
    }
```
___________________________________________________________________________________________________
api/motos:ID (con método DELETE) elimina la moto con el ID(ModeloID) que se pasa por parámetro junto con todas sus características, por ejemplo:
api/motos/4
___________________________________________________________________________________________________
api/motos/nombreProducto/:nombreProducto(con método GET) filtra las motos por el nombreProducto que recibe por parámetro, por ejemplo:
api/motos/nombreProducto/titan
  ```  {
        "ModeloID": 4,
        "capacidadTanque": 1,
        "cinlindrada": 150,
        "fuerza": 21,
        "nombreProducto": " titan "
    }
    {
        "ModeloID": 5,
        "capacidadTanque": 1,
        "cinlindrada": 150,
        "fuerza": 21,
        "nombreProducto": " titan "
    }
```
___________________________________________________________________________________________________
api/transacciones (con método GET) trae todas las transacciones con sus características en formato JSON, por ejemplo:
```[
    {
        "transaccionesID": 1414,
        "canal": “web”,
        "modeloID": 4,
        "precio": 999,
        "descuento": 100
    },
    {
        "transaccionesID": 1415,
        "canal": “Movil”,
        "modeloID": 5,
        "precio": 999,
        "descuento": 100
    }
]
```
___________________________________________________________________________________________________
api/transacciones (con método POST) agrega una transaccion nueva cuando la reciba con un JSON, por ejemplo:
  ```  {
        "canal": “Movil”,
        "modeloID": 5,
        "precio": 999,
        "descuento": 100
    }
```
___________________________________________________________________________________________________
api/transacciones/:ID (con método GET)  trae la transaccion con la ID(transaccionesID) que se pasa por parametro con sus características en formato JSON, ejemplo:
api/transacciones/1415
  ```  {
        "transaccionesID": 1415,
        "canal": “Movil”,
        "modeloID": 5,
        "precio": 999,
        "descuento": 100
    }
```
___________________________________________________________________________________________________
api/transacciones/:ID (con método PUT) modifica la transaccion con la ID(transaccionesID) que se pasa por parametro con sus características en formato JSON, ejemplo: 
api/transacciones/1415
 ```   {
        "canal": “Web”,
        "modeloID": 5,
        "precio": 1500,
        "descuento": 0
    }
```
___________________________________________________________________________________________________
api/transacciones/:ID (con método DELETE) elimina la transaccion con el ID(transaccionesID) que se pasa por parámetro junto con todas sus características, por ejemplo:
api/transacciones/1415
___________________________________________________________________________________________________
api/transacciones/canal/:CANAL (con método GET) trae todas las transacciones con el canal que se pasa por parametro con sus características en formato JSON, ejemplo:
api/transacciones/canal/Web
```[   
 {
        "transaccionesID": 1415,
        "canal": “Web”,
        "modeloID": 5,
        "precio": 1500,
        "descuento": 0
    }
    {
        "transaccionesID": 1416,
        "canal": “Web”,
        "modeloID": 6,
        "precio": 1500,
        "descuento": 0
    }
]
```
___________________________________________________________________________________________________
api/transacciones/orden/:ORDEN(con método GET) Devuelve las transacciones ordenadas de forma ascendente o descendente por el precio. El parametro :ORDER debe ser reemplazado por "asc" o por "desc" para que sea ordenado de alguna de las mismas, por ejemplo:
api/transacciones/orden/asc
```[   
 {
        "transaccionesID": 1415,
        "canal": “Web”,
        "modeloID": 5,
        "precio": 1,
        "descuento": 0
    }
    {
        "transaccionesID": 1416,
        "canal": “Web”,
        "modeloID": 6,
        "precio": 10,
        "descuento": 0
    }
   {
        "transaccionesID": 1417,
        "canal": “Web”,
        "modeloID": 7,
        "precio": 100,
        "descuento": 0
    }
]
```
___________________________________________________________________________________________________
api/auth/token(con método POST) Para poder utilizar los métodos PUT, POST o DELETE el usuario debe ser autorizado, por eso a traves del endpoint POST auth/token debe hacer un "Basic Auth" ingresando usuario (webadmin) y password (admin). Cuando tiene el token debe ingresar a "Headers" , en el campo “key” escribe "Authorization" y en el campo “Value” escribe “Bearer” seguido del token generado. Luego de esto volvemos a “Headers”, seleccionamos en “Type” “Bearer Token” y en el campo “Token” pega el token generado. 
Luego de seguir estos pasos el usuario podrá utilizar los métodos PUT, POST o DELETE según desee durante 60 minutos, pasado este tiempo tendrá que verificarse nuevamente.
