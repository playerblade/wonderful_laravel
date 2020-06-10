
drop database wonderful_laravel;
create database wonderful_laravel;
-- use wonderful_laravel;

drop database payment_online;
create database payment_online;
-- use payment_online;

                  select o.id as order_id ,
                      CASE po.process_order
                         when 'initial' then 'inicial'
                         when 'process' then 'proceso'
                         when 'preparation' then 'preparacion'
                         when 'dispatched' then 'despachado'
                         when 'delivered' then 'entregado'
                      END as estado,
                      o.created_at as fechaOrden , concat_ws(' ',u.last_name,u.mother_last_name,u.first_name,u.second_name) as usuario
                  from users u inner join user_status_orders uso on u.id = uso.user_id
                        inner join status_orders so on uso.status_order_id = so.id
                        inner join process_orders po on so.process_order_id = po.id
                        inner join orders o on so.order_id = o.id
		                inner join users c on o.user_id = c.id
                  and c.id = 5
                  order by o.created_at desc;

                  select o.id as order_id
                  from orders o ;

                  ---------
                 select u.first_name , ca.comment , s.star
                 from commentary_articles ca inner join users u on ca.user_id = u.id
                      inner join raiting_articles ra on ra.user_id = u.id
                      inner join stars s on ra.star_id = s.id
                 where ca.article_id = 1
                 and ra.article_id = 1;

                 ----------

                 select sum(ca.quantity) , a.stock
                 from color_articles ca inner join articles a on ca.article_id = a.id
                 where a.id = 1;

use wonderful_laravel;
-- inserts categorias
insert into categories (category, created_at, updated_at) values ('Electronicos','2019-05-02 04:54:11', '2019-05-02 04:54:11');
insert into categories (category, created_at, updated_at) values ('Ropas','2019-05-02 04:54:11', '2019-05-02 04:54:11');
insert into categories (category, created_at, updated_at) values ('Automoviles','2019-05-02 04:54:11', '2019-05-02 04:54:11');
insert into categories (category, created_at, updated_at) values ('Limpieza','2019-05-02 04:54:11', '2019-05-02 04:54:11');
insert into categories (category, created_at, updated_at) values ('Movies','2019-05-02 04:54:11', '2019-05-02 04:54:11');

-- inserts subdepartamentos
insert into sub_categories (category_id , sub_category, created_at ,updated_at) values (1, 'Laptops',curdate(),curdate());  -- 1
insert into sub_categories (category_id , sub_category, created_at ,updated_at) values (1, 'Monitores',curdate(),curdate());
insert into sub_categories (category_id , sub_category, created_at ,updated_at) values (2, 'Poleras',curdate(),curdate());   -- 3
insert into sub_categories (category_id , sub_category, created_at ,updated_at) values (2, 'Vestidos',curdate(),curdate());  -- 4
insert into sub_categories (category_id , sub_category, created_at ,updated_at) values (3, 'Vagonetas',curdate(),curdate()); -- 5
insert into sub_categories (category_id , sub_category, created_at ,updated_at) values (3, 'Taxis',curdate(),curdate());   -- 6
insert into sub_categories (category_id , sub_category, created_at ,updated_at) values (4, 'Trapeadores',curdate(),curdate()); -- 7
insert into sub_categories (category_id , sub_category, created_at ,updated_at) values (4, 'Toallas',curdate(),curdate()); -- 8
insert into sub_categories (category_id , sub_category, created_at ,updated_at) values (5, 'Drama',curdate(),curdate()); -- 9
insert into sub_categories (category_id , sub_category, created_at ,updated_at) values (5, 'Comedia',curdate(),curdate()); -- 10 

