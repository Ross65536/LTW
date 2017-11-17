rm todo.db -f
cat todo.sql | sqlite3 todo.db
cat lists.sql | sqlite3 todo.db
cat lists_triggers.sql | sqlite3 todo.db
