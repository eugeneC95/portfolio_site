//user tables
CREATE TABLE user (
    id int(10) AUTO_INCREMENT PRIMARY KEY,
    username varchar(255) NOT NULL,
    password varchar(255) NOT NULL,
    CONSTRAINT username CHECK (username NOT LIKE '%[^A-Z]%'),
    CONSTRAINT password CHECK (password NOT LIKE '%[^A-Z]%')
);