-- inserts articles 
insert into articles (sub_category_id, maker_id, title, description, stock, created_at, updated_at)
values (1,2, 'Dell XPS 13',  'una apariencia estupenda, la cual combina un exterior metálico con un interior blanco de fibra de vidrio tejida.', 12,curdate(),curdate()),
       (1,2, 'HP 15-DA0001LA 15.6',  'la serie Mi 9 es popular por ser una de las de mayor gama', 10,curdate(),curdate()),
       (2,4, 'MacBook Air (2018)',  'Es relativamente delgada y liviana, tiene el útil sensor Touch ID y la mejor duración de batería de entre las opciones de Mac', 12,curdate(),curdate()),
       (3,1, 'CATLEYA',  'El nombre de Bucaramanga proviene de la lengua Guane, una cultura de expertos en telares.', 12,curdate(),curdate()),
       (4,5, 'Polera manga corta',  ' El traje artesanal de la señorita Antioquia está elaborado en tejidos de lanas e hilazas.', 12,curdate(),curdate()),
       (4,3, 'Vestido Para Boda',  'Polera de colores rojos con estampados para toda la familia', 12,curdate(),curdate()),
       (4,1, 'Vestido Casuale',  'Con estanpado de una cara sonriente de color amarillo', 12,curdate(),curdate()),
       (5,5, 'CHEVROLET  Montana 2019',  'Carga de la SUV Trax 2019 compacta: Casa rodante Carga de la SUV Trax 2019 compacta: Artista Carga de la SUV Trax 2019 compacta', 8,curdate(),curdate()),
       (5,3, 'PEUGEOT 108 Pequeño',  'un automóvil realizado en joint-venture entre Toyota y el grupo PSA que da como resultado este modelo así como el Toyota Aygo y el Citroen C1', 12,curdate(),curdate()),
       (6,5, 'Toyota Corolla 2019',   'Motor: 1.8L, 16 válvulas Dual-VVTi.Potencia: 138 caballos @ 6.400 rpm.Torque: 173 Nm @ 4.000 rpm.', 12,curdate(),curdate()),
       (6,4, '2019 Toyota Corolla', 'The black and red beauty features a custom wrap.', 12,curdate(),curdate()),
       (5,4, 'Volkswagen Gol Sedan',  'HYUNDAI GRAND I10 1.25 GLS MT: 1.143 UNIDADES. ...', 12,curdate(),curdate()),
       (5,4, 'Suzuki Ciaz',  'El Ciaz es un modelo con carroceria de Suzuki, quizás no tan conocido al que merece la pena echar un vistazo. Su motor es un 4 cilindros de 1373 cc que entrega hasta 94 caballos.', 12,curdate(),curdate()),
       (7,5, 'Trapeadora De Goma',  'Trapeadora de goma con mango de madera muy efectiva para limpieza', 12,curdate(),curdate()),
       (7,5, 'Trapeadora De Trapo',  'Trapeadora de Trapo con mango de madera muy efectiva para limpieza', 12,curdate(),curdate()),
       (8,1, 'Toalla Sanitaria',  'Serie de toallas para sanitario deacuerdo a su nesecidad', 12,curdate(),curdate()),
       (8,1, 'Toalla De Cosina',  'Serie de toallas para Cosina deacuerdo a su nesecidad', 12,curdate(),curdate()),
       (8,3, 'Toalla de cuarto', 'Para  sadasdwkjdkawdna y tambien asdkasdasdiwdwmadkw como sajdkasdjkasdj',12 , curdate(),curdate()),
       (9,1, 'El padrino',  'En el verano de 1945, se celebra la boda de Connie Talia Shire y Carlo Rizzi Gianni Russo. Connie es la única hija de Don Vito Corleone Marlon... ', 12,curdate(),curdate()),
       (9,1, 'Lluvia de amor',  'Seo In Ha muchacho estudiante de bellas artes dedica su amor a una sola mujer,Kim Yoon Hee, de una belleza timida y elegante. Se conocieron y se enamoraron uno del otro durante su estudios universitarios...', 12,curdate(),curdate()),
       (9,1, 'De nuevo un final feliz',  'En el verano de 1945, se celebra la boda de Connie Talia Shire y Carlo Rizzi Gianni Russo. Connie es la única hija de Don Vito Corleone Marlon... ', 12,curdate(),curdate()),
       (9,3, 'Pasarela',  'Se trata de un grupo de jovenes famosos q se dedican al modelaje y una chica quiere audicionar para ser modelo y como jurado se encuentra uno de los modelos mas populares que le humilla a la señorita...', 12,curdate(),curdate()),
       (10,5, 'La vida es bella ',  'La Segunda Guerra Mundial está a punto de estallar en Europa.', 12,curdate(),curdate()),
       (10,1, 'Sonic. La película',  'Sonic, el famoso erizo azul de la conocida saga de videojuegos vivirá su primera aventura en la pantalla grande', 12,curdate(),curdate()), 
       (10,4, 'Hasta que la boda nos separe',  'Cuando debido a un equívoco, Alexia Silvia Alonso descubra entre las cosas de su novio Carlos Álex García', 10,curdate(),curdate());



