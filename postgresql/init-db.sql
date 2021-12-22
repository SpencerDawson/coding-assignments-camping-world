-- Creation of table: campers
CREATE TABLE IF NOT EXISTS campers (
  id INT NOT NULL,
  doc_id INT NOT NULL,
  make varchar(250) NOT NULL,
  brand varchar(250) NOT NULL,
  capacity INT NOT NULL,
  price INT NOT NULL,
  create_at TIMESTAMP NOT NULL,
  update_at TIMESTAMP NULL,
  PRIMARY KEY (id),
  CONSTRAINT fk_doc_id FOREIGN KEY (doc_id) REFERENCES documents (id)
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

CREATE SEQUENCE documents_id_seq INCREMENT BY 1 MINVALUE 1 START 1;
CREATE SEQUENCE campers_id_seq INCREMENT BY 1 MINVALUE 1 START 1;