CREATE TABLE users (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(256) NOT NULL,
    middle_name VARCHAR(256) NOT NULL,
    last_name VARCHAR(256) NOT NULL,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL
);

CREATE TABLE phones (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    phone VARCHAR(256) NOT NULL,
    user_id INT NOT NULL,
    FOREIGN KEY (user_id)
        REFERENCES users(id)
        ON DELETE CASCADE
);

INSERT INTO users (first_name, middle_name, last_name, created_at) VALUES 
    ('Сергей', 'Ильич', 'Беляков', NOW()),
    ('Алексей', 'Ильич', 'Беляков', NOW()),
    ('Сергей', 'Антонович', 'Беляков', NOW()),
    ('Сергей', 'Ильич', 'Плечевой', NOW());

INSERT INTO phones (phone, user_id) VALUES
    ('88005553535', 1),
    ('911', 1),
    ('112', 4);