-- inserts ciudades 

insert into cities (city) values ('Pando');
insert into cities (city) values ('La Paz');
insert into cities (city) values ('Oruro');
insert into cities (city) values ('Cochabamba');
insert into cities (city) values ('Potosi');
insert into cities (city) values ('Tarija');
insert into cities (city) values ('Chuquisaca');
insert into cities (city) values ('Santa Cruz');
insert into cities (city) values ('Beni');



-- -- inserts tarifa transporte vuelo
-- insert into transport_fares (city_id, price, end_date, shiping, created_at) values (1,400, '2019-06-27 20:45:31',  1,curdate());
-- insert into transport_fares (city_id, price, end_date, shiping, created_at) values (2,100, '2019-05-10 13:01:40', 1,curdate());
-- insert into transport_fares (city_id, price, end_date, shiping, created_at) values (3,500, '2019-09-24 08:12:06',  1,curdate());
-- insert into transport_fares (city_id, price, end_date, shiping, created_at) values (4,200 , '2019-07-07 03:41:33', 1,curdate());
-- insert into transport_fares (city_id, price, end_date, shiping, created_at) values (5,100, '2019-08-17 08:45:37', 1,curdate());
-- insert into transport_fares (city_id, price, end_date, shiping, created_at) values (6,700, '2019-08-02 15:48:54', 1,curdate());
-- insert into transport_fares (city_id, price, end_date, shiping, created_at) values (7,100, '2019-06-18 19:56:07',1,curdate());
-- insert into transport_fares (city_id, price, end_date, shiping, created_at) values (8,300 , '2019-11-24 17:06:03',1,curdate());
-- insert into transport_fares (city_id, price, end_date, shiping, created_at) values (9,400 , '2019-07-06 22:20:04',1,curdate());

-- -- inserts tarifa transporte bus
-- insert into transport_fares (city_id, price, end_date, shiping, created_at) values (1,80, '2019-06-27 20:45:31',  0,curdate());
-- insert into transport_fares (city_id, price, end_date, shiping, created_at) values (2,40, '2019-05-10 13:01:40', 0,curdate());
-- insert into transport_fares (city_id, price, end_date, shiping, created_at) values (3,50, '2019-09-24 08:12:06',  0,curdate());
-- insert into transport_fares (city_id, price, end_date, shiping, created_at) values (4,60 , '2019-07-07 03:41:33', 0,curdate());
-- insert into transport_fares (city_id, price, end_date, shiping, created_at) values (5,90, '2019-08-17 08:45:37', 0,curdate());
-- insert into transport_fares (city_id, price, end_date, shiping, created_at) values (6,60, '2019-08-02 15:48:54', 0,curdate());
-- insert into transport_fares (city_id, price, end_date, shiping, created_at) values (7,20, '2019-06-18 19:56:07',0,curdate());
-- insert into transport_fares (city_id, price, end_date, shiping, created_at) values (8,70 , '2019-11-24 17:06:03',0,curdate());
-- insert into transport_fares (city_id, price, end_date, shiping, created_at) values (9,30 , '2019-07-06 22:20:04',0,curdate());

