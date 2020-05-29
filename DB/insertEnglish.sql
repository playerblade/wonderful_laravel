INSERT  INTO roles(role) VALUES('administrador');
INSERT  INTO roles(role) VALUES('colaborador');
INSERT  INTO roles(role) VALUES('usuario');
INSERT  INTO roles(role) VALUES('verificador');
-- inserts users

select  cantidad.article ,cantidad.raiting * 100/ sum(cantidad.cantidadCliente) as porcentaje
from (select a.title as article ,ra.raiting as raiting ,count(ra.client_id)  cantidadCliente
      from raiting_articles ra inner join clients c on ra.client_id = c.id
           inner join commentary_articles ca on c.id = ca.client_id
           inner join articles a on ra.article_id = a.id
           and a.id = 6
           group by ra.raiting , article
           order by ra.raiting desc) as cantidad;

select  cantidad.article , (100 * cantidad.raiting) / sum(cantidad.cantidadCliente) as porcentaje
from (select a.title as article , ra.raiting as raiting , count(ra.client_id) cantidadCliente
      from raiting_articles ra inner join clients c on ra.client_id = c.id
           inner join commentary_articles ca on c.id = ca.client_id
           inner join articles a on ra.article_id = a.id
           and a.id = 1
           group by article,raiting 
           order by ra.raiting desc) as cantidad
group by cantidad.article ;

select  cantidad.article , 100 * cantidad.raiting / sum(cantidad.cantidadCliente)  as porcentaje
from (select a.title as article ,ra.raiting as raiting, count(ra.client_id) cantidadCliente
      from raiting_articles ra inner join clients c on ra.client_id = c.id
           inner join articles a on ra.article_id = a.id
           and a.id = 1
           group by raiting 
           order by ra.raiting desc) as cantidad
group by cantidad.article;


-- CONSULTAS PARA REGISTRAR ARTICULOS
select a.title , a.marker , a.stock , sb.sub_category , c.category
from  articles a inner join sub_categories sb on a.sub_category_id  = sb.id 
      inner join categories c on sb.category_id  = c.id;


select a.id as id , a.title as article , a.marker as marker , a.stock  as stock,
      sb.sub_category as sub_category , c.category as category , a.description as description
from  articles a inner join sub_categories sb on a.sub_category_id  = sb.id 
inner join categories c on sb.category_id  = c.id
where a.id = 25;
-------------------------------------------------------------------------------
color Articles
select sb.id ,  a.id as id , a.title as article , a.marker as marker , a.stock  as stock,
                        sb.sub_category as sub_category , c.category as category , a.description as description,
                        co.image as image
                 from  articles a inner join sub_categories sb on a.sub_category_id  = sb.id 
                       inner join categories c on sb.category_id  = c.id
                       inner join color_articles ca on a.id = ca.article_id
                       inner join colors co on ca.color_id = co.id;




select sb.sub_category , c.category
from  sub_categories sb inner join categories c on sb.category_id = c.id
where sb.id = 10;

-----------------------------------------------------------------------------------
select a.title as articulo , a.marker as fabricante, ia.url_image as image,
       pa.price as price , a.description as description , a.id as id , u.id as user_id
from articles a inner join image_articles ia on a.id = ia.article_id
      inner join price_articles pa on a.id = pa.article_id 
      inner join order_details od on  a.id = od.article_id
      inner join orders o on od.order_id = o.id
      inner join users u on o.user_id = u.id
      and pa.is_current = 1
      and ia.is_main = 1
      and a.id = 1
order by articulo desc

-- order Detail
select a.id as article_id, o.id as order_id ,
       a.title as articulo , pa.price as precio , od.quantity as cantidad ,
       od.sub_total as subTotal
from users u inner join orders o on u.id = o.user_id
      inner join order_details od on o.id = od.order_id
      inner join articles a on od.article_id = a.id
      inner join price_articles pa on a.id = pa.article_id
-- and o.id = $order_id
and o.id = 14
and pa.is_current = 1
group by u.id, od.id, a.title, pa.price;
--________________________________________________________________________________________________________________________________________________________________________________-
-- DE AQUI EMPIEZA

drop database wonderful_laravel;
create database wonderful_laravel;
use wonderful_laravel;

insert into users (ci, first_name, second_name, last_name, mother_last_name, gender, email, password,  active, created_at, updated_at)
values ('33-368-6785', 'Andie', 'Leese', 'Dikes', 'Allain', 'F', 'Andie@gmail.com','$2y$10$9QHOVN4yPR6MO1R8VUQGIOBGS7y6nQtm2db4Qs1X3Chj/OmYXA4Xe', 1,'2019-12-04 12:12:31','2019-10-05 06:42:59'),
       ('47-681-3604', 'Wilow', 'Yovonnda', 'Gennrich', 'Wards', 'F', 'Wilow@live.com','$2y$10$9QHOVN4yPR6MO1R8VUQGIOBGS7y6nQtm2db4Qs1X3Chj/OmYXA4Xe', 1,'2019-08-10 12:12:31','2019-10-05 06:42:59'),
       ('39-957-7020', 'Izabel', 'Wandie', 'Weld', 'Carnall', 'F', 'Izabel@gmail.com','$2y$10$9QHOVN4yPR6MO1R8VUQGIOBGS7y6nQtm2db4Qs1X3Chj/OmYXA4Xe', 0,'2018-12-04 12:12:31','2019-10-05 06:42:59'),
       ('96-315-0857', 'Thorstein', 'Derby', 'Carlson', 'MacKall', 'M', 'Thorstein@gmail.com','$2y$10$9QHOVN4yPR6MO1R8VUQGIOBGS7y6nQtm2db4Qs1X3Chj/OmYXA4Xe', 0,'2019-12-04 12:12:31','2019-10-05 06:42:59'),
       ('44-625-1894', 'Creighton', 'Dar', 'Fibbit', 'Clancy', 'M', 'Creighton@gmail.com','$2y$10$9QHOVN4yPR6MO1R8VUQGIOBGS7y6nQtm2db4Qs1X3Chj/OmYXA4Xe', 0,'2019-12-04 12:12:31','2019-10-05 06:42:59'),
       ('06-145-9400', 'Pryce', 'Collin', 'Harmond', 'Mignot', 'M', 'Pryce@gmail.com','$2y$10$9QHOVN4yPR6MO1R8VUQGIOBGS7y6nQtm2db4Qs1X3Chj/OmYXA4Xe', 1,'2019-12-04 12:12:31','2019-10-05 06:42:59'),
       ('31-464-0435', 'Margie', 'Starlin', 'Learned', 'Jeanet', 'F', 'Margie@gmail.com','$2y$10$9QHOVN4yPR6MO1R8VUQGIOBGS7y6nQtm2db4Qs1X3Chj/OmYXA4Xe', 0,'2019-12-04 12:12:31','2019-10-05 06:42:59'),
       ('48-817-3320', 'Urbanus', 'Lion', 'Chesshyre', 'Querree', 'M', 'Urbanus@gmail.com','$2y$10$9QHOVN4yPR6MO1R8VUQGIOBGS7y6nQtm2db4Qs1X3Chj/OmYXA4Xe', 0,'2019-12-04 12:12:31','2019-10-05 06:42:59'),
       ('52-054-8914', 'Tiffi', 'Diena', 'Colloff', 'Dilliston', 'F', 'Tiffi@arizona.edu','$2y$10$9QHOVN4yPR6MO1R8VUQGIOBGS7y6nQtm2db4Qs1X3Chj/OmYXA4Xe', 1,'2019-12-04 12:12:31','2019-10-05 06:42:59'),
       ('50-538-7226', 'Carmelle', 'Gaylene', 'Blance', 'Petranek', 'F', 'Carmelle@fotki.com','$2y$10$9QHOVN4yPR6MO1R8VUQGIOBGS7y6nQtm2db4Qs1X3Chj/OmYXA4Xe', 0,'2019-12-04 12:12:31','2019-10-05 06:42:59'),
       ('35-085-2151', 'Myron', 'Harmon', 'Gartery', 'Skeene', 'M', 'Myron@gmail.com','$2y$10$9QHOVN4yPR6MO1R8VUQGIOBGS7y6nQtm2db4Qs1X3Chj/OmYXA4Xe', 0,'2019-12-04 12:12:31','2019-10-05 06:42:59'),
       ('15-666-8039', 'Ruthi', 'Korie', 'Belbin', 'McCloy', 'F', 'Ruthi@unblog.fr','$2y$10$9QHOVN4yPR6MO1R8VUQGIOBGS7y6nQtm2db4Qs1X3Chj/OmYXA4Xe', 1,'2019-12-04 12:12:31','2019-10-05 06:42:59'),
       ('98-943-0432', 'Amelia', 'Myrtia', 'Blaes', 'Ascrofte', 'F', 'Amelia@amazon.co.uk','$2y$10$9QHOVN4yPR6MO1R8VUQGIOBGS7y6nQtm2db4Qs1X3Chj/OmYXA4Xe', 1,'2019-12-04 12:12:31','2019-10-05 06:42:59'),
       ('43-851-3197', 'Mario', 'Kermy', 'Fleote', 'Caig', 'M', 'Mario@marketwatch.com','$2y$10$9QHOVN4yPR6MO1R8VUQGIOBGS7y6nQtm2db4Qs1X3Chj/OmYXA4Xe', 0,'2019-12-04 12:12:31','2019-10-05 06:42:59'),
       ('50-725-3803', 'York', 'Mathias', 'Batt', 'Barrows', 'M', 'York@w3.org','$2y$10$9QHOVN4yPR6MO1R8VUQGIOBGS7y6nQtm2db4Qs1X3Chj/OmYXA4Xe', 1,'2019-12-04 12:12:31','2019-10-05 06:42:59'),
       ('95-931-4986', 'Celine', 'Gabi', 'Revans', 'Phelp', 'F', 'Celine@slideshare.net','$2y$10$9QHOVN4yPR6MO1R8VUQGIOBGS7y6nQtm2db4Qs1X3Chj/OmYXA4Xe', 1,'2019-12-04 12:12:31','2019-10-05 06:42:59'),
       ('77-801-8131', 'Alain', 'Elliot', 'Champion', 'Uzzell', 'M', 'Alain@themeforest.net','$2y$10$9QHOVN4yPR6MO1R8VUQGIOBGS7y6nQtm2db4Qs1X3Chj/OmYXA4Xe', 0,'2019-12-04 12:12:31','2019-10-05 06:42:59'),
       ('31-438-6647', 'Wilhelm', 'Lothaire', 'Wainman', 'Rotham', 'M', 'Wilhelm@microsoft.com','$2y$10$9QHOVN4yPR6MO1R8VUQGIOBGS7y6nQtm2db4Qs1X3Chj/OmYXA4Xe', 0,'2019-12-04 12:12:31','2019-10-05 06:42:59'),
       ('18-823-8647', 'Daron', 'Layton', 'Tomlett', 'McCrorie', 'M', 'Daron@gmail.com','$2y$10$9QHOVN4yPR6MO1R8VUQGIOBGS7y6nQtm2db4Qs1X3Chj/OmYXA4Xe', 0,'2019-12-04 12:12:31','2019-10-05 06:42:59');


insert into role_user (role_id, user_id, created_at, updated_at)
values (2,5,'2019-05-12 04:20:42','2019-05-12 04:20:42'),
       (2,6,'2019-05-12 04:20:42','2019-05-12 04:20:42'),
       (2,7,'2019-05-12 04:20:42','2019-05-12 04:20:42'),
       (2,8,'2019-05-12 04:20:42','2019-05-12 04:20:42'),
       (2,9,'2019-05-12 04:20:42','2019-05-12 04:20:42'),
       (3,10,'2019-05-12 04:20:42','2019-05-12 04:20:42'),
       (3,11,'2019-05-12 04:20:42','2019-05-12 04:20:42'),
       (3,12,'2019-05-12 04:20:42','2019-05-12 04:20:42'),
       (3,13,'2019-05-12 04:20:42','2019-05-12 04:20:42'),
       (3,14,'2019-05-12 04:20:42','2019-05-12 04:20:42'),
       (4,15,'2019-05-12 04:20:42','2019-05-12 04:20:42'),
       (4,16,'2019-05-12 04:20:42','2019-05-12 04:20:42'),
       (4,17,'2019-05-12 04:20:42','2019-05-12 04:20:42'),
       (4,18,'2019-05-12 04:20:42','2019-05-12 04:20:42'),
       (4,19,'2019-05-12 04:20:42','2019-05-12 04:20:42'),
       (2,20,'2019-05-12 04:20:42','2019-05-12 04:20:42'),
       (3,21,'2019-05-12 04:20:42','2019-05-12 04:20:42'),
       (4,22,'2019-05-12 04:20:42','2019-05-12 04:20:42'),
       (2,23,'2019-05-12 04:20:42','2019-05-12 04:20:42');



insert into clients (id, ci, first_name, second_name, last_name, mother_last_name, gender,phone_number, birthday, user, password, active,created_at,updated_at)
values (1, '20-704-7069', 'Anjela', 'Janka', 'Curtayne', 'Tylor', 'F','72735687', '2019-12-04 12:12:31', 'Anjela@gmail.com', '12345678', 0,'2020-01-25 12:31:29', '2020-01-25 12:31:29'),
       (2, '40-738-4270', 'Chariot', 'Kellen', 'Swinfon', 'Frise', 'M','67129021', '2019-11-16 22:24:21', 'Chariot@gmail.com', '12345678', 0,'2020-01-25 12:31:29', '2020-01-25 12:31:29'),
       (3, '57-283-0472', 'Glen', 'Cris', 'Maxstead', 'Savage', 'M','67129021', '2019-12-08 12:28:08', 'Glen@gmail.com', '12345678', 0,'2020-01-25 12:31:29', '2020-01-25 12:31:29'),
       (4, '42-602-7310', 'Rand', 'Tarrance', 'Sambells', 'Dovermann', 'M','67129021', '2019-07-13 00:36:37', 'Rand@gmail.com', '12345678', 0,'2020-01-25 12:31:29', '2020-01-25 12:31:29'),
       (5, '55-937-2042', 'Phelia', 'Georgia', 'Tomblett', 'Vieyra', 'F','72735687', '2019-04-13 07:50:08', 'Phelia@gmail.com', '12345678', 1,'2020-01-25 12:31:29', '2020-01-25 12:31:29'),
       (6, '80-347-4314', 'Oralee', 'Lynnett', 'Nerne', 'Neaverson', 'F','72735687', '2019-07-30 23:45:26', 'Oralee@gmail.com', '12345678', 0,'2020-01-25 12:31:29', '2020-01-25 12:31:29'),
       (7, '72-031-3814', 'Brandy', 'Norman', 'Milborn', 'Callery', 'M','67129021', '2020-01-21 09:35:48', 'Brandy@gmail.com', '12345678', 1,'2020-01-25 12:31:29', '2020-01-25 12:31:29'),
       (8, '31-079-6554', 'Gerladina', 'Quintina', 'Fri', 'Sclater', 'F','72735687', '2019-08-18 01:41:48', 'Gerladina@gmail.com', '12345678', 1,'2020-01-25 12:31:29', '2020-01-25 12:31:29'),
       (9, '11-861-3100', 'Tonya', 'Saba', 'Potts', 'Woodman', 'F','72735687', '2019-11-11 04:32:04', 'Tonya@gmail.com', '12345678', 1,'2020-01-25 12:31:29', '2020-01-25 12:31:29'),
       (10, '28-721-4619', 'Brittne', 'Ryann', 'Skrines', 'Noell', 'F','72735687', '2019-10-05 06:42:59', 'Brittne@gmail.com', '12345678', 1,'2020-01-25 12:31:29', '2020-01-25 12:31:29'),
       (11, '69-329-3724', 'Ferdinanda', 'Talyah', 'Buckmaster', 'Barok', 'F','72735687', '2019-07-12 16:28:26', 'Ferdinanda@gmail.com', '12345678', 0,'2020-01-25 12:31:29', '2020-01-25 12:31:29'),
       (12, '22-164-6987', 'Rabi', 'Del', 'Heindle', 'Feldbaum', 'M','67129021', '2019-05-12 00:34:12', 'Rabi@gmail.com', '12345678', 0,'2020-01-25 12:31:29', '2020-01-25 12:31:29'),
       (13, '01-187-2332', 'Ali', 'Gaspard', 'Marzele', 'Danieli', 'M','67129021', '2020-01-11 23:40:36', 'Ali@gmail.com', '12345678', 0,'2020-01-25 12:31:29', '2020-01-25 12:31:29'),
       (14, '88-736-5427', 'Lelia', 'Polly', 'Rawson', 'Lancley', 'F','72735687', '2019-05-12 04:20:42', 'Lelia@gmail.com', '12345678', 1,'2020-01-25 12:31:29', '2020-01-25 12:31:29'),
       (15, '08-782-6855', 'Tammara', 'Martica', 'Orrell', 'Lardeux', 'F','72735687', '2019-10-07 10:00:11', 'Tammara@gmail.com', '12345678', 1,'2020-01-25 12:31:29', '2020-01-25 12:31:29'),
       (16, '51-388-6361', 'Ame', 'Amandi', 'Redwin', 'Gioan', 'F','72735687', '2019-06-29 05:05:03', 'Ame@gmail.com', '12345678', 1,'2020-01-25 12:31:29', '2020-01-25 12:31:29'),
       (17, '25-350-9138', 'Tadeo', 'Hadleigh', 'Tuckley', 'Ornells', 'M','67129021', '2019-03-25 00:29:20', 'Tadeo@gmail.com', '12345678', 1,'2020-01-25 12:31:29', '2020-01-25 12:31:29'),
       (18, '15-456-3124', 'Jobina', 'Madeline', 'Cuerdall', 'Mould', 'F','72735687', '2020-01-05 03:48:41', 'Jobina@gmail.com', '12345678', 1,'2020-01-25 12:31:29', '2020-01-25 12:31:29'),
       (19, '86-898-8391', 'Hussein', 'Milty', 'Thoms', 'Bottomley', 'M','67129021', '2019-07-22 22:07:55', 'Hussein@gmail.com', '12345678', 0,'2020-01-25 12:31:29', '2020-01-25 12:31:29'),
       (20, '92-522-9876', 'Jervis', 'Costa', 'Killiam', 'Abdon', 'M','67129021', '2019-04-09 20:37:07', 'Jervis@gmail.com', '12345678', 1,'2020-01-25 12:31:29', '2020-01-25 12:31:29'),
       (21, '18-905-3970', 'Berty', 'Chanda', 'Schroeder', 'Mews', 'F','72735687', '2020-01-30 07:43:37', 'Berty@gmail.com', '12345678', 1,'2020-01-25 12:31:29', '2020-01-25 12:31:29'),
       (22, '94-515-6751', 'Brandy', 'Marketa', 'Edler', 'Vinecombe', 'F','72735687', '2020-01-25 12:31:29', 'Brandy@gmail.com', '12345678', 1,'2020-01-25 12:31:29', '2020-01-25 12:31:29'),
       (23, '92-661-5542', 'Drew', 'Judas', 'Emtage', 'Rudinger', 'M','67129021', '2020-01-06 01:17:05', 'Drew@gmail.com', '12345678', 0,'2020-01-25 12:31:29', '2020-01-25 12:31:29'),
       (24, '25-941-7086', 'Lorne', 'Pinchas', 'Dickons', 'Moles', 'M','67129021', '2019-05-02 04:54:11', 'Lorne@gmail.com', '12345678', 0,'2020-01-25 12:31:29', '2020-01-25 12:31:29'),
       (25, '90-575-8845', 'Chan', 'Bruce', 'Leigh', 'McMurtyr', 'M','67129021', '2020-02-13 20:10:57', 'Chan@gmail.com', '12345678', 0,'2020-01-25 12:31:29', '2020-01-25 12:31:29'),
       (26, '49-093-5685', 'Eva', 'Georgia', 'Bonavia', 'Haysey', 'F','72735687', '2019-12-04 08:50:33', 'Eva@gmail.com', '12345678', 0,'2020-01-25 12:31:29', '2020-01-25 12:31:29'),
       (27, '57-721-3406', 'Flem', 'Ermanno', 'Chafer', 'Shippam', 'M','67129021', '2019-10-04 07:39:40', 'Flem@gmail.com', '12345678', 1,'2020-01-25 12:31:29', '2020-01-25 12:31:29'),
       (28, '99-612-1293', 'Dael', 'Winny', 'Castel', 'Ungerechts', 'M','67129021', '2019-08-06 04:45:19', 'Dael@gmail.com', '12345678', 0,'2020-01-25 12:31:29', '2020-01-25 12:31:29'),
       (29, '48-650-8592', 'Wanda', 'Blakeley', 'Herculson', 'Howels', 'F','72735687', '2019-08-12 08:09:43', 'Wanda@gmail.com', '12345678', 1,'2020-01-25 12:31:29', '2020-01-25 12:31:29'),
       (30, '96-774-2348', 'Myrtie', 'Norina', 'Strelitzki', 'Lettuce', 'F','72735687', '2019-07-24 16:56:58', 'Myrtie@gmail.com', '12345678', 1,'2020-01-25 12:31:29', '2020-01-25 12:31:29');


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
       (1,4, 'HP 15-DA0001LA 15.6',  'la serie Mi 9 es popular por ser una de las de mayor gama', 12,curdate(),curdate()),
       (1,2, 'MacBook Air (2018)',  'Es relativamente delgada y liviana, tiene el útil sensor Touch ID y la mejor duración de batería de entre las opciones de Mac', 10,curdate(),curdate()),
       (2,5, 'CATLEYA',  ' El traje artesanal de la señorita Antioquia está elaborado en tejidos de lanas e hilazas.', 12,curdate(),curdate()),
       (2,1, 'LA GUANENTINA',  'El nombre de Bucaramanga proviene de la lengua Guane, una cultura de expertos en telares.', 12,curdate(),curdate()),
       (3,3, 'La ROJA',  'Polera de colores rojos con estampados para toda la familia', 12,curdate(),curdate()),
       (3,1, 'SONRIE',  'Con estanpado de una cara sonriente de color amarillo', 12,curdate(),curdate()),
       (4,5, 'CHEVROLET  Montana 2019',  'Carga de la SUV Trax 2019 compacta: Casa rodante Carga de la SUV Trax 2019 compacta: Artista Carga de la SUV Trax 2019 compacta', 8,curdate(),curdate()),
       (4,3, 'PEUGEOT 108 Pequeño',  'un automóvil realizado en joint-venture entre Toyota y el grupo PSA que da como resultado este modelo así como el Toyota Aygo y el Citroen C1', 12,curdate(),curdate()),
       (5,5, 'Toyota Corolla 2019',   'Motor: 1.8L, 16 válvulas Dual-VVTi.Potencia: 138 caballos @ 6.400 rpm.Torque: 173 Nm @ 4.000 rpm.', 12,curdate(),curdate()),
       (5,4, '2019 Toyota Corolla', 'The black and red beauty features a custom wrap.', 12,curdate(),curdate()),
       (6,4, 'Volkswagen Gol Sedan',  'HYUNDAI GRAND I10 1.25 GLS MT: 1.143 UNIDADES. ...', 12,curdate(),curdate()),
       (6,4, 'Suzuki Ciaz',  'El Ciaz es un modelo con carroceria de Suzuki, quizás no tan conocido al que merece la pena echar un vistazo. Su motor es un 4 cilindros de 1373 cc que entrega hasta 94 caballos.', 12,curdate(),curdate()),
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



-- inserts tarifa transporte

insert into transport_fares (city_id, price, end_date, valid, created_at) values (1,81, '2019-06-27 20:45:31',  1,curdate());
insert into transport_fares (city_id, price, end_date, valid, created_at) values (2,114, '2019-05-10 13:01:40', 0,curdate());
insert into transport_fares (city_id, price, end_date, valid, created_at) values (3,50, '2019-09-24 08:12:06', 1,curdate());
insert into transport_fares (city_id, price, end_date, valid, created_at) values (4,60 , '2019-07-07 03:41:33', 1,curdate());
insert into transport_fares (city_id, price, end_date, valid, created_at) values (5, 90, '2019-08-17 08:45:37', 1,curdate());
insert into transport_fares (city_id, price, end_date, valid, created_at) values (6, 67, '2019-08-02 15:48:54', 1,curdate());
insert into transport_fares (city_id, price, end_date, valid, created_at) values (7, 100, '2019-06-18 19:56:07', 0,curdate());
insert into transport_fares (city_id, price, end_date, valid, created_at) values (8,115 , '2019-11-24 17:06:03',1,curdate());
insert into transport_fares (city_id, price, end_date, valid, created_at) values (9,100 , '2019-07-06 22:20:04', 1,curdate());

--- sencond part
insert into transport_fares (city_id, price, end_date, valid, created_at) values (1,45, '2019-06-27 20:45:31',  1,curdate());
insert into transport_fares (city_id, price, end_date, valid, created_at) values (2,11, '2019-05-10 13:01:40', 0,curdate());
insert into transport_fares (city_id, price, end_date, valid, created_at) values (3,90, '2019-09-24 08:12:06', 1,curdate());
insert into transport_fares (city_id, price, end_date, valid, created_at) values (4,31 , '2019-07-07 03:41:33', 1,curdate());
insert into transport_fares (city_id, price, end_date, valid, created_at) values (5,35, '2019-08-17 08:45:37', 1,curdate());
insert into transport_fares (city_id, price, end_date, valid, created_at) values (6,31, '2019-08-02 15:48:54', 1,curdate());
insert into transport_fares (city_id, price, end_date, valid, created_at) values (7,76, '2019-06-18 19:56:07', 0,curdate());
insert into transport_fares (city_id, price, end_date, valid, created_at) values (8,87 , '2019-11-24 17:06:03',1,curdate());
insert into transport_fares (city_id, price, end_date, valid, created_at) values (9,91 , '2019-07-06 22:20:04', 1,curdate());

-- colores 


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
insert into color_articles (article_id, color_id) values (1,3);
insert into color_articles (article_id, color_id) values (1,13);
insert into color_articles (article_id, color_id) values (1,15);
insert into color_articles (article_id, color_id) values (2,24);
insert into color_articles (article_id, color_id) values (2,15);
insert into color_articles (article_id, color_id) values (2,13);
insert into color_articles (article_id, color_id) values (3,24);
insert into color_articles (article_id, color_id) values (3,15);
insert into color_articles (article_id, color_id) values (3,13);
insert into color_articles (article_id, color_id) values (4,15);
insert into color_articles (article_id, color_id) values (4,13);
insert into color_articles (article_id, color_id) values (4,24);
insert into color_articles (article_id, color_id) values (5,15);
insert into color_articles (article_id, color_id) values (5,13);
insert into color_articles (article_id, color_id) values (5,24);
insert into color_articles (article_id, color_id) values (6,3);
insert into color_articles (article_id, color_id) values (6,8);
insert into color_articles (article_id, color_id) values (6,4);
insert into color_articles (article_id, color_id) values (6,22);
insert into color_articles (article_id, color_id) values (6,13);
insert into color_articles (article_id, color_id) values (6,15);
insert into color_articles (article_id, color_id) values (7,15);
insert into color_articles (article_id, color_id) values (7,22);
insert into color_articles (article_id, color_id) values (7,6);
insert into color_articles (article_id, color_id) values (7,13);
insert into color_articles (article_id, color_id) values (8,8);
insert into color_articles (article_id, color_id) values (8,11);
insert into color_articles (article_id, color_id) values (8,3);
insert into color_articles (article_id, color_id) values (8,10);
insert into color_articles (article_id, color_id) values (8,13);
insert into color_articles (article_id, color_id) values (8,15);
insert into color_articles (article_id, color_id) values (9,22);
insert into color_articles (article_id, color_id) values (9,12);
insert into color_articles (article_id, color_id) values (9,3);
insert into color_articles (article_id, color_id) values (9,24);
insert into color_articles (article_id, color_id) values (9,13);
insert into color_articles (article_id, color_id) values (9,15);
insert into color_articles (article_id, color_id) values (10,15);
insert into color_articles (article_id, color_id) values (10,22);
insert into color_articles (article_id, color_id) values (10,13);
insert into color_articles (article_id, color_id) values (10,4);
insert into color_articles (article_id, color_id) values (11,15);
insert into color_articles (article_id, color_id) values (11,22);
insert into color_articles (article_id, color_id) values (11,13);
insert into color_articles (article_id, color_id) values (11,4);
insert into color_articles (article_id, color_id) values (12,15);
insert into color_articles (article_id, color_id) values (12,22);
insert into color_articles (article_id, color_id) values (12,4);
insert into color_articles (article_id, color_id) values (12,8);
insert into color_articles (article_id, color_id) values (13,15);
insert into color_articles (article_id, color_id) values (13,22);
insert into color_articles (article_id, color_id) values (13,4);
insert into color_articles (article_id, color_id) values (13,8);
insert into color_articles (article_id, color_id) values (14,5);
insert into color_articles (article_id, color_id) values (14,12);
insert into color_articles (article_id, color_id) values (14,8);
insert into color_articles (article_id, color_id) values (14,3);
insert into color_articles (article_id, color_id) values (15,5);
insert into color_articles (article_id, color_id) values (15,12);
insert into color_articles (article_id, color_id) values (15,8);
insert into color_articles (article_id, color_id) values (15,3);
insert into color_articles (article_id, color_id) values (16,5);
insert into color_articles (article_id, color_id) values (16,13);
insert into color_articles (article_id, color_id) values (16,8);
insert into color_articles (article_id, color_id) values (16,3);
insert into color_articles (article_id, color_id) values (17,13);
insert into color_articles (article_id, color_id) values (17,5);
insert into color_articles (article_id, color_id) values (17,4);
insert into color_articles (article_id, color_id) values (17,11);
insert into color_articles (article_id, color_id) values (17,8);
insert into color_articles (article_id, color_id) values (17,22);
insert into color_articles (article_id, color_id) values (18,5);
insert into color_articles (article_id, color_id) values (18,4);
insert into color_articles (article_id, color_id) values (18,11);
insert into color_articles (article_id, color_id) values (18,8);
insert into color_articles (article_id, color_id) values (18,22);

