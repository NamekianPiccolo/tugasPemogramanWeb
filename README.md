# Tugas Pemrograman Web - Kelompok 6

A modern web application built using **CodeIgniter 4** and styled with **Tailwind CSS**. This repository is configured to run fully in a dockerized environment.

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
1. Compile **Tailwind CSS** using a Node.js build stage.
2. Build the PHP 8.2-Apache runtime with all required CodeIgniter 4 extensions.
3. Automatically install all PHP dependencies via Composer.
4. Spin up the MySQL database container.
```bash
docker-compose up -d --build
```

Verify that the containers are up and running:
```bash
docker ps
```
The application will be accessible at: [http://localhost:8080](http://localhost:8080).

---

#### 4. Run Migrations & Seed the Database
Once the database container is ready, run the database migrations and seeders to populate initial data:

**Run Migrations:**
```bash
docker exec -it ci4_app php spark migrate
```

**Seed the Database (MainSeeder):**
```bash
docker exec -it ci4_app php spark db:seed MainSeeder
```

---

## 🌐 Cloudflare Tunnel Deployment

This project includes a built-in Cloudflare Tunnel (`cloudflared`) service in `docker-compose.yml` to securely expose your application to the web with free SSL and DDoS protection.

### How to use Cloudflare Tunnel:
1. Go to your **Cloudflare Dashboard > Zero Trust > Networks > Tunnels** and create a new tunnel.
2. Under "Install and run a connector", copy your **Tunnel Token**.
3. Open your local `.env` and paste your token:
   ```ini
   CLOUDFLARE_TUNNEL_TOKEN = your_copied_cloudflare_token_here
   ```
4. Start your services. The tunnel container will automatically start and route traffic securely to your CodeIgniter app container:
   ```bash
   docker-compose up -d
   ```

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
docker exec -it ci4_app bash
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