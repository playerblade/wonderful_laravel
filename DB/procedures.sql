
DROP PROCEDURE IF EXISTS get_users_with_roles;
delimiter //
CREATE PROCEDURE get_users_with_roles ()
    BEGIN
        SELECT u.* , r.role, CONCAT(u.last_name,' ',u.mother_last_name,' ', u.first_name) AS full_name
        FROM users u INNER JOIN roles r ON u.role_id = r.id
        WHERE r.id = 1 OR r.id = 2 OR r.id = 3 OR r.id = 4
        ORDER BY u.id DESC;
    END
//

delimiter ;

CALL get_users_with_roles();

-- # create procedure roles except client
DROP PROCEDURE IF EXISTS get_roles;
delimiter //
CREATE PROCEDURE get_roles ()
    BEGIN
        SELECT r.*
        FROM roles r
        WHERE r.id = 1 OR r.id = 2 OR r.id = 3 OR r.id = 4
        ORDER BY r.role ASC;
    END
//

delimiter ;

CALL get_roles();


-- procedure for insert users

DROP PROCEDURE IF EXISTS insert_users_with_roles;
delimiter //

CREATE PROCEDURE insert_users_with_roles (
    IN role_id INT(11),
    IN ci VARCHAR(15),
    IN first_name VARCHAR(15),
    IN second_name VARCHAR(15),
    IN last_name VARCHAR(15),
    IN mother_last_name VARCHAR(15),
    IN gender ENUM('F','M'),
    IN phone_number INT(15),
    IN birthday DATE,
    IN user VARCHAR(200),
    IN password VARCHAR(200),
    IN active INT(15)
)
BEGIN

    INSERT INTO users(role_id,ci,first_name,second_name,last_name,mother_last_name,gender,phone_number,birthday,user,password,active,created_at,updated_at)
    VALUES (role_id,ci,first_name,second_name,last_name,mother_last_name,gender,phone_number,birthday,user,password,active,curdate(),curdate());

END
//

delimiter ;

CALL insert_users_with_roles(5,'1212','sadas','dsada','dasas','dsadas','F',21312,'2020-05-21','sadas','asdas',1);


-- PA for clients

DROP PROCEDURE IF EXISTS get_clients;
delimiter //
CREATE PROCEDURE get_clients ()
    BEGIN
        SELECT u.* , r.role, CONCAT(' ',u.last_name,u.mother_last_name, u.first_name) AS full_name
        FROM users u INNER JOIN roles r ON u.role_id = r.id
        WHERE r.id = 5
        ORDER BY u.id DESC;
    END
//

delimiter ;

CALL get_clients();