insert into color_articles (article_id, color_id) values (19,22);
insert into color_articles (article_id, color_id) values (19,4);
insert into color_articles (article_id, color_id) values (19,8);
insert into color_articles (article_id, color_id) values (20,5);
insert into color_articles (article_id, color_id) values (20,12);
insert into color_articles (article_id, color_id) values (20,8);
insert into color_articles (article_id, color_id) values (21,3);
insert into color_articles (article_id, color_id) values (21,5);
insert into color_articles (article_id, color_id) values (22,12);
insert into color_articles (article_id, color_id) values (22,8);
insert into color_articles (article_id, color_id) values (23,3);
insert into color_articles (article_id, color_id) values (23,5);
insert into color_articles (article_id, color_id) values (24,13);
insert into color_articles (article_id, color_id) values (24,8);
insert into color_articles (article_id, color_id) values (25,3);
insert into color_articles (article_id, color_id) values (25,13);
insert into color_articles (article_id, color_id) values (25,5);



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
-- insertar mas imagenes secundarias

-- inserts orden

insert into orders (transport_fares_id, client_id, total_amount, created_at, updated_at) values (1,30,  '9.76', '2010-01-12 20:45:31', curdate());
insert into orders (transport_fares_id, client_id, total_amount, created_at, updated_at) values (1,29,  '8.71', '2011-02-01 20:45:31', curdate());
insert into orders (transport_fares_id, client_id, total_amount, created_at, updated_at) values (1,28,  '3.46', '2012-03-16 20:45:31', curdate());
insert into orders (transport_fares_id, client_id, total_amount, created_at, updated_at) values (2,27,  '0.45', '2013-11-28 20:45:31', curdate());
insert into orders (transport_fares_id, client_id, total_amount, created_at, updated_at) values (2,26,  '8.22', '2014-12-31 20:45:31', curdate());
insert into orders (transport_fares_id, client_id, total_amount, created_at, updated_at) values (2,25,  '5.13', '2015-10-20 20:45:31', curdate());-- a
insert into orders (transport_fares_id, client_id, total_amount, created_at, updated_at) values (3,24,  '4.76', '2016-06-30 20:45:31', curdate());
insert into orders (transport_fares_id, client_id, total_amount, created_at, updated_at) values (3,23,  '9.56', '2017-08-09 20:45:31', curdate());
insert into orders (transport_fares_id, client_id, total_amount, created_at, updated_at) values (4,22,  '9.27', '2018-01-01 20:45:31', curdate());
insert into orders (transport_fares_id, client_id, total_amount, created_at, updated_at) values (4,21,  '5.22', '2020-03-03 20:45:31', curdate());
insert into orders (transport_fares_id, client_id, total_amount, created_at, updated_at) values (4,20,  '2.60', '2011-04-05 20:45:31', curdate());
insert into orders (transport_fares_id, client_id, total_amount, created_at, updated_at) values (5,19,  '1.98', '2010-02-06 20:45:31', curdate());
insert into orders (transport_fares_id, client_id, total_amount, created_at, updated_at) values (5,18,  '2.85', '2012-03-01 20:45:31', curdate());
insert into orders (transport_fares_id, client_id, total_amount, created_at, updated_at) values (5,17,  '6.42', '2013-07-05 20:45:31', curdate()); -- a 
insert into orders (transport_fares_id, client_id, total_amount, created_at, updated_at) values (6,16,  '2.60', '2014-08-06 20:45:31', curdate()); -- a
insert into orders (transport_fares_id, client_id, total_amount, created_at, updated_at) values (6,15,  '6.44', '2015-11-10 20:45:31', curdate());
insert into orders (transport_fares_id, client_id, total_amount, created_at, updated_at) values (6,14,  '8.79', '2016-10-11 20:45:31', curdate()); -- a
insert into orders (transport_fares_id, client_id, total_amount, created_at, updated_at) values (7,13,  '8.66', '2017-12-12 20:45:31', curdate());
insert into orders (transport_fares_id, client_id, total_amount, created_at, updated_at) values (7,12,  '7.07', '2018-19-14 20:45:31', curdate());
insert into orders (transport_fares_id, client_id, total_amount, created_at, updated_at) values (7,11,  '3.82', '2015-01-16 20:45:31', curdate());
insert into orders (transport_fares_id, client_id, total_amount, created_at, updated_at) values (8,10,  '5.36', '2016-02-17 20:45:31', curdate());
insert into orders (transport_fares_id, client_id, total_amount, created_at, updated_at) values (8,9,   '0.57', '2017-03-18 20:45:31', curdate());
insert into orders (transport_fares_id, client_id, total_amount, created_at, updated_at) values (8,8,   '5.39', '2018-04-20 20:45:31', curdate());
insert into orders (transport_fares_id, client_id, total_amount, created_at, updated_at) values (9,7,  '7.69', '2010-05-21 20:45:31', curdate());
insert into orders (transport_fares_id, client_id, total_amount, created_at, updated_at) values (9,6,   '1.02', '2011-06-22 20:45:31', curdate());
insert into orders (transport_fares_id, client_id, total_amount, created_at, updated_at) values (9,5,   '2.01', '2014-07-25 20:45:31', curdate());
insert into orders (transport_fares_id, client_id, total_amount, created_at, updated_at) values (1,4,   '3.15', '2012-08-24 20:45:31', curdate());
insert into orders (transport_fares_id, client_id, total_amount, created_at, updated_at) values (1,3,   '8.84', '2013-09-27 20:45:31', curdate());
insert into orders (transport_fares_id, client_id, total_amount, created_at, updated_at) values (1,2,   '8.84', '2013-09-27 20:45:31', curdate());
insert into orders (transport_fares_id, client_id, total_amount, created_at, updated_at) values (1,1,   '8.84', '2013-09-27 20:45:31', curdate());

-- second part of orders
insert into orders (transport_fares_id, client_id, total_amount, created_at, updated_at) values (1,30,  '9.76', '2011-01-12 20:45:31', curdate());
insert into orders (transport_fares_id, client_id, total_amount, created_at, updated_at) values (1,29,  '8.71', '2011-02-01 20:45:31', curdate());
insert into orders (transport_fares_id, client_id, total_amount, created_at, updated_at) values (1,11,  '3.46', '2011-03-16 20:45:31', curdate());
insert into orders (transport_fares_id, client_id, total_amount, created_at, updated_at) values (2,27,  '0.45', '2010-11-28 20:45:31', curdate());
insert into orders (transport_fares_id, client_id, total_amount, created_at, updated_at) values (2,26,  '8.22', '2010-12-31 20:45:31', curdate());
insert into orders (transport_fares_id, client_id, total_amount, created_at, updated_at) values (2,25,  '5.13', '2010-10-20 20:45:31', curdate());-- a
insert into orders (transport_fares_id, client_id, total_amount, created_at, updated_at) values (3,25,  '4.76', '2012-06-30 20:45:31', curdate());
insert into orders (transport_fares_id, client_id, total_amount, created_at, updated_at) values (3,23,  '9.56', '2012-08-09 20:45:31', curdate());
insert into orders (transport_fares_id, client_id, total_amount, created_at, updated_at) values (3,2,   '9.27', '2012-01-01 20:45:31', curdate());
insert into orders (transport_fares_id, client_id, total_amount, created_at, updated_at) values (4,2,   '5.22', '2013-03-03 20:45:31', curdate());
insert into orders (transport_fares_id, client_id, total_amount, created_at, updated_at) values (4,2,   '2.60', '2013-04-05 20:45:31', curdate());
insert into orders (transport_fares_id, client_id, total_amount, created_at, updated_at) values (4,19,  '1.98', '2013-02-06 20:45:31', curdate());
insert into orders (transport_fares_id, client_id, total_amount, created_at, updated_at) values (5,18,  '2.85', '2014-03-01 20:45:31', curdate());
insert into orders (transport_fares_id, client_id, total_amount, created_at, updated_at) values (5,17,  '6.42', '2014-07-05 20:45:31', curdate()); -- a 
insert into orders (transport_fares_id, client_id, total_amount, created_at, updated_at) values (5,16,  '2.60', '2014-08-06 20:45:31', curdate()); -- a
insert into orders (transport_fares_id, client_id, total_amount, created_at, updated_at) values (6,15,  '6.44', '2015-11-10 20:45:31', curdate());
insert into orders (transport_fares_id, client_id, total_amount, created_at, updated_at) values (6,4,   '8.79', '2015-10-11 20:45:31', curdate()); -- a
insert into orders (transport_fares_id, client_id, total_amount, created_at, updated_at) values (6,13,  '8.66', '2015-12-12 20:45:31', curdate());
insert into orders (transport_fares_id, client_id, total_amount, created_at, updated_at) values (7,11,  '7.07', '2016-11-14 20:45:31', curdate());
insert into orders (transport_fares_id, client_id, total_amount, created_at, updated_at) values (7,11,  '3.82', '2016-01-16 20:45:31', curdate());
insert into orders (transport_fares_id, client_id, total_amount, created_at, updated_at) values (7,10,  '5.36', '2016-02-17 20:45:31', curdate());
insert into orders (transport_fares_id, client_id, total_amount, created_at, updated_at) values (8,9,   '0.57', '2017-03-18 20:45:31', curdate());
insert into orders (transport_fares_id, client_id, total_amount, created_at, updated_at) values (8,8,   '5.39', '2017-04-20 20:45:31', curdate());
insert into orders (transport_fares_id, client_id, total_amount, created_at, updated_at) values (8,7,   '7.69', '2017-05-21 20:45:31', curdate());
insert into orders (transport_fares_id, client_id, total_amount, created_at, updated_at) values (9,6,   '1.02', '2018-06-22 20:45:31', curdate());
insert into orders (transport_fares_id, client_id, total_amount, created_at, updated_at) values (9,5,   '2.01', '2018-07-25 20:45:31', curdate());
insert into orders (transport_fares_id, client_id, total_amount, created_at, updated_at) values (9,4,   '3.15', '2018-08-24 20:45:31', curdate());
insert into orders (transport_fares_id, client_id, total_amount, created_at, updated_at) values (9,3,   '8.84', '2019-09-27 20:45:31', curdate());
insert into orders (transport_fares_id, client_id, total_amount, created_at, updated_at) values (1,3,   '8.84', '2019-09-27 20:45:31', curdate());
insert into orders (transport_fares_id, client_id, total_amount, created_at, updated_at) values (1,6,   '8.84', '2019-09-27 20:45:31', curdate());
insert into orders (transport_fares_id, client_id, total_amount, created_at, updated_at) values (2,6,   '8.84', '2020-09-27 20:45:31', curdate());
insert into orders (transport_fares_id, client_id, total_amount, created_at, updated_at) values (2,3,   '8.84', '2020-09-27 20:45:31', curdate());
insert into orders (transport_fares_id, client_id, total_amount, created_at, updated_at) values (2,3,   '8.84', '2020-09-27 20:45:31', curdate());

-- other orders 

insert into orders (transport_fares_id, client_id, total_amount, created_at, updated_at) values (1,30,  '9.76', '2010-01-12 20:45:31', curdate());
insert into orders (transport_fares_id, client_id, total_amount, created_at, updated_at) values (1,29,  '8.71', '2011-02-01 20:45:31', curdate());
insert into orders (transport_fares_id, client_id, total_amount, created_at, updated_at) values (1,28,  '3.46', '2012-03-16 20:45:31', curdate());
insert into orders (transport_fares_id, client_id, total_amount, created_at, updated_at) values (2,27,  '0.45', '2013-11-28 20:45:31', curdate());
insert into orders (transport_fares_id, client_id, total_amount, created_at, updated_at) values (2,26,  '8.22', '2014-12-31 20:45:31', curdate());
insert into orders (transport_fares_id, client_id, total_amount, created_at, updated_at) values (2,25,  '5.13', '2015-10-20 20:45:31', curdate()); -- a
insert into orders (transport_fares_id, client_id, total_amount, created_at, updated_at) values (3,24,  '4.76', '2016-06-30 20:45:31', curdate());
insert into orders (transport_fares_id, client_id, total_amount, created_at, updated_at) values (3,23,  '9.56', '2017-08-09 20:45:31', curdate());
insert into orders (transport_fares_id, client_id, total_amount, created_at, updated_at) values (4,22,  '9.27', '2018-01-01 20:45:31', curdate());
insert into orders (transport_fares_id, client_id, total_amount, created_at, updated_at) values (4,21,  '5.22', '2020-03-03 20:45:31', curdate());
insert into orders (transport_fares_id, client_id, total_amount, created_at, updated_at) values (4,20,  '2.60', '2011-04-05 20:45:31', curdate());
insert into orders (transport_fares_id, client_id, total_amount, created_at, updated_at) values (5,19,  '1.98', '2010-02-06 20:45:31', curdate());
insert into orders (transport_fares_id, client_id, total_amount, created_at, updated_at) values (5,18,  '2.85', '2012-03-01 20:45:31', curdate());
insert into orders (transport_fares_id, client_id, total_amount, created_at, updated_at) values (5,17,  '6.42', '2013-07-05 20:45:31', curdate()); -- a
insert into orders (transport_fares_id, client_id, total_amount, created_at, updated_at) values (6,16,  '2.60', '2014-08-06 20:45:31', curdate()); -- a
insert into orders (transport_fares_id, client_id, total_amount, created_at, updated_at) values (6,15,  '6.44', '2015-11-10 20:45:31', curdate());
insert into orders (transport_fares_id, client_id, total_amount, created_at, updated_at) values (6,14,  '8.79', '2016-10-11 20:45:31', curdate()); -- a
insert into orders (transport_fares_id, client_id, total_amount, created_at, updated_at) values (7,13,  '8.66', '2017-12-12 20:45:31', curdate());
insert into orders (transport_fares_id, client_id, total_amount, created_at, updated_at) values (7,12,  '7.07', '2018-12-12 20:45:31', curdate());
insert into orders (transport_fares_id, client_id, total_amount, created_at, updated_at) values (7,11,  '3.82', '2015-01-16 20:45:31', curdate());
insert into orders (transport_fares_id, client_id, total_amount, created_at, updated_at) values (8,10,  '5.36', '2016-02-17 20:45:31', curdate());
insert into orders (transport_fares_id, client_id, total_amount, created_at, updated_at) values (8,9,   '0.57', '2017-03-18 20:45:31', curdate());
insert into orders (transport_fares_id, client_id, total_amount, created_at, updated_at) values (8,8,   '5.39', '2018-04-20 20:45:31', curdate());
insert into orders (transport_fares_id, client_id, total_amount, created_at, updated_at) values (9, 7,  '7.69', '2010-05-21 20:45:31', curdate());
insert into orders (transport_fares_id, client_id, total_amount, created_at, updated_at) values (9,6,   '1.02', '2011-06-22 20:45:31', curdate());
insert into orders (transport_fares_id, client_id, total_amount, created_at, updated_at) values (9,5,   '2.01', '2014-07-25 20:45:31', curdate());
insert into orders (transport_fares_id, client_id, total_amount, created_at, updated_at) values (1,4,   '3.15', '2012-08-24 20:45:31', curdate());
insert into orders (transport_fares_id, client_id, total_amount, created_at, updated_at) values (1,3,   '8.84', '2013-09-27 20:45:31', curdate());
-- hasta aqui 91 ordenes

-- second part of orders
insert into orders (transport_fares_id, client_id, total_amount, created_at, updated_at) values (9,30,  '9.76', '2011-01-12 20:45:31', curdate());
insert into orders (transport_fares_id, client_id, total_amount, created_at, updated_at) values (9,29,  '8.71', '2011-02-01 20:45:31', curdate());
insert into orders (transport_fares_id, client_id, total_amount, created_at, updated_at) values (9,11,  '3.46', '2011-03-16 20:45:31', curdate());
insert into orders (transport_fares_id, client_id, total_amount, created_at, updated_at) values (8,27,  '0.45', '2010-11-28 20:45:31', curdate());
insert into orders (transport_fares_id, client_id, total_amount, created_at, updated_at) values (8,26,  '8.22', '2010-12-31 20:45:31', curdate());
insert into orders (transport_fares_id, client_id, total_amount, created_at, updated_at) values (8,25,  '5.13', '2010-10-20 20:45:31', curdate());-- a
insert into orders (transport_fares_id, client_id, total_amount, created_at, updated_at) values (7,25,  '4.76', '2012-06-30 20:45:31', curdate());
insert into orders (transport_fares_id, client_id, total_amount, created_at, updated_at) values (7,23,  '9.56', '2012-08-09 20:45:31', curdate());
insert into orders (transport_fares_id, client_id, total_amount, created_at, updated_at) values (6,2,   '9.27', '2012-01-01 20:45:31', curdate());
insert into orders (transport_fares_id, client_id, total_amount, created_at, updated_at) values (6,2,   '5.22', '2013-03-03 20:45:31', curdate());
insert into orders (transport_fares_id, client_id, total_amount, created_at, updated_at) values (5,2,   '2.60', '2013-04-05 20:45:31', curdate());
insert into orders (transport_fares_id, client_id, total_amount, created_at, updated_at) values (5,19,  '1.98', '2013-02-06 20:45:31', curdate());
insert into orders (transport_fares_id, client_id, total_amount, created_at, updated_at) values (4,18,  '2.85', '2014-03-01 20:45:31', curdate());
insert into orders (transport_fares_id, client_id, total_amount, created_at, updated_at) values (4,17,  '6.42', '2014-07-05 20:45:31', curdate()); -- a 
insert into orders (transport_fares_id, client_id, total_amount, created_at, updated_at) values (3,16,  '2.60', '2014-08-06 20:45:31', curdate()); -- a
insert into orders (transport_fares_id, client_id, total_amount, created_at, updated_at) values (3,15,  '6.44', '2015-11-10 20:45:31', curdate());
insert into orders (transport_fares_id, client_id, total_amount, created_at, updated_at) values (2,4,   '8.79', '2015-10-11 20:45:31', curdate()); -- a
insert into orders (transport_fares_id, client_id, total_amount, created_at, updated_at) values (2,13,  '8.66', '2015-12-12 20:45:31', curdate());
insert into orders (transport_fares_id, client_id, total_amount, created_at, updated_at) values (1,11,  '7.07', '2016-11-14 20:45:31', curdate());
insert into orders (transport_fares_id, client_id, total_amount, created_at, updated_at) values (1,11,  '3.82', '2016-01-16 20:45:31', curdate());
insert into orders (transport_fares_id, client_id, total_amount, created_at, updated_at) values (2,10,  '5.36', '2016-02-17 20:45:31', curdate());
insert into orders (transport_fares_id, client_id, total_amount, created_at, updated_at) values (3,9,   '0.57', '2017-03-18 20:45:31', curdate());
insert into orders (transport_fares_id, client_id, total_amount, created_at, updated_at) values (4,8,   '5.39', '2017-04-20 20:45:31', curdate());
insert into orders (transport_fares_id, client_id, total_amount, created_at, updated_at) values (5,7,   '7.69', '2017-05-21 20:45:31', curdate());
insert into orders (transport_fares_id, client_id, total_amount, created_at, updated_at) values (6,6,   '1.02', '2018-06-22 20:45:31', curdate());
insert into orders (transport_fares_id, client_id, total_amount, created_at, updated_at) values (7,5,   '2.01', '2018-07-25 20:45:31', curdate());
insert into orders (transport_fares_id, client_id, total_amount, created_at, updated_at) values (8,4,   '3.15', '2018-08-24 20:45:31', curdate());
insert into orders (transport_fares_id, client_id, total_amount, created_at, updated_at) values (9,3,   '8.84', '2019-09-27 20:45:31', curdate());
insert into orders (transport_fares_id, client_id, total_amount, created_at, updated_at) values (1,3,   '8.84', '2019-09-27 20:45:31', curdate());
insert into orders (transport_fares_id, client_id, total_amount, created_at, updated_at) values (1,6,   '8.84', '2019-09-27 20:45:31', curdate());
insert into orders (transport_fares_id, client_id, total_amount, created_at, updated_at) values (2,6,   '8.84', '2020-09-27 20:45:31', curdate());
insert into orders (transport_fares_id, client_id, total_amount, created_at, updated_at) values (2,3,   '8.84', '2020-09-27 20:45:31', curdate());
insert into orders (transport_fares_id, client_id, total_amount, created_at, updated_at) values (2,3,   '8.84', '2020-09-27 20:45:31', curdate());
-- TOTAL 123 ordenes



-- inserts precioArticulo
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
insert into price_articles ( article_id, price, is_current, created_at) values ( 19, 234,  0, curdate());
insert into price_articles ( article_id, price, is_current, created_at) values ( 20, 546,  0, curdate());
insert into price_articles ( article_id, price, is_current, created_at) values ( 21, 787,  0, curdate());
insert into price_articles ( article_id, price, is_current, created_at) values ( 22, 34,  0,  curdate());
insert into price_articles ( article_id, price, is_current, created_at) values ( 23, 789 ,  0, curdate());
insert into price_articles ( article_id, price, is_current, created_at) values ( 24, 21,   0, curdate());
insert into price_articles ( article_id, price, is_current, created_at) values ( 25, 189,  0, curdate());

-- otros precios secundarios

insert into price_articles ( article_id, price, is_current, created_at) values ( 1, 5464,  0,  '2019-05-18 18:04:57', curdate());
insert into price_articles ( article_id, price, is_current, created_at) values ( 2, 423,  0, '2019-09-01 12:55:57', curdate());
insert into price_articles ( article_id, price, is_current, created_at) values ( 3, 657,  0, '2019-06-17 09:07:25', curdate());
insert into price_articles ( article_id, price, is_current, created_at) values ( 4, 23,  0, '2019-06-24 16:54:55', curdate());
insert into price_articles ( article_id, price, is_current, created_at) values ( 5, 880,  0,  '2019-09-19 17:00:12', curdate());
insert into price_articles ( article_id, price, is_current, created_at) values ( 6, 67,   0, '2019-07-04 01:52:55', curdate());
insert into price_articles ( article_id, price, is_current, created_at) values ( 7, 123,   0, '2020-02-20 14:40:38', curdate());
insert into price_articles ( article_id, price, is_current, created_at) values ( 8, 980,  0, '2019-05-25 06:48:01', curdate());
insert into price_articles ( article_id, price, is_current, created_at) values ( 9, 887,   0, '2019-06-09 01:53:32', curdate());
insert into price_articles ( article_id, price, is_current, created_at) values ( 10, 34,0, '2019-10-31 16:13:57', curdate());
insert into price_articles ( article_id, price, is_current, created_at) values ( 11, 345,0, '2019-03-23 16:53:37', curdate());
insert into price_articles ( article_id, price, is_current, created_at) values ( 12, 879,0, '2019-10-09 18:51:55', curdate());
insert into price_articles ( article_id, price, is_current, created_at) values ( 13, 123,0,'2019-03-05 16:40:05', curdate());
insert into price_articles ( article_id, price, is_current, created_at) values ( 14, 678,  0, '2020-02-09 19:49:09', curdate());
insert into price_articles ( article_id, price, is_current, created_at) values ( 15, 324,  0, '2019-07-13 04:49:11', curdate());
insert into price_articles ( article_id, price, is_current, created_at) values ( 16, 789,  0, '2019-09-16 21:15:00', curdate());
insert into price_articles ( article_id, price, is_current, created_at) values ( 17, 334,  0,   '2019-04-20 16:17:39', curdate());
insert into price_articles ( article_id, price, is_current, created_at) values ( 18, 231,  0, '2019-08-21 07:50:15', curdate());
insert into price_articles ( article_id, price, is_current, created_at) values ( 19, 765,   0, '2020-01-10 10:22:24', curdate());
insert into price_articles ( article_id, price, is_current, created_at) values ( 20, 343,   0, '2019-07-07 05:01:29', curdate());
insert into price_articles ( article_id, price, is_current, created_at) values ( 21, 2324,   0, '2019-07-07 05:01:29', curdate());
insert into price_articles ( article_id, price, is_current, created_at) values ( 22, 89,   0, '2019-07-07 05:01:29', curdate());
insert into price_articles ( article_id, price, is_current, created_at) values ( 23, 12,   0, '2019-07-07 05:01:29', curdate());
insert into price_articles ( article_id, price, is_current, created_at) values ( 24, 56,   0, '2019-07-07 05:01:29', curdate());
insert into price_articles ( article_id, price, is_current, created_at) values ( 25, 78,   0, '2019-07-07 05:01:29', curdate());

-- insert extra
insert into price_articles ( article_id, price, is_current, end_date, created_at) values ( 1, 123,  0,  '2019-05-18 18:04:57', curdate());
insert into price_articles ( article_id, price, is_current, end_date, created_at) values ( 1, 8797,  0,  '2019-05-18 18:04:57', curdate());
insert into price_articles ( article_id, price, is_current, end_date, created_at) values ( 1, 1213,  0,  '2019-05-18 18:04:57', curdate());
insert into price_articles ( article_id, price, is_current, end_date, created_at) values ( 1, 546,  0,  '2019-05-18 18:04:57', curdate());
insert into price_articles ( article_id, price, is_current, end_date, created_at) values ( 1, 797,  0,  '2019-05-18 18:04:57', curdate());

-- inserts status
insert into status_orders (order_id,process_order_id) values (1,1 );
insert into status_orders (order_id,process_order_id) values (2,1 );
insert into status_orders (order_id,process_order_id) values (3,1 );
insert into status_orders (order_id,process_order_id) values (4,2 );
insert into status_orders (order_id,process_order_id) values (5,5 );
insert into status_orders (order_id,process_order_id) values (6,3 );
insert into status_orders (order_id,process_order_id) values (7,3 );
insert into status_orders (order_id,process_order_id) values (8,3);
insert into status_orders (order_id,process_order_id) values (9,4);
insert into status_orders (order_id,process_order_id) values (10,4);
insert into status_orders (order_id,process_order_id) values (11,5);
insert into status_orders (order_id,process_order_id) values (12,5);
insert into status_orders (order_id,process_order_id) values (13,1);
insert into status_orders (order_id,process_order_id) values (14,5);
insert into status_orders (order_id,process_order_id) values (15,2);
insert into status_orders (order_id,process_order_id) values (16,2 );
insert into status_orders (order_id,process_order_id) values (17,2 );
insert into status_orders (order_id,process_order_id) values (18,5 );
insert into status_orders (order_id,process_order_id) values (19,3 );
insert into status_orders (order_id,process_order_id) values (20,4 );
insert into status_orders (order_id,process_order_id) values (21,4 );
insert into status_orders (order_id,process_order_id) values (22,1 );
insert into status_orders (order_id,process_order_id) values (23,5 );
insert into status_orders (order_id,process_order_id) values (24,5 );
insert into status_orders (order_id,process_order_id) values (25,2 );
insert into status_orders (order_id,process_order_id) values (26,2 );
insert into status_orders (order_id,process_order_id) values (27,3 );
insert into status_orders (order_id,process_order_id) values (28,3);
insert into status_orders (order_id,process_order_id) values (29,1);
insert into status_orders (order_id,process_order_id) values (30,5);
insert into status_orders (order_id,process_order_id) values (31,2);

