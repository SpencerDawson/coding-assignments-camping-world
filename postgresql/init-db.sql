-- Creation of campers table
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
