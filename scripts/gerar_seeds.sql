USE SistemaCadastroEventosDB;

INSERT INTO `user` (name, email, password, user_type)
VALUES
  ('Luiz Felipe', 'luiz@teste.com', '$2y$10$4B19Hq.xZESOCL17bAu3fe69I1yq0BVSUKlXPmKt4Qtd.Kc0WmgxK', 'organizer'),
  ('Fabio Henrique', 'fabio@teste.com', '$2y$10$2QlLEw5eKGY.UXPGluLP5OQGvMZiqr7czPxM/dHWM9FBHYs0JqaxK', 'participant'),
  ('Alexandre Bezerra', 'alexandre@teste.com', '$2y$10$WkDxwvxjZFvCVVFfCCr7Iu8F5eZYVvJnA9GCp.NnT2oPmgkdp8kty', 'administrator');

INSERT INTO `category` (name)
VALUES
  ('Esportes'),
  ('Música'),
  ('Tecnologia'),
  ('Artes'),
  ('Gastronomia'),
  ('Ciências');

INSERT INTO `event` (title, description, date, time, location, category_id, user_id, price, images)
VALUES
  ('Aniversário do Pedro', 'Aniversário 30 anos do Pedro Augusto', '2023-07-15', '16:00:00', 'Pátio de festas', 1, 1, 20.00, 'assets/images/aniversario_01.jpg,assets/images/aniversario_02.jpg'),
  ('Curso de Fotografia', 'Curso de fotografia para todas as idades', '2023-08-25', '18:00:00', 'Escola de Fotografia', 5, 1, 30.00, 'assets/images/fotografia_01.jpg,assets/images/fotografia_02.jpg'),
  ('Curso de Música', 'Curso de música clássica para todas as idades', '2023-09-02', '20:00:00', 'Centro de Eventos', 6, 1, 0.00, 'assets/images/musica_01.jpg,assets/images/musica_02.jpg'),
  ('Curso de Programação', 'Aprenda a programar em Python', '2023-08-05', '14:00:00', 'Escola de TI', 3, 1, 0.00, 'assets/images/programacao_01.jpg,assets/images/programacao_02.jpg'),
  ('Show de Rock', 'Show de bandas de rock locais', '2023-07-20', '19:30:00', 'Centro de Convenções', 2, 1, 10.00, 'assets/images/show_01.jpg,assets/images/show_02.jpg'),
  ('Peças de teatro', 'Peças de teatro clássicas', '2023-08-10', '10:00:00', 'Galeria de Arte', 4, 1, 5.00, 'assets/images/teatro_01.jpg,assets/images/teatro_02.jpg');

INSERT INTO `registration` (user_id, event_id, payment_status)
VALUES
  (2, 2, 'pending'),
  (2, 3, 'paid'),
  (2, 1, 'paid'),
  (2, 4, 'cancelled'),
  (2, 6, 'paid'),
  (2, 5, 'pending');

INSERT INTO `review` (user_id, event_id, score, comment)
VALUES
  (2, 2, 4, 'Ótimo show!'),
  (2, 1, 5, 'Torneio muito bem organizado'),
  (2, 3, 3, 'Gostei das bandas, mas o som estava alto demais'),
  (2, 6, 5, 'Aula excelente! Aprendi muito'),
  (2, 5, 4, 'Gostei das receitas, mas faltou um pouco mais de interação'),
  (2, 4, 2, 'Infelizmente não pude comparecer ao evento');