-- second part
insert into status_orders (order_id,process_order_id) values (32,1 );
insert into status_orders (order_id,process_order_id) values (33,1 );
insert into status_orders (order_id,process_order_id) values (34,2 );
insert into status_orders (order_id,process_order_id) values (35,5 );
insert into status_orders (order_id,process_order_id) values (36,3 );
insert into status_orders (order_id,process_order_id) values (37,3);
insert into status_orders (order_id,process_order_id) values (38,3);
insert into status_orders (order_id,process_order_id) values (39,4);
insert into status_orders (order_id,process_order_id) values (40,4);
insert into status_orders (order_id,process_order_id) values (41,5);
insert into status_orders (order_id,process_order_id) values (42,5);
insert into status_orders (order_id,process_order_id) values (43,1);
insert into status_orders (order_id,process_order_id) values (44,5);
insert into status_orders (order_id,process_order_id) values (45,2);
insert into status_orders (order_id,process_order_id) values (46,2 );
insert into status_orders (order_id,process_order_id) values (47,2 );
insert into status_orders (order_id,process_order_id) values (48,5 );
insert into status_orders (order_id,process_order_id) values (49,3 );
insert into status_orders (order_id,process_order_id) values (50,4 );
insert into status_orders (order_id,process_order_id) values (51,4 );
insert into status_orders (order_id,process_order_id) values (52,1 );
insert into status_orders (order_id,process_order_id) values (53,5 );
insert into status_orders (order_id,process_order_id) values (54,5 );
insert into status_orders (order_id,process_order_id) values (55,2 );
insert into status_orders (order_id,process_order_id) values (56,2 );
insert into status_orders (order_id,process_order_id) values (57,3 );
insert into status_orders (order_id,process_order_id) values (58,3);
insert into status_orders (order_id,process_order_id) values (59,1);
insert into status_orders (order_id,process_order_id) values (60,5);
insert into status_orders (order_id,process_order_id) values (61,2);
insert into status_orders (order_id,process_order_id) values (62,5);
insert into status_orders (order_id,process_order_id) values (63,1);
insert into status_orders (order_id,process_order_id) values (64,5);
insert into status_orders (order_id,process_order_id) values (65,2);
insert into status_orders (order_id,process_order_id) values (66,2 );
insert into status_orders (order_id,process_order_id) values (67,2 );
insert into status_orders (order_id,process_order_id) values (68,5 );
insert into status_orders (order_id,process_order_id) values (69,3 );
insert into status_orders (order_id,process_order_id) values (70,4 );
insert into status_orders (order_id,process_order_id) values (71,4 );
insert into status_orders (order_id,process_order_id) values (72,1 );
insert into status_orders (order_id,process_order_id) values (73,5 );
insert into status_orders (order_id,process_order_id) values (74,5 );
insert into status_orders (order_id,process_order_id) values (75,2 );
insert into status_orders (order_id,process_order_id) values (76,2 );
insert into status_orders (order_id,process_order_id) values (77,3 );
insert into status_orders (order_id,process_order_id) values (78,3);
insert into status_orders (order_id,process_order_id) values (79,1);
insert into status_orders (order_id,process_order_id) values (80,4 );
insert into status_orders (order_id,process_order_id) values (81,4 );
insert into status_orders (order_id,process_order_id) values (82,1 );
insert into status_orders (order_id,process_order_id) values (83,5 );
insert into status_orders (order_id,process_order_id) values (84,5 );
insert into status_orders (order_id,process_order_id) values (85,2 );
insert into status_orders (order_id,process_order_id) values (86,2 );
insert into status_orders (order_id,process_order_id) values (87,3 );
insert into status_orders (order_id,process_order_id) values (88,3);
insert into status_orders (order_id,process_order_id) values (89,1);
insert into status_orders (order_id,process_order_id) values (90,4 );


-- for part
insert into status_orders (order_id,process_order_id) values (91,1);
insert into status_orders (order_id,process_order_id) values (92,2 );
insert into status_orders (order_id,process_order_id) values (93,1 );
insert into status_orders (order_id,process_order_id) values (94,1 );
insert into status_orders (order_id,process_order_id) values (95,5 );
insert into status_orders (order_id,process_order_id) values (96,2 );
insert into status_orders (order_id,process_order_id) values (97,2 );
insert into status_orders (order_id,process_order_id) values (98,3);
insert into status_orders (order_id,process_order_id) values (99,3);
insert into status_orders (order_id,process_order_id) values (100,5);
insert into status_orders (order_id,process_order_id) values (101,5);
insert into status_orders (order_id,process_order_id) values (102,5);
insert into status_orders (order_id,process_order_id) values (103,5);
insert into status_orders (order_id,process_order_id) values (104,5);
insert into status_orders (order_id,process_order_id) values (105,5);
insert into status_orders (order_id,process_order_id) values (106,5);
insert into status_orders (order_id,process_order_id) values (107,5);
insert into status_orders (order_id,process_order_id) values (108,5);
insert into status_orders (order_id,process_order_id) values (109,5);
insert into status_orders (order_id,process_order_id) values (110,5);
insert into status_orders (order_id,process_order_id) values (111,5);
insert into status_orders (order_id,process_order_id) values (112,5);
insert into status_orders (order_id,process_order_id) values (113,1);
insert into status_orders (order_id,process_order_id) values (114,2);
insert into status_orders (order_id,process_order_id) values (115,5);
insert into status_orders (order_id,process_order_id) values (116,3 );
insert into status_orders (order_id,process_order_id) values (117,3 );
insert into status_orders (order_id,process_order_id) values (118,3 );
insert into status_orders (order_id,process_order_id) values (119,1 );
insert into status_orders (order_id,process_order_id) values (120,1 );
insert into status_orders (order_id,process_order_id) values (121,1 );
insert into status_orders (order_id,process_order_id) values (122,5 );
insert into status_orders (order_id,process_order_id) values (122,1 );
insert into status_orders (order_id,process_order_id) values (123,2 );

-- five part

--- orders entregados  WONDERFUL_LARAVEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEELL



-- other part RAUL

-- inserts detalle orden
insert into order_details (article_id, order_id, price_article_id, quantity, sub_total) values (1,1,1 ,2, 1200);
insert into order_details (article_id, order_id, price_article_id, quantity, sub_total) values (2,1,2, 3, 2100);
insert into order_details (article_id, order_id, price_article_id, quantity, sub_total) values (3,1,3, 1, 650);
insert into order_details (article_id, order_id, price_article_id, quantity, sub_total) values (4,1,4, 1, 200);
insert into order_details (article_id, order_id, price_article_id, quantity, sub_total) values (5,2,5, 1, 180);
insert into order_details (article_id, order_id, price_article_id, quantity, sub_total) values (6,2,6, 4, 100);
insert into order_details (article_id, order_id, price_article_id, quantity, sub_total) values (7,2,7, 4, 200);
insert into order_details (article_id, order_id, price_article_id, quantity, sub_total) values (8,3,8, 2, 240);
insert into order_details (article_id, order_id, price_article_id, quantity, sub_total) values (9,3,9, 1, 80);
insert into order_details (article_id, order_id, price_article_id, quantity, sub_total) values (10,3,10, 1, 3000);
insert into order_details (article_id, order_id, price_article_id, quantity, sub_total) values (11,4,11, 1, 3400);
insert into order_details (article_id, order_id, price_article_id, quantity, sub_total) values (12,4,12, 1, 2000);
insert into order_details (article_id, order_id, price_article_id, quantity, sub_total) values (13,4,13, 1, 2300);
insert into order_details (article_id, order_id, price_article_id, quantity, sub_total) values (14,5,14, 1, 10);
insert into order_details (article_id, order_id, price_article_id, quantity, sub_total) values (15,5,15, 4, 52);
insert into order_details (article_id, order_id, price_article_id, quantity, sub_total) values (16,5,16, 6, 120);
insert into order_details (article_id, order_id, price_article_id, quantity, sub_total) values (17,6,17, 4, 160);
insert into order_details (article_id, order_id, price_article_id, quantity, sub_total) values (18,6,18, 6, 390);
insert into order_details (article_id, order_id, price_article_id, quantity, sub_total) values (19,6,19, 2, 10);
insert into order_details (article_id, order_id, price_article_id, quantity, sub_total) values (20,7,20, 4, 20);
insert into order_details (article_id, order_id, price_article_id, quantity, sub_total) values (21,7,21, 5, 25);
insert into order_details (article_id, order_id, price_article_id, quantity, sub_total) values (22,7,22, 5, 25);
insert into order_details (article_id, order_id, price_article_id, quantity, sub_total) values (23,7,23, 6, 30);

insert into order_details (article_id, order_id, price_article_id, quantity, sub_total) values (1,8,1 ,2, 1200);
insert into order_details (article_id, order_id, price_article_id, quantity, sub_total) values (2,9,2, 3, 2100);
insert into order_details (article_id, order_id, price_article_id, quantity, sub_total) values (3,10,3, 1, 650);
insert into order_details (article_id, order_id, price_article_id, quantity, sub_total) values (4,11,4, 1, 200);
insert into order_details (article_id, order_id, price_article_id, quantity, sub_total) values (5,12,5, 1, 180);
insert into order_details (article_id, order_id, price_article_id, quantity, sub_total) values (6,12,6, 4, 100);
insert into order_details (article_id, order_id, price_article_id, quantity, sub_total) values (7,12,7, 4, 200);
insert into order_details (article_id, order_id, price_article_id, quantity, sub_total) values (8,13,8, 2, 240);
insert into order_details (article_id, order_id, price_article_id, quantity, sub_total) values (9,13,9, 1, 80);
insert into order_details (article_id, order_id, price_article_id, quantity, sub_total) values (10,14,10, 1, 3000);
insert into order_details (article_id, order_id, price_article_id, quantity, sub_total) values (11,15,11, 1, 3400);
insert into order_details (article_id, order_id, price_article_id, quantity, sub_total) values (12,16,12, 1, 2000);
insert into order_details (article_id, order_id, price_article_id, quantity, sub_total) values (13,17,13, 1, 2300);
insert into order_details (article_id, order_id, price_article_id, quantity, sub_total) values (14,18,14, 1, 10);
insert into order_details (article_id, order_id, price_article_id, quantity, sub_total) values (15,18,15, 4, 52);
insert into order_details (article_id, order_id, price_article_id, quantity, sub_total) values (16,18,16, 6, 120);
insert into order_details (article_id, order_id, price_article_id, quantity, sub_total) values (17,19,17, 4, 160);
insert into order_details (article_id, order_id, price_article_id, quantity, sub_total) values (18,19,18, 6, 390);
insert into order_details (article_id, order_id, price_article_id, quantity, sub_total) values (19,19,19, 2, 10);
insert into order_details (article_id, order_id, price_article_id, quantity, sub_total) values (20,20,20, 4, 20);
insert into order_details (article_id, order_id, price_article_id, quantity, sub_total) values (21,20,21, 5, 25);
insert into order_details (article_id, order_id, price_article_id, quantity, sub_total) values (22,20,22, 5, 25);
insert into order_details (article_id, order_id, price_article_id, quantity, sub_total) values (23,20,23, 6, 30);

insert into order_details (article_id, order_id, price_article_id, quantity, sub_total) values (1,21,1 ,2, 1200);
insert into order_details (article_id, order_id, price_article_id, quantity, sub_total) values (2,21,2, 3, 2100);
insert into order_details (article_id, order_id, price_article_id, quantity, sub_total) values (3,22,3, 1, 650);
insert into order_details (article_id, order_id, price_article_id, quantity, sub_total) values (4,22,4, 1, 200);
insert into order_details (article_id, order_id, price_article_id, quantity, sub_total) values (5,23,5, 1, 180);
insert into order_details (article_id, order_id, price_article_id, quantity, sub_total) values (6,23,6, 4, 100);
insert into order_details (article_id, order_id, price_article_id, quantity, sub_total) values (7,24,7, 4, 200);
insert into order_details (article_id, order_id, price_article_id, quantity, sub_total) values (8,24,8, 2, 240);
insert into order_details (article_id, order_id, price_article_id, quantity, sub_total) values (9,24,9, 1, 80);
insert into order_details (article_id, order_id, price_article_id, quantity, sub_total) values (10,25,10, 1, 3000);
insert into order_details (article_id, order_id, price_article_id, quantity, sub_total) values (11,26,11, 1, 3400);
insert into order_details (article_id, order_id, price_article_id, quantity, sub_total) values (12,27,12, 1, 2000);
insert into order_details (article_id, order_id, price_article_id, quantity, sub_total) values (13,28,13, 1, 2300);
insert into order_details (article_id, order_id, price_article_id, quantity, sub_total) values (14,29,14, 1, 10);
insert into order_details (article_id, order_id, price_article_id, quantity, sub_total) values (15,29,15, 4, 52);
insert into order_details (article_id, order_id, price_article_id, quantity, sub_total) values (16,29,16, 6, 120);
insert into order_details (article_id, order_id, price_article_id, quantity, sub_total) values (17,29,17, 4, 160);
insert into order_details (article_id, order_id, price_article_id, quantity, sub_total) values (18,30,18, 6, 390);
insert into order_details (article_id, order_id, price_article_id, quantity, sub_total) values (19,30,19, 2, 10);
insert into order_details (article_id, order_id, price_article_id, quantity, sub_total) values (20,30,20, 4, 20);
insert into order_details (article_id, order_id, price_article_id, quantity, sub_total) values (21,30,21, 5, 25);
insert into order_details (article_id, order_id, price_article_id, quantity, sub_total) values (22,31,22, 5, 25);
insert into order_details (article_id, order_id, price_article_id, quantity, sub_total) values (23,31,23, 6, 30);

insert into order_details (article_id, order_id, price_article_id, quantity, sub_total) values (1,32,1 ,2, 1200);
insert into order_details (article_id, order_id, price_article_id, quantity, sub_total) values (2,33,2, 3, 2100);
insert into order_details (article_id, order_id, price_article_id, quantity, sub_total) values (3,34,3, 1, 650);
insert into order_details (article_id, order_id, price_article_id, quantity, sub_total) values (4,34,4, 1, 200);
insert into order_details (article_id, order_id, price_article_id, quantity, sub_total) values (5,35,5, 1, 180);
insert into order_details (article_id, order_id, price_article_id, quantity, sub_total) values (6,35,6, 4, 100);
insert into order_details (article_id, order_id, price_article_id, quantity, sub_total) values (7,36,7, 4, 200);
insert into order_details (article_id, order_id, price_article_id, quantity, sub_total) values (8,36,8, 2, 240);
insert into order_details (article_id, order_id, price_article_id, quantity, sub_total) values (9,36,9, 1, 80);
insert into order_details (article_id, order_id, price_article_id, quantity, sub_total) values (10,37,10, 1, 3000);
insert into order_details (article_id, order_id, price_article_id, quantity, sub_total) values (11,38,11, 1, 3400);
insert into order_details (article_id, order_id, price_article_id, quantity, sub_total) values (12,39,12, 1, 2000);
insert into order_details (article_id, order_id, price_article_id, quantity, sub_total) values (13,40,13, 1, 2300);
insert into order_details (article_id, order_id, price_article_id, quantity, sub_total) values (14,41,14, 1, 10);
insert into order_details (article_id, order_id, price_article_id, quantity, sub_total) values (15,41,15, 4, 52);
insert into order_details (article_id, order_id, price_article_id, quantity, sub_total) values (16,41,16, 6, 120);
insert into order_details (article_id, order_id, price_article_id, quantity, sub_total) values (17,42,17, 4, 160);
insert into order_details (article_id, order_id, price_article_id, quantity, sub_total) values (18,42,18, 6, 390);
insert into order_details (article_id, order_id, price_article_id, quantity, sub_total) values (19,42,19, 2, 10);
insert into order_details (article_id, order_id, price_article_id, quantity, sub_total) values (20,42,20, 4, 20);
insert into order_details (article_id, order_id, price_article_id, quantity, sub_total) values (21,43,21, 5, 25);
insert into order_details (article_id, order_id, price_article_id, quantity, sub_total) values (22,44,22, 5, 25);
insert into order_details (article_id, order_id, price_article_id, quantity, sub_total) values (23,45,23, 6, 30);
insert into order_details (article_id, order_id, price_article_id, quantity, sub_total) values (23,46,23, 6, 30);
insert into order_details (article_id, order_id, price_article_id, quantity, sub_total) values (23,47,23, 6, 30);
insert into order_details (article_id, order_id, price_article_id, quantity, sub_total) values (23,48,23, 6, 30);
insert into order_details (article_id, order_id, price_article_id, quantity, sub_total) values (23,49,23, 6, 30);
insert into order_details (article_id, order_id, price_article_id, quantity, sub_total) values (23,50,23, 6, 30);
insert into order_details (article_id, order_id, price_article_id, quantity, sub_total) values (23,51,23, 6, 30);

insert into order_details (article_id, order_id, price_article_id, quantity, sub_total) values (1,52,1 ,2, 1200);
insert into order_details (article_id, order_id, price_article_id, quantity, sub_total) values (2,53,2, 3, 2100);
insert into order_details (article_id, order_id, price_article_id, quantity, sub_total) values (3,54,3, 1, 650);
insert into order_details (article_id, order_id, price_article_id, quantity, sub_total) values (4,54,4, 1, 200);
insert into order_details (article_id, order_id, price_article_id, quantity, sub_total) values (5,55,5, 1, 180);
insert into order_details (article_id, order_id, price_article_id, quantity, sub_total) values (6,55,6, 4, 100);
insert into order_details (article_id, order_id, price_article_id, quantity, sub_total) values (7,56,7, 4, 200);
insert into order_details (article_id, order_id, price_article_id, quantity, sub_total) values (8,56,8, 2, 240);
insert into order_details (article_id, order_id, price_article_id, quantity, sub_total) values (9,56,9, 1, 80);
insert into order_details (article_id, order_id, price_article_id, quantity, sub_total) values (10,57,10, 1, 3000);
insert into order_details (article_id, order_id, price_article_id, quantity, sub_total) values (11,58,11, 1, 3400);
insert into order_details (article_id, order_id, price_article_id, quantity, sub_total) values (12,59,12, 1, 2000);
insert into order_details (article_id, order_id, price_article_id, quantity, sub_total) values (13,60,13, 1, 2300);
insert into order_details (article_id, order_id, price_article_id, quantity, sub_total) values (14,61,14, 1, 10);
insert into order_details (article_id, order_id, price_article_id, quantity, sub_total) values (15,61,15, 4, 52);
insert into order_details (article_id, order_id, price_article_id, quantity, sub_total) values (16,61,16, 6, 120);
insert into order_details (article_id, order_id, price_article_id, quantity, sub_total) values (17,62,17, 4, 160);
insert into order_details (article_id, order_id, price_article_id, quantity, sub_total) values (18,62,18, 6, 390);
insert into order_details (article_id, order_id, price_article_id, quantity, sub_total) values (19,62,19, 2, 10);
insert into order_details (article_id, order_id, price_article_id, quantity, sub_total) values (20,62,20, 4, 20);
insert into order_details (article_id, order_id, price_article_id, quantity, sub_total) values (21,63,21, 5, 25);
insert into order_details (article_id, order_id, price_article_id, quantity, sub_total) values (22,63,22, 5, 25);
insert into order_details (article_id, order_id, price_article_id, quantity, sub_total) values (23,63,23, 6, 30);
insert into order_details (article_id, order_id, price_article_id, quantity, sub_total) values (1,62,1 ,2, 1200);
insert into order_details (article_id, order_id, price_article_id, quantity, sub_total) values (2,63,2, 3, 2100);
insert into order_details (article_id, order_id, price_article_id, quantity, sub_total) values (3,64,3, 1, 650);
insert into order_details (article_id, order_id, price_article_id, quantity, sub_total) values (4,64,4, 1, 200);
insert into order_details (article_id, order_id, price_article_id, quantity, sub_total) values (5,65,5, 1, 180);
insert into order_details (article_id, order_id, price_article_id, quantity, sub_total) values (6,65,6, 4, 100);
insert into order_details (article_id, order_id, price_article_id, quantity, sub_total) values (7,66,7, 4, 200);
insert into order_details (article_id, order_id, price_article_id, quantity, sub_total) values (8,66,8, 2, 240);
insert into order_details (article_id, order_id, price_article_id, quantity, sub_total) values (9,66,9, 1, 80);
insert into order_details (article_id, order_id, price_article_id, quantity, sub_total) values (10,67,10, 1, 3000);
insert into order_details (article_id, order_id, price_article_id, quantity, sub_total) values (11,68,11, 1, 3400);
insert into order_details (article_id, order_id, price_article_id, quantity, sub_total) values (12,69,12, 1, 2000);
insert into order_details (article_id, order_id, price_article_id, quantity, sub_total) values (13,70,13, 1, 2300);
insert into order_details (article_id, order_id, price_article_id, quantity, sub_total) values (14,71,14, 1, 10);
insert into order_details (article_id, order_id, price_article_id, quantity, sub_total) values (15,71,15, 4, 52);
insert into order_details (article_id, order_id, price_article_id, quantity, sub_total) values (16,71,16, 6, 120);
insert into order_details (article_id, order_id, price_article_id, quantity, sub_total) values (17,72,17, 4, 160);
insert into order_details (article_id, order_id, price_article_id, quantity, sub_total) values (18,72,18, 6, 390);
insert into order_details (article_id, order_id, price_article_id, quantity, sub_total) values (19,72,19, 2, 10);
insert into order_details (article_id, order_id, price_article_id, quantity, sub_total) values (20,72,20, 4, 20);
insert into order_details (article_id, order_id, price_article_id, quantity, sub_total) values (21,73,21, 5, 25);
insert into order_details (article_id, order_id, price_article_id, quantity, sub_total) values (22,73,22, 5, 25);
insert into order_details (article_id, order_id, price_article_id, quantity, sub_total) values (23,73,23, 6, 30);

insert into order_details (article_id, order_id, price_article_id, quantity, sub_total) values (3,74,3, 1, 650);
insert into order_details (article_id, order_id, price_article_id, quantity, sub_total) values (4,74,4, 1, 200);
insert into order_details (article_id, order_id, price_article_id, quantity, sub_total) values (5,75,5, 1, 180);
insert into order_details (article_id, order_id, price_article_id, quantity, sub_total) values (6,75,6, 4, 100);
insert into order_details (article_id, order_id, price_article_id, quantity, sub_total) values (7,76,7, 4, 200);
insert into order_details (article_id, order_id, price_article_id, quantity, sub_total) values (8,76,8, 2, 240);
insert into order_details (article_id, order_id, price_article_id, quantity, sub_total) values (9,76,9, 1, 80);
insert into order_details (article_id, order_id, price_article_id, quantity, sub_total) values (10,77,10, 1, 3000);
insert into order_details (article_id, order_id, price_article_id, quantity, sub_total) values (11,78,11, 1, 3400);
insert into order_details (article_id, order_id, price_article_id, quantity, sub_total) values (12,79,12, 1, 2000);
insert into order_details (article_id, order_id, price_article_id, quantity, sub_total) values (13,80,13, 1, 2300);
insert into order_details (article_id, order_id, price_article_id, quantity, sub_total) values (14,81,14, 1, 10);
insert into order_details (article_id, order_id, price_article_id, quantity, sub_total) values (15,81,15, 4, 52);
insert into order_details (article_id, order_id, price_article_id, quantity, sub_total) values (16,81,16, 6, 120);
insert into order_details (article_id, order_id, price_article_id, quantity, sub_total) values (17,82,17, 4, 160);
insert into order_details (article_id, order_id, price_article_id, quantity, sub_total) values (18,82,18, 6, 390);
insert into order_details (article_id, order_id, price_article_id, quantity, sub_total) values (19,82,19, 2, 10);
insert into order_details (article_id, order_id, price_article_id, quantity, sub_total) values (20,82,20, 4, 20);
insert into order_details (article_id, order_id, price_article_id, quantity, sub_total) values (21,83,21, 5, 25);
insert into order_details (article_id, order_id, price_article_id, quantity, sub_total) values (22,83,22, 5, 25);
insert into order_details (article_id, order_id, price_article_id, quantity, sub_total) values (23,83,23, 6, 30);
insert into order_details (article_id, order_id, price_article_id, quantity, sub_total) values (3,84,3, 1, 650);
insert into order_details (article_id, order_id, price_article_id, quantity, sub_total) values (4,84,4, 1, 200);
insert into order_details (article_id, order_id, price_article_id, quantity, sub_total) values (5,85,5, 1, 180);
insert into order_details (article_id, order_id, price_article_id, quantity, sub_total) values (6,85,6, 4, 100);
insert into order_details (article_id, order_id, price_article_id, quantity, sub_total) values (7,86,7, 4, 200);
insert into order_details (article_id, order_id, price_article_id, quantity, sub_total) values (8,86,8, 2, 240);
insert into order_details (article_id, order_id, price_article_id, quantity, sub_total) values (9,86,9, 1, 80);
insert into order_details (article_id, order_id, price_article_id, quantity, sub_total) values (10,87,10, 1, 3000);
insert into order_details (article_id, order_id, price_article_id, quantity, sub_total) values (11,88,11, 1, 3400);
insert into order_details (article_id, order_id, price_article_id, quantity, sub_total) values (12,89,12, 1, 2000);
insert into order_details (article_id, order_id, price_article_id, quantity, sub_total) values (13,90,13, 1, 2300);
insert into order_details (article_id, order_id, price_article_id, quantity, sub_total) values (14,91,14, 1, 10);
insert into order_details (article_id, order_id, price_article_id, quantity, sub_total) values (15,91,15, 4, 52);
insert into order_details (article_id, order_id, price_article_id, quantity, sub_total) values (16,91,16, 6, 120);
insert into order_details (article_id, order_id, price_article_id, quantity, sub_total) values (17,92,17, 4, 160);
insert into order_details (article_id, order_id, price_article_id, quantity, sub_total) values (18,92,18, 6, 390);
insert into order_details (article_id, order_id, price_article_id, quantity, sub_total) values (19,92,19, 2, 10);
insert into order_details (article_id, order_id, price_article_id, quantity, sub_total) values (20,92,20, 4, 20);
insert into order_details (article_id, order_id, price_article_id, quantity, sub_total) values (21,93,21, 5, 25);
insert into order_details (article_id, order_id, price_article_id, quantity, sub_total) values (22,93,22, 5, 25);
insert into order_details (article_id, order_id, price_article_id, quantity, sub_total) values (23,93,23, 6, 30);


insert into order_details (article_id, order_id, price_article_id, quantity, sub_total) values (3,94,3, 1, 650);
insert into order_details (article_id, order_id, price_article_id, quantity, sub_total) values (4,94,4, 1, 200);
insert into order_details (article_id, order_id, price_article_id, quantity, sub_total) values (5,95,5, 1, 180);
insert into order_details (article_id, order_id, price_article_id, quantity, sub_total) values (6,95,6, 4, 100);
insert into order_details (article_id, order_id, price_article_id, quantity, sub_total) values (7,96,7, 4, 200);
insert into order_details (article_id, order_id, price_article_id, quantity, sub_total) values (8,96,8, 2, 240);
insert into order_details (article_id, order_id, price_article_id, quantity, sub_total) values (9,96,9, 1, 80);
insert into order_details (article_id, order_id, price_article_id, quantity, sub_total) values (10,97,10, 1, 3000);
insert into order_details (article_id, order_id, price_article_id, quantity, sub_total) values (11,98,11, 1, 3400);
insert into order_details (article_id, order_id, price_article_id, quantity, sub_total) values (12,99,12, 1, 2000);
insert into order_details (article_id, order_id, price_article_id, quantity, sub_total) values (13,90,13, 1, 2300);
insert into order_details (article_id, order_id, price_article_id, quantity, sub_total) values (14,91,14, 1, 10);
insert into order_details (article_id, order_id, price_article_id, quantity, sub_total) values (15,91,15, 4, 52);
insert into order_details (article_id, order_id, price_article_id, quantity, sub_total) values (16,91,16, 6, 120);
insert into order_details (article_id, order_id, price_article_id, quantity, sub_total) values (17,92,17, 4, 160);
insert into order_details (article_id, order_id, price_article_id, quantity, sub_total) values (18,92,18, 6, 390);
insert into order_details (article_id, order_id, price_article_id, quantity, sub_total) values (19,92,19, 2, 10);
insert into order_details (article_id, order_id, price_article_id, quantity, sub_total) values (20,92,20, 4, 20);
insert into order_details (article_id, order_id, price_article_id, quantity, sub_total) values (21,93,21, 5, 25);
insert into order_details (article_id, order_id, price_article_id, quantity, sub_total) values (22,93,22, 5, 25);
insert into order_details (article_id, order_id, price_article_id, quantity, sub_total) values (23,93,23, 6, 30);
insert into order_details (article_id, order_id, price_article_id, quantity, sub_total) values (3,94,3, 1, 650);
insert into order_details (article_id, order_id, price_article_id, quantity, sub_total) values (4,94,4, 1, 200);
insert into order_details (article_id, order_id, price_article_id, quantity, sub_total) values (5,95,5, 1, 180);
insert into order_details (article_id, order_id, price_article_id, quantity, sub_total) values (6,95,6, 4, 100);
insert into order_details (article_id, order_id, price_article_id, quantity, sub_total) values (7,96,7, 4, 200);
insert into order_details (article_id, order_id, price_article_id, quantity, sub_total) values (8,96,8, 2, 240);
insert into order_details (article_id, order_id, price_article_id, quantity, sub_total) values (9,96,9, 1, 80);
insert into order_details (article_id, order_id, price_article_id, quantity, sub_total) values (10,97,10, 1, 3000);
insert into order_details (article_id, order_id, price_article_id, quantity, sub_total) values (11,98,11, 1, 3400);
insert into order_details (article_id, order_id, price_article_id, quantity, sub_total) values (12,99,12, 1, 2000);
insert into order_details (article_id, order_id, price_article_id, quantity, sub_total) values (13,100,13, 1, 2300);
insert into order_details (article_id, order_id, price_article_id, quantity, sub_total) values (14,101,14, 1, 10);
insert into order_details (article_id, order_id, price_article_id, quantity, sub_total) values (15,101,15, 4, 52);
insert into order_details (article_id, order_id, price_article_id, quantity, sub_total) values (16,101,16, 6, 120);
insert into order_details (article_id, order_id, price_article_id, quantity, sub_total) values (17,102,17, 4, 160);
insert into order_details (article_id, order_id, price_article_id, quantity, sub_total) values (18,102,18, 6, 390);
insert into order_details (article_id, order_id, price_article_id, quantity, sub_total) values (19,102,19, 2, 10);
insert into order_details (article_id, order_id, price_article_id, quantity, sub_total) values (20,102,20, 4, 20);
insert into order_details (article_id, order_id, price_article_id, quantity, sub_total) values (21,103,21, 5, 25);
insert into order_details (article_id, order_id, price_article_id, quantity, sub_total) values (22,104,22, 5, 25);
insert into order_details (article_id, order_id, price_article_id, quantity, sub_total) values (23,105,23, 6, 30);
insert into order_details (article_id, order_id, price_article_id, quantity, sub_total) values (10,106,10, 1, 3000);
insert into order_details (article_id, order_id, price_article_id, quantity, sub_total) values (11,107,11, 1, 3400);
insert into order_details (article_id, order_id, price_article_id, quantity, sub_total) values (12,108,12, 1, 2000);
insert into order_details (article_id, order_id, price_article_id, quantity, sub_total) values (10,109,10, 1, 3000);
insert into order_details (article_id, order_id, price_article_id, quantity, sub_total) values (11,110,11, 1, 3400);

