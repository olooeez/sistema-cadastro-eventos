USE SistemaCadastroEventosDB;

CREATE OR REPLACE TABLE `user` (
  user_id INT PRIMARY KEY AUTO_INCREMENT,
  name VARCHAR(255) NOT NULL,
  email VARCHAR(255) NOT NULL,
  password VARCHAR(255) NOT NULL,
  user_type ENUM('organizer', 'participant', 'administrator') NOT NULL
);

CREATE OR REPLACE TABLE `category` (
  category_id INT PRIMARY KEY AUTO_INCREMENT,
  name VARCHAR(255) NOT NULL
);

CREATE OR REPLACE TABLE `event` (
  event_id INT PRIMARY KEY AUTO_INCREMENT,
  title VARCHAR(255) NOT NULL,
  description TEXT,
  date DATE NOT NULL,
  time TIME NOT NULL,
  location VARCHAR(255) NOT NULL,
  category_id INT NOT NULL,
  user_id INT NOT NULL,
  price DECIMAL(10, 2),
  images TEXT,
  FOREIGN KEY (category_id) REFERENCES category(category_id) ON DELETE CASCADE,
  FOREIGN KEY (user_id) REFERENCES user(user_id) ON DELETE CASCADE
);

CREATE OR REPLACE TABLE `registration` (
  registration_id INT PRIMARY KEY AUTO_INCREMENT,
  user_id INT NOT NULL,
  event_id INT NOT NULL,
  payment_status ENUM('pending', 'paid', 'cancelled') NOT NULL,
  FOREIGN KEY (user_id) REFERENCES user(user_id) ON DELETE CASCADE,
  FOREIGN KEY (event_id) REFERENCES event(event_id) ON DELETE CASCADE
);

CREATE OR REPLACE TABLE `review` (
  review_id INT PRIMARY KEY AUTO_INCREMENT,
  user_id INT NOT NULL,
  event_id INT NOT NULL,
  score INT NOT NULL,
  comment TEXT,
  FOREIGN KEY (user_id) REFERENCES user(user_id) ON DELETE CASCADE,
  FOREIGN KEY (event_id) REFERENCES event(event_id) ON DELETE CASCADE
);
