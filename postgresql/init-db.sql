-- Creation of table: campers
CREATE TABLE IF NOT EXISTS campers (
  id INT NOT NULL,
  make varchar(250) NOT NULL,
  brand varchar(250) NOT NULL,
  capacity INT NOT NULL,
  price INT NOT NULL,
  create_at TIMESTAMP NOT NULL,
  update_at TIMESTAMP NULL,
  PRIMARY KEY (id)
);

-- Creation of table: documents
CREATE TABLE IF NOT EXISTS documents (
  id INT NOT NULL,
  name varchar(250) NOT NULL,
  path varchar(260) NOT NULL,
  type varchar(16) NOT NULL,
  create_at TIMESTAMP NOT NULL,
  update_at TIMESTAMP NULL,
  PRIMARY KEY (id)
);