insert into order_details (article_id, order_id, price_article_id, quantity, sub_total) values (14,111,14, 1, 10);
insert into order_details (article_id, order_id, price_article_id, quantity, sub_total) values (15,111,15, 4, 52);
insert into order_details (article_id, order_id, price_article_id, quantity, sub_total) values (16,111,16, 6, 120);
insert into order_details (article_id, order_id, price_article_id, quantity, sub_total) values (17,112,17, 4, 160);
insert into order_details (article_id, order_id, price_article_id, quantity, sub_total) values (18,112,18, 6, 390);
insert into order_details (article_id, order_id, price_article_id, quantity, sub_total) values (19,112,19, 2, 10);
insert into order_details (article_id, order_id, price_article_id, quantity, sub_total) values (20,112,20, 4, 20);
insert into order_details (article_id, order_id, price_article_id, quantity, sub_total) values (21,113,21, 5, 25);
insert into order_details (article_id, order_id, price_article_id, quantity, sub_total) values (22,114,22, 5, 25);
insert into order_details (article_id, order_id, price_article_id, quantity, sub_total) values (23,115,23, 6, 30);
insert into order_details (article_id, order_id, price_article_id, quantity, sub_total) values (10,116,10, 1, 3000);
insert into order_details (article_id, order_id, price_article_id, quantity, sub_total) values (11,117,11, 1, 3400);
insert into order_details (article_id, order_id, price_article_id, quantity, sub_total) values (12,118,12, 1, 2000);
insert into order_details (article_id, order_id, price_article_id, quantity, sub_total) values (10,119,10, 1, 3000);
insert into order_details (article_id, order_id, price_article_id, quantity, sub_total) values (11,120,11, 1, 3400);


insert into order_details (article_id, order_id, price_article_id, quantity, sub_total) values (1,121,1 ,2, 1200);
insert into order_details (article_id, order_id, price_article_id, quantity, sub_total) values (2,121,2, 3, 2100);
insert into order_details (article_id, order_id, price_article_id, quantity, sub_total) values (3,122,3, 1, 650);
insert into order_details (article_id, order_id, price_article_id, quantity, sub_total) values (4,122,4, 1, 200);
insert into order_details (article_id, order_id, price_article_id, quantity, sub_total) values (5,122,5, 1, 180);
insert into order_details (article_id, order_id, price_article_id, quantity, sub_total) values (6,122,6, 4, 100);
insert into order_details (article_id, order_id, price_article_id, quantity, sub_total) values (7,123,7, 4, 200);
insert into order_details (article_id, order_id, price_article_id, quantity, sub_total) values (8,123,8, 2, 240);
-- inserts user status order

-- inserts sara
insert into user_status_orders (status_order_id, user_id) 
values ( 1, 1),
       ( 2, 1),
       ( 3, 1),
       ( 4, 1),
       ( 5, 1),
       ( 6, 2),
       ( 7, 2),
       ( 8, 2),
       ( 9, 2),
       ( 10, 2),
       ( 11, 3),
       ( 12, 3),
       ( 13, 3),
       ( 14, 3),
       ( 15, 3), 
       ( 16, 4),
       ( 17, 4),
       ( 18, 4),
       ( 19, 4),
       ( 20, 4),
       ( 21, 5),
       ( 22, 5),
       ( 23, 5),
       ( 24, 5),
       ( 25, 5),
       ( 26, 6),
       ( 27, 6),
       ( 28, 6),
       ( 29, 6),
       ( 30, 6),
       ( 31, 7),
       ( 32, 7),
       ( 33, 7),
       ( 34, 7),
       ( 35, 7),
       ( 36, 8),
       ( 37, 8),
       ( 38, 8),
       ( 39, 8),
       ( 40, 8),
       ( 41, 9),
       ( 42, 9),
       ( 43, 9),
       ( 44, 9),
       ( 45, 9),
       ( 46, 10),
       ( 47, 10),
       ( 48, 10),
       ( 49, 10),
       ( 50, 10),
       ( 51, 11),
       ( 52, 11),
       ( 53, 11),
       ( 54, 11),
       ( 55, 11),
       ( 56, 12),
       ( 57, 12),
       ( 58, 12),
       ( 59, 12),
       ( 60, 12);


insert into user_status_orders (status_order_id, user_id) 
values ( 61, 13),
       ( 62, 13),
       ( 63, 13),
       ( 64, 13),
       ( 65, 13),
       ( 66, 14),
       ( 67, 14),
       ( 68, 14),
       ( 69, 14),
       ( 70, 14),
       ( 71, 15),
       ( 72, 15),
       ( 73, 15),
       ( 74, 15),
       ( 75, 15), 
       ( 76, 16),
       ( 77, 16),
       ( 78, 16),
       ( 79, 16),
       ( 80, 16),
       ( 81, 17),
       ( 82, 17),
       ( 83, 17),
       ( 84, 17),
       ( 85, 17),
       ( 86, 18),
       ( 87, 18),
       ( 88, 18),
       ( 89, 18),
       ( 90, 18),
       ( 91, 19),
       ( 92, 19),
       ( 93, 19),
       ( 94, 19),
       ( 95, 19),
       ( 96, 20),
       ( 97, 20),
       ( 98, 20),
       ( 99, 20),
       ( 100,20),
       ( 101, 21),
       ( 102, 21),
       ( 103, 21),
       ( 104, 21),
       ( 105, 21),
       ( 106, 22),
       ( 107, 22),
       ( 108, 22),
       ( 109, 22),
       ( 110, 22),
       ( 111, 22),
       ( 112, 23),
       ( 113, 23),
       ( 114, 23),
       ( 115, 23),
       ( 116, 23),
       ( 117, 5),
       ( 118, 6),
       ( 119, 7),
       ( 120, 8),
       ( 121, 9),
       ( 122, 10),
       ( 123, 11),
       ( 124, 12);

-- _____________________________________________________________________________________________________
-- HASTA AQUI YA ESTA BIEN 
insert into stars(star,created_at, updated_at) 
values ('1 estrella',curdate(),curdate()),
       ('2 estrella',curdate(),curdate()),
       ('3 estrella',curdate(),curdate()),
       ('4 estrella',curdate(),curdate()),
       ('5 estrella',curdate(),curdate());

-- evaluacionArticulo
insert into raiting_articles (article_id, client_id, star_id, created_at, updated_at)
values (1, 1,5,curdate(),curdate()),
       (2, 2,4,curdate(),curdate()),
       (3, 3,3,curdate(),curdate()),
       (4, 4,2,curdate(),curdate()),
       (5, 5,1,curdate(),curdate()),
       (6, 6,5,curdate(),curdate()),
       (7, 7,4,curdate(),curdate()),
       (8, 8,3,curdate(),curdate()),
       (9, 9,2,curdate(),curdate()),
       (10, 10,1,curdate(),curdate()),
       (11, 11,5,curdate(),curdate()),
       (12, 12,4,curdate(),curdate()),
       (13, 13,3,curdate(),curdate()),
       (14, 14,2,curdate(),curdate()),
       (15, 15,1,curdate(),curdate()),
       (16, 16,5,curdate(),curdate()),
       (17, 17,4,curdate(),curdate()),
       (18, 18,3,curdate(),curdate()),
       (19, 19,2,curdate(),curdate()),
       (20, 20,1,curdate(),curdate()),
       (21, 21,4,curdate(),curdate()),
       (22, 22,4,curdate(),curdate()),
       (23, 23,5,curdate(),curdate()),
       (24, 24,5,curdate(),curdate()),
       (25, 24,5,curdate(),curdate()),
       (1, 25,5,curdate(),curdate()),
       (2, 26,1,curdate(),curdate()),
       (3, 27,2,curdate(),curdate()),
       (4, 28,3,curdate(),curdate()),
       (5, 29,4,curdate(),curdate()),
       (6, 30,5,curdate(),curdate());

--        second part
insert into raiting_articles (article_id, client_id, star_id,created_at,updated_at)
values (6, 1,1,curdate(),curdate()),
       (7, 2,2,curdate(),curdate()),
       (8, 3,3,curdate(),curdate()),
       (9, 4,4,curdate(),curdate()),
       (10, 5,5,curdate(),curdate()),
       (11, 6,1,curdate(),curdate()),
       (12, 7,2,curdate(),curdate()),
       (13, 8,3,curdate(),curdate()),
       (14, 9,4,curdate(),curdate()),
       (15, 10,5,curdate(),curdate()),
       (16, 11,1,curdate(),curdate()),
       (17, 12,2,curdate(),curdate()),
       (18, 13,3,curdate(),curdate()),
       (19, 14,4,curdate(),curdate()),
       (20, 15,5,curdate(),curdate()),
       (21, 16,1,curdate(),curdate()),
       (22, 17,2,curdate(),curdate()),
       (23, 18,3,curdate(),curdate()),
       (24, 19,4,curdate(),curdate()),
       (25, 20,5,curdate(),curdate());
--         thre part

insert into raiting_articles (article_id, client_id, star_id,created_at,updated_at)
values (1, 20,5,curdate(),curdate()),
       (2, 19,4,curdate(),curdate()),
       (3, 18,3,curdate(),curdate()),
       (4, 17,2,curdate(),curdate()),
       (5, 16,1,curdate(),curdate()),
       (6, 15,5,curdate(),curdate()),
       (7, 14,4,curdate(),curdate()),
       (8, 13,3,curdate(),curdate()),
       (9, 12,2,curdate(),curdate()),
       (10, 11,1,curdate(),curdate()),
       (11, 10,5,curdate(),curdate()),
       (12, 9,4,curdate(),curdate()),
       (13, 8,3,curdate(),curdate()),
       (14, 7,2,curdate(),curdate()),
       (15, 6,1,curdate(),curdate()),
       (16, 5,5,curdate(),curdate()),
       (17, 4,4,curdate(),curdate()),
       (18, 3,3,curdate(),curdate()),
       (19, 2,2,curdate(),curdate()),
       (20, 1,1,curdate(),curdate());


    --    second part


-- evaluacionArticulo
insert into raiting_articles (article_id, client_id, star_id, created_at, updated_at)
values (21, 1,1,curdate(),curdate()),
       (22, 2,1,curdate(),curdate()),
       (23, 3,2,curdate(),curdate()),
       (24, 4,2,curdate(),curdate()),
       (25, 5,3,curdate(),curdate()),
       (1, 6, 3,curdate(),curdate()),
       (2, 7, 4,curdate(),curdate()),
       (3, 8, 4,curdate(),curdate()),
       (4, 9, 5,curdate(),curdate()),
       (5, 10,5,curdate(),curdate()),
       (6, 11,1,curdate(),curdate()),
       (7, 12,1,curdate(),curdate()),
       (8, 13,2,curdate(),curdate()),
       (9, 14,2,curdate(),curdate()),
       (10, 15,3,curdate(),curdate()),
       (11, 16,4,curdate(),curdate()),
       (12, 17,4,curdate(),curdate()),
       (13, 18,5,curdate(),curdate()),
       (14, 19,5,curdate(),curdate()),
       (15, 20,1,curdate(),curdate());

--        second part

insert into raiting_articles (article_id, client_id, star_id,created_at,updated_at)
values (21, 1,5,curdate(),curdate()),
       (22, 2,5,curdate(),curdate()),
       (23, 3,4,curdate(),curdate()),
       (24, 4,4,curdate(),curdate()),
       (25, 5,3,curdate(),curdate()),
       (1, 6,3,curdate(),curdate()),
       (2, 7,2,curdate(),curdate()),
       (3, 8,2,curdate(),curdate()),
       (4, 9,1,curdate(),curdate()),
       (5,10,1,curdate(),curdate()),
       (6,11,5,curdate(),curdate()),
       (7, 12,5,curdate(),curdate()),
       (8, 13,4,curdate(),curdate()),
       (9, 14,4,curdate(),curdate()),
       (10, 15,3,curdate(),curdate()),
       (11, 16,3,curdate(),curdate()),
       (12, 17,2,curdate(),curdate()),
       (13, 18,2,curdate(),curdate()),
       (14, 19,1,curdate(),curdate()),
       (15, 20,1,curdate(),curdate());
--         thre part

insert into raiting_articles (article_id, client_id, star_id,created_at,updated_at)
values (16, 21,1,curdate(),curdate()),
       (17, 22,1,curdate(),curdate()),
       (18, 23,2,curdate(),curdate()),
       (19, 24,2,curdate(),curdate()),
       (20, 25,3,curdate(),curdate()),
       (21, 26,3,curdate(),curdate()),
       (22, 27,4,curdate(),curdate()),
       (23, 28,4,curdate(),curdate()),
       (24, 29,5,curdate(),curdate()),
       (25, 10,5,curdate(),curdate()),
       (1, 30,1,curdate(),curdate()),
       (2, 19,1,curdate(),curdate()),
       (3, 28,2,curdate(),curdate()),
       (4, 17,2,curdate(),curdate()),
       (5, 16,3,curdate(),curdate()),
       (6, 15,3,curdate(),curdate()),
       (7, 24,4,curdate(),curdate()),
       (8, 23,4,curdate(),curdate()),
       (9, 22,5,curdate(),curdate()),
       (10, 21,5,curdate(),curdate());


insert into raiting_articles (article_id, client_id, star_id, created_at, updated_at)
values (11, 11,5,curdate(),curdate()),
       (12, 12,5,curdate(),curdate()),
       (13, 13,4,curdate(),curdate()),
       (14, 24,4,curdate(),curdate()),
       (15, 25,3,curdate(),curdate()),
       (16, 16,3,curdate(),curdate()),
       (17, 17,2,curdate(),curdate()),
       (18, 18,2,curdate(),curdate()),
       (19, 29,1,curdate(),curdate()),
       (20, 30,1,curdate(),curdate()),
       (21, 11,1,curdate(),curdate()),
       (22, 12,1,curdate(),curdate()),
       (23, 13,2,curdate(),curdate()),
       (24, 20,2,curdate(),curdate()),
       (25, 21,3,curdate(),curdate()),
       (1, 22,3,curdate(),curdate()),
       (2, 23,4,curdate(),curdate()),
       (3, 24,4,curdate(),curdate()),
       (4, 25,5,curdate(),curdate()),
       (5, 26,5,curdate(),curdate());

-- more raiting


-- evaluacionArticulo
insert into raiting_articles (article_id, client_id, star_id, created_at, updated_at)
values (1, 1,5,curdate(),curdate()),
       (2, 2,2,curdate(),curdate()),
       (3, 3,1,curdate(),curdate()),
       (4, 4,3,curdate(),curdate()),
       (5, 5,1,curdate(),curdate()),
       (6, 6,2,curdate(),curdate()),
       (7, 7,3,curdate(),curdate()),
       (8, 8,1,curdate(),curdate()),
       (9, 9,3,curdate(),curdate()),
       (10, 10,4,curdate(),curdate()),
       (11, 11,5,curdate(),curdate()),
       (12, 12,1,curdate(),curdate()),
       (13, 13,2,curdate(),curdate()),
       (14, 14,3,curdate(),curdate()),
       (15, 15,4,curdate(),curdate()),
       (16, 16,5,curdate(),curdate()),
       (17, 17,1,curdate(),curdate()),
       (18, 18,3,curdate(),curdate()),
       (19, 19,2,curdate(),curdate()),
       (20, 20,4,curdate(),curdate());

--        second part

insert into raiting_articles (article_id, client_id, star_id,created_at,updated_at)
values (21, 1,1,curdate(),curdate()),
       (22, 2,3,curdate(),curdate()),
       (23, 3,4,curdate(),curdate()),
       (24, 4,1,curdate(),curdate()),
       (25, 5,3,curdate(),curdate()),
       (1, 6,1,curdate(),curdate()),
       (2, 7,2,curdate(),curdate()),
       (3, 8,3,curdate(),curdate()),
       (4, 9,5,curdate(),curdate()),
       (5,10,1,curdate(),curdate()),
       (6,11,4,curdate(),curdate()),
       (7, 12,2,curdate(),curdate()),
       (8, 13,1,curdate(),curdate()),
       (9, 14,1,curdate(),curdate()),
       (10, 15,2,curdate(),curdate()),
       (11, 16,2,curdate(),curdate()),
       (12, 17,3,curdate(),curdate()),
       (13, 18,3,curdate(),curdate()),
       (14, 19,4,curdate(),curdate()),
       (15, 20,4,curdate(),curdate());
--         thre part

insert into raiting_articles (article_id, client_id, star_id,created_at,updated_at)
values (16, 21,3,curdate(),curdate()),
       (17, 22,3,curdate(),curdate()),
       (18, 23,4,curdate(),curdate()),
       (19, 24,4,curdate(),curdate()),
       (20, 25,1,curdate(),curdate()),
       (21, 26,1,curdate(),curdate()),
       (22, 27,2,curdate(),curdate()),
       (23, 28,2,curdate(),curdate()),
       (24, 29,3,curdate(),curdate()),
       (25, 10,3,curdate(),curdate()),
       (1, 30,2,curdate(),curdate()),
       (2, 19,2,curdate(),curdate()),
       (3, 28,1,curdate(),curdate()),
       (4, 17,1,curdate(),curdate()),
       (5, 16,2,curdate(),curdate()),
       (6, 15,2,curdate(),curdate()),
       (7, 24,5,curdate(),curdate()),
       (8, 23,5,curdate(),curdate()),
       (9, 22,4,curdate(),curdate()),
       (10, 21,4,curdate(),curdate());


insert into raiting_articles (article_id, client_id, star_id, created_at, updated_at)
values (11, 11,4,curdate(),curdate()),
       (12, 12,4,curdate(),curdate()),
       (13, 13,3,curdate(),curdate()),
       (14, 24,3,curdate(),curdate()),
       (15, 25,2,curdate(),curdate()),
       (16, 16,2,curdate(),curdate()),
       (17, 17,1,curdate(),curdate()),
       (18, 18,1,curdate(),curdate()),
       (19, 29,5,curdate(),curdate()),
       (20, 30,5,curdate(),curdate()),
       (21, 11,4,curdate(),curdate()),
       (22, 12,4,curdate(),curdate()),
       (23, 13,3,curdate(),curdate()),
       (24, 20,3,curdate(),curdate()),
       (25, 21,2,curdate(),curdate()),
       (1, 22,2,curdate(),curdate()),
       (2, 23,1,curdate(),curdate()),
       (3, 24,1,curdate(),curdate()),
       (4, 25,4,curdate(),curdate()),
       (5, 26,3,curdate(),curdate());


-- cometaries article

