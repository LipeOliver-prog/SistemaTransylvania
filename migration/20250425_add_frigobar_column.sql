SELECT * FROM `frigobar` WHERE 1
 ALTER TABLE frigobar ADD valor_total DECIMAL(10,2) NOT NULL DEFAULT 0.00;

 ALTER TABLE `clientes` ADD `especie` VARCHAR(100) NOT NULL ; 
 ALTER TABLE `funcionarios` ADD `especie` VARCHAR(100) NOT NULL ; 
 ALTER TABLE `quartos` ADD `especie` VARCHAR(100) NOT NULL ; 