-- inserts oficiales
-- inserts tarifa transporte normal
insert into transport_fares (city_id, price, end_date, shiping, created_at) values (1,120, '2019-06-27 20:45:31',  0,curdate());
insert into transport_fares (city_id, price, end_date, shiping, created_at) values (2,50, '2019-05-10 13:01:40', 0,curdate());
insert into transport_fares (city_id, price, end_date, shiping, created_at) values (3,30, '2019-09-24 08:12:06',  0,curdate());
insert into transport_fares (city_id, price, end_date, shiping, created_at) values (4,0 , '2019-07-07 03:41:33', 0,curdate());
insert into transport_fares (city_id, price, end_date, shiping, created_at) values (5,80, '2019-08-17 08:45:37', 0,curdate());
insert into transport_fares (city_id, price, end_date, shiping, created_at) values (6,80, '2019-08-02 15:48:54', 0,curdate());
insert into transport_fares (city_id, price, end_date, shiping, created_at) values (7,50, '2019-06-18 19:56:07',0,curdate());
insert into transport_fares (city_id, price, end_date, shiping, created_at) values (8,70 , '2019-11-24 17:06:03',0,curdate());
insert into transport_fares (city_id, price, end_date, shiping, created_at) values (9,100 , '2019-07-06 22:20:04',0,curdate());

-- inserts tarifa transporte rapido
insert into transport_fares (city_id, price, end_date, shiping, created_at) values (1,240, '2019-06-27 20:45:31',  1,curdate());
insert into transport_fares (city_id, price, end_date, shiping, created_at) values (2,100, '2019-05-10 13:01:40', 1,curdate());
insert into transport_fares (city_id, price, end_date, shiping, created_at) values (3,60, '2019-09-24 08:12:06',  1,curdate());
insert into transport_fares (city_id, price, end_date, shiping, created_at) values (4,0 , '2019-07-07 03:41:33', 1,curdate());
insert into transport_fares (city_id, price, end_date, shiping, created_at) values (5,160, '2019-08-17 08:45:37', 1,curdate());
insert into transport_fares (city_id, price, end_date, shiping, created_at) values (6,160, '2019-08-02 15:48:54', 1,curdate());
insert into transport_fares (city_id, price, end_date, shiping, created_at) values (7,100, '2019-06-18 19:56:07',1,curdate());
insert into transport_fares (city_id, price, end_date, shiping, created_at) values (8,140 , '2019-11-24 17:06:03',1,curdate());
insert into transport_fares (city_id, price, end_date, shiping, created_at) values (9,200 , '2019-07-06 22:20:04',1,curdate());


-- colors 
insert into colors (id, name, image) 
values (1, 'Mauv', 'mauv.jpg'),
       (2, 'Aquamarine', 'aquamarine.jpg'),
       (3, 'Red', 'red.jpg'),
       (4, 'Silver', 'Silver.jpg'),
       (5, 'Green', 'green.png'),
       (6, 'Brown', 'brown.jpg'),
       (7, 'Crimson', 'crimson.jpg'),
       (8, 'Yellow', 'yellow.jpg'),
       (9, 'Teal', 'teal.jpg'),
       (10, 'Purple', 'urple.png'),
       (11, 'Pink', 'pink.jpg'), 
       (12, 'Orange', 'orange.png'), 
       (13, 'Blue', 'blue.png'),
       (14, 'Mauv', 'mauv.jpg'),
       (15, 'Black', 'black.jpg'), 
       (16, 'Turquoise', 'turquoise.jpg'),
       (17, 'Red', 'red.jpg'),
       (18, 'Teal', 'teal.jpg'),
       (19, 'Red', 'red.jpg'),
       (20, 'Khaki', 'khaki.jpg'),
       (21, 'Turquoise', 'turquoise.jpg'),
       (22, 'White', 'white.png'), 
       (23, 'Indigo', 'indigo.jpg'),
       (24, 'Gray', 'gray.png'), 
       (25, 'Violet', 'violet.jpg'),
       (26, 'Red', 'red.jpg'),
       (27, 'Indigo', 'indigo.png'),
       (28, 'Goldenrod', 'goldenrod.png'),
       (29, 'Khaki', 'khaki.jpg'),
       (30, 'Mauv', 'mauv.jpg');

