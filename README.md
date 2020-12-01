# Aeroport-Flight-Challenge

Algoritmo PHP per il calcolo di voli al minor prezzo

Eseguire questa query in MySql prima di eseguire lo script:

```sql
CREATE DATABASE `challenge`;

USE `challenge`;

--
-- Dati per la tabella `voli`
--

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

CREATE TABLE `aeroporti` (
  `codice` varchar(2) NOT NULL,
  `nome` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dati per la tabella `aeroporti`
--

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
