-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : ven. 17 avr. 2026 à 14:36
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
-- Base de données : `mesfilmspreferes`
--

-- --------------------------------------------------------

--
-- Structure de la table `avis`
--

CREATE TABLE `avis` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `favori_id` bigint(20) UNSIGNED DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `rating` tinyint(3) UNSIGNED DEFAULT NULL,
  `texte` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `avis`
--

INSERT INTO `avis` (`id`, `favori_id`, `user_id`, `rating`, `texte`, `created_at`, `updated_at`) VALUES
(1, 4, 1, 3, 'Il est bien.', '2026-04-17 10:03:00', '2026-04-17 10:19:23'),
(2, 5, 1, 2, 'cool', '2026-04-17 10:11:39', '2026-04-17 10:11:39'),
(3, 6, 1, 5, 'j\'ai aimé', '2026-04-17 10:19:07', '2026-04-17 10:19:07'),
(4, 7, 1, 5, NULL, '2026-04-17 10:22:54', '2026-04-17 10:22:54');

-- --------------------------------------------------------

--
-- Structure de la table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
-- Structure de la table `favoris`
--

CREATE TABLE `favoris` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `favori_id` varchar(255) DEFAULT NULL,
  `film_title` varchar(255) NOT NULL,
  `film_year` varchar(255) DEFAULT NULL,
  `film_overview` text DEFAULT NULL,
  `film_poster_path` varchar(255) DEFAULT NULL,
  `avis` text DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `favoris`
--

INSERT INTO `favoris` (`id`, `favori_id`, `film_title`, `film_year`, `film_overview`, `film_poster_path`, `avis`, `user_id`, `created_at`, `updated_at`) VALUES
(3, '1226863', 'Super Mario Galaxy, le film', '2026', 'Au-delà du Royaume Champignon, Mario, Luigi et Yoshi voyagent à travers les galaxies aux côtés de Rosalina pour arrêter Bowser Jr., dont la tentative de sauver son père menace l’équilibre de l’univers.', 'https://image.tmdb.org/t/p/w500/aSQktALDmbunDbwkuZbZFMEWVFr.jpg', NULL, 2, '2026-04-16 07:25:58', '2026-04-16 07:25:58'),
(4, '1226863', 'Super Mario Galaxy, le film', '2026', 'Au-delà du Royaume Champignon, Mario, Luigi et Yoshi voyagent à travers les galaxies aux côtés de Rosalina pour arrêter Bowser Jr., dont la tentative de sauver son père menace l’équilibre de l’univers.', 'https://image.tmdb.org/t/p/w500/aSQktALDmbunDbwkuZbZFMEWVFr.jpg', 'Il est bien.', 1, '2026-04-17 10:02:45', '2026-04-17 10:19:23'),
(5, '936075', 'Michael', '2026', 'Michael dresse le portrait cinématographique de la vie et de l’héritage de l’un des artistes les plus influents de notre époque.  Le film raconte l’histoire de Michael Jackson au-delà de la musique, depuis la découverte d’un talent hors du commun en tant que leader des Jackson Five, jusqu’à l’artiste visionnaire dont l’ambition créative a alimenté une quête incessante pour devenir le plus grand artiste au monde.  Mettant en lumière sa vie hors scène et ses performances les plus emblématiques de ses débuts en solo, le film offre au public une place au premier rang pour découvrir Michael Jackson comme jamais auparavant.', 'https://image.tmdb.org/t/p/w500/2sDgNilJGVFpl1x4DMzYHjk0L0f.jpg', 'cool', 1, '2026-04-17 10:10:57', '2026-04-17 10:11:39'),
(7, '83533', 'Avatar : De feu et de cendres', '2025', 'Après la mort de Neteyam, Jake et Neytiri affrontent leur chagrin tout en faisant face au Peuple des Cendres, une tribu Na’vi redoutable menée par la fougueuse Varang, alors que le conflit sur Pandora s’intensifie et qu’une nouvelle quête morale s’amorce.', 'https://image.tmdb.org/t/p/w500/kG3N8oQ10qiw2MsnSHFGJpQNyEy.jpg', NULL, 1, '2026-04-17 10:22:46', '2026-04-17 10:22:46');

-- --------------------------------------------------------

--
-- Structure de la table `friend_user`
--