-- inserts color articulo
insert into color_articles (article_id, color_id, quantity) values (1,3,4);
insert into color_articles (article_id, color_id, quantity) values (1,13,4);
insert into color_articles (article_id, color_id, quantity) values (1,15,4);
insert into color_articles (article_id, color_id, quantity) values (2,24,4);
insert into color_articles (article_id, color_id, quantity) values (2,15,4);
insert into color_articles (article_id, color_id, quantity) values (2,13,4);
insert into color_articles (article_id, color_id, quantity) values (3,24,4);
insert into color_articles (article_id, color_id, quantity) values (3,15,4);
insert into color_articles (article_id, color_id, quantity) values (3,13,4);
insert into color_articles (article_id, color_id, quantity) values (4,15,4);
insert into color_articles (article_id, color_id, quantity) values (4,13,4);
insert into color_articles (article_id, color_id, quantity) values (4,24,4);
insert into color_articles (article_id, color_id, quantity) values (5,15,4);
insert into color_articles (article_id, color_id, quantity) values (5,13,4);
insert into color_articles (article_id, color_id, quantity) values (5,24,4);
insert into color_articles (article_id, color_id, quantity) values (6,3,4);
insert into color_articles (article_id, color_id, quantity) values (6,8,4);
insert into color_articles (article_id, color_id, quantity) values (6,4,4);
insert into color_articles (article_id, color_id, quantity) values (6,22,4);
insert into color_articles (article_id, color_id, quantity) values (6,13,4);
insert into color_articles (article_id, color_id, quantity) values (6,15,4);
insert into color_articles (article_id, color_id, quantity) values (7,15,4);
insert into color_articles (article_id, color_id, quantity) values (7,22,4);
insert into color_articles (article_id, color_id, quantity) values (7,6,4);
insert into color_articles (article_id, color_id, quantity) values (7,13,4);
insert into color_articles (article_id, color_id, quantity) values (8,8,4);
insert into color_articles (article_id, color_id, quantity) values (8,11,4);
insert into color_articles (article_id, color_id, quantity) values (8,3,4);
insert into color_articles (article_id, color_id, quantity) values (8,10,4);
insert into color_articles (article_id, color_id, quantity) values (8,13,4);
insert into color_articles (article_id, color_id, quantity) values (8,15,4);
insert into color_articles (article_id, color_id, quantity) values (9,22,4);
insert into color_articles (article_id, color_id, quantity) values (9,12,4);
insert into color_articles (article_id, color_id, quantity) values (9,3,4);
insert into color_articles (article_id, color_id, quantity) values (9,24,4);
insert into color_articles (article_id, color_id, quantity) values (9,13,4);
insert into color_articles (article_id, color_id, quantity) values (9,15,4);
insert into color_articles (article_id, color_id, quantity) values (10,15,4);
insert into color_articles (article_id, color_id, quantity) values (10,22,4);
insert into color_articles (article_id, color_id, quantity) values (10,13,4);
insert into color_articles (article_id, color_id, quantity) values (10,4,4);
insert into color_articles (article_id, color_id, quantity) values (11,15,4);
insert into color_articles (article_id, color_id, quantity) values (11,22,4);
insert into color_articles (article_id, color_id, quantity) values (11,13,4);
insert into color_articles (article_id, color_id, quantity) values (11,4,4);
insert into color_articles (article_id, color_id, quantity) values (12,15,4);
insert into color_articles (article_id, color_id, quantity) values (12,22,4);
insert into color_articles (article_id, color_id, quantity) values (12,4,4);
insert into color_articles (article_id, color_id, quantity) values (12,8,4);
insert into color_articles (article_id, color_id, quantity) values (13,15,4);
insert into color_articles (article_id, color_id, quantity) values (13,22,4);
insert into color_articles (article_id, color_id, quantity) values (13,4,4);
insert into color_articles (article_id, color_id, quantity) values (13,8,4);
insert into color_articles (article_id, color_id, quantity) values (14,5,4);
insert into color_articles (article_id, color_id, quantity) values (14,12,4);
insert into color_articles (article_id, color_id, quantity) values (14,8,4);
insert into color_articles (article_id, color_id, quantity) values (14,3,4);
insert into color_articles (article_id, color_id, quantity) values (15,5,4);
insert into color_articles (article_id, color_id, quantity) values (15,12,4);
insert into color_articles (article_id, color_id, quantity) values (15,8,4);
insert into color_articles (article_id, color_id, quantity) values (15,3,4);
insert into color_articles (article_id, color_id, quantity) values (16,5,4);
insert into color_articles (article_id, color_id, quantity) values (16,13,4);
insert into color_articles (article_id, color_id, quantity) values (16,8,4);
insert into color_articles (article_id, color_id, quantity) values (16,3,4);
insert into color_articles (article_id, color_id, quantity) values (17,13,4);
insert into color_articles (article_id, color_id, quantity) values (17,5,4);
insert into color_articles (article_id, color_id, quantity) values (17,4,4);
insert into color_articles (article_id, color_id, quantity) values (17,11,4);
insert into color_articles (article_id, color_id, quantity) values (17,8,4);
insert into color_articles (article_id, color_id, quantity) values (17,22,4);
insert into color_articles (article_id, color_id, quantity) values (18,5,4);
insert into color_articles (article_id, color_id, quantity) values (18,4,4);
insert into color_articles (article_id, color_id, quantity) values (18,11,4);
insert into color_articles (article_id, color_id, quantity) values (18,8,4);
insert into color_articles (article_id, color_id, quantity) values (18,22,4);

