# Airport Flight Challenge

## Overview
This repository contains a PHP algorithm to calculate the lowest-cost flights between airports using **Dijkstra's Algorithm**. For more details on the algorithm, refer to [Wikipedia](https://it.wikipedia.org/wiki/Algoritmo_di_Dijkstra).

## Database Configuration
The script connects to a MySQL database using the user `root` without a password. Ensure that MySQL is running and execute the following queries to set up the database and tables before running the script.

## Database Setup
Execute the following SQL commands in MySQL to create and populate the necessary tables.

```sql
CREATE DATABASE `challenge`;

USE `challenge`;

-- Table: voli (Flights)
CREATE TABLE `voli` (
  `codice` varchar(5) NOT NULL,
  `id_departure` varchar(2) NOT NULL,
  `id_arrival` varchar(2) NOT NULL,
  `costo` float(11,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `voli` (`codice`, `id_departure`, `id_arrival`, `costo`) VALUES
('CA001', 'TO', 'CA', 6.00),
('MI001', 'RM', 'MI', 6.00),
('MI002', 'TO', 'MI', 5.00),
('NA001', 'RM', 'NA', 5.00),
('NA002', 'CA', 'NA', 10.00),
('RM001', 'NA', 'RM', 2.00),
('RM002', 'MI', 'RM', 4.00),
('RM003', 'CA', 'RM', 4.00),
('RM004', 'VN', 'RM', 2.00),
('TO001', 'MI', 'TO', 3.00),
('TO002', 'CA', 'TO', 1.00),
('VN001', 'NA', 'VN', 12.00),
('VN002', 'RM', 'VN', 3.00),
('VN003', 'MI', 'VN', 4.00);

ALTER TABLE `voli`
  ADD PRIMARY KEY (`codice`);
COMMIT;

-- Table: aeroporti (Airports)
CREATE TABLE `aeroporti` (
  `codice` varchar(2) NOT NULL,
  `nome` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `aeroporti` (`codice`, `nome`) VALUES
('CA', 'Elmas, Cagliari'),
('MI', 'Linate, Milano'),
('NA', 'Capodichino, Napoli'),
('RM', 'Fiumicino, Roma'),
('TO', 'Caselle, Torino'),
('VN', 'Marco Polo, Venezia');

ALTER TABLE `aeroporti`
  ADD PRIMARY KEY (`codice`);
COMMIT;
```

## Usage
1. Set up the database as described above.
2. Run the PHP script to calculate the cheapest flight route between two given airports.
3. The script will use Dijkstra's Algorithm to determine the optimal path.

## Notes
- Ensure that the MySQL server is running before executing the script.
- Modify the database connection parameters if needed to match your MySQL configuration.
- The script assumes all flight data is stored in the `voli` table and airport data in the `aeroporti` table.

## Disclaimer
This script is provided as-is without any guarantees. Use it at your own risk, and ensure you have backups before making modifications to your database.
