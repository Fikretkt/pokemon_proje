USE pokedoc; -- GÜNCELLENDİ

CREATE TABLE pokemon (
    id INT AUTO_INCREMENT PRIMARY KEY,
    pokemon_id INT NOT NULL UNIQUE, 
    name VARCHAR(255) NOT NULL,
    type1 VARCHAR(50),
    type2 VARCHAR(50) NULL,
    height_dm DECIMAL(5, 2), 
    weight_hg DECIMAL(5, 2)  
);