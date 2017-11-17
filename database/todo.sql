CREATE TABLE users (
  username VARCHAR PRIMARY KEY,
  password VARCHAR NOT NULL,
  name VARCHAR,
  email VARCHAR UNIQUE
);
