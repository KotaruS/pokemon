-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Počítač: 127.0.0.1
-- Vytvořeno: Úte 06. úno 2018, 09:50
-- Verze serveru: 5.7.14
-- Verze PHP: 5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Databáze: `pokedex`
--

-- --------------------------------------------------------

--
-- Struktura tabulky `clovek`
--

CREATE TABLE `clovek` (
  `id` int(11) NOT NULL,
  `jmeno` varchar(60) COLLATE utf8_czech_ci NOT NULL,
  `popis_cloveka` text COLLATE utf8_czech_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

--
-- Vypisuji data pro tabulku `clovek`
--

INSERT INTO `clovek` (`id`, `jmeno`, `popis_cloveka`) VALUES
(1, 'Ash ', 'He is a Pokémon Trainer from Pallet Town whose goal is to become a Pokémon Master. He shares his Japanese name with the creator of the Pokémon franchise, Satoshi Tajiri. His English surname is a pun of the English motto, "Gotta catch \'em all!."'),
(2, 'Brock ', 'Brock (Japanese: タケシ Takeshi) is an aspiring Pokémon Doctor from Pewter City and a former traveling partner of Ash. He is also the former Gym Leader of the Pewter Gym.'),
(3, 'Gary', 'Gary Oak (Japanese: オーキド・シゲル Shigeru Okido) is a recurring character in the Pokémon anime. He is a Pokémon Researcher from Pallet Town and grandson of Professor Oak. He is a childhood friend and former rival of Ash Ketchum. His Japanese name is derived from Shigeru Miyamoto.');

-- --------------------------------------------------------

--
-- Struktura tabulky `pokemon`
--

CREATE TABLE `pokemon` (
  `id` int(11) NOT NULL,
  `nazev` varchar(60) COLLATE utf8_czech_ci NOT NULL,
  `popis` text COLLATE utf8_czech_ci NOT NULL,
  `obrazek` varchar(200) COLLATE utf8_czech_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

--
-- Vypisuji data pro tabulku `pokemon`
--

INSERT INTO `pokemon` (`id`, `nazev`, `popis`, `obrazek`) VALUES
(1, 'Bulbasaur', 'Bulbasaur can be seen napping in bright sunlight. There is a seed on its back. By soaking up the sun\'s rays, the seed grows progressively larger.', 'bulbasaur.png'),
(2, 'Charmander', 'The flame that burns at the tip of its tail is an indication of its emotions. The flame wavers when Charmander is enjoying itself. If the Pokémon becomes enraged, the flame burns fiercely.', 'charmander.png'),
(3, 'Squirtle', 'Squirtle\'s shell is not merely used for protection. The shell\'s rounded shape and the grooves on its surface help minimize resistance in water, enabling this Pokémon to swim at high speeds.', 'squirtle.png'),
(4, 'Weedle', 'Weedle has an extremely acute sense of smell. It is capable of distinguishing its favorite kinds of leaves from those it dislikes just by sniffing with its big red proboscis (nose).', 'weedle.png'),
(5, 'Rattata', 'Rattata is cautious in the extreme. Even while it is asleep, it constantly listens by moving its ears around. It is not picky about where it lives—it will make its nest anywhere.', 'rattata.png'),
(6, 'Ekans', 'Ekans curls itself up in a spiral while it rests. Assuming this position allows it to quickly respond to a threat from any direction with a glare from its upraised head.', 'ekans.png'),
(7, 'Pikachu', 'Whenever Pikachu comes across something new, it blasts it with a jolt of electricity. If you come across a blackened berry, it\'s evidence that this Pokémon mistook the intensity of its charge.', 'pikachu.png'),
(8, 'Ninetales', 'Ninetales casts a sinister light from its bright red eyes to gain total control over its foe\'s mind. This Pokémon is said to live for a thousand years.', 'ninetales.png'),
(9, 'Jigglypuff', 'Jigglypuff\'s vocal cords can freely adjust the wavelength of its voice. This Pokémon uses this ability to sing at precisely the right wavelength to make its foes most drowsy.', 'jigglypuff.png'),
(10, 'Diglett', 'Diglett are raised in most farms. The reason is simple— wherever this Pokémon burrows, the soil is left perfectly tilled for planting crops. This soil is made ideal for growing delicious vegetables.', 'diglett.png'),
(11, 'Meowth', 'Meowth withdraws its sharp claws into its paws to slinkily sneak about without making any incriminating footsteps. For some reason, this Pokémon loves shiny coins that glitter with light.', 'meowth.png'),
(12, 'Eevee', 'Eevee has an unstable genetic makeup that suddenly mutates due to the environment in which it lives. Radiation from various stones causes this Pokémon to evolve.', 'eevee.png'),
(13, 'Psyduck', 'Psyduck uses a mysterious power. When it does so, this Pokémon generates brain waves that are supposedly only seen in sleepers. This discovery spurred controversy among scholars.', 'psyduck.png'),
(14, 'Bellsprout', 'Bellsprout\'s thin and flexible body lets it bend and sway to avoid any attack, however strong it may be. From its mouth, this Pokémon spits a corrosive fluid that melts even iron.', 'bellsprout.png'),
(15, 'Geodude', 'The longer a Geodude lives, the more its edges are chipped and worn away, making it more rounded in appearance. However, this Pokémon\'s heart will remain hard, craggy, and rough always.', 'geodude.png'),
(16, 'Slowpoke', 'Slowpoke uses its tail to catch prey by dipping it in water at the side of a river. However, this Pokémon often forgets what it\'s doing and often spends entire days just loafing at water\'s edge.', 'slowpoke.png'),
(17, 'Dodrio', 'Watch out if Dodrio\'s three heads are looking in three separate directions. It\'s a sure sign that it is on its guard. Don\'t go near this Pokémon if it\'s being wary—it may decide to peck you.', 'dodrio.png'),
(18, 'Gengar', 'Sometimes, on a dark night, your shadow thrown by a streetlight will suddenly and startlingly overtake you. It is actually a Gengar running past you, pretending to be your shadow.', 'gengar.png'),
(19, 'Electrode', 'Electrode eats electricity in the atmosphere. On days when lightning strikes, you can see this Pokémon exploding all over the place from eating too much electricity.', 'electrode.png'),
(20, 'Koffing', 'If Koffing becomes agitated, it raises the toxicity of its internal gases and jets them out from all over its body. This Pokémon may also overinflate its round body, then explode.', 'koffing.png'),
(21, 'Staryu', 'Staryu\'s center section has an organ called the core that shines bright red. If you go to a beach toward the end of summer, the glowing cores of these Pokémon look like the stars in the sky.', 'staryu.png'),
(22, 'Jynx', 'Jynx walks rhythmically, swaying and shaking its hips as if it were dancing. Its motions are so bouncingly alluring, people seeing it are compelled to shake their hips without giving any thought to what they are doing.', 'jynx.png'),
(23, 'Ditto', 'Ditto rearranges its cell structure to transform itself into other shapes. However, if it tries to transform itself into something by relying on its memory, this Pokémon manages to get details wrong.', 'ditto.png'),
(24, 'Magikarp', 'Magikarp is a pathetic excuse for a Pokémon that is only capable of flopping and splashing. This behavior prompted scientists to undertake research into it.', 'magikarp.png'),
(25, 'Snorlax', 'Snorlax\'s typical day consists of nothing more than eating and sleeping. It is such a docile Pokémon that there are children who use its expansive belly as a place to play.', 'snorlax.png'),
(26, 'Mewtwo', 'Mewtwo is a Pokémon that was created by genetic manipulation. However, even though the scientific power of humans created this Pokémon\'s body, they failed to endow Mewtwo with a compassionate heart.', 'mewtwo.png'),
(27, 'Primeape', 'When Primeape becomes furious, its blood circulation is boosted. In turn, its muscles are made even stronger. However, it also becomes much less intelligent at the same time.', 'primeape.png'),
(28, 'Dragonair', 'Dragonair stores an enormous amount of energy inside its body. It is said to alter weather conditions in its vicinity by discharging energy from the crystals on its neck and tail.', 'dragonair.png');

-- --------------------------------------------------------

--
-- Struktura tabulky `pokemon_clovek`
--

CREATE TABLE `pokemon_clovek` (
  `id` int(11) NOT NULL,
  `pokemon_id` int(11) NOT NULL,
  `clovek_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

--
-- Vypisuji data pro tabulku `pokemon_clovek`
--

INSERT INTO `pokemon_clovek` (`id`, `pokemon_id`, `clovek_id`) VALUES
(1, 13, 1),
(2, 15, 1),
(3, 7, 1),
(4, 10, 1),
(5, 5, 2),
(6, 17, 2),
(7, 26, 2),
(8, 2, 3),
(9, 28, 3);

-- --------------------------------------------------------

--
-- Struktura tabulky `pokemon_typ`
--

CREATE TABLE `pokemon_typ` (
  `id` int(11) NOT NULL,
  `pokemon_id` int(11) NOT NULL,
  `typ_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

--
-- Vypisuji data pro tabulku `pokemon_typ`
--

INSERT INTO `pokemon_typ` (`id`, `pokemon_id`, `typ_id`) VALUES
(1, 1, 14),
(2, 1, 16),
(3, 2, 4),
(4, 3, 18),
(5, 4, 1),
(6, 4, 16),
(7, 5, 7),
(8, 6, 16),
(9, 7, 11),
(10, 8, 4),
(11, 9, 7),
(12, 9, 3),
(13, 10, 6),
(14, 11, 7),
(15, 12, 7),
(16, 13, 18),
(17, 14, 14),
(18, 14, 16),
(19, 15, 17),
(20, 15, 6),
(21, 16, 18),
(22, 16, 8),
(23, 17, 7),
(24, 17, 13),
(25, 18, 5),
(26, 18, 16),
(27, 19, 11),
(28, 20, 16),
(29, 21, 18),
(30, 22, 15),
(31, 22, 8),
(32, 23, 7),
(33, 24, 18),
(34, 25, 7),
(35, 26, 8),
(36, 27, 12),
(37, 28, 2);

-- --------------------------------------------------------

--
-- Struktura tabulky `typ`
--

CREATE TABLE `typ` (
  `id` int(11) NOT NULL,
  `nazev_typu` varchar(60) COLLATE utf8_czech_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

--
-- Vypisuji data pro tabulku `typ`
--

INSERT INTO `typ` (`id`, `nazev_typu`) VALUES
(1, 'Bug'),
(2, 'Dragon'),
(3, 'Fairy'),
(4, 'Fire'),
(5, 'Ghost'),
(6, 'Ground'),
(7, 'Normal'),
(8, 'Psychic'),
(9, 'Steel'),
(10, 'Dark'),
(11, 'Electric'),
(12, 'Fighting'),
(13, 'Flying'),
(14, 'Grass'),
(15, 'Ice'),
(16, 'Poison'),
(17, 'Rock'),
(18, 'Water');

--
-- Klíče pro exportované tabulky
--

--
-- Klíče pro tabulku `clovek`
--
ALTER TABLE `clovek`
  ADD PRIMARY KEY (`id`);

--
-- Klíče pro tabulku `pokemon`
--
ALTER TABLE `pokemon`
  ADD PRIMARY KEY (`id`);

--
-- Klíče pro tabulku `pokemon_clovek`
--
ALTER TABLE `pokemon_clovek`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx31` (`pokemon_id`),
  ADD KEY `idx33` (`clovek_id`);

--
-- Klíče pro tabulku `pokemon_typ`
--
ALTER TABLE `pokemon_typ`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx21` (`pokemon_id`),
  ADD KEY `idx23` (`typ_id`);

--
-- Klíče pro tabulku `typ`
--
ALTER TABLE `typ`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pro tabulky
--

--
-- AUTO_INCREMENT pro tabulku `clovek`
--
ALTER TABLE `clovek`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT pro tabulku `pokemon`
--
ALTER TABLE `pokemon`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
--
-- AUTO_INCREMENT pro tabulku `pokemon_clovek`
--
ALTER TABLE `pokemon_clovek`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT pro tabulku `pokemon_typ`
--
ALTER TABLE `pokemon_typ`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;
--
-- AUTO_INCREMENT pro tabulku `typ`
--
ALTER TABLE `typ`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- Omezení pro exportované tabulky
--

--
-- Omezení pro tabulku `pokemon_clovek`
--
ALTER TABLE `pokemon_clovek`
  ADD CONSTRAINT `fk3` FOREIGN KEY (`clovek_id`) REFERENCES `clovek` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk4` FOREIGN KEY (`pokemon_id`) REFERENCES `pokemon` (`id`) ON DELETE CASCADE;

--
-- Omezení pro tabulku `pokemon_typ`
--
ALTER TABLE `pokemon_typ`
  ADD CONSTRAINT `fk` FOREIGN KEY (`pokemon_id`) REFERENCES `pokemon` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk2` FOREIGN KEY (`typ_id`) REFERENCES `typ` (`id`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
