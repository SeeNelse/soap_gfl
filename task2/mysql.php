CREATE TABLE showroom_cars (
id INT(6) AUTO_INCREMENT,
brand_id INT(6) NOT NULL,
model VARCHAR(255) NOT NULL,
year_production INT(4) NOT NULL,
engine_capacity DOUBLE NOT NULL,
max_speed DOUBLE NOT NULL,
color VARCHAR(255) NOT NULL,
price DOUBLE NOT NULL,
FOREIGN KEY (brand_id) REFERENCES showroom_brand(id),
PRIMARY KEY(id)
);

CREATE TABLE showroom_brand (
id INT(6) AUTO_INCREMENT PRIMARY KEY,
brand VARCHAR(255) NOT NULL
);

CREATE TABLE showroom_order (
id INT(6)  AUTO_INCREMENT PRIMARY KEY,
car_id INT(6) NOT NULL,
name VARCHAR(255) NOT NULL,
surname VARCHAR(255) NOT NULL,
payment ENUM("cash","credit_card")
);

insert into showroom_brand (brand) values('Mazda');
insert into showroom_brand (brand) values('BMW');
insert into showroom_brand (brand) values('Lexus');
insert into showroom_brand (brand) values('Audi');
insert into showroom_brand (brand) values('Subaru');
insert into showroom_brand (brand) values('Toyota');
insert into showroom_brand (brand) values('Honda');
insert into showroom_brand (brand) values('Chevrolet');
insert into showroom_brand (brand) values('Ford');
insert into showroom_brand (brand) values('Opel');

insert into showroom_cars (brand_id, model, year_production, engine_capacity, max_speed, color, price) 
values(4, 'A6', 2018, 1.8, 250, 'black', 42500);

insert into showroom_cars (brand_id, model, year_production, engine_capacity, max_speed, color, price) 
values(2, '6 Series Gran Coupe', 2015, 4.4, 280, 'orange', 75000);

insert into showroom_cars (brand_id, model, year_production, engine_capacity, max_speed, color, price) 
values(2, 'X5', 2005, 3, 250, 'white', 14200);

insert into showroom_cars (brand_id, model, year_production, engine_capacity, max_speed, color, price) 
values(9, 'Mustang Premium', 2013, 3.7, 310, 'green', 20500);

insert into showroom_cars (brand_id, model, year_production, engine_capacity, max_speed, color, price) 
values(9, 'Focus', 2010, 1.6, 250, 'black', 6800);

insert into showroom_cars (brand_id, model, year_production, engine_capacity, max_speed, color, price) 
values(1, '6', 2015, 3, 280, 'blue', 17300);

insert into showroom_cars (brand_id, model, year_production, engine_capacity, max_speed, color, price) 
values(1, '3 Grand Touring', 2014, 2.5, 230, 'gray', 15000);

insert into showroom_cars (brand_id, model, year_production, engine_capacity, max_speed, color, price) 
values(1, 'CX-7', 2008, 2.3, 220, 'black', 9000);