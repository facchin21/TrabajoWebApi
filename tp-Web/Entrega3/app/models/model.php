<?php
require_once './config/config.php';
    class Model {
        protected $db;

        function __construct(){
            $this->db = new PDO('mysql:host=' . DB_HOST . ';dbname=tp-web;charset=' . DB_Charset, DB_USER, DB_PASS);
            $this->deploy();
        }

    function deploy() {
        $query = $this->db->query('SHOW TABLES');
        $tables = $query->fetchAll();
        if(count($tables)==0) {
            $sql =<<<END
                        
                        
            --
            -- Base de datos: `tp-web`
            --

            -- --------------------------------------------------------

            --
            -- Estructura de tabla para la tabla `motos`
            --

            CREATE TABLE `motos` (
            `ModeloID` int(11) NOT NULL,
            `capacidadTanque` double NOT NULL,
            `cinlindrada` double NOT NULL,
            `fuerza` double NOT NULL,
            `nombreProducto` varchar(45) NOT NULL
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

            --
            -- Volcado de datos para la tabla `motos`
            --

            INSERT INTO `motos` (`ModeloID`, `capacidadTanque`, `cinlindrada`, `fuerza`, `nombreProducto`) VALUES
            (1, 4.3, 110, 4300, 'Wave S'),
            (2, 12.7, 149, 6540, 'New Titan');

            -- --------------------------------------------------------

            --
            -- Estructura de tabla para la tabla `transacciones`
            --

            CREATE TABLE `transacciones` (
            `transacionesID` int(11) NOT NULL,
            `canal` varchar(45) NOT NULL,
            `modeloID` int(11) NOT NULL,
            `precio` double NOT NULL,
            `descuento` double DEFAULT NULL
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

            -- --------------------------------------------------------

            --
            -- Estructura de tabla para la tabla `user`
            --

            CREATE TABLE `user` (
            `userID` int(11) NOT NULL,
            `nombre` varchar(45) NOT NULL,
            `password` varchar(250) NOT NULL
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

            --
            -- Volcado de datos para la tabla `user`
            --

            INSERT INTO `user` (`userID`, `nombre`, `password`) VALUES
            (1, 'webadmin', '$2y$10$0ZQc0JrSaS0iMV1z52YkUO0rS8vPweETs89vqSWliLbQt7.d7BZFS');

            --
            -- Índices para tablas volcadas
            --

            --
            -- Indices de la tabla `motos`
            --
            ALTER TABLE `motos`
            ADD PRIMARY KEY (`ModeloID`);

            --
            -- Indices de la tabla `transacciones`
            --
            ALTER TABLE `transacciones`
            ADD PRIMARY KEY (`transacionesID`),
            ADD KEY `fk_Transactions_Products` (`modeloID`);

            --
            -- Indices de la tabla `user`
            --
            ALTER TABLE `user`
            ADD PRIMARY KEY (`userID`);

            --
            -- AUTO_INCREMENT de las tablas volcadas
            --

            --
            -- AUTO_INCREMENT de la tabla `motos`
            --
            ALTER TABLE `motos`
            MODIFY `ModeloID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

            --
            -- AUTO_INCREMENT de la tabla `transacciones`
            --
            ALTER TABLE `transacciones`
            MODIFY `transacionesID` int(11) NOT NULL AUTO_INCREMENT;

            --
            -- AUTO_INCREMENT de la tabla `user`
            --
            ALTER TABLE `user`
            MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

            --
            -- Restricciones para tablas volcadas
            --

            --
            -- Filtros para la tabla `transacciones`
            --
            ALTER TABLE `transacciones`
            ADD CONSTRAINT `fk_Transactions_Products` FOREIGN KEY (`modeloID`) REFERENCES `motos` (`ModeloID`);
            COMMIT;

            END;
                $this->db->query($sql);
        }
    }

}