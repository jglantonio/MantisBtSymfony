# 🐛 MantisBT Symfony Frontend

A modern and clean frontend for [MantisBT](https://www.mantisbt.org/) built with **Symfony**.  
Because MantisBT deserves a better face. 😄

---

## 🚀 What is this?

This project provides an alternative web interface for MantisBT, connecting directly  
to its database and exposing a friendlier UI built on top of the Symfony framework.

No more old-school interfaces — just clean, fast, and easy to extend.

---

## 🛠️ Built with

- [Symfony](https://symfony.com/) — PHP framework
- [Twig](https://twig.symfony.com/) — templating engine
- [Doctrine DBAL](https://www.doctrine-project.org/projects/dbal.html) — database access
- [MantisBT](https://www.mantisbt.org/) — bug tracking backend

---

## ⚙️ Requirements

- PHP 8.1+
- Composer
- A running MantisBT installation with database access
- Symfony CLI (optional but recommended)

---

## 📦 Installation
```bash
git clone https://github.com/your-username/your-repo.git
cd your-repo
composer install
```

Copy and configure your environment:
```bash
cp .env .env.local
```

Set your MantisBT database credentials in `.env.local`:
```dotenv
DATABASE_MANTIS_URL=mysql://user:pass@localhost:3306/mantisbt
```

Then run:
```bash
symfony server:start
```

---

## 🤝 Contributing

Pull requests are welcome! Feel free to open an issue if you find a bug  
or want to suggest a new feature.

---

## 📄 License

MIT — do whatever you want, just don't blame us. 😅
