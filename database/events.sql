-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 13, 2025 at 08:54 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `events`
--

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `status` varchar(250) NOT NULL DEFAULT 'Pending',
  `booked_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`id`, `user_id`, `event_id`, `status`, `booked_at`) VALUES
(5, 3, 6, 'Pending', '2025-01-13 07:49:13'),
(6, 3, 7, 'Pending', '2025-01-13 07:49:15'),
(7, 3, 8, 'Confirmed', '2025-01-13 07:49:18'),
(8, 3, 5, 'Pending', '2025-01-13 07:49:19'),
(9, 4, 5, 'Pending', '2025-01-13 07:49:58'),
(10, 4, 6, 'Pending', '2025-01-13 07:49:59'),
(11, 4, 7, 'Pending', '2025-01-13 07:50:01'),
(12, 4, 8, 'Confirmed', '2025-01-13 07:50:04');

-- --------------------------------------------------------

--
-- Table structure for table `event`
--

CREATE TABLE `event` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `userid` int(11) NOT NULL,
  `packageid` int(11) NOT NULL,
  `description` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` int(11) NOT NULL,
  `event_title` varchar(255) NOT NULL,
  `event_date` date NOT NULL,
  `event_time` time NOT NULL,
  `event_location` varchar(255) NOT NULL,
  `event_description` text NOT NULL,
  `event_image` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `event_title`, `event_date`, `event_time`, `event_location`, `event_description`, `event_image`, `created_at`) VALUES
(5, 'Ashes Band', '2025-01-22', '16:00:00', 'Dhanmondi-4, Dhaka', 'The band Ashes is known for its talented vocalists who bring emotion and energy to their performances. Their unique style and powerful lyrics resonate with fans, making them a standout in the music scene.\r\nJoin the Concert plase Booking.\r\ncontact: 01763131342', 'ashes.jpg', '2025-01-13 07:10:45'),
(6, 'Era Convention Hall', '2025-01-17', '18:00:00', 'Dhanmondi-4, Dhaka', 'Era Convention Hall Booking Description:\r\n\r\nWelcome to Era Convention Hall, the perfect venue for your special events, conferences, and gatherings. Our state-of-the-art facility offers a spacious and versatile environment for all types of occasions, whether it’s a wedding, corporate meeting, seminar, or a community event.\r\n\r\nVenue Features:\r\nCapacity: Accommodates up to 500 guests comfortably\r\nModern Audio-Visual Equipment: Equipped with high-quality sound systems, projectors, and screens\r\nAmbiance: Elegant and contemporary design with customizable lighting\r\nCatering: On-site catering services offering a wide range of menus to suit your needs\r\nParking: Ample parking space for guests\r\nAccessibility: Wheelchair accessible, with easy access for all guests\r\nBooking Information:\r\nLocation: [Address of the Era Convention Hall]\r\nAvailable for: Weddings, Corporate Events, Conferences, Seminars, Parties, and More!\r\nBooking Hours: Available from [Start Time] to [End Time]\r\nPricing: Prices vary depending on the event type and duration. Please contact us for customized quotes.\r\nSpecial Offers: Discounts for early bookings or off-season events. Contact for details.\r\nTo book your event at Era Convention Hall, simply fill out the booking form below or contact our customer service team at [Phone Number] or [Email Address]. We look forward to making your event an unforgettable experience!\r\nContact: 01763131342', 'convention.jpg', '2025-01-13 07:15:41'),
(7, 'Cricket Tournament Booking', '2025-01-29', '15:00:00', 'Gaibandha Stadium', 'Cricket Tournament Booking Description:\r\nWelcome to Cricket Tournament, where the thrill of cricket meets the excitement of competition! Whether you are a player, a team manager, or a passionate fan, this event offers an unforgettable experience filled with action-packed matches and unforgettable moments.\r\n\r\nEvent Features:\r\nFormat: [T20 / ODI / Test Match] Tournament\r\nTeams: [Number of teams] competing for the championship title\r\nVenue: [Venue Name & Address]\r\nDate & Time: [Start Date] to [End Date], [Event Start Time]\r\nCategory: [Men\'s / Women\'s / Mixed] teams\r\nEntry Fee: [Entry Fee Amount] per team (includes all event services)\r\nPrize Pool: [Prize Amount] for the winning team and additional prizes for Best Player, Best Bowler, etc', 'criket.jpg', '2025-01-13 07:46:51'),
(8, 'Football Tournament Booking', '2025-01-27', '14:00:00', 'Bogra Chandu Stadium', 'Join us at the Football Tournament for an action-packed sporting experience! Whether you\'re a player or a fan, this tournament promises high-energy matches and a competitive atmosphere. Get ready to witness incredible talent, teamwork, and sportsmanship on the field.\r\n\r\nEvent Features:\r\nTournament Format: [Knockout / Round Robin / League] Style\r\nTeams: [Number of teams] competing for the championship trophy\r\nVenue: [Venue Name & Address] – Equipped with top-class football facilities\r\nDate & Time: [Start Date] to [End Date], [Event Start Time]\r\nCategories: [Men\'s / Women\'s / Junior / Mixed] teams\r\nEntry Fee: [Entry Fee Amount] per team (includes all event-related services)\r\nPrize Pool: [Prize Amount] for the winning team, along with awards for Best Player, Best Goalkeeper, etc', 'footbal.jpg', '2025-01-13 07:48:41');

-- --------------------------------------------------------

--
-- Table structure for table `package`
--

CREATE TABLE `package` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` varchar(1000) NOT NULL,
  `price` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `id` int(11) NOT NULL,
  `amount` float NOT NULL,
  `eventid` int(11) NOT NULL,
  `userid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `userid` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `contact` varchar(250) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `roleid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`userid`, `name`, `contact`, `email`, `password`, `roleid`) VALUES
(1, 'admin', '0177', 'admin@gmail.com', '123', 1),
(2, 'isha', '01233435', 'isha@gmail.com', '123', 2),
(3, 'Galib Hasan Megh', '', 'galib@gmail.com', '123', 2),
(4, 'Md. Rabbani Mia', '', 'rabbani@gmail.com', '123', 2);

-- --------------------------------------------------------

--
-- Table structure for table `venue`
--

CREATE TABLE `venue` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `location` varchar(100) NOT NULL,
  `capacity` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `event_id` (`event_id`);

--
-- Indexes for table `event`
--
ALTER TABLE `event`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `package`
--
ALTER TABLE `package`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`userid`);

--
-- Indexes for table `venue`
--
ALTER TABLE `venue`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `event`
--
ALTER TABLE `event`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `package`
--
ALTER TABLE `package`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `userid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `venue`
--
ALTER TABLE `venue`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bookings`
--
ALTER TABLE `bookings`
  ADD CONSTRAINT `bookings_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`userid`),
  ADD CONSTRAINT `bookings_ibfk_2` FOREIGN KEY (`event_id`) REFERENCES `events` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
