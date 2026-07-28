-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mer. 29 juil. 2026 à 00:49
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `gestion_stages_sn`
--

-- --------------------------------------------------------

--
-- Structure de la table `candidatures`
--

CREATE TABLE `candidatures` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `stage_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `nom_candidat` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `telephone` varchar(255) NOT NULL,
  `cv_path` varchar(255) NOT NULL,
  `lettre_motivation` text NOT NULL,
  `statut` enum('en_attente','acceptee','refusee') NOT NULL DEFAULT 'en_attente',
  `date_candidature` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `candidatures`
--

INSERT INTO `candidatures` (`id`, `stage_id`, `user_id`, `nom_candidat`, `prenom`, `email`, `telephone`, `cv_path`, `lettre_motivation`, `statut`, `date_candidature`, `created_at`, `updated_at`) VALUES
(1, 1, 4, 'Ndiaye', 'mor talla ndiaye', 'lampardn105@gmail.com', '785461236', 'cvs/wh04ivqrqM6yDtSC9Y1vciYTQ8GJIozhYrfldX9S.docx', 'aezfv knfevbn  ôn\"ré $\"ét^,n ovcvbn r&u\"y cvbn,  étezébr tg\"éut\"ét\"é t\"ét\"bé gftrezaezrtyu xcvbn\"ré tyubin xc xcvbn, \"ytuyio azerty cvbn nwxcvbn', 'acceptee', '2026-07-28 21:38:56', '2026-07-28 21:38:56', '2026-07-28 21:43:00'),
(2, 6, 2, 'Niang', 'baba', 'baba@isi.sn', '771234568', 'cvs/A9s95f75hzDgsFGF1iRmCWi36bF9Us8PFQTs6Kj2.pdf', 'aaere azigr ^kjah $\r\nt^jap $lk^jtnh ,nbgziekje péohfjpkg, épnbogné\")npg é\"pofj\"ék^,n f\"éàfôkaenbfg\"éçf \"pénp fg\"jg\"n ^\"gn \"onbé l\' n\"ého\"éhonk\"', 'refusee', '2026-07-28 21:46:34', '2026-07-28 21:46:34', '2026-07-28 21:55:56');

-- --------------------------------------------------------

--
-- Structure de la table `departements`
--

CREATE TABLE `departements` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nom` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `region_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `departements`
--

INSERT INTO `departements` (`id`, `nom`, `slug`, `region_id`, `created_at`, `updated_at`) VALUES
(1, 'Dakar', 'dakar', 1, '2026-07-28 18:57:21', '2026-07-28 18:57:21'),
(2, 'Pikine', 'pikine', 1, '2026-07-28 18:57:21', '2026-07-28 18:57:21'),
(3, 'Guédiawaye', 'guediawaye', 1, '2026-07-28 18:57:21', '2026-07-28 18:57:21'),
(4, 'Rufisque', 'rufisque', 1, '2026-07-28 18:57:21', '2026-07-28 18:57:21'),
(5, 'Keur Massar', 'keur-massar', 1, '2026-07-28 18:57:21', '2026-07-28 18:57:21'),
(6, 'Thiès', 'thies', 2, '2026-07-28 18:57:21', '2026-07-28 18:57:21'),
(7, 'Mbour', 'mbour', 2, '2026-07-28 18:57:21', '2026-07-28 18:57:21'),
(8, 'Tivaouane', 'tivaouane', 2, '2026-07-28 18:57:21', '2026-07-28 18:57:21'),
(9, 'Saint-Louis', 'saint-louis', 3, '2026-07-28 18:57:21', '2026-07-28 18:57:21'),
(10, 'Dagana', 'dagana', 3, '2026-07-28 18:57:21', '2026-07-28 18:57:21'),
(11, 'Podor', 'podor', 3, '2026-07-28 18:57:21', '2026-07-28 18:57:21'),
(12, 'Diourbel', 'diourbel', 4, '2026-07-28 18:57:21', '2026-07-28 18:57:21'),
(13, 'Bambey', 'bambey', 4, '2026-07-28 18:57:21', '2026-07-28 18:57:21'),
(14, 'Mbacké', 'mbacke', 4, '2026-07-28 18:57:21', '2026-07-28 18:57:21'),
(15, 'Fatick', 'fatick', 5, '2026-07-28 18:57:21', '2026-07-28 18:57:21'),
(16, 'Foundiougne', 'foundiougne', 5, '2026-07-28 18:57:21', '2026-07-28 18:57:21'),
(17, 'Gossas', 'gossas', 5, '2026-07-28 18:57:21', '2026-07-28 18:57:21'),
(18, 'Kaffrine', 'kaffrine', 6, '2026-07-28 18:57:21', '2026-07-28 18:57:21'),
(19, 'Birkelane', 'birkelane', 6, '2026-07-28 18:57:21', '2026-07-28 18:57:21'),
(20, 'Koungheul', 'koungheul', 6, '2026-07-28 18:57:21', '2026-07-28 18:57:21'),
(21, 'Malem-Hodar', 'malem-hodar', 6, '2026-07-28 18:57:21', '2026-07-28 18:57:21'),
(22, 'Kaolack', 'kaolack', 7, '2026-07-28 18:57:21', '2026-07-28 18:57:21'),
(23, 'Nioro du Rip', 'nioro-du-rip', 7, '2026-07-28 18:57:21', '2026-07-28 18:57:21'),
(24, 'Guinguinéo', 'guinguineo', 7, '2026-07-28 18:57:21', '2026-07-28 18:57:21'),
(25, 'Kédougou', 'kedougou', 8, '2026-07-28 18:57:21', '2026-07-28 18:57:21'),
(26, 'Salemata', 'salemata', 8, '2026-07-28 18:57:21', '2026-07-28 18:57:21'),
(27, 'Saraya', 'saraya', 8, '2026-07-28 18:57:21', '2026-07-28 18:57:21'),
(28, 'Kolda', 'kolda', 9, '2026-07-28 18:57:21', '2026-07-28 18:57:21'),
(29, 'Vélingara', 'velingara', 9, '2026-07-28 18:57:21', '2026-07-28 18:57:21'),
(30, 'Médina Yoro Foulah', 'medina-yoro-foulah', 9, '2026-07-28 18:57:21', '2026-07-28 18:57:21'),
(31, 'Louga', 'louga', 10, '2026-07-28 18:57:21', '2026-07-28 18:57:21'),
(32, 'Kébémer', 'kebemer', 10, '2026-07-28 18:57:21', '2026-07-28 18:57:21'),
(33, 'Linguère', 'linguere', 10, '2026-07-28 18:57:21', '2026-07-28 18:57:21'),
(34, 'Matam', 'matam', 11, '2026-07-28 18:57:21', '2026-07-28 18:57:21'),
(35, 'Kanel', 'kanel', 11, '2026-07-28 18:57:21', '2026-07-28 18:57:21'),
(36, 'Ranérou', 'ranerou', 11, '2026-07-28 18:57:21', '2026-07-28 18:57:21'),
(37, 'Sédhiou', 'sedhiou', 12, '2026-07-28 18:57:21', '2026-07-28 18:57:21'),
(38, 'Bounkiling', 'bounkiling', 12, '2026-07-28 18:57:21', '2026-07-28 18:57:21'),
(39, 'Goudomp', 'goudomp', 12, '2026-07-28 18:57:21', '2026-07-28 18:57:21'),
(40, 'Tambacounda', 'tambacounda', 13, '2026-07-28 18:57:21', '2026-07-28 18:57:21'),
(41, 'Bakel', 'bakel', 13, '2026-07-28 18:57:21', '2026-07-28 18:57:21'),
(42, 'Goudiry', 'goudiry', 13, '2026-07-28 18:57:21', '2026-07-28 18:57:21'),
(43, 'Koumpentoum', 'koumpentoum', 13, '2026-07-28 18:57:21', '2026-07-28 18:57:21'),
(44, 'Ziguinchor', 'ziguinchor', 14, '2026-07-28 18:57:21', '2026-07-28 18:57:21'),
(45, 'Bignona', 'bignona', 14, '2026-07-28 18:57:21', '2026-07-28 18:57:21'),
(46, 'Oussouye', 'oussouye', 14, '2026-07-28 18:57:21', '2026-07-28 18:57:21');

-- --------------------------------------------------------

--
-- Structure de la table `entreprises`
--

CREATE TABLE `entreprises` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nom` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `adresse` text NOT NULL,
  `ville_id` bigint(20) UNSIGNED NOT NULL,
  `telephone` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `site_web` varchar(255) DEFAULT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `secteur_activite` varchar(255) NOT NULL,
  `taille` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `entreprises`