insert into commentary_articles (article_id, client_id , comment ,created_at,updated_at) 
values (1, 1,'sii me gusta Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi vitae condimentum erat. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae Sed posuere, purus at efficitur hendrerit, augue elit lacinia arcu, a eleifend sem elit et nunc. Sed rutrum vestibulum est, sit amet cursus dolor fermentum vel. Suspendisse mi nibh, congue et ante et, commodo mattis lacus.',curdate(),curdate()),
       (2, 2,'sii me gusta Vivamus rhoncus nisl sed venenatis luctus. Sed condimentum risus ut tortor feugiat laoreet. Suspendisse potenti. Donec et finibus sem, ut commodo lectus. Cras eget neque dignissim, placerat orci interdum, venenatis odio. Nulla turpis elit, consequat eu eros ac, consectetur fringilla urna. Duis gravida ex pulvinar mauris ornare, eget porttitor enim vulputate. Mauris hendrerit, massa nec aliquam cursus, ex elit euismod lorem, vehicula rhoncus nisl dui sit amet eros. Nulla turpis lorem, dignissim a sapien eget, ultrices venenatis dolor. Curabitur vel turpis at magna elementum hendrerit vel id dui. Curabitur a ex ullamcorper, ornare velit vel, tincidunt ipsum.',curdate(),curdate()),
       (3, 3,'sii me gusta Cras ut ipsum ornare, aliquam ipsum non, posuere elit. In hac habitasse platea dictumst. Aenean elementum leo augue, id fermentum risus efficitur vel. Nulla iaculis malesuada scelerisque. Praesent vel ipsum felis. Ut molestie, purus aliquam placerat sollicitudin, mi ligula euismod neque, non bibendum nibh neque et erat. Etiam dignissim aliquam ligula, aliquet feugiat nibh rhoncus ut. Aliquam efficitur lacinia lacinia. Morbi ac molestie lectus, vitae hendrerit nisl. Nullam metus odio, malesuada in vehicula at, consectetur nec justo. Quisque suscipit odio velit, at accumsan urna vestibulum a. Proin dictum, urna ut varius consectetur, sapien justo porta lectus, at mollis nisi orci et nulla. Donec pellentesque tortor vel nisl commodo ullamcorper.',curdate(),curdate()),
       (4, 4,'Mas u menos Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi vitae condimentum erat. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae Sed posuere, purus at efficitur hendrerit, augue elit lacinia arcu, a eleifend sem elit et nunc. Sed rutrum vestibulum est, sit amet cursus dolor fermentum vel. Suspendisse mi nibh, congue et ante et, commodo mattis lacus.',curdate(),curdate()),
       (5, 5,'sii me gusta Vivamus rhoncus nisl sed venenatis luctus. Sed condimentum risus ut tortor feugiat laoreet. Suspendisse potenti. Donec et finibus sem, ut commodo lectus. Cras eget neque dignissim, placerat orci interdum, venenatis odio. Nulla turpis elit, consequat eu eros ac, consectetur fringilla urna. Duis gravida ex pulvinar mauris ornare, eget porttitor enim vulputate. Mauris hendrerit, massa nec aliquam cursus, ex elit euismod lorem, vehicula rhoncus nisl dui sit amet eros. Nulla turpis lorem, dignissim a sapien eget, ultrices venenatis dolor. Curabitur vel turpis at magna elementum hendrerit vel id dui. Curabitur a ex ullamcorper, ornare velit vel, tincidunt ipsum.',curdate(),curdate()),
       (6, 6,'sii me gusta Cras ut ipsum ornare, aliquam ipsum non, posuere elit. In hac habitasse platea dictumst. Aenean elementum leo augue, id fermentum risus efficitur vel. Nulla iaculis malesuada scelerisque. Praesent vel ipsum felis. Ut molestie, purus aliquam placerat sollicitudin, mi ligula euismod neque, non bibendum nibh neque et erat. Etiam dignissim aliquam ligula, aliquet feugiat nibh rhoncus ut. Aliquam efficitur lacinia lacinia. Morbi ac molestie lectus, vitae hendrerit nisl. Nullam metus odio, malesuada in vehicula at, consectetur nec justo. Quisque suscipit odio velit, at accumsan urna vestibulum a. Proin dictum, urna ut varius consectetur, sapien justo porta lectus, at mollis nisi orci et nulla. Donec pellentesque tortor vel nisl commodo ullamcorper.',curdate(),curdate()),
       (7, 7,'Gracias fue de mi agrado Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi vitae condimentum erat. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae Sed posuere, purus at efficitur hendrerit, augue elit lacinia arcu, a eleifend sem elit et nunc. Sed rutrum vestibulum est, sit amet cursus dolor fermentum vel. Suspendisse mi nibh, congue et ante et, commodo mattis lacus.',curdate(),curdate()),
       (8, 8,'sii me gusta Vivamus rhoncus nisl sed venenatis luctus. Sed condimentum risus ut tortor feugiat laoreet. Suspendisse potenti. Donec et finibus sem, ut commodo lectus. Cras eget neque dignissim, placerat orci interdum, venenatis odio. Nulla turpis elit, consequat eu eros ac, consectetur fringilla urna. Duis gravida ex pulvinar mauris ornare, eget porttitor enim vulputate. Mauris hendrerit, massa nec aliquam cursus, ex elit euismod lorem, vehicula rhoncus nisl dui sit amet eros. Nulla turpis lorem, dignissim a sapien eget, ultrices venenatis dolor. Curabitur vel turpis at magna elementum hendrerit vel id dui. Curabitur a ex ullamcorper, ornare velit vel, tincidunt ipsum.',curdate(),curdate()),
       (9, 9,'Mejorar por favor en la entrega, me llego en la fecha atrasada Cras ut ipsum ornare, aliquam ipsum non, posuere elit. In hac habitasse platea dictumst. Aenean elementum leo augue, id fermentum risus efficitur vel. Nulla iaculis malesuada scelerisque. Praesent vel ipsum felis. Ut molestie, purus aliquam placerat sollicitudin, mi ligula euismod neque, non bibendum nibh neque et erat. Etiam dignissim aliquam ligula, aliquet feugiat nibh rhoncus ut. Aliquam efficitur lacinia lacinia. Morbi ac molestie lectus, vitae hendrerit nisl. Nullam metus odio, malesuada in vehicula at, consectetur nec justo. Quisque suscipit odio velit, at accumsan urna vestibulum a. Proin dictum, urna ut varius consectetur, sapien justo porta lectus, at mollis nisi orci et nulla. Donec pellentesque tortor vel nisl commodo ullamcorper.',curdate(),curdate()),
       (10, 10,'sii me gusta Vivamus rhoncus nisl sed venenatis luctus. Sed condimentum risus ut tortor feugiat laoreet. Suspendisse potenti. Donec et finibus sem, ut commodo lectus. Cras eget neque dignissim, placerat orci interdum, venenatis odio. Nulla turpis elit, consequat eu eros ac, consectetur fringilla urna. Duis gravida ex pulvinar mauris ornare, eget porttitor enim vulputate. Mauris hendrerit, massa nec aliquam cursus, ex elit euismod lorem, vehicula rhoncus nisl dui sit amet eros. Nulla turpis lorem, dignissim a sapien eget, ultrices venenatis dolor. Curabitur vel turpis at magna elementum hendrerit vel id dui. Curabitur a ex ullamcorper, ornare velit vel, tincidunt ipsum.',curdate(),curdate()),
       (11, 11,'sii me gusta Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi vitae condimentum erat. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae Sed posuere, purus at efficitur hendrerit, augue elit lacinia arcu, a eleifend sem elit et nunc. Sed rutrum vestibulum est, sit amet cursus dolor fermentum vel. Suspendisse mi nibh, congue et ante et, commodo mattis lacus.',curdate(),curdate()),
       (12, 12,'sii me gusta Vivamus rhoncus nisl sed venenatis luctus. Sed condimentum risus ut tortor feugiat laoreet. Suspendisse potenti. Donec et finibus sem, ut commodo lectus. Cras eget neque dignissim, placerat orci interdum, venenatis odio. Nulla turpis elit, consequat eu eros ac, consectetur fringilla urna. Duis gravida ex pulvinar mauris ornare, eget porttitor enim vulputate. Mauris hendrerit, massa nec aliquam cursus, ex elit euismod lorem, vehicula rhoncus nisl dui sit amet eros. Nulla turpis lorem, dignissim a sapien eget, ultrices venenatis dolor. Curabitur vel turpis at magna elementum hendrerit vel id dui. Curabitur a ex ullamcorper, ornare velit vel, tincidunt ipsum.',curdate(),curdate()),
       (13, 13,'sii me gusta Cras ut ipsum ornare, aliquam ipsum non, posuere elit. In hac habitasse platea dictumst. Aenean elementum leo augue, id fermentum risus efficitur vel. Nulla iaculis malesuada scelerisque. Praesent vel ipsum felis. Ut molestie, purus aliquam placerat sollicitudin, mi ligula euismod neque, non bibendum nibh neque et erat. Etiam dignissim aliquam ligula, aliquet feugiat nibh rhoncus ut. Aliquam efficitur lacinia lacinia. Morbi ac molestie lectus, vitae hendrerit nisl. Nullam metus odio, malesuada in vehicula at, consectetur nec justo. Quisque suscipit odio velit, at accumsan urna vestibulum a. Proin dictum, urna ut varius consectetur, sapien justo porta lectus, at mollis nisi orci et nulla. Donec pellentesque tortor vel nisl commodo ullamcorper.',curdate(),curdate()),
       (14, 14,'sii me gusta Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi vitae condimentum erat. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae Sed posuere, purus at efficitur hendrerit, augue elit lacinia arcu, a eleifend sem elit et nunc. Sed rutrum vestibulum est, sit amet cursus dolor fermentum vel. Suspendisse mi nibh, congue et ante et, commodo mattis lacus.',curdate(),curdate()),
       (15, 15,'sii me gusta Vivamus rhoncus nisl sed venenatis luctus. Sed condimentum risus ut tortor feugiat laoreet. Suspendisse potenti. Donec et finibus sem, ut commodo lectus. Cras eget neque dignissim, placerat orci interdum, venenatis odio. Nulla turpis elit, consequat eu eros ac, consectetur fringilla urna. Duis gravida ex pulvinar mauris ornare, eget porttitor enim vulputate. Mauris hendrerit, massa nec aliquam cursus, ex elit euismod lorem, vehicula rhoncus nisl dui sit amet eros. Nulla turpis lorem, dignissim a sapien eget, ultrices venenatis dolor. Curabitur vel turpis at magna elementum hendrerit vel id dui. Curabitur a ex ullamcorper, ornare velit vel, tincidunt ipsum.',curdate(),curdate()),
       (16, 16,'sii me gusta Cras ut ipsum ornare, aliquam ipsum non, posuere elit. In hac habitasse platea dictumst. Aenean elementum leo augue, id fermentum risus efficitur vel. Nulla iaculis malesuada scelerisque. Praesent vel ipsum felis. Ut molestie, purus aliquam placerat sollicitudin, mi ligula euismod neque, non bibendum nibh neque et erat. Etiam dignissim aliquam ligula, aliquet feugiat nibh rhoncus ut. Aliquam efficitur lacinia lacinia. Morbi ac molestie lectus, vitae hendrerit nisl. Nullam metus odio, malesuada in vehicula at, consectetur nec justo. Quisque suscipit odio velit, at accumsan urna vestibulum a. Proin dictum, urna ut varius consectetur, sapien justo porta lectus, at mollis nisi orci et nulla. Donec pellentesque tortor vel nisl commodo ullamcorper.',curdate(),curdate()),
       (17, 17,'sii me gusta Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi vitae condimentum erat. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae Sed posuere, purus at efficitur hendrerit, augue elit lacinia arcu, a eleifend sem elit et nunc. Sed rutrum vestibulum est, sit amet cursus dolor fermentum vel. Suspendisse mi nibh, congue et ante et, commodo mattis lacus.',curdate(),curdate()),
       (18, 18,'sii me gusta Vivamus rhoncus nisl sed venenatis luctus. Sed condimentum risus ut tortor feugiat laoreet. Suspendisse potenti. Donec et finibus sem, ut commodo lectus. Cras eget neque dignissim, placerat orci interdum, venenatis odio. Nulla turpis elit, consequat eu eros ac, consectetur fringilla urna. Duis gravida ex pulvinar mauris ornare, eget porttitor enim vulputate. Mauris hendrerit, massa nec aliquam cursus, ex elit euismod lorem, vehicula rhoncus nisl dui sit amet eros. Nulla turpis lorem, dignissim a sapien eget, ultrices venenatis dolor. Curabitur vel turpis at magna elementum hendrerit vel id dui. Curabitur a ex ullamcorper, ornare velit vel, tincidunt ipsum.',curdate(),curdate()),
       (19, 19,'sii me gusta Cras ut ipsum ornare, aliquam ipsum non, posuere elit. In hac habitasse platea dictumst. Aenean elementum leo augue, id fermentum risus efficitur vel. Nulla iaculis malesuada scelerisque. Praesent vel ipsum felis. Ut molestie, purus aliquam placerat sollicitudin, mi ligula euismod neque, non bibendum nibh neque et erat. Etiam dignissim aliquam ligula, aliquet feugiat nibh rhoncus ut. Aliquam efficitur lacinia lacinia. Morbi ac molestie lectus, vitae hendrerit nisl. Nullam metus odio, malesuada in vehicula at, consectetur nec justo. Quisque suscipit odio velit, at accumsan urna vestibulum a. Proin dictum, urna ut varius consectetur, sapien justo porta lectus, at mollis nisi orci et nulla. Donec pellentesque tortor vel nisl commodo ullamcorper. ',curdate(),curdate()),
       (20, 20,'sii me gusta Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi vitae condimentum erat. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae Sed posuere, purus at efficitur hendrerit, augue elit lacinia arcu, a eleifend sem elit et nunc. Sed rutrum vestibulum est, sit amet cursus dolor fermentum vel. Suspendisse mi nibh, congue et ante et, commodo mattis lacus.',curdate(),curdate()),
       (21, 21,'sii me gusta Cras ut ipsum ornare, aliquam ipsum non, posuere elit. In hac habitasse platea dictumst. Aenean elementum leo augue, id fermentum risus efficitur vel. Nulla iaculis malesuada scelerisque. Praesent vel ipsum felis. Ut molestie, purus aliquam placerat sollicitudin, mi ligula euismod neque, non bibendum nibh neque et erat. Etiam dignissim aliquam ligula, aliquet feugiat nibh rhoncus ut. Aliquam efficitur lacinia lacinia. Morbi ac molestie lectus, vitae hendrerit nisl. Nullam metus odio, malesuada in vehicula at, consectetur nec justo. Quisque suscipit odio velit, at accumsan urna vestibulum a. Proin dictum, urna ut varius consectetur, sapien justo porta lectus, at mollis nisi orci et nulla. Donec pellentesque tortor vel nisl commodo ullamcorper. ',curdate(),curdate()),
       (22, 22,'sii me gusta Vivamus rhoncus nisl sed venenatis luctus. Sed condimentum risus ut tortor feugiat laoreet. Suspendisse potenti. Donec et finibus sem, ut commodo lectus. Cras eget neque dignissim, placerat orci interdum, venenatis odio. Nulla turpis elit, consequat eu eros ac, consectetur fringilla urna. Duis gravida ex pulvinar mauris ornare, eget porttitor enim vulputate. Mauris hendrerit, massa nec aliquam cursus, ex elit euismod lorem, vehicula rhoncus nisl dui sit amet eros. Nulla turpis lorem, dignissim a sapien eget, ultrices venenatis dolor. Curabitur vel turpis at magna elementum hendrerit vel id dui. Curabitur a ex ullamcorper, ornare velit vel, tincidunt ipsum.',curdate(),curdate()),
       (23, 23,'sii me gusta Vivamus rhoncus nisl sed venenatis luctus. Sed condimentum risus ut tortor feugiat laoreet. Suspendisse potenti. Donec et finibus sem, ut commodo lectus. Cras eget neque dignissim, placerat orci interdum, venenatis odio. Nulla turpis elit, consequat eu eros ac, consectetur fringilla urna. Duis gravida ex pulvinar mauris ornare, eget porttitor enim vulputate. Mauris hendrerit, massa nec aliquam cursus, ex elit euismod lorem, vehicula rhoncus nisl dui sit amet eros. Nulla turpis lorem, dignissim a sapien eget, ultrices venenatis dolor. Curabitur vel turpis at magna elementum hendrerit vel id dui. Curabitur a ex ullamcorper, ornare velit vel, tincidunt ipsum.',curdate(),curdate()),
       (24, 24,'sii me gusta Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi vitae condimentum erat. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae Sed posuere, purus at efficitur hendrerit, augue elit lacinia arcu, a eleifend sem elit et nunc. Sed rutrum vestibulum est, sit amet cursus dolor fermentum vel. Suspendisse mi nibh, congue et ante et, commodo mattis lacus.',curdate(),curdate()),
       (25, 25,'sii me gusta Vivamus rhoncus nisl sed venenatis luctus. Sed condimentum risus ut tortor feugiat laoreet. Suspendisse potenti. Donec et finibus sem, ut commodo lectus. Cras eget neque dignissim, placerat orci interdum, venenatis odio. Nulla turpis elit, consequat eu eros ac, consectetur fringilla urna. Duis gravida ex pulvinar mauris ornare, eget porttitor enim vulputate. Mauris hendrerit, massa nec aliquam cursus, ex elit euismod lorem, vehicula rhoncus nisl dui sit amet eros. Nulla turpis lorem, dignissim a sapien eget, ultrices venenatis dolor. Curabitur vel turpis at magna elementum hendrerit vel id dui. Curabitur a ex ullamcorper, ornare velit vel, tincidunt ipsum.',curdate(),curdate());
       

      --  2 parte

insert into commentary_articles (article_id, client_id , comment ,created_at,updated_at) 
values (1, 26,'sii me gusta Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi vitae condimentum erat. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae Sed posuere, purus at efficitur hendrerit, augue elit lacinia arcu, a eleifend sem elit et nunc. Sed rutrum vestibulum est, sit amet cursus dolor fermentum vel. Suspendisse mi nibh, congue et ante et, commodo mattis lacus.',curdate(),curdate()),
       (2, 27,'sii me gusta Vivamus rhoncus nisl sed venenatis luctus. Sed condimentum risus ut tortor feugiat laoreet. Suspendisse potenti. Donec et finibus sem, ut commodo lectus. Cras eget neque dignissim, placerat orci interdum, venenatis odio. Nulla turpis elit, consequat eu eros ac, consectetur fringilla urna. Duis gravida ex pulvinar mauris ornare, eget porttitor enim vulputate. Mauris hendrerit, massa nec aliquam cursus, ex elit euismod lorem, vehicula rhoncus nisl dui sit amet eros. Nulla turpis lorem, dignissim a sapien eget, ultrices venenatis dolor. Curabitur vel turpis at magna elementum hendrerit vel id dui. Curabitur a ex ullamcorper, ornare velit vel, tincidunt ipsum.',curdate(),curdate()),
       (3, 28,'sii me gusta Cras ut ipsum ornare, aliquam ipsum non, posuere elit. In hac habitasse platea dictumst. Aenean elementum leo augue, id fermentum risus efficitur vel. Nulla iaculis malesuada scelerisque. Praesent vel ipsum felis. Ut molestie, purus aliquam placerat sollicitudin, mi ligula euismod neque, non bibendum nibh neque et erat. Etiam dignissim aliquam ligula, aliquet feugiat nibh rhoncus ut. Aliquam efficitur lacinia lacinia. Morbi ac molestie lectus, vitae hendrerit nisl. Nullam metus odio, malesuada in vehicula at, consectetur nec justo. Quisque suscipit odio velit, at accumsan urna vestibulum a. Proin dictum, urna ut varius consectetur, sapien justo porta lectus, at mollis nisi orci et nulla. Donec pellentesque tortor vel nisl commodo ullamcorper.',curdate(),curdate()),
       (4, 29,'Mas u menos Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi vitae condimentum erat. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae Sed posuere, purus at efficitur hendrerit, augue elit lacinia arcu, a eleifend sem elit et nunc. Sed rutrum vestibulum est, sit amet cursus dolor fermentum vel. Suspendisse mi nibh, congue et ante et, commodo mattis lacus.',curdate(),curdate()),
       (5, 30,'sii me gusta Vivamus rhoncus nisl sed venenatis luctus. Sed condimentum risus ut tortor feugiat laoreet. Suspendisse potenti. Donec et finibus sem, ut commodo lectus. Cras eget neque dignissim, placerat orci interdum, venenatis odio. Nulla turpis elit, consequat eu eros ac, consectetur fringilla urna. Duis gravida ex pulvinar mauris ornare, eget porttitor enim vulputate. Mauris hendrerit, massa nec aliquam cursus, ex elit euismod lorem, vehicula rhoncus nisl dui sit amet eros. Nulla turpis lorem, dignissim a sapien eget, ultrices venenatis dolor. Curabitur vel turpis at magna elementum hendrerit vel id dui. Curabitur a ex ullamcorper, ornare velit vel, tincidunt ipsum.',curdate(),curdate()),
       (6, 1,'sii me gusta Cras ut ipsum ornare, aliquam ipsum non, posuere elit. In hac habitasse platea dictumst. Aenean elementum leo augue, id fermentum risus efficitur vel. Nulla iaculis malesuada scelerisque. Praesent vel ipsum felis. Ut molestie, purus aliquam placerat sollicitudin, mi ligula euismod neque, non bibendum nibh neque et erat. Etiam dignissim aliquam ligula, aliquet feugiat nibh rhoncus ut. Aliquam efficitur lacinia lacinia. Morbi ac molestie lectus, vitae hendrerit nisl. Nullam metus odio, malesuada in vehicula at, consectetur nec justo. Quisque suscipit odio velit, at accumsan urna vestibulum a. Proin dictum, urna ut varius consectetur, sapien justo porta lectus, at mollis nisi orci et nulla. Donec pellentesque tortor vel nisl commodo ullamcorper.',curdate(),curdate()),
       (7, 2,'Gracias fue de mi agrado Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi vitae condimentum erat. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae Sed posuere, purus at efficitur hendrerit, augue elit lacinia arcu, a eleifend sem elit et nunc. Sed rutrum vestibulum est, sit amet cursus dolor fermentum vel. Suspendisse mi nibh, congue et ante et, commodo mattis lacus.',curdate(),curdate()),
       (8, 3,'sii me gusta Vivamus rhoncus nisl sed venenatis luctus. Sed condimentum risus ut tortor feugiat laoreet. Suspendisse potenti. Donec et finibus sem, ut commodo lectus. Cras eget neque dignissim, placerat orci interdum, venenatis odio. Nulla turpis elit, consequat eu eros ac, consectetur fringilla urna. Duis gravida ex pulvinar mauris ornare, eget porttitor enim vulputate. Mauris hendrerit, massa nec aliquam cursus, ex elit euismod lorem, vehicula rhoncus nisl dui sit amet eros. Nulla turpis lorem, dignissim a sapien eget, ultrices venenatis dolor. Curabitur vel turpis at magna elementum hendrerit vel id dui. Curabitur a ex ullamcorper, ornare velit vel, tincidunt ipsum.',curdate(),curdate()),
       (9, 4,'Mejorar por favor en la entrega, me llego en la fecha atrasada Cras ut ipsum ornare, aliquam ipsum non, posuere elit. In hac habitasse platea dictumst. Aenean elementum leo augue, id fermentum risus efficitur vel. Nulla iaculis malesuada scelerisque. Praesent vel ipsum felis. Ut molestie, purus aliquam placerat sollicitudin, mi ligula euismod neque, non bibendum nibh neque et erat. Etiam dignissim aliquam ligula, aliquet feugiat nibh rhoncus ut. Aliquam efficitur lacinia lacinia. Morbi ac molestie lectus, vitae hendrerit nisl. Nullam metus odio, malesuada in vehicula at, consectetur nec justo. Quisque suscipit odio velit, at accumsan urna vestibulum a. Proin dictum, urna ut varius consectetur, sapien justo porta lectus, at mollis nisi orci et nulla. Donec pellentesque tortor vel nisl commodo ullamcorper.',curdate(),curdate()),
       (10, 5,'sii me gusta Vivamus rhoncus nisl sed venenatis luctus. Sed condimentum risus ut tortor feugiat laoreet. Suspendisse potenti. Donec et finibus sem, ut commodo lectus. Cras eget neque dignissim, placerat orci interdum, venenatis odio. Nulla turpis elit, consequat eu eros ac, consectetur fringilla urna. Duis gravida ex pulvinar mauris ornare, eget porttitor enim vulputate. Mauris hendrerit, massa nec aliquam cursus, ex elit euismod lorem, vehicula rhoncus nisl dui sit amet eros. Nulla turpis lorem, dignissim a sapien eget, ultrices venenatis dolor. Curabitur vel turpis at magna elementum hendrerit vel id dui. Curabitur a ex ullamcorper, ornare velit vel, tincidunt ipsum.',curdate(),curdate()),
       (11, 6,'sii me gusta Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi vitae condimentum erat. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae Sed posuere, purus at efficitur hendrerit, augue elit lacinia arcu, a eleifend sem elit et nunc. Sed rutrum vestibulum est, sit amet cursus dolor fermentum vel. Suspendisse mi nibh, congue et ante et, commodo mattis lacus.',curdate(),curdate()),
       (12, 7,'sii me gusta Vivamus rhoncus nisl sed venenatis luctus. Sed condimentum risus ut tortor feugiat laoreet. Suspendisse potenti. Donec et finibus sem, ut commodo lectus. Cras eget neque dignissim, placerat orci interdum, venenatis odio. Nulla turpis elit, consequat eu eros ac, consectetur fringilla urna. Duis gravida ex pulvinar mauris ornare, eget porttitor enim vulputate. Mauris hendrerit, massa nec aliquam cursus, ex elit euismod lorem, vehicula rhoncus nisl dui sit amet eros. Nulla turpis lorem, dignissim a sapien eget, ultrices venenatis dolor. Curabitur vel turpis at magna elementum hendrerit vel id dui. Curabitur a ex ullamcorper, ornare velit vel, tincidunt ipsum.',curdate(),curdate()),
       (13, 8,'sii me gusta Cras ut ipsum ornare, aliquam ipsum non, posuere elit. In hac habitasse platea dictumst. Aenean elementum leo augue, id fermentum risus efficitur vel. Nulla iaculis malesuada scelerisque. Praesent vel ipsum felis. Ut molestie, purus aliquam placerat sollicitudin, mi ligula euismod neque, non bibendum nibh neque et erat. Etiam dignissim aliquam ligula, aliquet feugiat nibh rhoncus ut. Aliquam efficitur lacinia lacinia. Morbi ac molestie lectus, vitae hendrerit nisl. Nullam metus odio, malesuada in vehicula at, consectetur nec justo. Quisque suscipit odio velit, at accumsan urna vestibulum a. Proin dictum, urna ut varius consectetur, sapien justo porta lectus, at mollis nisi orci et nulla. Donec pellentesque tortor vel nisl commodo ullamcorper.',curdate(),curdate()),
       (14, 9,'sii me gusta Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi vitae condimentum erat. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae Sed posuere, purus at efficitur hendrerit, augue elit lacinia arcu, a eleifend sem elit et nunc. Sed rutrum vestibulum est, sit amet cursus dolor fermentum vel. Suspendisse mi nibh, congue et ante et, commodo mattis lacus.',curdate(),curdate()),
       (15, 10,'sii me gusta Vivamus rhoncus nisl sed venenatis luctus. Sed condimentum risus ut tortor feugiat laoreet. Suspendisse potenti. Donec et finibus sem, ut commodo lectus. Cras eget neque dignissim, placerat orci interdum, venenatis odio. Nulla turpis elit, consequat eu eros ac, consectetur fringilla urna. Duis gravida ex pulvinar mauris ornare, eget porttitor enim vulputate. Mauris hendrerit, massa nec aliquam cursus, ex elit euismod lorem, vehicula rhoncus nisl dui sit amet eros. Nulla turpis lorem, dignissim a sapien eget, ultrices venenatis dolor. Curabitur vel turpis at magna elementum hendrerit vel id dui. Curabitur a ex ullamcorper, ornare velit vel, tincidunt ipsum.',curdate(),curdate()),
       (16, 11,'sii me gusta Cras ut ipsum ornare, aliquam ipsum non, posuere elit. In hac habitasse platea dictumst. Aenean elementum leo augue, id fermentum risus efficitur vel. Nulla iaculis malesuada scelerisque. Praesent vel ipsum felis. Ut molestie, purus aliquam placerat sollicitudin, mi ligula euismod neque, non bibendum nibh neque et erat. Etiam dignissim aliquam ligula, aliquet feugiat nibh rhoncus ut. Aliquam efficitur lacinia lacinia. Morbi ac molestie lectus, vitae hendrerit nisl. Nullam metus odio, malesuada in vehicula at, consectetur nec justo. Quisque suscipit odio velit, at accumsan urna vestibulum a. Proin dictum, urna ut varius consectetur, sapien justo porta lectus, at mollis nisi orci et nulla. Donec pellentesque tortor vel nisl commodo ullamcorper.',curdate(),curdate()),
       (17, 12,'sii me gusta Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi vitae condimentum erat. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae Sed posuere, purus at efficitur hendrerit, augue elit lacinia arcu, a eleifend sem elit et nunc. Sed rutrum vestibulum est, sit amet cursus dolor fermentum vel. Suspendisse mi nibh, congue et ante et, commodo mattis lacus.',curdate(),curdate()),
       (18, 13,'sii me gusta Vivamus rhoncus nisl sed venenatis luctus. Sed condimentum risus ut tortor feugiat laoreet. Suspendisse potenti. Donec et finibus sem, ut commodo lectus. Cras eget neque dignissim, placerat orci interdum, venenatis odio. Nulla turpis elit, consequat eu eros ac, consectetur fringilla urna. Duis gravida ex pulvinar mauris ornare, eget porttitor enim vulputate. Mauris hendrerit, massa nec aliquam cursus, ex elit euismod lorem, vehicula rhoncus nisl dui sit amet eros. Nulla turpis lorem, dignissim a sapien eget, ultrices venenatis dolor. Curabitur vel turpis at magna elementum hendrerit vel id dui. Curabitur a ex ullamcorper, ornare velit vel, tincidunt ipsum.',curdate(),curdate()),
       (19, 14,'sii me gusta Cras ut ipsum ornare, aliquam ipsum non, posuere elit. In hac habitasse platea dictumst. Aenean elementum leo augue, id fermentum risus efficitur vel. Nulla iaculis malesuada scelerisque. Praesent vel ipsum felis. Ut molestie, purus aliquam placerat sollicitudin, mi ligula euismod neque, non bibendum nibh neque et erat. Etiam dignissim aliquam ligula, aliquet feugiat nibh rhoncus ut. Aliquam efficitur lacinia lacinia. Morbi ac molestie lectus, vitae hendrerit nisl. Nullam metus odio, malesuada in vehicula at, consectetur nec justo. Quisque suscipit odio velit, at accumsan urna vestibulum a. Proin dictum, urna ut varius consectetur, sapien justo porta lectus, at mollis nisi orci et nulla. Donec pellentesque tortor vel nisl commodo ullamcorper. ',curdate(),curdate()),
       (20, 15,'sii me gusta Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi vitae condimentum erat. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae Sed posuere, purus at efficitur hendrerit, augue elit lacinia arcu, a eleifend sem elit et nunc. Sed rutrum vestibulum est, sit amet cursus dolor fermentum vel. Suspendisse mi nibh, congue et ante et, commodo mattis lacus.',curdate(),curdate()),
       (21, 16,'sii me gusta Cras ut ipsum ornare, aliquam ipsum non, posuere elit. In hac habitasse platea dictumst. Aenean elementum leo augue, id fermentum risus efficitur vel. Nulla iaculis malesuada scelerisque. Praesent vel ipsum felis. Ut molestie, purus aliquam placerat sollicitudin, mi ligula euismod neque, non bibendum nibh neque et erat. Etiam dignissim aliquam ligula, aliquet feugiat nibh rhoncus ut. Aliquam efficitur lacinia lacinia. Morbi ac molestie lectus, vitae hendrerit nisl. Nullam metus odio, malesuada in vehicula at, consectetur nec justo. Quisque suscipit odio velit, at accumsan urna vestibulum a. Proin dictum, urna ut varius consectetur, sapien justo porta lectus, at mollis nisi orci et nulla. Donec pellentesque tortor vel nisl commodo ullamcorper. ',curdate(),curdate()),
       (22, 17,'sii me gusta Vivamus rhoncus nisl sed venenatis luctus. Sed condimentum risus ut tortor feugiat laoreet. Suspendisse potenti. Donec et finibus sem, ut commodo lectus. Cras eget neque dignissim, placerat orci interdum, venenatis odio. Nulla turpis elit, consequat eu eros ac, consectetur fringilla urna. Duis gravida ex pulvinar mauris ornare, eget porttitor enim vulputate. Mauris hendrerit, massa nec aliquam cursus, ex elit euismod lorem, vehicula rhoncus nisl dui sit amet eros. Nulla turpis lorem, dignissim a sapien eget, ultrices venenatis dolor. Curabitur vel turpis at magna elementum hendrerit vel id dui. Curabitur a ex ullamcorper, ornare velit vel, tincidunt ipsum.',curdate(),curdate()),
       (23, 18,'sii me gusta Vivamus rhoncus nisl sed venenatis luctus. Sed condimentum risus ut tortor feugiat laoreet. Suspendisse potenti. Donec et finibus sem, ut commodo lectus. Cras eget neque dignissim, placerat orci interdum, venenatis odio. Nulla turpis elit, consequat eu eros ac, consectetur fringilla urna. Duis gravida ex pulvinar mauris ornare, eget porttitor enim vulputate. Mauris hendrerit, massa nec aliquam cursus, ex elit euismod lorem, vehicula rhoncus nisl dui sit amet eros. Nulla turpis lorem, dignissim a sapien eget, ultrices venenatis dolor. Curabitur vel turpis at magna elementum hendrerit vel id dui. Curabitur a ex ullamcorper, ornare velit vel, tincidunt ipsum.',curdate(),curdate()),
       (24, 19,'sii me gusta Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi vitae condimentum erat. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae Sed posuere, purus at efficitur hendrerit, augue elit lacinia arcu, a eleifend sem elit et nunc. Sed rutrum vestibulum est, sit amet cursus dolor fermentum vel. Suspendisse mi nibh, congue et ante et, commodo mattis lacus.',curdate(),curdate()),
       (25, 20,'sii me gusta Vivamus rhoncus nisl sed venenatis luctus. Sed condimentum risus ut tortor feugiat laoreet. Suspendisse potenti. Donec et finibus sem, ut commodo lectus. Cras eget neque dignissim, placerat orci interdum, venenatis odio. Nulla turpis elit, consequat eu eros ac, consectetur fringilla urna. Duis gravida ex pulvinar mauris ornare, eget porttitor enim vulputate. Mauris hendrerit, massa nec aliquam cursus, ex elit euismod lorem, vehicula rhoncus nisl dui sit amet eros. Nulla turpis lorem, dignissim a sapien eget, ultrices venenatis dolor. Curabitur vel turpis at magna elementum hendrerit vel id dui. Curabitur a ex ullamcorper, ornare velit vel, tincidunt ipsum.',curdate(),curdate());
       
      -- 3 parte

