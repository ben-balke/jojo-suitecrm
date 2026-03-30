# Jojo SuiteCRM Integration

Jojo SuiteCRM integrates the **Jojo Render engine** into SuiteCRM’s email parsing system, allowing you to use a modern, flexible template DSL in place of (or alongside) Smarty.

---

## ✨ Features

- Replace SuiteCRM’s legacy email parser
- Clean `{{ }}` syntax
- Fallback/default values:
  ```text
  {{first_name | "Friend"}}
  ```
- Extensible provider system (e.g., SugarBean access)
- Composer-installable package

---

## 📦 Installation

### 1. Add repositories (if not using Packagist)

In your SuiteCRM root `composer.json`:

```json
{
  "repositories": [
    {
      "type": "vcs",
      "url": "https://github.com/ben-balke/jojo-render"
    },
    {
      "type": "vcs",
      "url": "https://github.com/ben-balke/jojo-suitecrm"
    }
  ]
}
```

---

### 2. Install via Composer

From your SuiteCRM root:

```bash
composer require ben-balke/jojo-suitecrm:dev-main ben-balke/jojo-render:dev-main
```

---

### 3. Install the SuiteCRM extension config

Run:

```bash
php vendor/ben-balke/jojo-suitecrm/bin/install-extension.php
```

This will create:

```text
extensions/Jojo/config/services/jojo.yaml
```

Which loads the Jojo services into SuiteCRM.

---

### 4. Clear cache

```bash
php bin/console cache:clear
```

If needed, manually delete:

```text
cache/prod
```

---

## ✅ Verification

To confirm Jojo is active:

1. Add a temporary log inside the parser:
   ```php
   error_log('JOJO PARSER HIT');
   ```

2. Send a test email from SuiteCRM

3. Check logs for confirmation

---

## 🧪 Example Usage

```text
Hello {{first_name | "Friend"}},

Your case number is {{case_number}}.
```

---

## ⚙️ How It Works

```text
SuiteCRM Email System
        ↓
EmailParserRegistry
        ↓
JojoEmailParser
        ↓
JojoRender Engine
```

Jojo is registered as an `email.parser` service and runs during email processing.

---

## ⚠️ Notes

- The extension config file is required — SuiteCRM does not load vendor services automatically
- The install script is safe to run multiple times
- If something breaks, you can temporarily disable parsing by returning the input string unchanged in the parser

---

## 🚀 Next Steps

- Add custom providers (e.g., related records)
- Add filters (uppercase, currency, formatting)
- Replace Smarty entirely

---

## 🧑‍💻 Development

To reinstall the extension file:

```bash
composer jojo:install-extension
```

(If configured in your root Composer scripts)

---

## 📄 License

MIT