--

INSERT INTO `entreprises` (`id`, `nom`, `slug`, `adresse`, `ville_id`, `telephone`, `email`, `site_web`, `logo`, `description`, `secteur_activite`, `taille`, `created_at`, `updated_at`) VALUES
(1, 'Sonatel S.A', 'sonatel-sa-6a691bb0e4dbd', 'Route des Almadies, Dakar', 67, '338391000', 'contact@sonatel.sn', 'https://www.sonatel.sn', NULL, 'Leader des télécommunications au Sénégal.', 'telecom', '1000+', '2026-07-28 21:14:24', '2026-07-28 21:14:24'),
(2, 'Orange Sénégal', 'orange-senegal-6a691bb0e76b3', 'Immeuble Orange, Dakar', 23, '338390000', 'contact@orange.sn', 'https://www.orange.sn', NULL, 'Opérateur mobile et internet de référence.', 'telecom', '1000+', '2026-07-28 21:14:24', '2026-07-28 21:14:24'),
(3, 'Ecobank Sénégal', 'ecobank-senegal-6a691bb0e9db8', 'Place de l\'Indépendance, Dakar', 104, '338399000', 'contact@ecobank.sn', 'https://www.ecobank.com', NULL, 'Banque panafricaine de premier plan.', 'banque', '500+', '2026-07-28 21:14:24', '2026-07-28 21:14:24'),
(4, 'Sunu Assurances', 'sunu-assurances-6a691bb0ec27e', 'Rue Félix Faure, Dakar', 128, '338398000', 'contact@sunu.sn', 'https://www.sunugroup.com', NULL, 'Groupe d\'assurances leader en Afrique de l\'Ouest.', 'banque', '500+', '2026-07-28 21:14:24', '2026-07-28 21:14:24'),
(5, 'TIGO Sénégal', 'tigo-senegal-6a691bb0edbb5', 'Zone Aéroport, Dakar', 127, '338397000', 'contact@tigo.sn', 'https://www.tigo.sn', NULL, 'Opérateur de téléphonie mobile et services digitaux.', 'telecom', '500+', '2026-07-28 21:14:24', '2026-07-28 21:14:24'),
(6, 'Free Sénégal', 'free-senegal-6a691bb0ef45e', 'Immeuble Free, Dakar', 22, '338396000', 'contact@free.sn', 'https://www.free.sn', NULL, 'Opérateur mobile et internet à bas prix.', 'telecom', '200+', '2026-07-28 21:14:24', '2026-07-28 21:14:24'),
(7, 'TotalEnergies Sénégal', 'totalenergies-senegal-6a691bb0f08a8', 'Boulevard de la République, Dakar', 125, '338395000', 'contact@total.sn', 'https://www.total.sn', NULL, 'Groupe énergétique leader au Sénégal.', 'industrie', '500+', '2026-07-28 21:14:24', '2026-07-28 21:14:24'),
(8, 'Axa Sénégal', 'axa-senegal-6a691bb0f1eba', 'Rue Malenfant, Dakar', 135, '338394000', 'contact@axa.sn', 'https://www.axa.sn', NULL, 'Groupe d\'assurances international.', 'banque', '200+', '2026-07-28 21:14:24', '2026-07-28 21:14:24'),
(9, 'Nestlé Sénégal', 'nestle-senegal-6a691bb0f33e8', 'Zone industrielle, Dakar', 136, '338393000', 'contact@nestle.sn', 'https://www.nestle.sn', NULL, 'Groupe agroalimentaire mondial.', 'commerce', '200+', '2026-07-28 21:14:24', '2026-07-28 21:14:24'),
(10, 'Coca-Cola Sénégal', 'coca-cola-senegal-6a691bb10062c', 'Zone industrielle, Dakar', 112, '338392000', 'contact@cocacola.sn', 'https://www.coca-cola.com', NULL, 'Leader des boissons gazeuses au Sénégal.', 'commerce', '100+', '2026-07-28 21:14:25', '2026-07-28 21:14:25');

