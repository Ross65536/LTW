DROP TRIGGER IF EXISTS create_list;
CREATE TRIGGER create_list
AFTER INSERT ON lists
  BEGIN
    INSERT INTO list_users (list_id, username) VALUES (NEW.id, NEW.creator);
  END;


INSERT INTO users (username, password, name, email) VALUES ('test', '1234', 'John Doe', 'test@example.com');
INSERT INTO users (username, password, name, email) VALUES ('test2', '1234', 'Maria Doe', 'testa@example.com');
INSERT INTO lists (date_created, name, creator) VALUES (date('now'), 'Lista de Teste', 'test');
INSERT INTO list_users (list_id, username) VALUES (1, 'test2');
INSERT INTO list_items (list_id, description) VALUES (1, 'primeiro item de lista');
INSERT INTO list_items (list_id, description) VALUES (1, 'segundo item de lista');
INSERT INTO list_items (list_id, description) VALUES (1, 'terceiro item de lista');
