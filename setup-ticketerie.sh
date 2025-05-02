#!/bin/bash

# Noms des dossiers
$BACKEND_DIR="backend"
$FRONTEND_DIR="frontend"

### BACKEND (Laravel)
echo "🚀 Création du backend Laravel..."
composer create-project laravel/laravel $BACKEND_DIR
cd $BACKEND_DIR

# Création de quelques fichiers/controllers nécessaires
php artisan make:model Event -mcr
php artisan make:model Participant -mcr
php artisan make:mail TicketMail
php artisan make:command ExpireEvents

# Dossiers organisés
mkdir -p app/Http/Controllers/Admin
mkdir -p app/Mail
mkdir -p app/Console/Commands

# Copie du .env
cp .env .env.example

cd ..

### FRONTEND (VueJS)
echo "✨ Création du frontend VueJS 3 avec Vite..."
npm create vite@latest $FRONTEND_DIR -- --template vue
cd $FRONTEND_DIR

# Installation des dépendances frontend
npm install
npm install vue-router@4 tailwindcss postcss autoprefixer --save-dev

# Init TailwindCSS
npx tailwindcss init -p

# Création des dossiers frontend
mkdir -p src/pages/public
mkdir -p src/pages/admin
mkdir -p src/components
mkdir -p src/router

# Création des fichiers de base
touch src/pages/public/Events.vue
touch src/pages/public/Participate.vue
touch src/pages/admin/Dashboard.vue
touch src/pages/admin/Events.vue
touch src/pages/admin/Stats.vue
touch src/pages/Login.vue
touch src/router/index.js
touch src/components/Sidebar.vue

echo "✅ Structure du projet ticketerie terminée avec succès !"
