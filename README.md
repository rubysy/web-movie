# Web Cineflix

A web-based movie and TV show streaming application built using Laravel and MySQL. Web Cineflix provides a complete viewing experience featuring search, watchlist, comments, and trailers.

## Table of Contents

- [Key Features](#-key-features)
- [Tech Stack](#-tech-stack)
- [System Requirements](#-system-requirements)
- [Installation](#-installation)
- [Database Configuration](#-database-configuration)
- [Usage Guide](#-usage-guide)
- [Demo Account](#-demo-account)
- [Screenshots](#-screenshots)
- [Contribution](#-contribution)
- [License](#-license)

## ✨ Key Features

- 🎥 **Streaming Movies & TV Shows** - Watch your favorite movies and TV series
- 🔍 **Advanced Search** - Search content by title, genre, or category
- 📱 **Responsive Design** - Optimized display for both desktop and mobile
- 👤 **Authentication System** - Secure user registration and login
- 📚 **Watchlist** - Save movies and series to watch later
- 💬 **Comment System** - Provide reviews and read feedback from other users
- 🎬 **Trailer Preview** - Watch trailers before diving into the full movie
- 📊 **Content Details** - Comprehensive information about movies and TV shows

## 🛠 Tech Stack

- **Backend**: Laravel (PHP Framework)
- **Database**: MySQL
- **Frontend**: HTML, CSS, JavaScript, Bootstrap
- **Server**: Apache/Nginx
- **Package Manager**: Composer

## 📋 System Requirements

- PHP >= 8.0
- Composer
- MySQL >= 5.7
- Apache/Nginx Web Server
- Node.js & NPM (for asset compilation)

## 🚀 Installation

1. **Clone Repository**
   ```bash
   git clone [https://github.com/rubysy/web-movie.git](https://github.com/rubysy/web-movie.git)
   cd web-movie
   ```

2. **Install Dependencies**
   ```bash
   composer install
   npm install
   ```

3. **Copy Environment File**
   ```bash
   cp .env.example .env
   ```

4. **Generate Application Key**
   ```bash
   php artisan key:generate
   ```

5. **Compile Assets**
   ```bash
   npm run dev
   # atau untuk production
   npm run build
   ```

## 🗄 Configuration Database

1. **Create Database MySQL**
   ```sql
   CREATE DATABASE db_film;
   ```

2. **Config File .env**
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=db_film
   DB_USERNAME=root
   DB_PASSWORD=your_password
   ```

3. **Run Migration & Seeder**
   ```bash
   php artisan migrate
   php artisan db:seed
   ```

4. **Run Server**
   ```bash
   php artisan serve
   ```

   Application access on: `http://localhost:8000`

## Guide

### Steps to Use the Application:

1. **Access Website**
   - Open your browser and visit `http://localhost:8000`
   - The landing page will appear with login or registration options

2. **Authentication**
   - **Registration**: Click "Register" to create a new account
   - **Login**: Enter your email and password to sign in

3. **Explore Content**
   - **Movies**: Browse the collection of available films
   - **TV Shows**: Explore TV series and episodes
   - **Search**: Use the search feature to find specific content

4. **Interactive Features**
   - **Watchlist**: Add movies/series to your personal watchlist
   - **Details**: View full information, ratings, and synopsis
   - **Trailer**: Watch previews before viewing the full content
   - **Comments**: Write reviews and read opinions from other users

5. **Comment Management**
   - Add comments on the detail page
   - Edit or delete your own comments
   - Read and respond to other users' feedback

6. **Logout**
   - Click the logout button to securely exit the application

## 👤 Demo Account

For testing and demonstration purposes, use the following account:

**User Account:**
- **Email**: `user@cineflix.com`
- **Password**: `cineflix123`

> **Note**: This account includes sample data to test the application's features.

## Screenshots

<!-- Add application screenshots here -->
*Screenshots soon*

## 🤝 Contribution

Contributions are always welcome! To contribute:

1. Fork this repository
2. Create a new feature branch (`git checkout -b feature/AmazingFeature`)
3. Commit your changes (`git commit -m 'Add some AmazingFeature'`)
4. Push to the branch (`git push origin feature/AmazingFeature`)
5. Open a Pull Request

## 📄 License

This project is licensed under the MIT License. See the `LICENSE` file for more details.

## 📞 Contact

- **Developer**: [rubysy](https://github.com/rubysy)
- **Repository**: [web-movie](https://github.com/rubysy/web-movie)

---

**Don't forget to give a star if this project helps you!**

