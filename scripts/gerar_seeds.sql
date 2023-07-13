USE SistemaCadastroEventosDB;

-- A senha para cada usuário é '123'
INSERT INTO `user` (name, email, password, user_type)
VALUES
  ('Luiz Felipe', 'luiz@teste.com', '$2y$10$4B19Hq.xZESOCL17bAu3fe69I1yq0BVSUKlXPmKt4Qtd.Kc0WmgxK', 'organizer'),
  ('Alexandre Bezerra', 'alexandre@teste.com', '$2y$10$WkDxwvxjZFvCVVFfCCr7Iu8F5eZYVvJnA9GCp.NnT2oPmgkdp8kty', 'administrator'),
  ('Fabio Henrique', 'fabio@teste.com', '$2y$10$2QlLEw5eKGY.UXPGluLP5OQGvMZiqr7czPxM/dHWM9FBHYs0JqaxK', 'participant'),
  ('Pedro Henrique', 'pedro@teste.com', '$2y$10$2QlLEw5eKGY.UXPGluLP5OQGvMZiqr7czPxM/dHWM9FBHYs0JqaxK', 'participant'),
  ('Lucas Silva', 'lucas@teste.com', '$2y$10$2QlLEw5eKGY.UXPGluLP5OQGvMZiqr7czPxM/dHWM9FBHYs0JqaxK', 'participant'),
  ('Clausius Reis', 'clausius@teste.com', '$2y$10$2QlLEw5eKGY.UXPGluLP5OQGvMZiqr7czPxM/dHWM9FBHYs0JqaxK', 'participant'),
  ('João Goulart', 'joao@teste.com', '$2y$10$2QlLEw5eKGY.UXPGluLP5OQGvMZiqr7czPxM/dHWM9FBHYs0JqaxK', 'participant'),
  ('Itamar Franco', 'itamar@teste.com', '$2y$10$2QlLEw5eKGY.UXPGluLP5OQGvMZiqr7czPxM/dHWM9FBHYs0JqaxK', 'participant');

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
  (3, 1, 'pending'),
  (4, 1, 'paid'),
  (5, 1, 'paid'),
  (6, 1, 'cancelled'),
  (7, 1, 'paid'),
  (8, 1, 'pending');

INSERT INTO `registration` (user_id, event_id, payment_status)
VALUES
  (3, 2, 'paid'),
  (4, 2, 'pending'),
  (5, 2, 'pending'),
  (6, 2, 'cancelled'),
  (7, 2, 'paid'),
  (8, 2, 'paid');

INSERT INTO `registration` (user_id, event_id, payment_status)
VALUES
  (3, 3, 'pending'),
  (4, 3, 'paid'),
  (5, 3, 'pending'),
  (6, 3, 'paid'),
  (7, 3, 'cancelled'),
  (8, 3, 'cancelled');

INSERT INTO `registration` (user_id, event_id, payment_status)
VALUES
  (3, 4, 'cancelled'),
  (4, 4, 'cancelled'),
  (5, 4, 'paid'),
  (6, 4, 'paid'),
  (7, 4, 'paid'),
  (8, 4, 'paid');

INSERT INTO `registration` (user_id, event_id, payment_status)
VALUES
  (3, 5, 'pending'),
  (4, 5, 'pending'),
  (5, 5, 'paid'),
  (6, 5, 'paid'),
  (7, 5, 'paid'),
  (8, 5, 'cancelled');

INSERT INTO `registration` (user_id, event_id, payment_status)
VALUES
  (3, 6, 'paid'),
  (4, 6, 'paid'),
  (5, 6, 'paid'),
  (6, 6, 'paid'),
  (7, 6, 'paid'),
  (8, 6, 'paid');

INSERT INTO `review` (user_id, event_id, score, comment)
VALUES
  (3, 1, 4, 'Ótimo evento!'),
  (4, 1, 5, 'Localização conveniente e boas atividades'),
  (5, 1, 3, 'Alguns problemas de organização, mas no geral foi bom'),
  (6, 1, 4, 'Recomendo a todos'),
  (7, 1, 5, 'Excelente experiência, com certeza participarei de novo'),
  (8, 1, 2, 'Expectativas não foram atendidas');

INSERT INTO `review` (user_id, event_id, score, comment)
VALUES
  (3, 2, 3, 'Instrutor qualificado, mas conteúdo básico demais'),
  (4, 2, 4, 'Aprendi algumas técnicas úteis'),
  (5, 2, 5, 'Ótimo curso, recomendo a todos interessados em fotografia'),
  (6, 2, 3, 'Duração muito longa, poderia ser mais condensado'),
  (7, 2, 4, 'Local agradável e material didático de qualidade'),
  (8, 2, 5, 'Aprendi muitas coisas novas, obrigado!');

INSERT INTO `review` (user_id, event_id, score, comment)
VALUES
  (3, 3, 5, 'Apresentações musicais incríveis!'),
  (4, 3, 4, 'Instrutores muito talentosos'),
  (5, 3, 3, 'Achei o conteúdo um pouco avançado para iniciantes'),
  (6, 3, 4, 'Gostei da diversidade de estilos musicais abordados'),
  (7, 3, 5, 'Recomendo a todos os amantes de música clássica'),
  (8, 3, 3, 'A infraestrutura poderia ser melhor');

INSERT INTO `review` (user_id, event_id, score, comment)
VALUES
  (3, 4, 4, 'Ótimo curso introdutório'),
  (4, 4, 5, 'Didática clara e exercícios práticos úteis'),
  (5, 4, 3, 'Algumas partes do conteúdo foram confusas'),
  (6, 4, 4, 'Bom suporte dos instrutores'),
  (7, 4, 5, 'Recomendo a todos que desejam aprender Python'),
  (8, 4, 2, 'Não atendeu às minhas expectativas');

INSERT INTO `review` (user_id, event_id, score, comment)
VALUES
  (3, 5, 3, 'Boas bandas, mas o som estava muito alto'),
  (4, 5, 4, 'Ambiente animado e público entusiasmado'),
  (5, 5, 5, 'Ingresso com bom custo-benefício'),
  (6, 5, 3, 'Duração do show foi um pouco curta'),
  (7, 5, 4, 'Gostei da seleção de músicas'),
  (8, 5, 5, 'Show imperdível para os fãs de rock');

INSERT INTO `review` (user_id, event_id, score, comment)
VALUES
  (3, 6, 4, 'Ótimas peças de teatro!'),
  (4, 6, 5, 'Elenco talentoso e encenações emocionantes'),
  (5, 6, 3, 'Algumas peças foram um pouco longas'),
  (6, 6, 4, 'Boa organização e estrutura do evento'),
  (7, 6, 5, 'Recomendo a todos os amantes de teatro'),
  (8, 6, 2, 'Expectativas não foram atendidas, falta de entusiasmo');