insert into color_articles (article_id, color_id, quantity) values (19,22,4);
insert into color_articles (article_id, color_id, quantity) values (19,4,4);
insert into color_articles (article_id, color_id, quantity) values (19,8,4);
insert into color_articles (article_id, color_id, quantity) values (20,5,4);
insert into color_articles (article_id, color_id, quantity) values (20,12,4);
insert into color_articles (article_id, color_id, quantity) values (20,8,4);
insert into color_articles (article_id, color_id, quantity) values (21,3,4);
insert into color_articles (article_id, color_id, quantity) values (21,5,4);
insert into color_articles (article_id, color_id, quantity) values (22,12,4);
insert into color_articles (article_id, color_id, quantity) values (22,8,4);
insert into color_articles (article_id, color_id, quantity) values (23,3,4);
insert into color_articles (article_id, color_id, quantity) values (23,5,4);
insert into color_articles (article_id, color_id, quantity) values (24,13,4);
insert into color_articles (article_id, color_id, quantity) values (24,8,4);
insert into color_articles (article_id, color_id, quantity) values (25,3,4);
insert into color_articles (article_id, color_id, quantity) values (25,13,4);
insert into color_articles (article_id, color_id, quantity) values (25,5,4);



-- inserts procesoOrden
insert into process_orders (process_order) values ( 'initial');
insert into process_orders (process_order) values ( 'process');
insert into process_orders (process_order) values ( 'preparation');
insert into process_orders (process_order) values ( 'dispatched');
insert into process_orders (process_order) values ( 'delivered');



-- inserts articulo
insert into image_articles (article_id, url_image, is_main,created_at,updated_at) 
values (1, '1a.jpg', 1,curdate(),curdate()),
       (2, '2a.jpg', 1,curdate(),curdate()),
       (3, '3a.jpg', 1,curdate(),curdate()),
       (4, '4a.jpg', 1,curdate(),curdate()),
       (5, '5.jpg', 1,curdate(),curdate()),
       (6, '6.jpg', 1,curdate(),curdate()),
       (7, '7.jpg', 1,curdate(),curdate()),
       (8, '8.jpg', 1,curdate(),curdate()),
       (9, '9.jpg', 1,curdate(),curdate()),
       (10, '10.jpg', 1,curdate(),curdate()),
       (11, '11.jpg', 1,curdate(),curdate()),
       (12, '12.jpg', 1,curdate(),curdate()),
       (13, '13.jpg', 1,curdate(),curdate()),
       (14, '14.jpg', 1,curdate(),curdate()),
       (15, '15.jpg', 1,curdate(),curdate()),
       (16, '16.jpg', 1,curdate(),curdate()),
       (17, '17.jpg', 1,curdate(),curdate()),
       (18, '18.jpg', 1,curdate(),curdate()),
       (19, '19.jpg', 1,curdate(),curdate()),
       (20, '20.jpg', 1,curdate(),curdate()),
       (21, '21.jpg', 1,curdate(),curdate()),
       (22, '22.jpg', 1,curdate(),curdate()),
       (23, '23.jpg', 1,curdate(),curdate()),
       (24, '24.jpg', 1,curdate(),curdate()),
       (25, '25.jpg', 1,curdate(),curdate());


