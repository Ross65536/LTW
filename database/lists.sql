.mode columns
.headers on

DROP TABLE IF EXISTS lists;
CREATE TABLE lists (
  id INTEGER PRIMARY KEY,
  date_created INTEGER,
  name VARCHAR,
  creator VARCHAR,
  FOREIGN KEY (creator) REFERENCES users
);

DROP TABLE IF EXISTS list_items;
CREATE TABLE list_items (
  id INTEGER PRIMARY KEY,
  list_id INTEGER,
  description VARCHAR,
  done INTEGER DEFAULT 0,
  FOREIGN KEY (list_id) REFERENCES lists,
  UNIQUE (list_id, description)
);

DROP TABLE IF EXISTS list_users;
CREATE TABLE list_users (
  id INTEGER PRIMARY KEY,
  list_id INTEGER,
  username VARCHAR,
  FOREIGN KEY (list_id) REFERENCES lists,
  FOREIGN KEY (username) REFERENCES users,
  UNIQUE (list_id, username)
);
