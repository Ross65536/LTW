-- need to update password if passwording salting is changed

INSERT INTO users (username, password, name, email, photo_url) VALUES ('test', '$2y$10$2l7VoYVm2MUBetimJSZyXOuNj9mbl7iWa7KajQxIrM6XqMu.lbtW.', 'John Doe', 'test@gmail.com', 0); 
-- u: test
-- pass: Test1$00

INSERT INTO users (username, password, name, email, photo_url) VALUES ('test2', '$2y$10$iu8nh01z.nGjyPBdsUyooO65lohUg8NpF3MBmq//azTD0U0uy40si', 'Meery Dones', 'test2@fe.up.pt', 0); 
-- u: test2
-- pass: Test2$00

INSERT INTO users (username, password, photo_url) VALUES ('test3', '$2y$10$A/yQcYYJUUgACsv8wt6p8eU7L6y/7XlmFWn2QsGg0kpPpF80p9WXG', 0); 
-- u: test3
-- pass: AasP1)3ase

-- list: test list
INSERT INTO lists (date_created, name, creator, list_image) VALUES (date('now'), 'test list', 'test3', 0);
INSERT INTO list_users (list_id, username) VALUES (1, 'test');
INSERT INTO list_items (list_id, description, done) VALUES (1, 'item 1', 0);
INSERT INTO list_items (list_id, description, done) VALUES (1, 'item 2', 0);
INSERT INTO list_items (list_id, description, done) VALUES (1, 'item 3', 0);