-- --------------------------------------------------------

--
-- Structure de la table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2026_07_03_215246_create_regions_table', 1),
(6, '2026_07_03_215247_create_departements_table', 1),
(7, '2026_07_03_215249_create_villes_table', 1),
(8, '2026_07_03_215250_create_entreprises_table', 1),
(9, '2026_07_03_215251_create_stages_table', 1),
(10, '2026_07_03_215252_create_candidatures_table', 1),
(11, '2026_07_09_213950_add_entreprise_id_to_users_table', 1),
(12, '2026_07_28_201752_add_role_to_users_table', 2);

-- --------------------------------------------------------

--
-- Structure de la table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `regions`
--

CREATE TABLE `regions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nom` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `regions`
--

INSERT INTO `regions` (`id`, `nom`, `slug`, `description`, `image`, `created_at`, `updated_at`) VALUES
(1, 'Dakar', 'dakar', NULL, NULL, '2026-07-28 18:57:21', '2026-07-28 18:57:21'),
(2, 'Thiès', 'thies', NULL, NULL, '2026-07-28 18:57:21', '2026-07-28 18:57:21'),
(3, 'Saint-Louis', 'saint-louis', NULL, NULL, '2026-07-28 18:57:21', '2026-07-28 18:57:21'),
(4, 'Diourbel', 'diourbel', NULL, NULL, '2026-07-28 18:57:21', '2026-07-28 18:57:21'),
(5, 'Fatick', 'fatick', NULL, NULL, '2026-07-28 18:57:21', '2026-07-28 18:57:21'),
(6, 'Kaffrine', 'kaffrine', NULL, NULL, '2026-07-28 18:57:21', '2026-07-28 18:57:21'),
(7, 'Kaolack', 'kaolack', NULL, NULL, '2026-07-28 18:57:21', '2026-07-28 18:57:21'),
(8, 'Kédougou', 'kedougou', NULL, NULL, '2026-07-28 18:57:21', '2026-07-28 18:57:21'),
(9, 'Kolda', 'kolda', NULL, NULL, '2026-07-28 18:57:21', '2026-07-28 18:57:21'),
(10, 'Louga', 'louga', NULL, NULL, '2026-07-28 18:57:21', '2026-07-28 18:57:21'),
(11, 'Matam', 'matam', NULL, NULL, '2026-07-28 18:57:21', '2026-07-28 18:57:21'),
(12, 'Sédhiou', 'sedhiou', NULL, NULL, '2026-07-28 18:57:21', '2026-07-28 18:57:21'),
(13, 'Tambacounda', 'tambacounda', NULL, NULL, '2026-07-28 18:57:21', '2026-07-28 18:57:21'),
(14, 'Ziguinchor', 'ziguinchor', NULL, NULL, '2026-07-28 18:57:21', '2026-07-28 18:57:21');

-- --------------------------------------------------------

--
-- Structure de la table `stages`
--

