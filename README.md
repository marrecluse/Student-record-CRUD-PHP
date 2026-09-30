# Student Record CRUD (PHP)

A small student-records manager built in plain PHP + MySQL (no framework), covering the
basics of a secure CRUD app: parameterized queries, session-based auth, password
hashing, and CSRF-protected forms.

## Stack

- PHP 8 (mysqli, sessions)
- MySQL / MariaDB
- Bootstrap 4 for styling

## Security

- **SQL injection** — every query is parameterized (`mysqli::prepare` + `bind_param`),
  including the `id` values used by update/delete (also hard-cast to `int` as a second
  layer of defense).
- **Password storage** — passwords are hashed with `password_hash()` / verified with
  `password_verify()`; nothing is stored or displayed in plain text.
- **Session auth** — `display.php`, `insert.php`, `update.php`, `delete.php`, and
  `operations.php` all require an authenticated session (`requireLogin()`); the session
  ID is regenerated on login to prevent fixation.
- **CSRF** — every state-changing form (login, insert, update, delete, logout) carries a
  per-session token checked with `hash_equals()`. Delete is a POST-only action, not a
  bare GET link.
- **Output escaping** — anything reflecting user input (usernames) is passed through
  `htmlspecialchars()`.
- **Credentials** — DB credentials are read from environment variables via a `.env`
  file (see `.env.example`), never committed to source.

## Setup

```bash
cp .env.example .env
# edit .env with your DB credentials

mysql -u root -p < schema.sql
php -S localhost:8000
```

Then open `http://localhost:8000` and log in with a seeded user (there's no public
sign-up page by design — create the first account directly in the `students` table):

```sql
-- password_hash() output for a test password, generate your own with:
-- php -r "echo password_hash('yourpassword', PASSWORD_DEFAULT);"
INSERT INTO students (username, password_hash) VALUES ('admin', '<paste hash here>');
```

## Known limitations

This is a learning project, not production software — there's no rate limiting on
login attempts, no password complexity rules, and no account lockout. It's meant to
demonstrate secure coding fundamentals (parameterized queries, hashing, CSRF, session
auth) rather than to be a hardened, internet-facing app.
