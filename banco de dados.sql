CREATE TABLE insumo (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    unidade VARCHAR(10) NOT NULL,
    quantidade DECIMAL(10,2) NOT NULL DEFAULT 0,
    preco DECIMAL(10,2) NOT NULL,
    id_categoria INT NOT NULL,
    FOREIGN KEY (id_categoria) REFERENCES categoria(id)
);

INSERT INTO categoria (nome) VALUES
('Fertilizante'),
('Defensivo'),
('Semente');

INSERT INTO insumo
(nome, unidade, quantidade, preco, id_categoria)
VALUES
('Ureia', 'kg', 500, 3.80, 1),
('Glifosato', 'L', 120, 28.50, 2),
('Semente de Soja', 'kg', 800, 7.90, 3);