CREATE TABLE `stages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `titre` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `entreprise_id` bigint(20) UNSIGNED NOT NULL,
  `ville_id` bigint(20) UNSIGNED NOT NULL,
  `adresse_exacte` varchar(255) DEFAULT NULL,
  `duree` varchar(255) NOT NULL,
  `remuneration` tinyint(1) NOT NULL DEFAULT 0,
  `montant_remuneration` decimal(10,2) DEFAULT NULL,
  `date_debut` date NOT NULL,
  `date_fin` date NOT NULL,
  `type` enum('technique','professionnel','recherche','autre') NOT NULL,
  `statut` enum('ouvert','ferme','en_cours') NOT NULL DEFAULT 'ouvert',
  `competences_requises` text DEFAULT NULL,
  `nb_postes` int(11) NOT NULL DEFAULT 1,
  `date_limite_candidature` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `stages`
--

INSERT INTO `stages` (`id`, `titre`, `slug`, `description`, `entreprise_id`, `ville_id`, `adresse_exacte`, `duree`, `remuneration`, `montant_remuneration`, `date_debut`, `date_fin`, `type`, `statut`, `competences_requises`, `nb_postes`, `date_limite_candidature`, `created_at`, `updated_at`) VALUES
(1, 'Développeur Full Stack Laravel', 'developpeur-full-stack-laravel-6a691bb104b9d', 'Stage de 6 mois pour Développeur Full Stack Laravel. Une excellente opportunité pour développer vos compétences.', 10, 107, NULL, '6 mois', 1, 150000.00, '2026-08-13', '2027-01-07', 'technique', 'ouvert', 'PHP, Laravel, MySQL, Git, travail en équipe', 2, '2026-08-04', '2026-07-28 21:14:25', '2026-07-28 21:14:25'),
(2, 'Assistant Marketing Digital', 'assistant-marketing-digital-6a691bb1082bd', 'Stage de 4 mois pour Assistant Marketing Digital. Une excellente opportunité pour développer vos compétences.', 3, 54, NULL, '4 mois', 1, 120000.00, '2026-08-22', '2026-11-30', 'professionnel', 'ouvert', 'PHP, Laravel, MySQL, Git, travail en équipe', 1, '2026-08-07', '2026-07-28 21:14:25', '2026-07-28 21:14:25'),
(3, 'Analyste Financier Junior', 'analyste-financier-junior-6a691bb109d8c', 'Stage de 3 mois pour Analyste Financier Junior. Une excellente opportunité pour développer vos compétences.', 3, 134, NULL, '3 mois', 0, NULL, '2026-08-27', '2027-01-02', 'recherche', 'ferme', 'PHP, Laravel, MySQL, Git, travail en équipe', 2, '2026-08-06', '2026-07-28 21:14:25', '2026-07-28 21:14:25'),
(4, 'Ingénieur Réseaux et Télécoms', 'ingenieur-reseaux-et-telecoms-6a691bb10cd46', 'Stage de 5 mois pour Ingénieur Réseaux et Télécoms. Une excellente opportunité pour développer vos compétences.', 10, 75, NULL, '5 mois', 1, 180000.00, '2026-08-14', '2027-02-06', 'technique', 'ouvert', 'PHP, Laravel, MySQL, Git, travail en équipe', 3, '2026-08-09', '2026-07-28 21:14:25', '2026-07-28 21:14:25'),
(5, 'Assistant RH', 'assistant-rh-6a691bb10ee71', 'Stage de 4 mois pour Assistant RH. Une excellente opportunité pour développer vos compétences.', 5, 83, NULL, '4 mois', 0, NULL, '2026-08-10', '2026-12-08', 'professionnel', 'en_cours', 'PHP, Laravel, MySQL, Git, travail en équipe', 1, '2026-08-05', '2026-07-28 21:14:25', '2026-07-28 21:14:25'),
(6, 'Développeur Mobile Flutter', 'developpeur-mobile-flutter-6a691bb1103c2', 'Stage de 6 mois pour Développeur Mobile Flutter. Une excellente opportunité pour développer vos compétences.', 1, 16, NULL, '6 mois', 1, 160000.00, '2026-08-18', '2026-12-24', 'technique', 'ouvert', 'PHP, Laravel, MySQL, Git, travail en équipe', 2, '2026-08-13', '2026-07-28 21:14:25', '2026-07-28 21:14:25'),
(7, 'Chargé de Communication', 'charge-de-communication-6a691bb1120d9', 'Stage de 3 mois pour Chargé de Communication. Une excellente opportunité pour développer vos compétences.', 7, 85, NULL, '3 mois', 0, NULL, '2026-08-07', '2026-11-24', 'professionnel', 'ouvert', 'PHP, Laravel, MySQL, Git, travail en équipe', 1, '2026-08-07', '2026-07-28 21:14:25', '2026-07-28 21:14:25'),
(8, 'Ingénieur Cybersécurité', 'ingenieur-cybersecurite-6a691bb113c01', 'Stage de 6 mois pour Ingénieur Cybersécurité. Une excellente opportunité pour développer vos compétences.', 10, 14, NULL, '6 mois', 1, 200000.00, '2026-08-22', '2027-01-20', 'recherche', 'ferme', 'PHP, Laravel, MySQL, Git, travail en équipe', 2, '2026-08-13', '2026-07-28 21:14:25', '2026-07-28 21:14:25');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `entreprise_id` bigint(20) UNSIGNED DEFAULT NULL,
  `role` enum('admin','etudiant','entreprise') NOT NULL DEFAULT 'etudiant',
  `telephone` varchar(255) DEFAULT NULL,
  `adresse` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `entreprise_id`, `role`, `telephone`, `adresse`) VALUES
(1, 'Admin Gestion Stages', 'admin@gestionstages.sn', NULL, '$2y$12$ej2XMOna8Pgiqw69F6mgpe6loPcN2wkbNN.x22BtkEHO.edvO3uju', NULL, '2026-07-28 21:14:24', '2026-07-28 21:14:24', NULL, 'admin', '771234567', 'Dakar, Sénégal'),
(2, 'Baba Niang', 'baba@isi.sn', NULL, '$2y$12$sgBcYkTFvsNIvQV5f4bRNeSSXfBaXgJDXEoH7CvNFhCyC9fXh4qcu', NULL, '2026-07-28 21:14:24', '2026-07-28 21:14:24', NULL, 'etudiant', '771234568', 'Dakar, Sénégal'),
(3, 'Anta Gueye', 'anta@isi.sn', NULL, '$2y$12$VWaY9nAiyjtrqfHNHv3tJuTg6Z.L8MwFqI9V8pzgGya/XEJSo9Sp.', NULL, '2026-07-28 21:14:24', '2026-07-28 21:14:24', NULL, 'etudiant', '771234569', 'Dakar, Sénégal'),
(4, 'mohamed mor talla Ndiaye', 'lampardn105@gmail.com', NULL, '$2y$12$yOXU2GIK.s9KUuzfjFc/uOKQgtZkgPbgBzgbx/ZHK7Z7.LIRKlVF2', NULL, '2026-07-28 21:34:53', '2026-07-28 21:34:53', NULL, 'etudiant', '785461236', NULL),
(5, 'Professeur Dabo', 'dabo@isi.sn', NULL, '$2y$12$owT3rJgXHPRqkaV.hiATm.9k1OVFDin3Ch7WX2mrz.k9f3PgMSzoe', NULL, '2026-07-28 21:51:55', '2026-07-28 21:51:55', NULL, 'admin', '771234570', 'Dakar, Sénégal'),
(6, 'Dabo Étudiant', 'dabo.etudiant@isi.sn', NULL, '$2y$12$7q.6AeWWaimE90Cit3zjzu7erlSd6SLBRabngD8WAZGNSsb9OgVT2', NULL, '2026-07-28 21:51:55', '2026-07-28 21:51:55', NULL, 'etudiant', '771234571', 'Dakar, Sénégal');

-- --------------------------------------------------------

--
-- Structure de la table `villes`
--

CREATE TABLE `villes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nom` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `departement_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `villes`
--