insert into commentary_articles (article_id, client_id , comment ,created_at,updated_at) 
values (1, 21,'sii me gusta Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi vitae condimentum erat. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae Sed posuere, purus at efficitur hendrerit, augue elit lacinia arcu, a eleifend sem elit et nunc. Sed rutrum vestibulum est, sit amet cursus dolor fermentum vel. Suspendisse mi nibh, congue et ante et, commodo mattis lacus.',curdate(),curdate()),
       (2, 22,'sii me gusta Vivamus rhoncus nisl sed venenatis luctus. Sed condimentum risus ut tortor feugiat laoreet. Suspendisse potenti. Donec et finibus sem, ut commodo lectus. Cras eget neque dignissim, placerat orci interdum, venenatis odio. Nulla turpis elit, consequat eu eros ac, consectetur fringilla urna. Duis gravida ex pulvinar mauris ornare, eget porttitor enim vulputate. Mauris hendrerit, massa nec aliquam cursus, ex elit euismod lorem, vehicula rhoncus nisl dui sit amet eros. Nulla turpis lorem, dignissim a sapien eget, ultrices venenatis dolor. Curabitur vel turpis at magna elementum hendrerit vel id dui. Curabitur a ex ullamcorper, ornare velit vel, tincidunt ipsum.',curdate(),curdate()),
       (3, 23,'sii me gusta Cras ut ipsum ornare, aliquam ipsum non, posuere elit. In hac habitasse platea dictumst. Aenean elementum leo augue, id fermentum risus efficitur vel. Nulla iaculis malesuada scelerisque. Praesent vel ipsum felis. Ut molestie, purus aliquam placerat sollicitudin, mi ligula euismod neque, non bibendum nibh neque et erat. Etiam dignissim aliquam ligula, aliquet feugiat nibh rhoncus ut. Aliquam efficitur lacinia lacinia. Morbi ac molestie lectus, vitae hendrerit nisl. Nullam metus odio, malesuada in vehicula at, consectetur nec justo. Quisque suscipit odio velit, at accumsan urna vestibulum a. Proin dictum, urna ut varius consectetur, sapien justo porta lectus, at mollis nisi orci et nulla. Donec pellentesque tortor vel nisl commodo ullamcorper.',curdate(),curdate()),
       (4, 24,'Mas u menos Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi vitae condimentum erat. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae Sed posuere, purus at efficitur hendrerit, augue elit lacinia arcu, a eleifend sem elit et nunc. Sed rutrum vestibulum est, sit amet cursus dolor fermentum vel. Suspendisse mi nibh, congue et ante et, commodo mattis lacus.',curdate(),curdate()),
       (5, 25,'sii me gusta Vivamus rhoncus nisl sed venenatis luctus. Sed condimentum risus ut tortor feugiat laoreet. Suspendisse potenti. Donec et finibus sem, ut commodo lectus. Cras eget neque dignissim, placerat orci interdum, venenatis odio. Nulla turpis elit, consequat eu eros ac, consectetur fringilla urna. Duis gravida ex pulvinar mauris ornare, eget porttitor enim vulputate. Mauris hendrerit, massa nec aliquam cursus, ex elit euismod lorem, vehicula rhoncus nisl dui sit amet eros. Nulla turpis lorem, dignissim a sapien eget, ultrices venenatis dolor. Curabitur vel turpis at magna elementum hendrerit vel id dui. Curabitur a ex ullamcorper, ornare velit vel, tincidunt ipsum.',curdate(),curdate()),
       (6, 26,'sii me gusta Cras ut ipsum ornare, aliquam ipsum non, posuere elit. In hac habitasse platea dictumst. Aenean elementum leo augue, id fermentum risus efficitur vel. Nulla iaculis malesuada scelerisque. Praesent vel ipsum felis. Ut molestie, purus aliquam placerat sollicitudin, mi ligula euismod neque, non bibendum nibh neque et erat. Etiam dignissim aliquam ligula, aliquet feugiat nibh rhoncus ut. Aliquam efficitur lacinia lacinia. Morbi ac molestie lectus, vitae hendrerit nisl. Nullam metus odio, malesuada in vehicula at, consectetur nec justo. Quisque suscipit odio velit, at accumsan urna vestibulum a. Proin dictum, urna ut varius consectetur, sapien justo porta lectus, at mollis nisi orci et nulla. Donec pellentesque tortor vel nisl commodo ullamcorper.',curdate(),curdate()),
       (7, 27,'Gracias fue de mi agrado Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi vitae condimentum erat. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae Sed posuere, purus at efficitur hendrerit, augue elit lacinia arcu, a eleifend sem elit et nunc. Sed rutrum vestibulum est, sit amet cursus dolor fermentum vel. Suspendisse mi nibh, congue et ante et, commodo mattis lacus.',curdate(),curdate()),
       (8, 28,'sii me gusta Vivamus rhoncus nisl sed venenatis luctus. Sed condimentum risus ut tortor feugiat laoreet. Suspendisse potenti. Donec et finibus sem, ut commodo lectus. Cras eget neque dignissim, placerat orci interdum, venenatis odio. Nulla turpis elit, consequat eu eros ac, consectetur fringilla urna. Duis gravida ex pulvinar mauris ornare, eget porttitor enim vulputate. Mauris hendrerit, massa nec aliquam cursus, ex elit euismod lorem, vehicula rhoncus nisl dui sit amet eros. Nulla turpis lorem, dignissim a sapien eget, ultrices venenatis dolor. Curabitur vel turpis at magna elementum hendrerit vel id dui. Curabitur a ex ullamcorper, ornare velit vel, tincidunt ipsum.',curdate(),curdate()),
       (9, 29,'Mejorar por favor en la entrega, me llego en la fecha atrasada Cras ut ipsum ornare, aliquam ipsum non, posuere elit. In hac habitasse platea dictumst. Aenean elementum leo augue, id fermentum risus efficitur vel. Nulla iaculis malesuada scelerisque. Praesent vel ipsum felis. Ut molestie, purus aliquam placerat sollicitudin, mi ligula euismod neque, non bibendum nibh neque et erat. Etiam dignissim aliquam ligula, aliquet feugiat nibh rhoncus ut. Aliquam efficitur lacinia lacinia. Morbi ac molestie lectus, vitae hendrerit nisl. Nullam metus odio, malesuada in vehicula at, consectetur nec justo. Quisque suscipit odio velit, at accumsan urna vestibulum a. Proin dictum, urna ut varius consectetur, sapien justo porta lectus, at mollis nisi orci et nulla. Donec pellentesque tortor vel nisl commodo ullamcorper.',curdate(),curdate()),
       (10, 30,'sii me gusta Vivamus rhoncus nisl sed venenatis luctus. Sed condimentum risus ut tortor feugiat laoreet. Suspendisse potenti. Donec et finibus sem, ut commodo lectus. Cras eget neque dignissim, placerat orci interdum, venenatis odio. Nulla turpis elit, consequat eu eros ac, consectetur fringilla urna. Duis gravida ex pulvinar mauris ornare, eget porttitor enim vulputate. Mauris hendrerit, massa nec aliquam cursus, ex elit euismod lorem, vehicula rhoncus nisl dui sit amet eros. Nulla turpis lorem, dignissim a sapien eget, ultrices venenatis dolor. Curabitur vel turpis at magna elementum hendrerit vel id dui. Curabitur a ex ullamcorper, ornare velit vel, tincidunt ipsum.',curdate(),curdate()),
       (11, 1,'sii me gusta Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi vitae condimentum erat. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae Sed posuere, purus at efficitur hendrerit, augue elit lacinia arcu, a eleifend sem elit et nunc. Sed rutrum vestibulum est, sit amet cursus dolor fermentum vel. Suspendisse mi nibh, congue et ante et, commodo mattis lacus.',curdate(),curdate()),
       (12, 2,'sii me gusta Vivamus rhoncus nisl sed venenatis luctus. Sed condimentum risus ut tortor feugiat laoreet. Suspendisse potenti. Donec et finibus sem, ut commodo lectus. Cras eget neque dignissim, placerat orci interdum, venenatis odio. Nulla turpis elit, consequat eu eros ac, consectetur fringilla urna. Duis gravida ex pulvinar mauris ornare, eget porttitor enim vulputate. Mauris hendrerit, massa nec aliquam cursus, ex elit euismod lorem, vehicula rhoncus nisl dui sit amet eros. Nulla turpis lorem, dignissim a sapien eget, ultrices venenatis dolor. Curabitur vel turpis at magna elementum hendrerit vel id dui. Curabitur a ex ullamcorper, ornare velit vel, tincidunt ipsum.',curdate(),curdate()),
       (13, 3,'sii me gusta Cras ut ipsum ornare, aliquam ipsum non, posuere elit. In hac habitasse platea dictumst. Aenean elementum leo augue, id fermentum risus efficitur vel. Nulla iaculis malesuada scelerisque. Praesent vel ipsum felis. Ut molestie, purus aliquam placerat sollicitudin, mi ligula euismod neque, non bibendum nibh neque et erat. Etiam dignissim aliquam ligula, aliquet feugiat nibh rhoncus ut. Aliquam efficitur lacinia lacinia. Morbi ac molestie lectus, vitae hendrerit nisl. Nullam metus odio, malesuada in vehicula at, consectetur nec justo. Quisque suscipit odio velit, at accumsan urna vestibulum a. Proin dictum, urna ut varius consectetur, sapien justo porta lectus, at mollis nisi orci et nulla. Donec pellentesque tortor vel nisl commodo ullamcorper.',curdate(),curdate()),
       (14, 4,'sii me gusta Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi vitae condimentum erat. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae Sed posuere, purus at efficitur hendrerit, augue elit lacinia arcu, a eleifend sem elit et nunc. Sed rutrum vestibulum est, sit amet cursus dolor fermentum vel. Suspendisse mi nibh, congue et ante et, commodo mattis lacus.',curdate(),curdate()),
       (15, 5,'sii me gusta Vivamus rhoncus nisl sed venenatis luctus. Sed condimentum risus ut tortor feugiat laoreet. Suspendisse potenti. Donec et finibus sem, ut commodo lectus. Cras eget neque dignissim, placerat orci interdum, venenatis odio. Nulla turpis elit, consequat eu eros ac, consectetur fringilla urna. Duis gravida ex pulvinar mauris ornare, eget porttitor enim vulputate. Mauris hendrerit, massa nec aliquam cursus, ex elit euismod lorem, vehicula rhoncus nisl dui sit amet eros. Nulla turpis lorem, dignissim a sapien eget, ultrices venenatis dolor. Curabitur vel turpis at magna elementum hendrerit vel id dui. Curabitur a ex ullamcorper, ornare velit vel, tincidunt ipsum.',curdate(),curdate()),
       (16, 6,'sii me gusta Cras ut ipsum ornare, aliquam ipsum non, posuere elit. In hac habitasse platea dictumst. Aenean elementum leo augue, id fermentum risus efficitur vel. Nulla iaculis malesuada scelerisque. Praesent vel ipsum felis. Ut molestie, purus aliquam placerat sollicitudin, mi ligula euismod neque, non bibendum nibh neque et erat. Etiam dignissim aliquam ligula, aliquet feugiat nibh rhoncus ut. Aliquam efficitur lacinia lacinia. Morbi ac molestie lectus, vitae hendrerit nisl. Nullam metus odio, malesuada in vehicula at, consectetur nec justo. Quisque suscipit odio velit, at accumsan urna vestibulum a. Proin dictum, urna ut varius consectetur, sapien justo porta lectus, at mollis nisi orci et nulla. Donec pellentesque tortor vel nisl commodo ullamcorper.',curdate(),curdate()),
       (17, 7,'sii me gusta Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi vitae condimentum erat. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae Sed posuere, purus at efficitur hendrerit, augue elit lacinia arcu, a eleifend sem elit et nunc. Sed rutrum vestibulum est, sit amet cursus dolor fermentum vel. Suspendisse mi nibh, congue et ante et, commodo mattis lacus.',curdate(),curdate()),
       (18, 8,'sii me gusta Vivamus rhoncus nisl sed venenatis luctus. Sed condimentum risus ut tortor feugiat laoreet. Suspendisse potenti. Donec et finibus sem, ut commodo lectus. Cras eget neque dignissim, placerat orci interdum, venenatis odio. Nulla turpis elit, consequat eu eros ac, consectetur fringilla urna. Duis gravida ex pulvinar mauris ornare, eget porttitor enim vulputate. Mauris hendrerit, massa nec aliquam cursus, ex elit euismod lorem, vehicula rhoncus nisl dui sit amet eros. Nulla turpis lorem, dignissim a sapien eget, ultrices venenatis dolor. Curabitur vel turpis at magna elementum hendrerit vel id dui. Curabitur a ex ullamcorper, ornare velit vel, tincidunt ipsum.',curdate(),curdate()),
       (19, 9,'sii me gusta Cras ut ipsum ornare, aliquam ipsum non, posuere elit. In hac habitasse platea dictumst. Aenean elementum leo augue, id fermentum risus efficitur vel. Nulla iaculis malesuada scelerisque. Praesent vel ipsum felis. Ut molestie, purus aliquam placerat sollicitudin, mi ligula euismod neque, non bibendum nibh neque et erat. Etiam dignissim aliquam ligula, aliquet feugiat nibh rhoncus ut. Aliquam efficitur lacinia lacinia. Morbi ac molestie lectus, vitae hendrerit nisl. Nullam metus odio, malesuada in vehicula at, consectetur nec justo. Quisque suscipit odio velit, at accumsan urna vestibulum a. Proin dictum, urna ut varius consectetur, sapien justo porta lectus, at mollis nisi orci et nulla. Donec pellentesque tortor vel nisl commodo ullamcorper. ',curdate(),curdate()),
       (20, 10,'sii me gusta Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi vitae condimentum erat. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae Sed posuere, purus at efficitur hendrerit, augue elit lacinia arcu, a eleifend sem elit et nunc. Sed rutrum vestibulum est, sit amet cursus dolor fermentum vel. Suspendisse mi nibh, congue et ante et, commodo mattis lacus.',curdate(),curdate()),
       (21, 11,'sii me gusta Cras ut ipsum ornare, aliquam ipsum non, posuere elit. In hac habitasse platea dictumst. Aenean elementum leo augue, id fermentum risus efficitur vel. Nulla iaculis malesuada scelerisque. Praesent vel ipsum felis. Ut molestie, purus aliquam placerat sollicitudin, mi ligula euismod neque, non bibendum nibh neque et erat. Etiam dignissim aliquam ligula, aliquet feugiat nibh rhoncus ut. Aliquam efficitur lacinia lacinia. Morbi ac molestie lectus, vitae hendrerit nisl. Nullam metus odio, malesuada in vehicula at, consectetur nec justo. Quisque suscipit odio velit, at accumsan urna vestibulum a. Proin dictum, urna ut varius consectetur, sapien justo porta lectus, at mollis nisi orci et nulla. Donec pellentesque tortor vel nisl commodo ullamcorper. ',curdate(),curdate()),
       (22, 12,'sii me gusta Vivamus rhoncus nisl sed venenatis luctus. Sed condimentum risus ut tortor feugiat laoreet. Suspendisse potenti. Donec et finibus sem, ut commodo lectus. Cras eget neque dignissim, placerat orci interdum, venenatis odio. Nulla turpis elit, consequat eu eros ac, consectetur fringilla urna. Duis gravida ex pulvinar mauris ornare, eget porttitor enim vulputate. Mauris hendrerit, massa nec aliquam cursus, ex elit euismod lorem, vehicula rhoncus nisl dui sit amet eros. Nulla turpis lorem, dignissim a sapien eget, ultrices venenatis dolor. Curabitur vel turpis at magna elementum hendrerit vel id dui. Curabitur a ex ullamcorper, ornare velit vel, tincidunt ipsum.',curdate(),curdate()),
       (23, 13,'sii me gusta Vivamus rhoncus nisl sed venenatis luctus. Sed condimentum risus ut tortor feugiat laoreet. Suspendisse potenti. Donec et finibus sem, ut commodo lectus. Cras eget neque dignissim, placerat orci interdum, venenatis odio. Nulla turpis elit, consequat eu eros ac, consectetur fringilla urna. Duis gravida ex pulvinar mauris ornare, eget porttitor enim vulputate. Mauris hendrerit, massa nec aliquam cursus, ex elit euismod lorem, vehicula rhoncus nisl dui sit amet eros. Nulla turpis lorem, dignissim a sapien eget, ultrices venenatis dolor. Curabitur vel turpis at magna elementum hendrerit vel id dui. Curabitur a ex ullamcorper, ornare velit vel, tincidunt ipsum.',curdate(),curdate()),
       (24, 14,'sii me gusta Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi vitae condimentum erat. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae Sed posuere, purus at efficitur hendrerit, augue elit lacinia arcu, a eleifend sem elit et nunc. Sed rutrum vestibulum est, sit amet cursus dolor fermentum vel. Suspendisse mi nibh, congue et ante et, commodo mattis lacus.',curdate(),curdate()),
       (25, 15,'sii me gusta Vivamus rhoncus nisl sed venenatis luctus. Sed condimentum risus ut tortor feugiat laoreet. Suspendisse potenti. Donec et finibus sem, ut commodo lectus. Cras eget neque dignissim, placerat orci interdum, venenatis odio. Nulla turpis elit, consequat eu eros ac, consectetur fringilla urna. Duis gravida ex pulvinar mauris ornare, eget porttitor enim vulputate. Mauris hendrerit, massa nec aliquam cursus, ex elit euismod lorem, vehicula rhoncus nisl dui sit amet eros. Nulla turpis lorem, dignissim a sapien eget, ultrices venenatis dolor. Curabitur vel turpis at magna elementum hendrerit vel id dui. Curabitur a ex ullamcorper, ornare velit vel, tincidunt ipsum.',curdate(),curdate());
       
      -- 4 parte 

insert into commentary_articles (article_id, client_id , comment ,created_at,updated_at) 
values (1, 16,'sii me gusta Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi vitae condimentum erat. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae Sed posuere, purus at efficitur hendrerit, augue elit lacinia arcu, a eleifend sem elit et nunc. Sed rutrum vestibulum est, sit amet cursus dolor fermentum vel. Suspendisse mi nibh, congue et ante et, commodo mattis lacus.',curdate(),curdate()),
       (2, 17,'sii me gusta Vivamus rhoncus nisl sed venenatis luctus. Sed condimentum risus ut tortor feugiat laoreet. Suspendisse potenti. Donec et finibus sem, ut commodo lectus. Cras eget neque dignissim, placerat orci interdum, venenatis odio. Nulla turpis elit, consequat eu eros ac, consectetur fringilla urna. Duis gravida ex pulvinar mauris ornare, eget porttitor enim vulputate. Mauris hendrerit, massa nec aliquam cursus, ex elit euismod lorem, vehicula rhoncus nisl dui sit amet eros. Nulla turpis lorem, dignissim a sapien eget, ultrices venenatis dolor. Curabitur vel turpis at magna elementum hendrerit vel id dui. Curabitur a ex ullamcorper, ornare velit vel, tincidunt ipsum.',curdate(),curdate()),
       (3, 18,'sii me gusta Cras ut ipsum ornare, aliquam ipsum non, posuere elit. In hac habitasse platea dictumst. Aenean elementum leo augue, id fermentum risus efficitur vel. Nulla iaculis malesuada scelerisque. Praesent vel ipsum felis. Ut molestie, purus aliquam placerat sollicitudin, mi ligula euismod neque, non bibendum nibh neque et erat. Etiam dignissim aliquam ligula, aliquet feugiat nibh rhoncus ut. Aliquam efficitur lacinia lacinia. Morbi ac molestie lectus, vitae hendrerit nisl. Nullam metus odio, malesuada in vehicula at, consectetur nec justo. Quisque suscipit odio velit, at accumsan urna vestibulum a. Proin dictum, urna ut varius consectetur, sapien justo porta lectus, at mollis nisi orci et nulla. Donec pellentesque tortor vel nisl commodo ullamcorper.',curdate(),curdate()),
       (4, 19,'Mas u menos Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi vitae condimentum erat. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae Sed posuere, purus at efficitur hendrerit, augue elit lacinia arcu, a eleifend sem elit et nunc. Sed rutrum vestibulum est, sit amet cursus dolor fermentum vel. Suspendisse mi nibh, congue et ante et, commodo mattis lacus.',curdate(),curdate()),
       (5, 20,'sii me gusta Vivamus rhoncus nisl sed venenatis luctus. Sed condimentum risus ut tortor feugiat laoreet. Suspendisse potenti. Donec et finibus sem, ut commodo lectus. Cras eget neque dignissim, placerat orci interdum, venenatis odio. Nulla turpis elit, consequat eu eros ac, consectetur fringilla urna. Duis gravida ex pulvinar mauris ornare, eget porttitor enim vulputate. Mauris hendrerit, massa nec aliquam cursus, ex elit euismod lorem, vehicula rhoncus nisl dui sit amet eros. Nulla turpis lorem, dignissim a sapien eget, ultrices venenatis dolor. Curabitur vel turpis at magna elementum hendrerit vel id dui. Curabitur a ex ullamcorper, ornare velit vel, tincidunt ipsum.',curdate(),curdate()),
       (6, 21,'sii me gusta Cras ut ipsum ornare, aliquam ipsum non, posuere elit. In hac habitasse platea dictumst. Aenean elementum leo augue, id fermentum risus efficitur vel. Nulla iaculis malesuada scelerisque. Praesent vel ipsum felis. Ut molestie, purus aliquam placerat sollicitudin, mi ligula euismod neque, non bibendum nibh neque et erat. Etiam dignissim aliquam ligula, aliquet feugiat nibh rhoncus ut. Aliquam efficitur lacinia lacinia. Morbi ac molestie lectus, vitae hendrerit nisl. Nullam metus odio, malesuada in vehicula at, consectetur nec justo. Quisque suscipit odio velit, at accumsan urna vestibulum a. Proin dictum, urna ut varius consectetur, sapien justo porta lectus, at mollis nisi orci et nulla. Donec pellentesque tortor vel nisl commodo ullamcorper.',curdate(),curdate()),
       (7, 22,'Gracias fue de mi agrado Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi vitae condimentum erat. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae Sed posuere, purus at efficitur hendrerit, augue elit lacinia arcu, a eleifend sem elit et nunc. Sed rutrum vestibulum est, sit amet cursus dolor fermentum vel. Suspendisse mi nibh, congue et ante et, commodo mattis lacus.',curdate(),curdate()),
       (8, 23,'sii me gusta Vivamus rhoncus nisl sed venenatis luctus. Sed condimentum risus ut tortor feugiat laoreet. Suspendisse potenti. Donec et finibus sem, ut commodo lectus. Cras eget neque dignissim, placerat orci interdum, venenatis odio. Nulla turpis elit, consequat eu eros ac, consectetur fringilla urna. Duis gravida ex pulvinar mauris ornare, eget porttitor enim vulputate. Mauris hendrerit, massa nec aliquam cursus, ex elit euismod lorem, vehicula rhoncus nisl dui sit amet eros. Nulla turpis lorem, dignissim a sapien eget, ultrices venenatis dolor. Curabitur vel turpis at magna elementum hendrerit vel id dui. Curabitur a ex ullamcorper, ornare velit vel, tincidunt ipsum.',curdate(),curdate()),
       (9, 24,'Mejorar por favor en la entrega, me llego en la fecha atrasada Cras ut ipsum ornare, aliquam ipsum non, posuere elit. In hac habitasse platea dictumst. Aenean elementum leo augue, id fermentum risus efficitur vel. Nulla iaculis malesuada scelerisque. Praesent vel ipsum felis. Ut molestie, purus aliquam placerat sollicitudin, mi ligula euismod neque, non bibendum nibh neque et erat. Etiam dignissim aliquam ligula, aliquet feugiat nibh rhoncus ut. Aliquam efficitur lacinia lacinia. Morbi ac molestie lectus, vitae hendrerit nisl. Nullam metus odio, malesuada in vehicula at, consectetur nec justo. Quisque suscipit odio velit, at accumsan urna vestibulum a. Proin dictum, urna ut varius consectetur, sapien justo porta lectus, at mollis nisi orci et nulla. Donec pellentesque tortor vel nisl commodo ullamcorper.',curdate(),curdate()),
       (10, 25,'sii me gusta Vivamus rhoncus nisl sed venenatis luctus. Sed condimentum risus ut tortor feugiat laoreet. Suspendisse potenti. Donec et finibus sem, ut commodo lectus. Cras eget neque dignissim, placerat orci interdum, venenatis odio. Nulla turpis elit, consequat eu eros ac, consectetur fringilla urna. Duis gravida ex pulvinar mauris ornare, eget porttitor enim vulputate. Mauris hendrerit, massa nec aliquam cursus, ex elit euismod lorem, vehicula rhoncus nisl dui sit amet eros. Nulla turpis lorem, dignissim a sapien eget, ultrices venenatis dolor. Curabitur vel turpis at magna elementum hendrerit vel id dui. Curabitur a ex ullamcorper, ornare velit vel, tincidunt ipsum.',curdate(),curdate()),
       (11, 26,'sii me gusta Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi vitae condimentum erat. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae Sed posuere, purus at efficitur hendrerit, augue elit lacinia arcu, a eleifend sem elit et nunc. Sed rutrum vestibulum est, sit amet cursus dolor fermentum vel. Suspendisse mi nibh, congue et ante et, commodo mattis lacus.',curdate(),curdate()),
       (12, 27,'sii me gusta Vivamus rhoncus nisl sed venenatis luctus. Sed condimentum risus ut tortor feugiat laoreet. Suspendisse potenti. Donec et finibus sem, ut commodo lectus. Cras eget neque dignissim, placerat orci interdum, venenatis odio. Nulla turpis elit, consequat eu eros ac, consectetur fringilla urna. Duis gravida ex pulvinar mauris ornare, eget porttitor enim vulputate. Mauris hendrerit, massa nec aliquam cursus, ex elit euismod lorem, vehicula rhoncus nisl dui sit amet eros. Nulla turpis lorem, dignissim a sapien eget, ultrices venenatis dolor. Curabitur vel turpis at magna elementum hendrerit vel id dui. Curabitur a ex ullamcorper, ornare velit vel, tincidunt ipsum.',curdate(),curdate()),
       (13, 28,'sii me gusta Cras ut ipsum ornare, aliquam ipsum non, posuere elit. In hac habitasse platea dictumst. Aenean elementum leo augue, id fermentum risus efficitur vel. Nulla iaculis malesuada scelerisque. Praesent vel ipsum felis. Ut molestie, purus aliquam placerat sollicitudin, mi ligula euismod neque, non bibendum nibh neque et erat. Etiam dignissim aliquam ligula, aliquet feugiat nibh rhoncus ut. Aliquam efficitur lacinia lacinia. Morbi ac molestie lectus, vitae hendrerit nisl. Nullam metus odio, malesuada in vehicula at, consectetur nec justo. Quisque suscipit odio velit, at accumsan urna vestibulum a. Proin dictum, urna ut varius consectetur, sapien justo porta lectus, at mollis nisi orci et nulla. Donec pellentesque tortor vel nisl commodo ullamcorper.',curdate(),curdate()),
       (14, 29,'sii me gusta Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi vitae condimentum erat. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae Sed posuere, purus at efficitur hendrerit, augue elit lacinia arcu, a eleifend sem elit et nunc. Sed rutrum vestibulum est, sit amet cursus dolor fermentum vel. Suspendisse mi nibh, congue et ante et, commodo mattis lacus.',curdate(),curdate()),
       (15, 30,'sii me gusta Vivamus rhoncus nisl sed venenatis luctus. Sed condimentum risus ut tortor feugiat laoreet. Suspendisse potenti. Donec et finibus sem, ut commodo lectus. Cras eget neque dignissim, placerat orci interdum, venenatis odio. Nulla turpis elit, consequat eu eros ac, consectetur fringilla urna. Duis gravida ex pulvinar mauris ornare, eget porttitor enim vulputate. Mauris hendrerit, massa nec aliquam cursus, ex elit euismod lorem, vehicula rhoncus nisl dui sit amet eros. Nulla turpis lorem, dignissim a sapien eget, ultrices venenatis dolor. Curabitur vel turpis at magna elementum hendrerit vel id dui. Curabitur a ex ullamcorper, ornare velit vel, tincidunt ipsum.',curdate(),curdate()),
       (16, 1,'sii me gusta Cras ut ipsum ornare, aliquam ipsum non, posuere elit. In hac habitasse platea dictumst. Aenean elementum leo augue, id fermentum risus efficitur vel. Nulla iaculis malesuada scelerisque. Praesent vel ipsum felis. Ut molestie, purus aliquam placerat sollicitudin, mi ligula euismod neque, non bibendum nibh neque et erat. Etiam dignissim aliquam ligula, aliquet feugiat nibh rhoncus ut. Aliquam efficitur lacinia lacinia. Morbi ac molestie lectus, vitae hendrerit nisl. Nullam metus odio, malesuada in vehicula at, consectetur nec justo. Quisque suscipit odio velit, at accumsan urna vestibulum a. Proin dictum, urna ut varius consectetur, sapien justo porta lectus, at mollis nisi orci et nulla. Donec pellentesque tortor vel nisl commodo ullamcorper.',curdate(),curdate()),
       (17, 2,'sii me gusta Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi vitae condimentum erat. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae Sed posuere, purus at efficitur hendrerit, augue elit lacinia arcu, a eleifend sem elit et nunc. Sed rutrum vestibulum est, sit amet cursus dolor fermentum vel. Suspendisse mi nibh, congue et ante et, commodo mattis lacus.',curdate(),curdate()),
       (18, 3,'sii me gusta Vivamus rhoncus nisl sed venenatis luctus. Sed condimentum risus ut tortor feugiat laoreet. Suspendisse potenti. Donec et finibus sem, ut commodo lectus. Cras eget neque dignissim, placerat orci interdum, venenatis odio. Nulla turpis elit, consequat eu eros ac, consectetur fringilla urna. Duis gravida ex pulvinar mauris ornare, eget porttitor enim vulputate. Mauris hendrerit, massa nec aliquam cursus, ex elit euismod lorem, vehicula rhoncus nisl dui sit amet eros. Nulla turpis lorem, dignissim a sapien eget, ultrices venenatis dolor. Curabitur vel turpis at magna elementum hendrerit vel id dui. Curabitur a ex ullamcorper, ornare velit vel, tincidunt ipsum.',curdate(),curdate()),
       (19, 4,'sii me gusta Cras ut ipsum ornare, aliquam ipsum non, posuere elit. In hac habitasse platea dictumst. Aenean elementum leo augue, id fermentum risus efficitur vel. Nulla iaculis malesuada scelerisque. Praesent vel ipsum felis. Ut molestie, purus aliquam placerat sollicitudin, mi ligula euismod neque, non bibendum nibh neque et erat. Etiam dignissim aliquam ligula, aliquet feugiat nibh rhoncus ut. Aliquam efficitur lacinia lacinia. Morbi ac molestie lectus, vitae hendrerit nisl. Nullam metus odio, malesuada in vehicula at, consectetur nec justo. Quisque suscipit odio velit, at accumsan urna vestibulum a. Proin dictum, urna ut varius consectetur, sapien justo porta lectus, at mollis nisi orci et nulla. Donec pellentesque tortor vel nisl commodo ullamcorper. ',curdate(),curdate()),
       (20, 5,'sii me gusta Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi vitae condimentum erat. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae Sed posuere, purus at efficitur hendrerit, augue elit lacinia arcu, a eleifend sem elit et nunc. Sed rutrum vestibulum est, sit amet cursus dolor fermentum vel. Suspendisse mi nibh, congue et ante et, commodo mattis lacus.',curdate(),curdate()),
       (21, 6,'sii me gusta Cras ut ipsum ornare, aliquam ipsum non, posuere elit. In hac habitasse platea dictumst. Aenean elementum leo augue, id fermentum risus efficitur vel. Nulla iaculis malesuada scelerisque. Praesent vel ipsum felis. Ut molestie, purus aliquam placerat sollicitudin, mi ligula euismod neque, non bibendum nibh neque et erat. Etiam dignissim aliquam ligula, aliquet feugiat nibh rhoncus ut. Aliquam efficitur lacinia lacinia. Morbi ac molestie lectus, vitae hendrerit nisl. Nullam metus odio, malesuada in vehicula at, consectetur nec justo. Quisque suscipit odio velit, at accumsan urna vestibulum a. Proin dictum, urna ut varius consectetur, sapien justo porta lectus, at mollis nisi orci et nulla. Donec pellentesque tortor vel nisl commodo ullamcorper. ',curdate(),curdate()),
       (22, 7,'sii me gusta Vivamus rhoncus nisl sed venenatis luctus. Sed condimentum risus ut tortor feugiat laoreet. Suspendisse potenti. Donec et finibus sem, ut commodo lectus. Cras eget neque dignissim, placerat orci interdum, venenatis odio. Nulla turpis elit, consequat eu eros ac, consectetur fringilla urna. Duis gravida ex pulvinar mauris ornare, eget porttitor enim vulputate. Mauris hendrerit, massa nec aliquam cursus, ex elit euismod lorem, vehicula rhoncus nisl dui sit amet eros. Nulla turpis lorem, dignissim a sapien eget, ultrices venenatis dolor. Curabitur vel turpis at magna elementum hendrerit vel id dui. Curabitur a ex ullamcorper, ornare velit vel, tincidunt ipsum.',curdate(),curdate()),
       (23, 8,'sii me gusta Vivamus rhoncus nisl sed venenatis luctus. Sed condimentum risus ut tortor feugiat laoreet. Suspendisse potenti. Donec et finibus sem, ut commodo lectus. Cras eget neque dignissim, placerat orci interdum, venenatis odio. Nulla turpis elit, consequat eu eros ac, consectetur fringilla urna. Duis gravida ex pulvinar mauris ornare, eget porttitor enim vulputate. Mauris hendrerit, massa nec aliquam cursus, ex elit euismod lorem, vehicula rhoncus nisl dui sit amet eros. Nulla turpis lorem, dignissim a sapien eget, ultrices venenatis dolor. Curabitur vel turpis at magna elementum hendrerit vel id dui. Curabitur a ex ullamcorper, ornare velit vel, tincidunt ipsum.',curdate(),curdate()),
       (24, 9,'sii me gusta Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi vitae condimentum erat. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae Sed posuere, purus at efficitur hendrerit, augue elit lacinia arcu, a eleifend sem elit et nunc. Sed rutrum vestibulum est, sit amet cursus dolor fermentum vel. Suspendisse mi nibh, congue et ante et, commodo mattis lacus.',curdate(),curdate()),
       (25, 10,'sii me gusta Vivamus rhoncus nisl sed venenatis luctus. Sed condimentum risus ut tortor feugiat laoreet. Suspendisse potenti. Donec et finibus sem, ut commodo lectus. Cras eget neque dignissim, placerat orci interdum, venenatis odio. Nulla turpis elit, consequat eu eros ac, consectetur fringilla urna. Duis gravida ex pulvinar mauris ornare, eget porttitor enim vulputate. Mauris hendrerit, massa nec aliquam cursus, ex elit euismod lorem, vehicula rhoncus nisl dui sit amet eros. Nulla turpis lorem, dignissim a sapien eget, ultrices venenatis dolor. Curabitur vel turpis at magna elementum hendrerit vel id dui. Curabitur a ex ullamcorper, ornare velit vel, tincidunt ipsum.',curdate(),curdate());
       
      -- 5 parte

