drop database if exists shop;
create database shop default character set utf8 collate utf8_general_ci;
grant all on shop.* to 'staff'@'localhost' identified by 'password';
use shop;

create table product (
	id int auto_increment primary key, 
	name varchar(200) not null, 
	price int not null
);

create table customer (
	id int auto_increment primary key, 
	name varchar(100) not null, 
	address varchar(200) not null, 
	login varchar(100) not null unique, 
	password varchar(100) not null
);

create table purchase (
	id int not null primary key, 
	customer_id int not null, 
	foreign key(customer_id) references customer(id)
);

create table purchase_detail (
	purchase_id int not null, 
	product_id int not null, 
	count int not null, 
	primary key(purchase_id, product_id), 
	foreign key(purchase_id) references purchase(id), 
	foreign key(product_id) references product(id)
);

create table favorite (
	customer_id int not null, 
	product_id int not null, 
	primary key(customer_id, product_id), 
	foreign key(customer_id) references customer(id), 
	foreign key(product_id) references product(id)
);

insert into product values(null, '雞排', 65);
insert into product values(null, '米血', 10);
insert into product values(null, '甜不辣', 10);
insert into product values(null, '鹹酥雞', 55);
insert into product values(null, '雞心', 30);
insert into product values(null, '芋頭', 15);
insert into product values(null, '鴨血', 20);
insert into product values(null, '雞屁股', 20);
insert into product values(null, '豆腐', 20);
insert into product values(null, '花枝丸', 15);
insert into product values(null, '香菇', 15);

insert into customer values(null, '陳 貫選', '台北市大同路18號', 'chen', 'chen123');
insert into customer values(null, '黃 昭司', '台中市大心路38號', 'huang', 'huang123');
insert into customer values(null, '王 威婷', '台南市大廣路182號', 'wang', 'wang123');
insert into customer values(null, '陸大宏', '高雄市大履路118號', 'lu', 'lu123');
insert into customer values(null, '吳 履谷', '花蓮縣大點路138號', 'wu', 'wu123');
insert into customer values(null, '郭 襄藝', '高雄市大方路188號', 'kuo', 'kuo123');
insert into customer values(null, '魏 右薪', '新竹市大商路131號', 'wei', 'wei123');
insert into customer values(null, '邱 高芳', '新北市大田路8號', 'chu', 'chu123');
insert into customer values(null, '林 有福', '台東縣大邱路13號', 'lin', 'lin123');
