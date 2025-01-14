-- Drop the existing tables if they exist (optional)
DROP TABLE IF EXISTS reviews;
DROP TABLE IF EXISTS movies;

-- Create the 'movies' table
CREATE TABLE movies (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    title TEXT NOT NULL,
    director TEXT,
    release_year INTEGER,
    genre TEXT,
    description TEXT,
    poster TEXT, -- Column to store the poster file path
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Create the 'reviews' table
CREATE TABLE reviews (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    movie_id INTEGER NOT NULL,
    author TEXT,
    rating REAL CHECK (rating >= 0 AND rating <= 5), -- Ratings between 0 and 5
    review_text TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (movie_id) REFERENCES movies(id) ON DELETE CASCADE
);

-- Sample data for 'movies' table (optional)
INSERT INTO movies (title, director, release_year, genre, description, poster) VALUES
('Thoovanathumbikal', 'Lal Jose', 2020, 'Action', 'A gripping action-packed story set against the backdrop of loyalty and betrayal.', NULL),
('King of Kotha', 'Jeethu Joseph', 2019, 'Drama', 'A powerful drama that delves into the complexities of family, revenge, and redemption.', NULL),
('Godfather', 'Lal Jose', 2021, 'Comedy', 'A hilarious comedy that explores family dynamics with unexpected twists.', NULL),
('Beeshma Parvam', 'Jeethu Joseph', 2020, 'Action', 'An intense action film centered around a fearless protagonists journey for justice.', NULL),
('Turbo', 'Basil Joseph', 2019, 'Drama', 'A captivating drama about personal growth and the relentless pursuit of ones dreams.', NULL),
('Premam', 'Basil Joseph', 2021, 'Comedy', 'A feel-good comedy about love, friendships, and the humorous moments in everyday life.', NULL),
('Spadikam', 'Lal Jose', 2020, 'Action', 'A riveting action film featuring a tale of rebellion, power, and redemption.', NULL),
('Falimy', 'Jeethu Joseph', 2019, 'Drama', 'A heartfelt drama that examines the bonds between family members amid trials and tribulations.', NULL),
('Bramayugam', 'Basil Joseph', 2021, 'Comedy', 'A quirky comedy with a unique twist, blending humor and life lessons.', NULL),
('Joji', 'Lal Jose', 2020, 'Action', 'A thrilling action movie showcasing the struggle between right and wrong in a high-stakes world.', NULL),
('Annadharam', 'Basil Joseph', 2019, 'Drama', 'A moving drama about resilience and overcoming lifes most challenging obstacles.', NULL),
('Goatlife', 'Jeethu Joseph', 2021, 'Comedy', 'A light-hearted comedy exploring the unpredictable nature of life and relationships.', NULL),
('Super Sharanya', 'Lal Jose', 2021, 'Comedy', 'A delightful comedy packed with quirky characters and humorous adventures.', NULL),
('Villain', 'Jeethu Joseph', 2021, 'Comedy', 'A clever comedy that turns the concept of heroes and villains upside down with its witty narrative.', NULL);

-- Sample data for 'reviews' table (optional)
INSERT INTO reviews (movie_id, author, rating, review_text) VALUES
(1, 'Appu', 4.5, 'Great action movie!'),
(1, 'Melvin', 4.0, 'Good entertainment!'),
(1, 'Tom', 3.5, 'Decent drama movie.'),
(2, 'Theresa', 5.0, 'Very funny and entertaining!'),
(2, 'Teena', 4.5, 'Great action movie!'),
(3, 'Sijo', 4.0, 'Good entertainment!'),
(3, 'Adam', 3.5, 'Decent drama movie.'),
(3, 'Tony', 5.0, 'Very funny and entertaining!'),
(4, 'Kingini', 4.5, 'Great action movie!'),
(5, 'Madonna', 4.0, 'Good entertainment!'),
(5, 'Jimmy', 3.5, 'Decent drama movie.'),
(5, 'Jasmin', 5.0, 'Very funny and entertaining!'),
(5, 'Sibi', 4.5, 'Great action movie!'),
(6, 'Joy', 4.0, 'Good entertainment!'),
(7, 'Mary', 3.5, 'Decent drama movie.'),
(8, 'Maya', 5.0, 'Very funny and entertaining!'),
(8, 'Sabu', 4.5, 'Great action movie!'),
(9, 'Tobi', 4.0, 'Good entertainment!'),
(9, 'Malu', 3.5, 'Decent drama movie.'),
(9, 'Chinnu', 5.0, 'Very funny and entertaining!'),
(10, 'Sanju', 4.5, 'Great action movie!'),
(11, 'Molly', 4.0, 'Good entertainment!'),
(12, 'Thomas', 3.5, 'Decent drama movie.'),
(13, 'Roy', 5.0, 'Very funny and entertaining!'),
(14, 'Raymond', 4.5, 'Great action movie!'),
(14, 'Aljo', 4.0, 'Good entertainment!'),
(14, 'Raju', 3.5, 'Decent drama movie.');