INSERT INTO `villes` (`id`, `nom`, `slug`, `departement_id`, `created_at`, `updated_at`) VALUES
(1, 'Dakar', 'dakar', 1, '2026-07-28 18:57:21', '2026-07-28 18:57:21'),
(2, 'Pikine', 'pikine', 1, '2026-07-28 18:57:21', '2026-07-28 18:57:21'),
(3, 'Guédiawaye', 'guediawaye', 1, '2026-07-28 18:57:21', '2026-07-28 18:57:21'),
(4, 'Rufisque', 'rufisque', 1, '2026-07-28 18:57:21', '2026-07-28 18:57:21'),
(5, 'Yeumbeul', 'yeumbeul', 1, '2026-07-28 18:57:21', '2026-07-28 18:57:21'),
(6, 'Thiaroye', 'thiaroye', 1, '2026-07-28 18:57:21', '2026-07-28 18:57:21'),
(7, 'Hann', 'hann', 1, '2026-07-28 18:57:21', '2026-07-28 18:57:21'),
(8, 'Grand-Yoff', 'grand-yoff', 1, '2026-07-28 18:57:21', '2026-07-28 18:57:21'),
(9, 'Médina', 'medina', 1, '2026-07-28 18:57:21', '2026-07-28 18:57:21'),
(10, 'Plateau', 'plateau', 1, '2026-07-28 18:57:21', '2026-07-28 18:57:21'),
(11, 'Ouakam', 'ouakam', 1, '2026-07-28 18:57:21', '2026-07-28 18:57:21'),
(12, 'Ngor', 'ngor', 1, '2026-07-28 18:57:21', '2026-07-28 18:57:21'),
(13, 'Yoff', 'yoff', 1, '2026-07-28 18:57:21', '2026-07-28 18:57:21'),
(14, 'Sicap Mermoz', 'sicap-mermoz', 1, '2026-07-28 18:57:21', '2026-07-28 18:57:21'),
(16, 'Diamniadio', 'diamniadio', 2, '2026-07-28 21:14:22', '2026-07-28 21:14:22'),
(17, 'Mbao', 'mbao', 2, '2026-07-28 21:14:22', '2026-07-28 21:14:22'),
(18, 'Wakhinane', 'wakhinane', 3, '2026-07-28 21:14:22', '2026-07-28 21:14:22'),
(19, 'Sam Notaire', 'sam-notaire', 3, '2026-07-28 21:14:22', '2026-07-28 21:14:22'),
(20, 'Bargny', 'bargny', 4, '2026-07-28 21:14:22', '2026-07-28 21:14:22'),
(21, 'Sendou', 'sendou', 4, '2026-07-28 21:14:22', '2026-07-28 21:14:22'),
(22, 'Sébikotane', 'sebikotane', 4, '2026-07-28 21:14:22', '2026-07-28 21:14:22'),
(23, 'Keur Massar', 'keur-massar', 5, '2026-07-28 21:14:22', '2026-07-28 21:14:22'),
(24, 'Malika', 'malika', 5, '2026-07-28 21:14:22', '2026-07-28 21:14:22'),
(25, 'Yeumbeul Nord', 'yeumbeul-nord', 5, '2026-07-28 21:14:22', '2026-07-28 21:14:22'),
(26, 'Yeumbeul Sud', 'yeumbeul-sud', 5, '2026-07-28 21:14:22', '2026-07-28 21:14:22'),
(27, 'Thiès', 'thies', 6, '2026-07-28 21:14:22', '2026-07-28 21:14:22'),
(28, 'Pout', 'pout', 6, '2026-07-28 21:14:22', '2026-07-28 21:14:22'),
(29, 'Notto', 'notto', 6, '2026-07-28 21:14:22', '2026-07-28 21:14:22'),
(30, 'Khombole', 'khombole', 6, '2026-07-28 21:14:22', '2026-07-28 21:14:22'),
(31, 'Kayar', 'kayar', 6, '2026-07-28 21:14:22', '2026-07-28 21:14:22'),
(32, 'Nguékhokh', 'nguekhokh', 6, '2026-07-28 21:14:22', '2026-07-28 21:14:22'),
(33, 'Mbour', 'mbour', 7, '2026-07-28 21:14:22', '2026-07-28 21:14:22'),
(34, 'Saly', 'saly', 7, '2026-07-28 21:14:22', '2026-07-28 21:14:22'),
(35, 'Popenguine', 'popenguine', 7, '2026-07-28 21:14:22', '2026-07-28 21:14:22'),
(36, 'Nianing', 'nianing', 7, '2026-07-28 21:14:22', '2026-07-28 21:14:22'),
(37, 'Ngaparou', 'ngaparou', 7, '2026-07-28 21:14:22', '2026-07-28 21:14:22'),
(38, 'Somone', 'somone', 7, '2026-07-28 21:14:22', '2026-07-28 21:14:22'),
(39, 'Joal-Fadiouth', 'joal-fadiouth', 7, '2026-07-28 21:14:22', '2026-07-28 21:14:22'),
(40, 'Tivaouane', 'tivaouane', 8, '2026-07-28 21:14:22', '2026-07-28 21:14:22'),
(41, 'Mékhé', 'mekhe', 8, '2026-07-28 21:14:22', '2026-07-28 21:14:22'),
(42, 'Darou Khoudoss', 'darou-khoudoss', 8, '2026-07-28 21:14:22', '2026-07-28 21:14:22'),
(43, 'Mboro', 'mboro', 8, '2026-07-28 21:14:22', '2026-07-28 21:14:22'),
(44, 'Ndiassane', 'ndiassane', 8, '2026-07-28 21:14:23', '2026-07-28 21:14:23'),
(45, 'Saint-Louis', 'saint-louis', 9, '2026-07-28 21:14:23', '2026-07-28 21:14:23'),
(46, 'Ndioum', 'ndioum', 9, '2026-07-28 21:14:23', '2026-07-28 21:14:23'),
(47, 'Richard-Toll', 'richard-toll', 9, '2026-07-28 21:14:23', '2026-07-28 21:14:23'),
(48, 'Mpal', 'mpal', 9, '2026-07-28 21:14:23', '2026-07-28 21:14:23'),
(49, 'Gandiol', 'gandiol', 9, '2026-07-28 21:14:23', '2026-07-28 21:14:23'),
(50, 'Dagana', 'dagana', 10, '2026-07-28 21:14:23', '2026-07-28 21:14:23'),
(51, 'Rosso', 'rosso', 10, '2026-07-28 21:14:23', '2026-07-28 21:14:23'),
(52, 'Ndombo', 'ndombo', 10, '2026-07-28 21:14:23', '2026-07-28 21:14:23'),
(53, 'Podor', 'podor', 11, '2026-07-28 21:14:23', '2026-07-28 21:14:23'),
(54, 'Aéré', 'aere', 11, '2026-07-28 21:14:23', '2026-07-28 21:14:23'),
(55, 'Mbal', 'mbal', 11, '2026-07-28 21:14:23', '2026-07-28 21:14:23'),
(56, 'Galoya', 'galoya', 11, '2026-07-28 21:14:23', '2026-07-28 21:14:23'),
(57, 'Diourbel', 'diourbel', 12, '2026-07-28 21:14:23', '2026-07-28 21:14:23'),
(58, 'Touba', 'touba', 12, '2026-07-28 21:14:23', '2026-07-28 21:14:23'),
(59, 'Mbacké', 'mbacke', 12, '2026-07-28 21:14:23', '2026-07-28 21:14:23'),
(60, 'Kael', 'kael', 12, '2026-07-28 21:14:23', '2026-07-28 21:14:23'),
(61, 'Nguick', 'nguick', 12, '2026-07-28 21:14:23', '2026-07-28 21:14:23'),
(62, 'Taïf', 'taif', 12, '2026-07-28 21:14:23', '2026-07-28 21:14:23'),
(63, 'Bambey', 'bambey', 13, '2026-07-28 21:14:23', '2026-07-28 21:14:23'),
(64, 'Dankh', 'dankh', 13, '2026-07-28 21:14:23', '2026-07-28 21:14:23'),
(65, 'Ndoulo', 'ndoulo', 13, '2026-07-28 21:14:23', '2026-07-28 21:14:23'),
(66, 'Pété', 'pete', 13, '2026-07-28 21:14:23', '2026-07-28 21:14:23'),
(67, 'Ndioumane', 'ndioumane', 14, '2026-07-28 21:14:23', '2026-07-28 21:14:23'),
(68, 'Fatick', 'fatick', 15, '2026-07-28 21:14:23', '2026-07-28 21:14:23'),
(69, 'Diakhao', 'diakhao', 15, '2026-07-28 21:14:23', '2026-07-28 21:14:23'),
(70, 'Sokone', 'sokone', 15, '2026-07-28 21:14:23', '2026-07-28 21:14:23'),
(71, 'Ndiop', 'ndiop', 15, '2026-07-28 21:14:23', '2026-07-28 21:14:23'),
(72, 'Niodior', 'niodior', 15, '2026-07-28 21:14:23', '2026-07-28 21:14:23'),
(73, 'Foundiougne', 'foundiougne', 16, '2026-07-28 21:14:23', '2026-07-28 21:14:23'),
(74, 'Bassoul', 'bassoul', 16, '2026-07-28 21:14:23', '2026-07-28 21:14:23'),
(75, 'Dionewar', 'dionewar', 16, '2026-07-28 21:14:23', '2026-07-28 21:14:23'),
(76, 'Gossas', 'gossas', 17, '2026-07-28 21:14:23', '2026-07-28 21:14:23'),
(77, 'Pambal', 'pambal', 17, '2026-07-28 21:14:23', '2026-07-28 21:14:23'),
(78, 'Kaffrine', 'kaffrine', 18, '2026-07-28 21:14:23', '2026-07-28 21:14:23'),
(79, 'Ndoga Babacar', 'ndoga-babacar', 18, '2026-07-28 21:14:23', '2026-07-28 21:14:23'),
(80, 'Gaye', 'gaye', 18, '2026-07-28 21:14:23', '2026-07-28 21:14:23'),
(81, 'Katahel', 'katahel', 18, '2026-07-28 21:14:23', '2026-07-28 21:14:23'),
(82, 'Birkelane', 'birkelane', 19, '2026-07-28 21:14:23', '2026-07-28 21:14:23'),
(83, 'Kahi', 'kahi', 19, '2026-07-28 21:14:23', '2026-07-28 21:14:23'),
(84, 'Mabo', 'mabo', 19, '2026-07-28 21:14:23', '2026-07-28 21:14:23'),
(85, 'Koungheul', 'koungheul', 20, '2026-07-28 21:14:23', '2026-07-28 21:14:23'),
(86, 'Lour Escale', 'lour-escale', 20, '2026-07-28 21:14:23', '2026-07-28 21:14:23'),
(87, 'Saloum', 'saloum', 20, '2026-07-28 21:14:23', '2026-07-28 21:14:23'),
(88, 'Malem-Hodar', 'malem-hodar', 21, '2026-07-28 21:14:23', '2026-07-28 21:14:23'),
(89, 'Ouol', 'ouol', 21, '2026-07-28 21:14:23', '2026-07-28 21:14:23'),
(90, 'Kaolack', 'kaolack', 22, '2026-07-28 21:14:23', '2026-07-28 21:14:23'),
(91, 'Kahone', 'kahone', 22, '2026-07-28 21:14:23', '2026-07-28 21:14:23'),
(92, 'Sibassor', 'sibassor', 22, '2026-07-28 21:14:23', '2026-07-28 21:14:23'),
(93, 'Ndoffane', 'ndoffane', 22, '2026-07-28 21:14:23', '2026-07-28 21:14:23'),
(94, 'Gandiaye', 'gandiaye', 22, '2026-07-28 21:14:23', '2026-07-28 21:14:23'),
(95, 'Pakala', 'pakala', 22, '2026-07-28 21:14:23', '2026-07-28 21:14:23'),
(96, 'Nioro du Rip', 'nioro-du-rip', 23, '2026-07-28 21:14:23', '2026-07-28 21:14:23'),
(97, 'Guinguinéo', 'guinguineo', 24, '2026-07-28 21:14:23', '2026-07-28 21:14:23'),
(98, 'Mbadane', 'mbadane', 24, '2026-07-28 21:14:23', '2026-07-28 21:14:23'),
(99, 'Kédougou', 'kedougou', 25, '2026-07-28 21:14:23', '2026-07-28 21:14:23'),
(100, 'Bandafassi', 'bandafassi', 25, '2026-07-28 21:14:23', '2026-07-28 21:14:23'),
(101, 'Dindéfello', 'dindefello', 25, '2026-07-28 21:14:23', '2026-07-28 21:14:23'),
(102, 'Ségou', 'segou', 25, '2026-07-28 21:14:23', '2026-07-28 21:14:23'),
(103, 'Salemata', 'salemata', 26, '2026-07-28 21:14:23', '2026-07-28 21:14:23'),
(104, 'Saraya', 'saraya', 27, '2026-07-28 21:14:23', '2026-07-28 21:14:23'),
(105, 'Bembou', 'bembou', 27, '2026-07-28 21:14:23', '2026-07-28 21:14:23'),
(106, 'Khossanto', 'khossanto', 27, '2026-07-28 21:14:23', '2026-07-28 21:14:23'),
(107, 'Kolda', 'kolda', 28, '2026-07-28 21:14:23', '2026-07-28 21:14:23'),
(108, 'Mampatim', 'mampatim', 28, '2026-07-28 21:14:23', '2026-07-28 21:14:23'),
(109, 'Saré Yoba', 'sare-yoba', 28, '2026-07-28 21:14:23', '2026-07-28 21:14:23'),
(110, 'Pata', 'pata', 28, '2026-07-28 21:14:23', '2026-07-28 21:14:23'),
(111, 'Dabo', 'dabo', 28, '2026-07-28 21:14:23', '2026-07-28 21:14:23'),
(112, 'Vélingara', 'velingara', 29, '2026-07-28 21:14:23', '2026-07-28 21:14:23'),
(113, 'Bounkiling', 'bounkiling', 29, '2026-07-28 21:14:23', '2026-07-28 21:14:23'),
(114, 'Goudomp', 'goudomp', 29, '2026-07-28 21:14:23', '2026-07-28 21:14:23'),
(115, 'Médina Yoro Foulah', 'medina-yoro-foulah', 30, '2026-07-28 21:14:23', '2026-07-28 21:14:23'),
(116, 'Louga', 'louga', 31, '2026-07-28 21:14:23', '2026-07-28 21:14:23'),
(117, 'Kébémer', 'kebemer', 31, '2026-07-28 21:14:23', '2026-07-28 21:14:23'),
(118, 'Sagatta', 'sagatta', 31, '2026-07-28 21:14:23', '2026-07-28 21:14:23'),
(119, 'Ndiagne', 'ndiagne', 31, '2026-07-28 21:14:23', '2026-07-28 21:14:23'),
(120, 'Linguère', 'linguere', 32, '2026-07-28 21:14:23', '2026-07-28 21:14:23'),
(121, 'Dahra', 'dahra', 32, '2026-07-28 21:14:23', '2026-07-28 21:14:23'),
(122, 'Ouadiour', 'ouadiour', 33, '2026-07-28 21:14:23', '2026-07-28 21:14:23'),
(123, 'Matam', 'matam', 34, '2026-07-28 21:14:23', '2026-07-28 21:14:23'),
(124, 'Ourossogui', 'ourossogui', 34, '2026-07-28 21:14:23', '2026-07-28 21:14:23'),
(125, 'Nabadji Civol', 'nabadji-civol', 34, '2026-07-28 21:14:23', '2026-07-28 21:14:23'),
(126, 'Sinthiou', 'sinthiou', 34, '2026-07-28 21:14:23', '2026-07-28 21:14:23'),
(127, 'Kanel', 'kanel', 35, '2026-07-28 21:14:23', '2026-07-28 21:14:23'),
(128, 'Diawara', 'diawara', 35, '2026-07-28 21:14:23', '2026-07-28 21:14:23'),
(129, 'Ranérou', 'ranerou', 36, '2026-07-28 21:14:23', '2026-07-28 21:14:23'),
(130, 'Sédhiou', 'sedhiou', 37, '2026-07-28 21:14:23', '2026-07-28 21:14:23'),
(131, 'Djibabouya', 'djibabouya', 37, '2026-07-28 21:14:23', '2026-07-28 21:14:23'),
(132, 'Tambacounda', 'tambacounda', 40, '2026-07-28 21:14:23', '2026-07-28 21:14:23'),
(133, 'Koumpentoum', 'koumpentoum', 40, '2026-07-28 21:14:23', '2026-07-28 21:14:23'),
(134, 'Bakel', 'bakel', 40, '2026-07-28 21:14:23', '2026-07-28 21:14:23'),
(135, 'Goudiry', 'goudiry', 40, '2026-07-28 21:14:23', '2026-07-28 21:14:23'),
(136, 'Kidira', 'kidira', 40, '2026-07-28 21:14:23', '2026-07-28 21:14:23'),
(137, 'Koumel', 'koumel', 40, '2026-07-28 21:14:23', '2026-07-28 21:14:23'),
(138, 'Béli', 'beli', 41, '2026-07-28 21:14:23', '2026-07-28 21:14:23'),
(139, 'Ziguinchor', 'ziguinchor', 44, '2026-07-28 21:14:23', '2026-07-28 21:14:23'),
(140, 'Bignona', 'bignona', 44, '2026-07-28 21:14:23', '2026-07-28 21:14:23'),
(141, 'Oussouye', 'oussouye', 44, '2026-07-28 21:14:23', '2026-07-28 21:14:23'),
(142, 'Thionck-Essyl', 'thionck-essyl', 44, '2026-07-28 21:14:23', '2026-07-28 21:14:23'),
(143, 'Diouloulou', 'diouloulou', 44, '2026-07-28 21:14:23', '2026-07-28 21:14:23');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `candidatures`
--
ALTER TABLE `candidatures`
  ADD PRIMARY KEY (`id`),
  ADD KEY `candidatures_stage_id_foreign` (`stage_id`),
  ADD KEY `candidatures_user_id_foreign` (`user_id`);

