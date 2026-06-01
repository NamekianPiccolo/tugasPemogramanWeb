# Tugas Pemrograman Web - Kelompok 6

A modern web application built using **CodeIgniter 4** and styled with **Tailwind CSS**. This repository is configured to run fully in a dockerized environment.

---

## ✨ Zero-Configuration Features

This project is engineered to work out-of-the-box with **zero local configuration** required. Simply run the build command, and the system handles the rest:

*   **⚡ Zero-Config Database Bootstrapping**: A smart startup entrypoint (`docker-entrypoint.sh`) waits for MySQL to be fully online and automatically runs `php spark migrate` and `php spark db:seed MainSeeder` for you.
*   **🧹 Multi-Stage Tailwind CSS Compilation**: Tailwind CSS v4 compiles inside an isolated builder stage. The final web container remains **completely clean and free of any `node_modules`** or heavy node runtimes.
*   **🔒 Instant Cloudflare Tunneling**: Generates a secure, shareable public HTTPS link (`trycloudflare.com`) instantly when launched, allowing you to showcase your local project to anyone, anywhere—no port forwarding, accounts, or tokens required.

---

## 🚀 Docker Quick Start Installation

Follow these steps to build, install, and run this project seamlessly on your machine using Docker.

### 📋 Prerequisites
Make sure you have the following installed on your host machine:
*   [Docker](https://www.docker.com/products/docker-desktop)
*   [Docker Compose](https://docs.docker.com/compose/install/)

---

### 🛠️ Installation Steps

#### 1. Clone the Repository
Clone this repository to your local directory:
```bash
git clone https://github.com/NamekianPiccolo/tugasPemogramanWeb.git
cd tugasPemogramanWeb
```

#### 2. Set Up the Environment Configuration (`.env`)
Copy the provided environment example template to `.env`:
```bash
cp .env.example .env
```

Open `.env` and update the database configuration to match the Docker Compose setup:
```ini
# App Environment
CI_ENVIRONMENT = development
app_baseURL = 'http://localhost:8080/'

# Database configuration for Docker
database.default.hostname = db
database.default.database = ci4_database
database.default.username = ci4_user
database.default.password = ci4_password
database.default.DBDriver = MySQLi
database.default.port = 3306
```
> [!IMPORTANT]
> When running inside Docker, `database.default.hostname` must be set to `db` (the service name in `docker-compose.yml`) instead of `localhost`.

---

#### 3. Build and Run the Docker Containers
Launch the docker-compose services. This command will:
1. **Compile Tailwind CSS** using a temporary Node.js build stage (installing all node modules and cleanly deleting them afterward).
2. **Build the PHP 8.2-Apache runtime** with all required CodeIgniter 4 extensions.
3. **Automatically install PHP dependencies** via Composer.
4. **Spin up MySQL database** and wait for it to be fully ready.
5. **Automatically run database migrations & seeders** on startup (`MainSeeder` runs automatically!).

```bash
docker-compose up -d --build
```

Verify that the containers are up and running:
```bash
docker ps
```
The application will be accessible at: [http://localhost:8080](http://localhost:8080).

---

#### 4. Run Migrations & Seed the Database (Optional / Manual)
Since migrations and database seeding are **handled automatically** on startup, you do not need to run these. However, if you need to run them manually in the future:

**Run Migrations:**
```bash
docker exec -it tugas_web_app php spark migrate
```

**Seed the Database (MainSeeder):**
```bash
docker exec -it tugas_web_app php spark db:seed MainSeeder
```

---

## 🌐 Cloudflare Quick Tunnel Deployment

This project includes a built-in **Cloudflare Quick Tunnel** in `docker-compose.yml`. This allows you to generate a secure, public HTTPS link (e.g. `https://your-random-words.trycloudflare.com`) to share your local application with teachers or team members **without needing a Cloudflare account, token, or custom domain!**

### How to get your Link:
1. Start your Docker services normally:
   ```bash
   docker-compose up -d --build
   ```
2. Wait a few seconds for the tunnel to connect, then check the tunnel logs to find your public URL:
   ```bash
   docker logs tugas_web_tunnel
   ```
3. Look for a block that looks like this:
   ```text
   +--------------------------------------------------------------------------------------+
   |  Your quick tunnel has been created! Visit it at:                                    |
   |  https://some-random-words.trycloudflare.com                                         |
   +--------------------------------------------------------------------------------------+
   ```
4. Copy that HTTPS link and open it in your browser. Anyone in the world can now securely access your CodeIgniter 4 application!

---

## 🛠️ Development & Utilities

### Watch Tailwind CSS Changes
For active CSS editing, you can use the Node container to automatically watch and compile Tailwind modifications:
```bash
docker-compose run --rm node npm run watch
```

### Accessing the PHP Container Shell
If you need to execute standard `spark` commands directly inside the Apache container:
```bash
docker exec -it tugas_web_app bash
```

### Stopping the Services
To shut down the docker containers without losing your MySQL data:
```bash
docker-compose down
```
To shut down and wipe the database volume:
```bash
docker-compose down -v
```