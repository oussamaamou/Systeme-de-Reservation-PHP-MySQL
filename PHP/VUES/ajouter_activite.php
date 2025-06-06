<?php
require_once '../CONFIG/Database.php';
require 'admin.php';

session_start();

if(!isset($_SESSION['ID'])){
    header('location: login.php');
    exit();
}

$db = new Database();
$activityManager = new ActivityManager($db);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $activityManager->addActivity(
            $_POST['nom'],
            $_POST['description'],
            $_POST['capacite'],
            $_POST['date_debut'],
            $_POST['date_fin'],
            $_POST['disponibilite']
        );
        $_SESSION['message'] = "Activité ajoutée avec succès";
        header('Location: afficher_activite.php');
        exit();
    } catch (Exception $e) {
        $_SESSION['error'] = $e->getMessage();
    }
}

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Lien du Tailwind -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Lien des Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css" integrity="sha512-5Hs3dF2AEPkpNAR7UiOHba+lRSJNeM2ECkwxUIxC1Q/FLycGTbNapWXB4tP889k5T5Ju8fs4b1P5z/iB4nMfSQ==" crossorigin="anonymous" referrerpolicy="no-referrer" /> 

    <title>Ajouter une Activité</title>
</head>
<body class="bg-gradient-to-b from-red-100 to-blue-500">

    <header>
        <nav class="border-gray-200 px-4 lg:px-6 py-2.5 dark:bg-gray-800">
            <div class="flex flex-wrap justify-between items-center mx-auto max-w-screen-xl">
                <a class="flex items-center">
                    <img src="/Systeme%20de%20Reservation%20PHP%20&%20MySQL/ASSETS/IMGS/Logo Gym Reservation.png" class="mr-3 mt-[-3rem] w-[15rem]" alt="Logo du Site Web" />
                </a>
                <div class="flex items-center lg:order-2 mt-[-4rem]">
                    <a href="../VUES/login.php" class="text-white bg-blue-900 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm px-4 lg:px-5 py-2 lg:py-2.5 mr-2 dark:bg-primary-600 dark:hover:bg-primary-700 focus:outline-none dark:focus:ring-primary-800">Logout</a>
                </div>
                <div class="hidden justify-between items-center w-full lg:flex lg:w-auto lg:order-1 mt-[-4rem]" id="mobile-menu-2">
                    <ul class="flex flex-col mt-4 mr-[9rem] font-medium lg:flex-row lg:space-x-8 lg:mt-0">
                        <li>
                            <a href="gestion.php" class="block py-2 pr-4 pl-3 text-gray-900 rounded bg-primary-700 lg:bg-transparent lg:text-primary-700 lg:p-0 dark:text-white">Gestion</a>
                        </li>
                        <li>
                            <a href="afficher_activite_admin.php" class="block py-2 pr-4 pl-3 text-gray-900 border-b border-gray-100 hover:bg-gray-50 lg:hover:bg-transparent lg:border-0 lg:hover:text-primary-700 lg:p-0 dark:text-gray-400 lg:dark:hover:text-white dark:hover:bg-gray-700 dark:hover:text-white lg:dark:hover:bg-transparent dark:border-gray-700">Activités</a>
                        </li>
                        <li>
                            <a href="manipuler_reservation.php" class="block py-2 pr-4 pl-3 text-gray-900 border-b border-gray-100 hover:bg-gray-50 lg:hover:bg-transparent lg:border-0 lg:hover:text-primary-700 lg:p-0 dark:text-gray-400 lg:dark:hover:text-white dark:hover:bg-gray-700 dark:hover:text-white lg:dark:hover:bg-transparent dark:border-gray-700">Réservations</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>


    <main>
        <h2 class="text-3xl mb-[2rem] text-center font-bold dark:text-white">Ajouter une nouvelle Activité</h2>
        <div class="w-full mb-[2rem] mx-auto bg-white rounded-lg shadow dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700">
            <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                <form class="max-w-sm " method="POST">
                    <div class="mb-5">
                        <label for="nom" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nom de l'activité</label>
                        <input type="text" id="nom" name="nom" class="capitalize shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" required />
                    </div>
                    <div class="mb-5">
                        <label for="description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Description</label>
                        <textarea type="text" id="description" name="description" class="normal-case shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" required></textarea>
                    </div>
                    <div class="mb-5">
                        <label for="capacite" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Capacité</label>
                        <input type="number" id="capacite" name="capacite" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" required />
                    </div>
                    <div class="mb-5">
                        <label for="date_debut" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Date de début</label>
                        <input type="date" id="date_debut" name="date_debut" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" required />
                    </div>
                    <div class="mb-5">
                        <label for="date_fin" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Date de fin</label>
                        <input type="date" id="date_fin" name="date_fin" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" required />
                    </div>

                    <label for="disponibilite" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Disponibilité</label>
                    <select id="disponibilite" name="disponibilite" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm mb-[1rem] rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option value="1">Disponible</option>
                        <option value="0">Indisponible</option>
                    </select>
                    
                    <button type="submit" class="text-white bg-blue-900 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Ajouter l'activité</button>
                </form>
            </div>
        </div>
    </main>
</body>
</html>