insert into commentary_articles (article_id, client_id , comment ,created_at,updated_at) 
values (1, 11,'sii me gusta Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi vitae condimentum erat. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae Sed posuere, purus at efficitur hendrerit, augue elit lacinia arcu, a eleifend sem elit et nunc. Sed rutrum vestibulum est, sit amet cursus dolor fermentum vel. Suspendisse mi nibh, congue et ante et, commodo mattis lacus.',curdate(),curdate()),
       (2, 12,'sii me gusta Vivamus rhoncus nisl sed venenatis luctus. Sed condimentum risus ut tortor feugiat laoreet. Suspendisse potenti. Donec et finibus sem, ut commodo lectus. Cras eget neque dignissim, placerat orci interdum, venenatis odio. Nulla turpis elit, consequat eu eros ac, consectetur fringilla urna. Duis gravida ex pulvinar mauris ornare, eget porttitor enim vulputate. Mauris hendrerit, massa nec aliquam cursus, ex elit euismod lorem, vehicula rhoncus nisl dui sit amet eros. Nulla turpis lorem, dignissim a sapien eget, ultrices venenatis dolor. Curabitur vel turpis at magna elementum hendrerit vel id dui. Curabitur a ex ullamcorper, ornare velit vel, tincidunt ipsum.',curdate(),curdate()),
       (3, 13,'sii me gusta Cras ut ipsum ornare, aliquam ipsum non, posuere elit. In hac habitasse platea dictumst. Aenean elementum leo augue, id fermentum risus efficitur vel. Nulla iaculis malesuada scelerisque. Praesent vel ipsum felis. Ut molestie, purus aliquam placerat sollicitudin, mi ligula euismod neque, non bibendum nibh neque et erat. Etiam dignissim aliquam ligula, aliquet feugiat nibh rhoncus ut. Aliquam efficitur lacinia lacinia. Morbi ac molestie lectus, vitae hendrerit nisl. Nullam metus odio, malesuada in vehicula at, consectetur nec justo. Quisque suscipit odio velit, at accumsan urna vestibulum a. Proin dictum, urna ut varius consectetur, sapien justo porta lectus, at mollis nisi orci et nulla. Donec pellentesque tortor vel nisl commodo ullamcorper.',curdate(),curdate()),
       (4, 14,'Mas u menos Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi vitae condimentum erat. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae Sed posuere, purus at efficitur hendrerit, augue elit lacinia arcu, a eleifend sem elit et nunc. Sed rutrum vestibulum est, sit amet cursus dolor fermentum vel. Suspendisse mi nibh, congue et ante et, commodo mattis lacus.',curdate(),curdate()),
       (5, 15,'sii me gusta Vivamus rhoncus nisl sed venenatis luctus. Sed condimentum risus ut tortor feugiat laoreet. Suspendisse potenti. Donec et finibus sem, ut commodo lectus. Cras eget neque dignissim, placerat orci interdum, venenatis odio. Nulla turpis elit, consequat eu eros ac, consectetur fringilla urna. Duis gravida ex pulvinar mauris ornare, eget porttitor enim vulputate. Mauris hendrerit, massa nec aliquam cursus, ex elit euismod lorem, vehicula rhoncus nisl dui sit amet eros. Nulla turpis lorem, dignissim a sapien eget, ultrices venenatis dolor. Curabitur vel turpis at magna elementum hendrerit vel id dui. Curabitur a ex ullamcorper, ornare velit vel, tincidunt ipsum.',curdate(),curdate()),
       (6, 16,'sii me gusta Cras ut ipsum ornare, aliquam ipsum non, posuere elit. In hac habitasse platea dictumst. Aenean elementum leo augue, id fermentum risus efficitur vel. Nulla iaculis malesuada scelerisque. Praesent vel ipsum felis. Ut molestie, purus aliquam placerat sollicitudin, mi ligula euismod neque, non bibendum nibh neque et erat. Etiam dignissim aliquam ligula, aliquet feugiat nibh rhoncus ut. Aliquam efficitur lacinia lacinia. Morbi ac molestie lectus, vitae hendrerit nisl. Nullam metus odio, malesuada in vehicula at, consectetur nec justo. Quisque suscipit odio velit, at accumsan urna vestibulum a. Proin dictum, urna ut varius consectetur, sapien justo porta lectus, at mollis nisi orci et nulla. Donec pellentesque tortor vel nisl commodo ullamcorper.',curdate(),curdate()),
       (7, 17,'Gracias fue de mi agrado Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi vitae condimentum erat. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae Sed posuere, purus at efficitur hendrerit, augue elit lacinia arcu, a eleifend sem elit et nunc. Sed rutrum vestibulum est, sit amet cursus dolor fermentum vel. Suspendisse mi nibh, congue et ante et, commodo mattis lacus.',curdate(),curdate()),
       (8, 18,'sii me gusta Vivamus rhoncus nisl sed venenatis luctus. Sed condimentum risus ut tortor feugiat laoreet. Suspendisse potenti. Donec et finibus sem, ut commodo lectus. Cras eget neque dignissim, placerat orci interdum, venenatis odio. Nulla turpis elit, consequat eu eros ac, consectetur fringilla urna. Duis gravida ex pulvinar mauris ornare, eget porttitor enim vulputate. Mauris hendrerit, massa nec aliquam cursus, ex elit euismod lorem, vehicula rhoncus nisl dui sit amet eros. Nulla turpis lorem, dignissim a sapien eget, ultrices venenatis dolor. Curabitur vel turpis at magna elementum hendrerit vel id dui. Curabitur a ex ullamcorper, ornare velit vel, tincidunt ipsum.',curdate(),curdate()),
       (9, 19,'Mejorar por favor en la entrega, me llego en la fecha atrasada Cras ut ipsum ornare, aliquam ipsum non, posuere elit. In hac habitasse platea dictumst. Aenean elementum leo augue, id fermentum risus efficitur vel. Nulla iaculis malesuada scelerisque. Praesent vel ipsum felis. Ut molestie, purus aliquam placerat sollicitudin, mi ligula euismod neque, non bibendum nibh neque et erat. Etiam dignissim aliquam ligula, aliquet feugiat nibh rhoncus ut. Aliquam efficitur lacinia lacinia. Morbi ac molestie lectus, vitae hendrerit nisl. Nullam metus odio, malesuada in vehicula at, consectetur nec justo. Quisque suscipit odio velit, at accumsan urna vestibulum a. Proin dictum, urna ut varius consectetur, sapien justo porta lectus, at mollis nisi orci et nulla. Donec pellentesque tortor vel nisl commodo ullamcorper.',curdate(),curdate()),
       (10, 20,'sii me gusta Vivamus rhoncus nisl sed venenatis luctus. Sed condimentum risus ut tortor feugiat laoreet. Suspendisse potenti. Donec et finibus sem, ut commodo lectus. Cras eget neque dignissim, placerat orci interdum, venenatis odio. Nulla turpis elit, consequat eu eros ac, consectetur fringilla urna. Duis gravida ex pulvinar mauris ornare, eget porttitor enim vulputate. Mauris hendrerit, massa nec aliquam cursus, ex elit euismod lorem, vehicula rhoncus nisl dui sit amet eros. Nulla turpis lorem, dignissim a sapien eget, ultrices venenatis dolor. Curabitur vel turpis at magna elementum hendrerit vel id dui. Curabitur a ex ullamcorper, ornare velit vel, tincidunt ipsum.',curdate(),curdate()),
       (11, 21,'sii me gusta Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi vitae condimentum erat. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae Sed posuere, purus at efficitur hendrerit, augue elit lacinia arcu, a eleifend sem elit et nunc. Sed rutrum vestibulum est, sit amet cursus dolor fermentum vel. Suspendisse mi nibh, congue et ante et, commodo mattis lacus.',curdate(),curdate()),
       (12, 22,'sii me gusta Vivamus rhoncus nisl sed venenatis luctus. Sed condimentum risus ut tortor feugiat laoreet. Suspendisse potenti. Donec et finibus sem, ut commodo lectus. Cras eget neque dignissim, placerat orci interdum, venenatis odio. Nulla turpis elit, consequat eu eros ac, consectetur fringilla urna. Duis gravida ex pulvinar mauris ornare, eget porttitor enim vulputate. Mauris hendrerit, massa nec aliquam cursus, ex elit euismod lorem, vehicula rhoncus nisl dui sit amet eros. Nulla turpis lorem, dignissim a sapien eget, ultrices venenatis dolor. Curabitur vel turpis at magna elementum hendrerit vel id dui. Curabitur a ex ullamcorper, ornare velit vel, tincidunt ipsum.',curdate(),curdate()),
       (13, 23,'sii me gusta Cras ut ipsum ornare, aliquam ipsum non, posuere elit. In hac habitasse platea dictumst. Aenean elementum leo augue, id fermentum risus efficitur vel. Nulla iaculis malesuada scelerisque. Praesent vel ipsum felis. Ut molestie, purus aliquam placerat sollicitudin, mi ligula euismod neque, non bibendum nibh neque et erat. Etiam dignissim aliquam ligula, aliquet feugiat nibh rhoncus ut. Aliquam efficitur lacinia lacinia. Morbi ac molestie lectus, vitae hendrerit nisl. Nullam metus odio, malesuada in vehicula at, consectetur nec justo. Quisque suscipit odio velit, at accumsan urna vestibulum a. Proin dictum, urna ut varius consectetur, sapien justo porta lectus, at mollis nisi orci et nulla. Donec pellentesque tortor vel nisl commodo ullamcorper.',curdate(),curdate()),
       (14, 24,'sii me gusta Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi vitae condimentum erat. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae Sed posuere, purus at efficitur hendrerit, augue elit lacinia arcu, a eleifend sem elit et nunc. Sed rutrum vestibulum est, sit amet cursus dolor fermentum vel. Suspendisse mi nibh, congue et ante et, commodo mattis lacus.',curdate(),curdate()),
       (15, 25,'sii me gusta Vivamus rhoncus nisl sed venenatis luctus. Sed condimentum risus ut tortor feugiat laoreet. Suspendisse potenti. Donec et finibus sem, ut commodo lectus. Cras eget neque dignissim, placerat orci interdum, venenatis odio. Nulla turpis elit, consequat eu eros ac, consectetur fringilla urna. Duis gravida ex pulvinar mauris ornare, eget porttitor enim vulputate. Mauris hendrerit, massa nec aliquam cursus, ex elit euismod lorem, vehicula rhoncus nisl dui sit amet eros. Nulla turpis lorem, dignissim a sapien eget, ultrices venenatis dolor. Curabitur vel turpis at magna elementum hendrerit vel id dui. Curabitur a ex ullamcorper, ornare velit vel, tincidunt ipsum.',curdate(),curdate()),
       (16, 26,'sii me gusta Cras ut ipsum ornare, aliquam ipsum non, posuere elit. In hac habitasse platea dictumst. Aenean elementum leo augue, id fermentum risus efficitur vel. Nulla iaculis malesuada scelerisque. Praesent vel ipsum felis. Ut molestie, purus aliquam placerat sollicitudin, mi ligula euismod neque, non bibendum nibh neque et erat. Etiam dignissim aliquam ligula, aliquet feugiat nibh rhoncus ut. Aliquam efficitur lacinia lacinia. Morbi ac molestie lectus, vitae hendrerit nisl. Nullam metus odio, malesuada in vehicula at, consectetur nec justo. Quisque suscipit odio velit, at accumsan urna vestibulum a. Proin dictum, urna ut varius consectetur, sapien justo porta lectus, at mollis nisi orci et nulla. Donec pellentesque tortor vel nisl commodo ullamcorper.',curdate(),curdate()),
       (17, 27,'sii me gusta Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi vitae condimentum erat. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae Sed posuere, purus at efficitur hendrerit, augue elit lacinia arcu, a eleifend sem elit et nunc. Sed rutrum vestibulum est, sit amet cursus dolor fermentum vel. Suspendisse mi nibh, congue et ante et, commodo mattis lacus.',curdate(),curdate()),
       (18, 28,'sii me gusta Vivamus rhoncus nisl sed venenatis luctus. Sed condimentum risus ut tortor feugiat laoreet. Suspendisse potenti. Donec et finibus sem, ut commodo lectus. Cras eget neque dignissim, placerat orci interdum, venenatis odio. Nulla turpis elit, consequat eu eros ac, consectetur fringilla urna. Duis gravida ex pulvinar mauris ornare, eget porttitor enim vulputate. Mauris hendrerit, massa nec aliquam cursus, ex elit euismod lorem, vehicula rhoncus nisl dui sit amet eros. Nulla turpis lorem, dignissim a sapien eget, ultrices venenatis dolor. Curabitur vel turpis at magna elementum hendrerit vel id dui. Curabitur a ex ullamcorper, ornare velit vel, tincidunt ipsum.',curdate(),curdate()),
       (19, 29,'sii me gusta Cras ut ipsum ornare, aliquam ipsum non, posuere elit. In hac habitasse platea dictumst. Aenean elementum leo augue, id fermentum risus efficitur vel. Nulla iaculis malesuada scelerisque. Praesent vel ipsum felis. Ut molestie, purus aliquam placerat sollicitudin, mi ligula euismod neque, non bibendum nibh neque et erat. Etiam dignissim aliquam ligula, aliquet feugiat nibh rhoncus ut. Aliquam efficitur lacinia lacinia. Morbi ac molestie lectus, vitae hendrerit nisl. Nullam metus odio, malesuada in vehicula at, consectetur nec justo. Quisque suscipit odio velit, at accumsan urna vestibulum a. Proin dictum, urna ut varius consectetur, sapien justo porta lectus, at mollis nisi orci et nulla. Donec pellentesque tortor vel nisl commodo ullamcorper. ',curdate(),curdate()),
       (20, 30,'sii me gusta Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi vitae condimentum erat. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae Sed posuere, purus at efficitur hendrerit, augue elit lacinia arcu, a eleifend sem elit et nunc. Sed rutrum vestibulum est, sit amet cursus dolor fermentum vel. Suspendisse mi nibh, congue et ante et, commodo mattis lacus.',curdate(),curdate()),
       (21, 1,'sii me gusta Cras ut ipsum ornare, aliquam ipsum non, posuere elit. In hac habitasse platea dictumst. Aenean elementum leo augue, id fermentum risus efficitur vel. Nulla iaculis malesuada scelerisque. Praesent vel ipsum felis. Ut molestie, purus aliquam placerat sollicitudin, mi ligula euismod neque, non bibendum nibh neque et erat. Etiam dignissim aliquam ligula, aliquet feugiat nibh rhoncus ut. Aliquam efficitur lacinia lacinia. Morbi ac molestie lectus, vitae hendrerit nisl. Nullam metus odio, malesuada in vehicula at, consectetur nec justo. Quisque suscipit odio velit, at accumsan urna vestibulum a. Proin dictum, urna ut varius consectetur, sapien justo porta lectus, at mollis nisi orci et nulla. Donec pellentesque tortor vel nisl commodo ullamcorper. ',curdate(),curdate()),
       (22, 2,'sii me gusta Vivamus rhoncus nisl sed venenatis luctus. Sed condimentum risus ut tortor feugiat laoreet. Suspendisse potenti. Donec et finibus sem, ut commodo lectus. Cras eget neque dignissim, placerat orci interdum, venenatis odio. Nulla turpis elit, consequat eu eros ac, consectetur fringilla urna. Duis gravida ex pulvinar mauris ornare, eget porttitor enim vulputate. Mauris hendrerit, massa nec aliquam cursus, ex elit euismod lorem, vehicula rhoncus nisl dui sit amet eros. Nulla turpis lorem, dignissim a sapien eget, ultrices venenatis dolor. Curabitur vel turpis at magna elementum hendrerit vel id dui. Curabitur a ex ullamcorper, ornare velit vel, tincidunt ipsum.',curdate(),curdate()),
       (23, 3,'sii me gusta Vivamus rhoncus nisl sed venenatis luctus. Sed condimentum risus ut tortor feugiat laoreet. Suspendisse potenti. Donec et finibus sem, ut commodo lectus. Cras eget neque dignissim, placerat orci interdum, venenatis odio. Nulla turpis elit, consequat eu eros ac, consectetur fringilla urna. Duis gravida ex pulvinar mauris ornare, eget porttitor enim vulputate. Mauris hendrerit, massa nec aliquam cursus, ex elit euismod lorem, vehicula rhoncus nisl dui sit amet eros. Nulla turpis lorem, dignissim a sapien eget, ultrices venenatis dolor. Curabitur vel turpis at magna elementum hendrerit vel id dui. Curabitur a ex ullamcorper, ornare velit vel, tincidunt ipsum.',curdate(),curdate()),
       (24, 4,'sii me gusta Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi vitae condimentum erat. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae Sed posuere, purus at efficitur hendrerit, augue elit lacinia arcu, a eleifend sem elit et nunc. Sed rutrum vestibulum est, sit amet cursus dolor fermentum vel. Suspendisse mi nibh, congue et ante et, commodo mattis lacus.',curdate(),curdate()),
       (25, 5,'sii me gusta Vivamus rhoncus nisl sed venenatis luctus. Sed condimentum risus ut tortor feugiat laoreet. Suspendisse potenti. Donec et finibus sem, ut commodo lectus. Cras eget neque dignissim, placerat orci interdum, venenatis odio. Nulla turpis elit, consequat eu eros ac, consectetur fringilla urna. Duis gravida ex pulvinar mauris ornare, eget porttitor enim vulputate. Mauris hendrerit, massa nec aliquam cursus, ex elit euismod lorem, vehicula rhoncus nisl dui sit amet eros. Nulla turpis lorem, dignissim a sapien eget, ultrices venenatis dolor. Curabitur vel turpis at magna elementum hendrerit vel id dui. Curabitur a ex ullamcorper, ornare velit vel, tincidunt ipsum.',curdate(),curdate());
       
      -- 6 parte