--
-- Index pour la table `departements`
--
ALTER TABLE `departements`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `departements_slug_unique` (`slug`),
  ADD KEY `departements_region_id_foreign` (`region_id`);

--
-- Index pour la table `entreprises`
--
ALTER TABLE `entreprises`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `entreprises_slug_unique` (`slug`),
  ADD KEY `entreprises_ville_id_foreign` (`ville_id`);

--
-- Index pour la table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Index pour la table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Index pour la table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Index pour la table `regions`
--
ALTER TABLE `regions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `regions_slug_unique` (`slug`);

--
-- Index pour la table `stages`
--
ALTER TABLE `stages`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `stages_slug_unique` (`slug`),
  ADD KEY `stages_entreprise_id_foreign` (`entreprise_id`),
  ADD KEY `stages_ville_id_foreign` (`ville_id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_entreprise_id_foreign` (`entreprise_id`);

--
-- Index pour la table `villes`
--
ALTER TABLE `villes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `villes_slug_unique` (`slug`),
  ADD KEY `villes_departement_id_foreign` (`departement_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `candidatures`
--
ALTER TABLE `candidatures`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `departements`
--
ALTER TABLE `departements`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT pour la table `entreprises`
--
ALTER TABLE `entreprises`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT pour la table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `regions`
--
ALTER TABLE `regions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT pour la table `stages`
--
ALTER TABLE `stages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `villes`
--
ALTER TABLE `villes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=144;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `candidatures`
--
ALTER TABLE `candidatures`
  ADD CONSTRAINT `candidatures_stage_id_foreign` FOREIGN KEY (`stage_id`) REFERENCES `stages` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `candidatures_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `departements`
--
ALTER TABLE `departements`
  ADD CONSTRAINT `departements_region_id_foreign` FOREIGN KEY (`region_id`) REFERENCES `regions` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `entreprises`
--
ALTER TABLE `entreprises`
  ADD CONSTRAINT `entreprises_ville_id_foreign` FOREIGN KEY (`ville_id`) REFERENCES `villes` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `stages`
--
ALTER TABLE `stages`
  ADD CONSTRAINT `stages_entreprise_id_foreign` FOREIGN KEY (`entreprise_id`) REFERENCES `entreprises` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `stages_ville_id_foreign` FOREIGN KEY (`ville_id`) REFERENCES `villes` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_entreprise_id_foreign` FOREIGN KEY (`entreprise_id`) REFERENCES `entreprises` (`id`) ON DELETE SET NULL;

--
-- Contraintes pour la table `villes`
--
ALTER TABLE `villes`
  ADD CONSTRAINT `villes_departement_id_foreign` FOREIGN KEY (`departement_id`) REFERENCES `departements` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
