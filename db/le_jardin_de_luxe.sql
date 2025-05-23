-- --------------------------------------------------------
-- Base de données : le_jardin_de_luxe
-- Projet : Boutique en ligne de produits de luxe importés du Japon
-- Auteur : Fetra Henintsoa Ratsimaharison
-- --------------------------------------------------------

CREATE DATABASE IF NOT EXISTS le_jardin_de_luxe;
USE le_jardin_de_luxe;

-- --------------------------------------------------------
-- Table : produits
-- --------------------------------------------------------

CREATE TABLE IF NOT EXISTS produits (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nom VARCHAR(255) NOT NULL,
  description TEXT,
  prix DECIMAL(10,2) NOT NULL,
  image VARCHAR(255),
  date_ajout TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);