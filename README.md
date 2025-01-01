# Encore Tunes

Encore Tunes is a web application designed for music enthusiasts to showcase their talent and presence online.

## Features

### Tracks
- Display a collection of music tracks with album covers.
- Provides track details such as title, artist, and duration.
- Users can interact with the tracks through intuitive controls.

### Calendar
- A fully interactive calendar to display availability and bookings.
- Highlights pending approvals, confirmed dates.
- Easy navigation between months.

### Contact Form
- Enables users to send messages directly through the platform.
- Validates form input for name, email, and message fields.
- Includes quick contact links for email and social media.

## Tech Stack
- **Frontend**: HTML, CSS, Tailwind CSS, Alpine.js
- **Backend**: Laravel PHP Framework
- **Database**: MySQL
- **Additional Tools**: Docker, Redis

## Installation

Follow these steps to set up the project locally:

1. Clone the repository:
   ```bash
   git clone https://github.com/chaikivskyi/encore-tunes.git
   cd encore-tunes
2. Install dependencies:
   ```bash
   docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v "$(pwd):/var/www/html" \
    -w /var/www/html \
    laravelsail/php84-composer:latest \
    composer install --ignore-platform-reqs
   
   sail npm install
3. Set up environment
   ```bash
   docker compose up -d --build
   
4. Configure the `.env` file:
   - Copy the example configuration file:
      ```bash
      cp .env.example .env
    - Update database credentials and other necessary settings in `.env`.

5. Run database migrations:
   ```bash
   sail php artisan migrate

6. Start the development server:
   ```bash
   php artisan serve

7. Build frontend assets:
    ```bash
   sail npm run build
   
8. Access the application in your browser:
    ```bash
   http://localhost

## Usage
- **Tracks**: Browse through the available tracks on the homepage.
- **Calendar**: View available dates for bookings, and request for availability.
- **Contact Form**: Fill out the form to send a message or use provided quick contact links.
