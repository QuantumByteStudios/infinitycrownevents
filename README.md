# Infinity Crown Events

Static marketing site: HTML, Bootstrap 5, LineIcons, and vanilla JS under `assets/`. **There is no database and no PHP** in this repository.

Development and AI edits should follow **`.cursor/skills/h-rules/SKILL.md`** where applicable, with the **static-site mapping** in **`.cursor/rules/infinitycrownevents-h-rules.mdc`** (scripts before `</body>`, external JS, `.editorconfig`, error pages). If you later add PHP + MySQL, adopt the full h-rules layout (`config/`, `includes/helpers.php`, `ASSETS_URL`, CSRF, etc.).

If Apache’s document root is **not** this folder (for example the site lives at `http://localhost/infinitycrownevents/`), update the `ErrorDocument` paths in `.htaccess` so they point at your deployed `404.html` and `500.html`.