CREATE TABLE `friend_user` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `friend_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `friend_user`
--

INSERT INTO `friend_user` (`id`, `friend_id`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 2, 1, '2026-01-07 09:01:17', '2026-01-07 09:01:17'),
(2, 1, 2, '2026-04-16 06:41:02', '2026-04-16 06:41:02');

-- --------------------------------------------------------

--
-- Structure de la table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
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
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_12_17_100000_create_favoris_table', 2),
(5, '2025_12_17_100010_create_friend_user_table', 2),
(6, '2025_12_17_100020_create_partages_table', 2),
(7, '2025_12_17_100030_create_avis_table', 2),
(8, '2026_04_17_000000_add_note_to_partages_table', 3);

-- --------------------------------------------------------

--
-- Structure de la table `partages`
--

CREATE TABLE `partages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `favori_id` bigint(20) UNSIGNED DEFAULT NULL,
  `film_title` varchar(255) NOT NULL,
  `film_poster_path` varchar(255) DEFAULT NULL,
  `film_tmdb_id` int(10) UNSIGNED DEFAULT NULL,
  `friend_id` bigint(20) UNSIGNED NOT NULL,
  `message` text DEFAULT NULL,
  `avis` text DEFAULT NULL,
  `note` tinyint(3) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `partages`
--

INSERT INTO `partages` (`id`, `user_id`, `favori_id`, `film_title`, `film_poster_path`, `film_tmdb_id`, `friend_id`, `message`, `avis`, `note`, `created_at`, `updated_at`) VALUES
(1, 1, NULL, 'Star Wars', 'https://image.tmdb.org/t/p/w500/6FfCtAuVAW8XJjZ7eWeLibRLWTw.jpg', 11, 2, NULL, NULL, NULL, '2026-01-07 09:01:35', '2026-01-07 09:01:35'),
(2, 2, NULL, 'Rogue One: A Star Wars Story', 'https://image.tmdb.org/t/p/w500/i0yw1mFbB7sNGHCs7EXZPzFkdA1.jpg', 330459, 1, NULL, NULL, NULL, '2026-04-16 06:41:25', '2026-04-16 06:41:25');

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
-- Structure de la table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('8p1dRDxZ6GOrwbRzt7cBMHno9p65fUTeHdqkwHqB', 1, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', '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', 1767779957),
('9ThbOzKz2kLypsqVHYugkeEVdQiwcj70UVp2Xi2z', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', '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', 1767780624),
('zSyNMgw5cYccq3iePXsKleM4d0wxXxCkChU7GyHM', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'YTozOntzOjY6Il9mbGFzaCI7YToyOntzOjM6Im5ldyI7YTowOnt9czozOiJvbGQiO2E6MDp7fX1zOjY6Il90b2tlbiI7czo0MDoiM05ramI2TnRXamdhYktMV2g4dWNjZndGYndlNGtrNWpKdUN1czRKVyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NTQ6Imh0dHA6Ly9sb2NhbGhvc3QvbWVzZmlsbXNwcmVmZXJlcy1hcGkvcHVibGljL2Nvbm5leGlvbiI7czo1OiJyb3V0ZSI7czo5OiJjb25uZXhpb24iO319', 1775207761);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `username`, `email`, `avatar`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Hugo', 'Demangeat', 'HD', 'hugo.demangeat.2024@lurcat.fr', '1776328815_DEMANGEAT Hugo.jpg', NULL, '$2y$12$323K2A6tlHcZCIG2YfWrOu980hR0M3hhlX1e.oyzOURQlAs5tGJYa', NULL, '2025-12-17 09:42:01', '2026-04-16 06:40:15'),
(2, 'Toto', 'toto', 'toto', 'toto@gmail.com', '1765970646_Tête_à_Toto.svg.png', NULL, '$2y$12$tiH5ePkjrbNxClbdqdeZ.OLF3RhMZ8Q0Q2.HYZwsznUlNhjgensde', NULL, '2025-12-17 10:15:52', '2025-12-17 10:24:06');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `avis`
--
ALTER TABLE `avis`
  ADD PRIMARY KEY (`id`),
  ADD KEY `avis_favori_id_index` (`favori_id`),
  ADD KEY `avis_user_id_index` (`user_id`);

--
-- Index pour la table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Index pour la table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Index pour la table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Index pour la table `favoris`
--
ALTER TABLE `favoris`
  ADD PRIMARY KEY (`id`),
  ADD KEY `favoris_user_id_foreign` (`user_id`);

--
-- Index pour la table `friend_user`
--
ALTER TABLE `friend_user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `friend_user_friend_id_index` (`friend_id`),
  ADD KEY `friend_user_user_id_index` (`user_id`);

--
-- Index pour la table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Index pour la table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `partages`
--
ALTER TABLE `partages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `partages_user_id_foreign` (`user_id`),
  ADD KEY `partages_friend_id_index` (`friend_id`);

--
-- Index pour la table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Index pour la table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_username_unique` (`username`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `avis`
--
ALTER TABLE `avis`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `favoris`
--
ALTER TABLE `favoris`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `friend_user`
--
ALTER TABLE `friend_user`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `partages`
--
ALTER TABLE `partages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `favoris`
--
ALTER TABLE `favoris`
  ADD CONSTRAINT `favoris_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Contraintes pour la table `partages`
--
ALTER TABLE `partages`
  ADD CONSTRAINT `partages_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