-- inserts articulo
insert into image_articles (article_id, url_image, is_main,created_at,updated_at) 
-- id 1 
values (1, '1b.jpg', 0,curdate(),curdate()),
       (1, '1c.jpg', 0,curdate(),curdate()),
       (1, '1d.jpg', 0,curdate(),curdate()),
       (1, '1e.jpg', 0,curdate(),curdate()),
       (1, '1f.jpg', 0,curdate(),curdate()),
       (1, '1g.jpg', 0,curdate(),curdate()),
       (1, '1h.jpg', 0,curdate(),curdate()),
      --  id 2 
       (2, '2b.jpg', 0,curdate(),curdate()),
       (2, '2c.jpg', 0,curdate(),curdate()),
       (2, '2d.jpg', 0,curdate(),curdate()),
       (2, '2e.jpg', 0,curdate(),curdate()),
      --  id 3
       (3, '3b.jpg', 0,curdate(),curdate()),
       (3, '3c.jpg', 0,curdate(),curdate()),
       (3, '3d.jpg', 0,curdate(),curdate()),
       (3, '3e.jpg', 0,curdate(),curdate()),
      --  id 4
       (4, '4b.jpg', 0,curdate(),curdate()),
       (4, '4c.jpg', 0,curdate(),curdate()),
       (4, '4d.jpg', 0,curdate(),curdate()),
       (4, '4e.jpg', 0,curdate(),curdate()),

       (12, '12_segundario.jpg', 0,curdate(),curdate()),
       (13, '13_segundario.jpg', 0,curdate(),curdate()),
       (13, '13_segundario1.jpg', 0,curdate(),curdate());

-- insert into precioArticulo (idPrecioArticulo,idArticulo ,precio,esActual,fechaInicio,fechaFin );

insert into price_articles ( article_id, price, is_current, created_at) values ( 3, 650,  1,  curdate());
insert into price_articles ( article_id, price, is_current, created_at) values ( 1, 600,  1,  curdate());
insert into price_articles ( article_id, price, is_current, created_at) values ( 2, 700,  1,  curdate());
insert into price_articles ( article_id, price, is_current, created_at) values ( 4, 200,  1,  curdate());
insert into price_articles ( article_id, price, is_current, created_at) values ( 5, 180,  1,  curdate());
insert into price_articles ( article_id, price, is_current, created_at) values ( 6, 25,   1,  curdate());
insert into price_articles ( article_id, price, is_current, created_at) values ( 7, 50,   1,  curdate());
insert into price_articles ( article_id, price, is_current, created_at) values ( 8, 120,  1,  curdate());
insert into price_articles ( article_id, price, is_current, created_at) values ( 9, 80,   1,  curdate());
insert into price_articles ( article_id, price, is_current, created_at) values ( 10, 3000,1,  curdate());
insert into price_articles ( article_id, price, is_current, created_at) values ( 11, 3400,1,  curdate());
insert into price_articles ( article_id, price, is_current, created_at) values ( 12, 2000,1,  curdate());
insert into price_articles ( article_id, price, is_current, created_at) values ( 13, 2300,1,  curdate());
insert into price_articles ( article_id, price, is_current, created_at) values ( 14, 10,  1,  curdate());
insert into price_articles ( article_id, price, is_current, created_at) values ( 15, 13,  1,  curdate());
insert into price_articles ( article_id, price, is_current, created_at) values ( 16, 20,  1,  curdate());
insert into price_articles ( article_id, price, is_current, created_at) values ( 17, 40,  1,  curdate());
insert into price_articles ( article_id, price, is_current, created_at) values ( 18, 65,  1,  curdate());
insert into price_articles ( article_id, price, is_current, created_at) values ( 19, 5,   1,  curdate());
insert into price_articles ( article_id, price, is_current, created_at) values ( 20, 5,   1,  curdate());
insert into price_articles ( article_id, price, is_current, created_at) values ( 21, 5,   1,  curdate());
insert into price_articles ( article_id, price, is_current, created_at) values ( 22, 5,   1,  curdate());
insert into price_articles ( article_id, price, is_current, created_at) values ( 23, 5,   1,  curdate());
insert into price_articles ( article_id, price, is_current, created_at) values ( 24, 5,   1,  curdate());
insert into price_articles ( article_id, price, is_current, created_at) values ( 25, 5,   1,  curdate());

