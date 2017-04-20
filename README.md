database table
============
Name: Recept

| id | matnamn | recept |
| --- | --- | --- |
| 1 | koka makaroner | Koka upp vatten ... |
| 2 | koka te | Koka upp vatten ... |

SQL to create database and table
-------------------
You have to create the database and the table. Use commands below.

-- Skapa databas
CREATE DATABASE Webbutveckling

-- Välj utf-8 ??? hur ? TODO

-- Välj den databas som ska användas
USE Webbutveckling

-- Skapa tabellen Recept
CREATE TABLE Recept
(
    id INT PRIMARY KEY AUTO_INCREMENT,
    matnamn CHAR(100),
    recept TEXT
);

-- Lägg till rader i tabellen Recept
INSERT INTO Recept (matnamn, recept) VALUES ('Koka makaroner', 'Koka upp vatten i en stor kastrull. Häll i 70 gram pasta per person. Koka i 10 minuter. Häll av i drukslag.');

INSERT INTO Recept (matnamn, recept) VALUES ('Koka te', 'Koka upp vatten. Häll i en mugg. Tag teblad i en tetång. Ställ tången i muggen med vatten. Låt stå i 5 minuter.');

More examples using SQL
----------------

-- Välj alla rader i tabellen Recept
SELECT * FROM Recept;

-- Välj den första raden
SELECT * FROM Recept WHERE id=0;

-- Välj raden för koka te
SELECT * FROM Recept WHERE matnamn='koka te';

-- Välj recept från raden koka te
SELECT recept FROM Recept WHERE matnamn='koka te';

index.php
=========
Display all recipes.

Click to add a recipe. Linked to: recept-admin.php?new=new

Click to change a recipe. Linked to: recept-admin.php?id=2

recept-admin.php
===========
Adds new recipe to database if $_GET['new']='new'. 
Will set $_GET['id'] to the id of the added recipe.

Form that displays the recipe subject to change. $_GET['id'] determines wich to display.

Form sent to self: recept-admin.php?id=2 using post

If $_POST is set changes is saved to database. 
Will strip tags from input. Used for security.

Link to remove recipe: recept-admin-delete.php?id=2

recept-admin-delete.php
===============
Used to display recipe subject to delete. 
Confirm delete or return to index.php.

functions.php
==============
A function used to connect to the database.