insert into commentary_articles (article_id, client_id , comment ,created_at,updated_at) 
values (1, 6,'sii me gusta Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi vitae condimentum erat. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae Sed posuere, purus at efficitur hendrerit, augue elit lacinia arcu, a eleifend sem elit et nunc. Sed rutrum vestibulum est, sit amet cursus dolor fermentum vel. Suspendisse mi nibh, congue et ante et, commodo mattis lacus.',curdate(),curdate()),
       (2, 7,'sii me gusta Vivamus rhoncus nisl sed venenatis luctus. Sed condimentum risus ut tortor feugiat laoreet. Suspendisse potenti. Donec et finibus sem, ut commodo lectus. Cras eget neque dignissim, placerat orci interdum, venenatis odio. Nulla turpis elit, consequat eu eros ac, consectetur fringilla urna. Duis gravida ex pulvinar mauris ornare, eget porttitor enim vulputate. Mauris hendrerit, massa nec aliquam cursus, ex elit euismod lorem, vehicula rhoncus nisl dui sit amet eros. Nulla turpis lorem, dignissim a sapien eget, ultrices venenatis dolor. Curabitur vel turpis at magna elementum hendrerit vel id dui. Curabitur a ex ullamcorper, ornare velit vel, tincidunt ipsum.',curdate(),curdate()),
       (3, 8,'sii me gusta Cras ut ipsum ornare, aliquam ipsum non, posuere elit. In hac habitasse platea dictumst. Aenean elementum leo augue, id fermentum risus efficitur vel. Nulla iaculis malesuada scelerisque. Praesent vel ipsum felis. Ut molestie, purus aliquam placerat sollicitudin, mi ligula euismod neque, non bibendum nibh neque et erat. Etiam dignissim aliquam ligula, aliquet feugiat nibh rhoncus ut. Aliquam efficitur lacinia lacinia. Morbi ac molestie lectus, vitae hendrerit nisl. Nullam metus odio, malesuada in vehicula at, consectetur nec justo. Quisque suscipit odio velit, at accumsan urna vestibulum a. Proin dictum, urna ut varius consectetur, sapien justo porta lectus, at mollis nisi orci et nulla. Donec pellentesque tortor vel nisl commodo ullamcorper.',curdate(),curdate()),
       (4, 9,'Mas u menos Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi vitae condimentum erat. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae Sed posuere, purus at efficitur hendrerit, augue elit lacinia arcu, a eleifend sem elit et nunc. Sed rutrum vestibulum est, sit amet cursus dolor fermentum vel. Suspendisse mi nibh, congue et ante et, commodo mattis lacus.',curdate(),curdate()),
       (5, 10,'sii me gusta Vivamus rhoncus nisl sed venenatis luctus. Sed condimentum risus ut tortor feugiat laoreet. Suspendisse potenti. Donec et finibus sem, ut commodo lectus. Cras eget neque dignissim, placerat orci interdum, venenatis odio. Nulla turpis elit, consequat eu eros ac, consectetur fringilla urna. Duis gravida ex pulvinar mauris ornare, eget porttitor enim vulputate. Mauris hendrerit, massa nec aliquam cursus, ex elit euismod lorem, vehicula rhoncus nisl dui sit amet eros. Nulla turpis lorem, dignissim a sapien eget, ultrices venenatis dolor. Curabitur vel turpis at magna elementum hendrerit vel id dui. Curabitur a ex ullamcorper, ornare velit vel, tincidunt ipsum.',curdate(),curdate()),
       (6, 11,'sii me gusta Cras ut ipsum ornare, aliquam ipsum non, posuere elit. In hac habitasse platea dictumst. Aenean elementum leo augue, id fermentum risus efficitur vel. Nulla iaculis malesuada scelerisque. Praesent vel ipsum felis. Ut molestie, purus aliquam placerat sollicitudin, mi ligula euismod neque, non bibendum nibh neque et erat. Etiam dignissim aliquam ligula, aliquet feugiat nibh rhoncus ut. Aliquam efficitur lacinia lacinia. Morbi ac molestie lectus, vitae hendrerit nisl. Nullam metus odio, malesuada in vehicula at, consectetur nec justo. Quisque suscipit odio velit, at accumsan urna vestibulum a. Proin dictum, urna ut varius consectetur, sapien justo porta lectus, at mollis nisi orci et nulla. Donec pellentesque tortor vel nisl commodo ullamcorper.',curdate(),curdate()),
       (7, 12,'Gracias fue de mi agrado Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi vitae condimentum erat. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae Sed posuere, purus at efficitur hendrerit, augue elit lacinia arcu, a eleifend sem elit et nunc. Sed rutrum vestibulum est, sit amet cursus dolor fermentum vel. Suspendisse mi nibh, congue et ante et, commodo mattis lacus.',curdate(),curdate()),
       (8, 13,'sii me gusta Vivamus rhoncus nisl sed venenatis luctus. Sed condimentum risus ut tortor feugiat laoreet. Suspendisse potenti. Donec et finibus sem, ut commodo lectus. Cras eget neque dignissim, placerat orci interdum, venenatis odio. Nulla turpis elit, consequat eu eros ac, consectetur fringilla urna. Duis gravida ex pulvinar mauris ornare, eget porttitor enim vulputate. Mauris hendrerit, massa nec aliquam cursus, ex elit euismod lorem, vehicula rhoncus nisl dui sit amet eros. Nulla turpis lorem, dignissim a sapien eget, ultrices venenatis dolor. Curabitur vel turpis at magna elementum hendrerit vel id dui. Curabitur a ex ullamcorper, ornare velit vel, tincidunt ipsum.',curdate(),curdate()),
       (9, 14,'Mejorar por favor en la entrega, me llego en la fecha atrasada Cras ut ipsum ornare, aliquam ipsum non, posuere elit. In hac habitasse platea dictumst. Aenean elementum leo augue, id fermentum risus efficitur vel. Nulla iaculis malesuada scelerisque. Praesent vel ipsum felis. Ut molestie, purus aliquam placerat sollicitudin, mi ligula euismod neque, non bibendum nibh neque et erat. Etiam dignissim aliquam ligula, aliquet feugiat nibh rhoncus ut. Aliquam efficitur lacinia lacinia. Morbi ac molestie lectus, vitae hendrerit nisl. Nullam metus odio, malesuada in vehicula at, consectetur nec justo. Quisque suscipit odio velit, at accumsan urna vestibulum a. Proin dictum, urna ut varius consectetur, sapien justo porta lectus, at mollis nisi orci et nulla. Donec pellentesque tortor vel nisl commodo ullamcorper.',curdate(),curdate()),
       (10, 15,'sii me gusta Vivamus rhoncus nisl sed venenatis luctus. Sed condimentum risus ut tortor feugiat laoreet. Suspendisse potenti. Donec et finibus sem, ut commodo lectus. Cras eget neque dignissim, placerat orci interdum, venenatis odio. Nulla turpis elit, consequat eu eros ac, consectetur fringilla urna. Duis gravida ex pulvinar mauris ornare, eget porttitor enim vulputate. Mauris hendrerit, massa nec aliquam cursus, ex elit euismod lorem, vehicula rhoncus nisl dui sit amet eros. Nulla turpis lorem, dignissim a sapien eget, ultrices venenatis dolor. Curabitur vel turpis at magna elementum hendrerit vel id dui. Curabitur a ex ullamcorper, ornare velit vel, tincidunt ipsum.',curdate(),curdate()),
       (11, 16,'sii me gusta Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi vitae condimentum erat. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae Sed posuere, purus at efficitur hendrerit, augue elit lacinia arcu, a eleifend sem elit et nunc. Sed rutrum vestibulum est, sit amet cursus dolor fermentum vel. Suspendisse mi nibh, congue et ante et, commodo mattis lacus.',curdate(),curdate()),
       (12, 17,'sii me gusta Vivamus rhoncus nisl sed venenatis luctus. Sed condimentum risus ut tortor feugiat laoreet. Suspendisse potenti. Donec et finibus sem, ut commodo lectus. Cras eget neque dignissim, placerat orci interdum, venenatis odio. Nulla turpis elit, consequat eu eros ac, consectetur fringilla urna. Duis gravida ex pulvinar mauris ornare, eget porttitor enim vulputate. Mauris hendrerit, massa nec aliquam cursus, ex elit euismod lorem, vehicula rhoncus nisl dui sit amet eros. Nulla turpis lorem, dignissim a sapien eget, ultrices venenatis dolor. Curabitur vel turpis at magna elementum hendrerit vel id dui. Curabitur a ex ullamcorper, ornare velit vel, tincidunt ipsum.',curdate(),curdate()),
       (13, 18,'sii me gusta Cras ut ipsum ornare, aliquam ipsum non, posuere elit. In hac habitasse platea dictumst. Aenean elementum leo augue, id fermentum risus efficitur vel. Nulla iaculis malesuada scelerisque. Praesent vel ipsum felis. Ut molestie, purus aliquam placerat sollicitudin, mi ligula euismod neque, non bibendum nibh neque et erat. Etiam dignissim aliquam ligula, aliquet feugiat nibh rhoncus ut. Aliquam efficitur lacinia lacinia. Morbi ac molestie lectus, vitae hendrerit nisl. Nullam metus odio, malesuada in vehicula at, consectetur nec justo. Quisque suscipit odio velit, at accumsan urna vestibulum a. Proin dictum, urna ut varius consectetur, sapien justo porta lectus, at mollis nisi orci et nulla. Donec pellentesque tortor vel nisl commodo ullamcorper.',curdate(),curdate()),
       (14, 19,'sii me gusta Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi vitae condimentum erat. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae Sed posuere, purus at efficitur hendrerit, augue elit lacinia arcu, a eleifend sem elit et nunc. Sed rutrum vestibulum est, sit amet cursus dolor fermentum vel. Suspendisse mi nibh, congue et ante et, commodo mattis lacus.',curdate(),curdate()),
       (15, 20,'sii me gusta Vivamus rhoncus nisl sed venenatis luctus. Sed condimentum risus ut tortor feugiat laoreet. Suspendisse potenti. Donec et finibus sem, ut commodo lectus. Cras eget neque dignissim, placerat orci interdum, venenatis odio. Nulla turpis elit, consequat eu eros ac, consectetur fringilla urna. Duis gravida ex pulvinar mauris ornare, eget porttitor enim vulputate. Mauris hendrerit, massa nec aliquam cursus, ex elit euismod lorem, vehicula rhoncus nisl dui sit amet eros. Nulla turpis lorem, dignissim a sapien eget, ultrices venenatis dolor. Curabitur vel turpis at magna elementum hendrerit vel id dui. Curabitur a ex ullamcorper, ornare velit vel, tincidunt ipsum.',curdate(),curdate()),
       (16, 21,'sii me gusta Cras ut ipsum ornare, aliquam ipsum non, posuere elit. In hac habitasse platea dictumst. Aenean elementum leo augue, id fermentum risus efficitur vel. Nulla iaculis malesuada scelerisque. Praesent vel ipsum felis. Ut molestie, purus aliquam placerat sollicitudin, mi ligula euismod neque, non bibendum nibh neque et erat. Etiam dignissim aliquam ligula, aliquet feugiat nibh rhoncus ut. Aliquam efficitur lacinia lacinia. Morbi ac molestie lectus, vitae hendrerit nisl. Nullam metus odio, malesuada in vehicula at, consectetur nec justo. Quisque suscipit odio velit, at accumsan urna vestibulum a. Proin dictum, urna ut varius consectetur, sapien justo porta lectus, at mollis nisi orci et nulla. Donec pellentesque tortor vel nisl commodo ullamcorper.',curdate(),curdate()),
       (17, 22,'sii me gusta Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi vitae condimentum erat. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae Sed posuere, purus at efficitur hendrerit, augue elit lacinia arcu, a eleifend sem elit et nunc. Sed rutrum vestibulum est, sit amet cursus dolor fermentum vel. Suspendisse mi nibh, congue et ante et, commodo mattis lacus.',curdate(),curdate()),
       (18, 23,'sii me gusta Vivamus rhoncus nisl sed venenatis luctus. Sed condimentum risus ut tortor feugiat laoreet. Suspendisse potenti. Donec et finibus sem, ut commodo lectus. Cras eget neque dignissim, placerat orci interdum, venenatis odio. Nulla turpis elit, consequat eu eros ac, consectetur fringilla urna. Duis gravida ex pulvinar mauris ornare, eget porttitor enim vulputate. Mauris hendrerit, massa nec aliquam cursus, ex elit euismod lorem, vehicula rhoncus nisl dui sit amet eros. Nulla turpis lorem, dignissim a sapien eget, ultrices venenatis dolor. Curabitur vel turpis at magna elementum hendrerit vel id dui. Curabitur a ex ullamcorper, ornare velit vel, tincidunt ipsum.',curdate(),curdate()),
       (19, 24,'sii me gusta Cras ut ipsum ornare, aliquam ipsum non, posuere elit. In hac habitasse platea dictumst. Aenean elementum leo augue, id fermentum risus efficitur vel. Nulla iaculis malesuada scelerisque. Praesent vel ipsum felis. Ut molestie, purus aliquam placerat sollicitudin, mi ligula euismod neque, non bibendum nibh neque et erat. Etiam dignissim aliquam ligula, aliquet feugiat nibh rhoncus ut. Aliquam efficitur lacinia lacinia. Morbi ac molestie lectus, vitae hendrerit nisl. Nullam metus odio, malesuada in vehicula at, consectetur nec justo. Quisque suscipit odio velit, at accumsan urna vestibulum a. Proin dictum, urna ut varius consectetur, sapien justo porta lectus, at mollis nisi orci et nulla. Donec pellentesque tortor vel nisl commodo ullamcorper. ',curdate(),curdate()),
       (20, 25,'sii me gusta Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi vitae condimentum erat. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae Sed posuere, purus at efficitur hendrerit, augue elit lacinia arcu, a eleifend sem elit et nunc. Sed rutrum vestibulum est, sit amet cursus dolor fermentum vel. Suspendisse mi nibh, congue et ante et, commodo mattis lacus.',curdate(),curdate()),
       (21, 26,'sii me gusta Cras ut ipsum ornare, aliquam ipsum non, posuere elit. In hac habitasse platea dictumst. Aenean elementum leo augue, id fermentum risus efficitur vel. Nulla iaculis malesuada scelerisque. Praesent vel ipsum felis. Ut molestie, purus aliquam placerat sollicitudin, mi ligula euismod neque, non bibendum nibh neque et erat. Etiam dignissim aliquam ligula, aliquet feugiat nibh rhoncus ut. Aliquam efficitur lacinia lacinia. Morbi ac molestie lectus, vitae hendrerit nisl. Nullam metus odio, malesuada in vehicula at, consectetur nec justo. Quisque suscipit odio velit, at accumsan urna vestibulum a. Proin dictum, urna ut varius consectetur, sapien justo porta lectus, at mollis nisi orci et nulla. Donec pellentesque tortor vel nisl commodo ullamcorper. ',curdate(),curdate()),
       (22, 27,'sii me gusta Vivamus rhoncus nisl sed venenatis luctus. Sed condimentum risus ut tortor feugiat laoreet. Suspendisse potenti. Donec et finibus sem, ut commodo lectus. Cras eget neque dignissim, placerat orci interdum, venenatis odio. Nulla turpis elit, consequat eu eros ac, consectetur fringilla urna. Duis gravida ex pulvinar mauris ornare, eget porttitor enim vulputate. Mauris hendrerit, massa nec aliquam cursus, ex elit euismod lorem, vehicula rhoncus nisl dui sit amet eros. Nulla turpis lorem, dignissim a sapien eget, ultrices venenatis dolor. Curabitur vel turpis at magna elementum hendrerit vel id dui. Curabitur a ex ullamcorper, ornare velit vel, tincidunt ipsum.',curdate(),curdate()),
       (23, 28,'sii me gusta Vivamus rhoncus nisl sed venenatis luctus. Sed condimentum risus ut tortor feugiat laoreet. Suspendisse potenti. Donec et finibus sem, ut commodo lectus. Cras eget neque dignissim, placerat orci interdum, venenatis odio. Nulla turpis elit, consequat eu eros ac, consectetur fringilla urna. Duis gravida ex pulvinar mauris ornare, eget porttitor enim vulputate. Mauris hendrerit, massa nec aliquam cursus, ex elit euismod lorem, vehicula rhoncus nisl dui sit amet eros. Nulla turpis lorem, dignissim a sapien eget, ultrices venenatis dolor. Curabitur vel turpis at magna elementum hendrerit vel id dui. Curabitur a ex ullamcorper, ornare velit vel, tincidunt ipsum.',curdate(),curdate()),
       (24, 29,'sii me gusta Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi vitae condimentum erat. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae Sed posuere, purus at efficitur hendrerit, augue elit lacinia arcu, a eleifend sem elit et nunc. Sed rutrum vestibulum est, sit amet cursus dolor fermentum vel. Suspendisse mi nibh, congue et ante et, commodo mattis lacus.',curdate(),curdate()),
       (25, 30,'sii me gusta Vivamus rhoncus nisl sed venenatis luctus. Sed condimentum risus ut tortor feugiat laoreet. Suspendisse potenti. Donec et finibus sem, ut commodo lectus. Cras eget neque dignissim, placerat orci interdum, venenatis odio. Nulla turpis elit, consequat eu eros ac, consectetur fringilla urna. Duis gravida ex pulvinar mauris ornare, eget porttitor enim vulputate. Mauris hendrerit, massa nec aliquam cursus, ex elit euismod lorem, vehicula rhoncus nisl dui sit amet eros. Nulla turpis lorem, dignissim a sapien eget, ultrices venenatis dolor. Curabitur vel turpis at magna elementum hendrerit vel id dui. Curabitur a ex ullamcorper, ornare velit vel, tincidunt ipsum.',curdate(),curdate());
       
      -- 7 parte

insert into commentary_articles (article_id, client_id , comment ,created_at,updated_at) 
values (1, 26,'sii me gusta Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi vitae condimentum erat. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae Sed posuere, purus at efficitur hendrerit, augue elit lacinia arcu, a eleifend sem elit et nunc. Sed rutrum vestibulum est, sit amet cursus dolor fermentum vel. Suspendisse mi nibh, congue et ante et, commodo mattis lacus.',curdate(),curdate()),
       (2, 27,'sii me gusta Vivamus rhoncus nisl sed venenatis luctus. Sed condimentum risus ut tortor feugiat laoreet. Suspendisse potenti. Donec et finibus sem, ut commodo lectus. Cras eget neque dignissim, placerat orci interdum, venenatis odio. Nulla turpis elit, consequat eu eros ac, consectetur fringilla urna. Duis gravida ex pulvinar mauris ornare, eget porttitor enim vulputate. Mauris hendrerit, massa nec aliquam cursus, ex elit euismod lorem, vehicula rhoncus nisl dui sit amet eros. Nulla turpis lorem, dignissim a sapien eget, ultrices venenatis dolor. Curabitur vel turpis at magna elementum hendrerit vel id dui. Curabitur a ex ullamcorper, ornare velit vel, tincidunt ipsum.',curdate(),curdate()),
       (3, 28,'sii me gusta Cras ut ipsum ornare, aliquam ipsum non, posuere elit. In hac habitasse platea dictumst. Aenean elementum leo augue, id fermentum risus efficitur vel. Nulla iaculis malesuada scelerisque. Praesent vel ipsum felis. Ut molestie, purus aliquam placerat sollicitudin, mi ligula euismod neque, non bibendum nibh neque et erat. Etiam dignissim aliquam ligula, aliquet feugiat nibh rhoncus ut. Aliquam efficitur lacinia lacinia. Morbi ac molestie lectus, vitae hendrerit nisl. Nullam metus odio, malesuada in vehicula at, consectetur nec justo. Quisque suscipit odio velit, at accumsan urna vestibulum a. Proin dictum, urna ut varius consectetur, sapien justo porta lectus, at mollis nisi orci et nulla. Donec pellentesque tortor vel nisl commodo ullamcorper.',curdate(),curdate()),
       (4, 4,'Mas u menos Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi vitae condimentum erat. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae Sed posuere, purus at efficitur hendrerit, augue elit lacinia arcu, a eleifend sem elit et nunc. Sed rutrum vestibulum est, sit amet cursus dolor fermentum vel. Suspendisse mi nibh, congue et ante et, commodo mattis lacus.',curdate(),curdate()),
       (5, 5,'sii me gusta Vivamus rhoncus nisl sed venenatis luctus. Sed condimentum risus ut tortor feugiat laoreet. Suspendisse potenti. Donec et finibus sem, ut commodo lectus. Cras eget neque dignissim, placerat orci interdum, venenatis odio. Nulla turpis elit, consequat eu eros ac, consectetur fringilla urna. Duis gravida ex pulvinar mauris ornare, eget porttitor enim vulputate. Mauris hendrerit, massa nec aliquam cursus, ex elit euismod lorem, vehicula rhoncus nisl dui sit amet eros. Nulla turpis lorem, dignissim a sapien eget, ultrices venenatis dolor. Curabitur vel turpis at magna elementum hendrerit vel id dui. Curabitur a ex ullamcorper, ornare velit vel, tincidunt ipsum.',curdate(),curdate()),
       (6, 6,'sii me gusta Cras ut ipsum ornare, aliquam ipsum non, posuere elit. In hac habitasse platea dictumst. Aenean elementum leo augue, id fermentum risus efficitur vel. Nulla iaculis malesuada scelerisque. Praesent vel ipsum felis. Ut molestie, purus aliquam placerat sollicitudin, mi ligula euismod neque, non bibendum nibh neque et erat. Etiam dignissim aliquam ligula, aliquet feugiat nibh rhoncus ut. Aliquam efficitur lacinia lacinia. Morbi ac molestie lectus, vitae hendrerit nisl. Nullam metus odio, malesuada in vehicula at, consectetur nec justo. Quisque suscipit odio velit, at accumsan urna vestibulum a. Proin dictum, urna ut varius consectetur, sapien justo porta lectus, at mollis nisi orci et nulla. Donec pellentesque tortor vel nisl commodo ullamcorper.',curdate(),curdate()),
       (7, 7,'Gracias fue de mi agrado Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi vitae condimentum erat. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae Sed posuere, purus at efficitur hendrerit, augue elit lacinia arcu, a eleifend sem elit et nunc. Sed rutrum vestibulum est, sit amet cursus dolor fermentum vel. Suspendisse mi nibh, congue et ante et, commodo mattis lacus.',curdate(),curdate()),
       (8, 8,'sii me gusta Vivamus rhoncus nisl sed venenatis luctus. Sed condimentum risus ut tortor feugiat laoreet. Suspendisse potenti. Donec et finibus sem, ut commodo lectus. Cras eget neque dignissim, placerat orci interdum, venenatis odio. Nulla turpis elit, consequat eu eros ac, consectetur fringilla urna. Duis gravida ex pulvinar mauris ornare, eget porttitor enim vulputate. Mauris hendrerit, massa nec aliquam cursus, ex elit euismod lorem, vehicula rhoncus nisl dui sit amet eros. Nulla turpis lorem, dignissim a sapien eget, ultrices venenatis dolor. Curabitur vel turpis at magna elementum hendrerit vel id dui. Curabitur a ex ullamcorper, ornare velit vel, tincidunt ipsum.',curdate(),curdate()),
       (9, 9,'Mejorar por favor en la entrega, me llego en la fecha atrasada Cras ut ipsum ornare, aliquam ipsum non, posuere elit. In hac habitasse platea dictumst. Aenean elementum leo augue, id fermentum risus efficitur vel. Nulla iaculis malesuada scelerisque. Praesent vel ipsum felis. Ut molestie, purus aliquam placerat sollicitudin, mi ligula euismod neque, non bibendum nibh neque et erat. Etiam dignissim aliquam ligula, aliquet feugiat nibh rhoncus ut. Aliquam efficitur lacinia lacinia. Morbi ac molestie lectus, vitae hendrerit nisl. Nullam metus odio, malesuada in vehicula at, consectetur nec justo. Quisque suscipit odio velit, at accumsan urna vestibulum a. Proin dictum, urna ut varius consectetur, sapien justo porta lectus, at mollis nisi orci et nulla. Donec pellentesque tortor vel nisl commodo ullamcorper.',curdate(),curdate()),
       (10, 10,'sii me gusta Vivamus rhoncus nisl sed venenatis luctus. Sed condimentum risus ut tortor feugiat laoreet. Suspendisse potenti. Donec et finibus sem, ut commodo lectus. Cras eget neque dignissim, placerat orci interdum, venenatis odio. Nulla turpis elit, consequat eu eros ac, consectetur fringilla urna. Duis gravida ex pulvinar mauris ornare, eget porttitor enim vulputate. Mauris hendrerit, massa nec aliquam cursus, ex elit euismod lorem, vehicula rhoncus nisl dui sit amet eros. Nulla turpis lorem, dignissim a sapien eget, ultrices venenatis dolor. Curabitur vel turpis at magna elementum hendrerit vel id dui. Curabitur a ex ullamcorper, ornare velit vel, tincidunt ipsum.',curdate(),curdate()),
       (11, 11,'sii me gusta Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi vitae condimentum erat. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae Sed posuere, purus at efficitur hendrerit, augue elit lacinia arcu, a eleifend sem elit et nunc. Sed rutrum vestibulum est, sit amet cursus dolor fermentum vel. Suspendisse mi nibh, congue et ante et, commodo mattis lacus.',curdate(),curdate()),
       (12, 12,'sii me gusta Vivamus rhoncus nisl sed venenatis luctus. Sed condimentum risus ut tortor feugiat laoreet. Suspendisse potenti. Donec et finibus sem, ut commodo lectus. Cras eget neque dignissim, placerat orci interdum, venenatis odio. Nulla turpis elit, consequat eu eros ac, consectetur fringilla urna. Duis gravida ex pulvinar mauris ornare, eget porttitor enim vulputate. Mauris hendrerit, massa nec aliquam cursus, ex elit euismod lorem, vehicula rhoncus nisl dui sit amet eros. Nulla turpis lorem, dignissim a sapien eget, ultrices venenatis dolor. Curabitur vel turpis at magna elementum hendrerit vel id dui. Curabitur a ex ullamcorper, ornare velit vel, tincidunt ipsum.',curdate(),curdate()),
       (13, 13,'sii me gusta Cras ut ipsum ornare, aliquam ipsum non, posuere elit. In hac habitasse platea dictumst. Aenean elementum leo augue, id fermentum risus efficitur vel. Nulla iaculis malesuada scelerisque. Praesent vel ipsum felis. Ut molestie, purus aliquam placerat sollicitudin, mi ligula euismod neque, non bibendum nibh neque et erat. Etiam dignissim aliquam ligula, aliquet feugiat nibh rhoncus ut. Aliquam efficitur lacinia lacinia. Morbi ac molestie lectus, vitae hendrerit nisl. Nullam metus odio, malesuada in vehicula at, consectetur nec justo. Quisque suscipit odio velit, at accumsan urna vestibulum a. Proin dictum, urna ut varius consectetur, sapien justo porta lectus, at mollis nisi orci et nulla. Donec pellentesque tortor vel nisl commodo ullamcorper.',curdate(),curdate()),
       (14, 14,'sii me gusta Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi vitae condimentum erat. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae Sed posuere, purus at efficitur hendrerit, augue elit lacinia arcu, a eleifend sem elit et nunc. Sed rutrum vestibulum est, sit amet cursus dolor fermentum vel. Suspendisse mi nibh, congue et ante et, commodo mattis lacus.',curdate(),curdate()),
       (15, 15,'sii me gusta Vivamus rhoncus nisl sed venenatis luctus. Sed condimentum risus ut tortor feugiat laoreet. Suspendisse potenti. Donec et finibus sem, ut commodo lectus. Cras eget neque dignissim, placerat orci interdum, venenatis odio. Nulla turpis elit, consequat eu eros ac, consectetur fringilla urna. Duis gravida ex pulvinar mauris ornare, eget porttitor enim vulputate. Mauris hendrerit, massa nec aliquam cursus, ex elit euismod lorem, vehicula rhoncus nisl dui sit amet eros. Nulla turpis lorem, dignissim a sapien eget, ultrices venenatis dolor. Curabitur vel turpis at magna elementum hendrerit vel id dui. Curabitur a ex ullamcorper, ornare velit vel, tincidunt ipsum.',curdate(),curdate()),
       (16, 16,'sii me gusta Cras ut ipsum ornare, aliquam ipsum non, posuere elit. In hac habitasse platea dictumst. Aenean elementum leo augue, id fermentum risus efficitur vel. Nulla iaculis malesuada scelerisque. Praesent vel ipsum felis. Ut molestie, purus aliquam placerat sollicitudin, mi ligula euismod neque, non bibendum nibh neque et erat. Etiam dignissim aliquam ligula, aliquet feugiat nibh rhoncus ut. Aliquam efficitur lacinia lacinia. Morbi ac molestie lectus, vitae hendrerit nisl. Nullam metus odio, malesuada in vehicula at, consectetur nec justo. Quisque suscipit odio velit, at accumsan urna vestibulum a. Proin dictum, urna ut varius consectetur, sapien justo porta lectus, at mollis nisi orci et nulla. Donec pellentesque tortor vel nisl commodo ullamcorper.',curdate(),curdate()),
       (17, 17,'sii me gusta Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi vitae condimentum erat. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae Sed posuere, purus at efficitur hendrerit, augue elit lacinia arcu, a eleifend sem elit et nunc. Sed rutrum vestibulum est, sit amet cursus dolor fermentum vel. Suspendisse mi nibh, congue et ante et, commodo mattis lacus.',curdate(),curdate()),
       (18, 18,'sii me gusta Vivamus rhoncus nisl sed venenatis luctus. Sed condimentum risus ut tortor feugiat laoreet. Suspendisse potenti. Donec et finibus sem, ut commodo lectus. Cras eget neque dignissim, placerat orci interdum, venenatis odio. Nulla turpis elit, consequat eu eros ac, consectetur fringilla urna. Duis gravida ex pulvinar mauris ornare, eget porttitor enim vulputate. Mauris hendrerit, massa nec aliquam cursus, ex elit euismod lorem, vehicula rhoncus nisl dui sit amet eros. Nulla turpis lorem, dignissim a sapien eget, ultrices venenatis dolor. Curabitur vel turpis at magna elementum hendrerit vel id dui. Curabitur a ex ullamcorper, ornare velit vel, tincidunt ipsum.',curdate(),curdate()),
       (19, 19,'sii me gusta Cras ut ipsum ornare, aliquam ipsum non, posuere elit. In hac habitasse platea dictumst. Aenean elementum leo augue, id fermentum risus efficitur vel. Nulla iaculis malesuada scelerisque. Praesent vel ipsum felis. Ut molestie, purus aliquam placerat sollicitudin, mi ligula euismod neque, non bibendum nibh neque et erat. Etiam dignissim aliquam ligula, aliquet feugiat nibh rhoncus ut. Aliquam efficitur lacinia lacinia. Morbi ac molestie lectus, vitae hendrerit nisl. Nullam metus odio, malesuada in vehicula at, consectetur nec justo. Quisque suscipit odio velit, at accumsan urna vestibulum a. Proin dictum, urna ut varius consectetur, sapien justo porta lectus, at mollis nisi orci et nulla. Donec pellentesque tortor vel nisl commodo ullamcorper. ',curdate(),curdate()),
       (20, 20,'sii me gusta Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi vitae condimentum erat. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae Sed posuere, purus at efficitur hendrerit, augue elit lacinia arcu, a eleifend sem elit et nunc. Sed rutrum vestibulum est, sit amet cursus dolor fermentum vel. Suspendisse mi nibh, congue et ante et, commodo mattis lacus.',curdate(),curdate()),
       (21, 21,'sii me gusta Cras ut ipsum ornare, aliquam ipsum non, posuere elit. In hac habitasse platea dictumst. Aenean elementum leo augue, id fermentum risus efficitur vel. Nulla iaculis malesuada scelerisque. Praesent vel ipsum felis. Ut molestie, purus aliquam placerat sollicitudin, mi ligula euismod neque, non bibendum nibh neque et erat. Etiam dignissim aliquam ligula, aliquet feugiat nibh rhoncus ut. Aliquam efficitur lacinia lacinia. Morbi ac molestie lectus, vitae hendrerit nisl. Nullam metus odio, malesuada in vehicula at, consectetur nec justo. Quisque suscipit odio velit, at accumsan urna vestibulum a. Proin dictum, urna ut varius consectetur, sapien justo porta lectus, at mollis nisi orci et nulla. Donec pellentesque tortor vel nisl commodo ullamcorper. ',curdate(),curdate()),
       (22, 22,'sii me gusta Vivamus rhoncus nisl sed venenatis luctus. Sed condimentum risus ut tortor feugiat laoreet. Suspendisse potenti. Donec et finibus sem, ut commodo lectus. Cras eget neque dignissim, placerat orci interdum, venenatis odio. Nulla turpis elit, consequat eu eros ac, consectetur fringilla urna. Duis gravida ex pulvinar mauris ornare, eget porttitor enim vulputate. Mauris hendrerit, massa nec aliquam cursus, ex elit euismod lorem, vehicula rhoncus nisl dui sit amet eros. Nulla turpis lorem, dignissim a sapien eget, ultrices venenatis dolor. Curabitur vel turpis at magna elementum hendrerit vel id dui. Curabitur a ex ullamcorper, ornare velit vel, tincidunt ipsum.',curdate(),curdate()),
       (23, 23,'sii me gusta Vivamus rhoncus nisl sed venenatis luctus. Sed condimentum risus ut tortor feugiat laoreet. Suspendisse potenti. Donec et finibus sem, ut commodo lectus. Cras eget neque dignissim, placerat orci interdum, venenatis odio. Nulla turpis elit, consequat eu eros ac, consectetur fringilla urna. Duis gravida ex pulvinar mauris ornare, eget porttitor enim vulputate. Mauris hendrerit, massa nec aliquam cursus, ex elit euismod lorem, vehicula rhoncus nisl dui sit amet eros. Nulla turpis lorem, dignissim a sapien eget, ultrices venenatis dolor. Curabitur vel turpis at magna elementum hendrerit vel id dui. Curabitur a ex ullamcorper, ornare velit vel, tincidunt ipsum.',curdate(),curdate()),
       (24, 29,'sii me gusta Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi vitae condimentum erat. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae Sed posuere, purus at efficitur hendrerit, augue elit lacinia arcu, a eleifend sem elit et nunc. Sed rutrum vestibulum est, sit amet cursus dolor fermentum vel. Suspendisse mi nibh, congue et ante et, commodo mattis lacus.',curdate(),curdate()),
       (25, 30,'sii me gusta Vivamus rhoncus nisl sed venenatis luctus. Sed condimentum risus ut tortor feugiat laoreet. Suspendisse potenti. Donec et finibus sem, ut commodo lectus. Cras eget neque dignissim, placerat orci interdum, venenatis odio. Nulla turpis elit, consequat eu eros ac, consectetur fringilla urna. Duis gravida ex pulvinar mauris ornare, eget porttitor enim vulputate. Mauris hendrerit, massa nec aliquam cursus, ex elit euismod lorem, vehicula rhoncus nisl dui sit amet eros. Nulla turpis lorem, dignissim a sapien eget, ultrices venenatis dolor. Curabitur vel turpis at magna elementum hendrerit vel id dui. Curabitur a ex ullamcorper, ornare velit vel, tincidunt ipsum.',curdate(),curdate());
       