-- precios secundarios

insert into price_articles ( article_id, price, is_current, created_at) values ( 1, 50,  0,   curdate());
insert into price_articles ( article_id, price, is_current, created_at) values ( 2, 20,  0,   curdate());
insert into price_articles ( article_id, price, is_current, created_at) values ( 3, 710,  0,  curdate());
insert into price_articles ( article_id, price, is_current, created_at) values ( 4, 120,  0,  curdate());
insert into price_articles ( article_id, price, is_current, created_at) values ( 5, 80,  0,   curdate());
insert into price_articles ( article_id, price, is_current, created_at) values ( 6, 225,   0, curdate());
insert into price_articles ( article_id, price, is_current, created_at) values ( 7, 450,   0, curdate());
insert into price_articles ( article_id, price, is_current, created_at) values ( 8, 20,  0,   curdate());
insert into price_articles ( article_id, price, is_current, created_at) values ( 9, 480,   0, curdate());
insert into price_articles ( article_id, price, is_current, created_at) values ( 10, 7040,0,  curdate());
insert into price_articles ( article_id, price, is_current, created_at) values ( 11, 1900,0,  curdate());
insert into price_articles ( article_id, price, is_current, created_at) values ( 12, 2100,0,  curdate());
insert into price_articles ( article_id, price, is_current, created_at) values ( 13, 9000,0,  curdate());
insert into price_articles ( article_id, price, is_current, created_at) values ( 14, 101,  0, curdate());
insert into price_articles ( article_id, price, is_current, created_at) values ( 15, 213,  0, curdate());
insert into price_articles ( article_id, price, is_current, created_at) values ( 16, 230,  0, curdate());
insert into price_articles ( article_id, price, is_current, created_at) values ( 17, 640,  0, curdate());
insert into price_articles ( article_id, price, is_current, created_at) values ( 18, 150,  0, curdate());
insert into price_articles ( article_id, pricecd , is_current, created_at) values ( 19, 234,  0, curdate());
insert into price_articles ( article_id, price, is_current, created_at) values ( 20, 546,  0, curdate());
insert into price_articles ( article_id, price, is_current, created_at) values ( 21, 787,  0, curdate());
insert into price_articles ( article_id, price, is_current, created_at) values ( 22, 34,  0,  curdate());
insert into price_articles ( article_id, price, is_current, created_at) values ( 23, 789 ,  0, curdate());
insert into price_articles ( article_id, price, is_current, created_at) values ( 24, 21,   0, curdate());
insert into price_articles ( article_id, price, is_current, created_at) values ( 25, 189,  0, curdate());

-- starts articles

insert into stars(star,created_at, updated_at) 
values ('1 estrella',curdate(),curdate()),
       ('2 estrella',curdate(),curdate()),
       ('3 estrella',curdate(),curdate()),
       ('4 estrella',curdate(),curdate()),
       ('5 estrella',curdate(),curdate());

use payment_online;
-- -------------------------------------------------------------------------------------------------------
-- Inserts para la base de datos payment_online

insert into bank_users ( first_name, last_name, phone_number, email, created_at) 
values ( 'Josh', 'Perez', 76757121,'jhosh@gmail.com' ,curdate()),
       ( 'Drake', 'Gomez', 78765290,'drake@gmail.com' ,curdate());


insert into bank_accounts ( account_number, bank_user_id, amount, active, created_at) values ( 10001, 1, 10000, 1, curdate());
insert into bank_accounts ( account_number, bank_user_id, amount, active, created_at) values ( 10002, 2, 1000, 1, curdate());
-- insert into bank_accounts ( account_number, bank_user_id, amount, active, created_at) values ( 10003, 1000, 1, 1, curdate());


insert into transaction_types ( type, description, created_at) values ( "tarjeta", "Pago online atraves de tarjetas",curdate());


insert into transactions ( bank_accounts_id, transaction_type_id, mount_transaction, created_at) values ( 1, 1, 25, 
