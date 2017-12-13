rm -f todo.db
cat users.sql | sqlite3 todo.db
cat lists.sql | sqlite3 todo.db
cat security.sql | sqlite3 todo.db
