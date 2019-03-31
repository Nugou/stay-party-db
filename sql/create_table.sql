use u406455635_sp;

create table user_data (
	id_user int primary key auto_increment,
	name varchar(50) not null,
	email varchar(50) not null unique,
	activated boolean not null
);

create table user_account (
	id_user int,
	password varchar(50) not null,
	foreign key (id_user) references user_data(id_user)
);

create table driver_data(
	id_driver int primary key auto_increment,
	name varchar(50) not null ,
	email varchar(50) not null ,
	enabled boolean not null ,
	activated boolean not null
);

create table driver_account(
	id_driver int ,
	password varchar(16) not null ,
	foreign key (id_driver) references driver_data(id_driver)
);

create table users_travel(
	id_travel int primary key auto_increment,
	id_driver int,
	id_user_1 int,
	id_user_2 int,
	id_user_3 int,
	id_user_4 int,
	foreign key (id_driver) references driver_data(id_driver),
	foreign key (id_user_1) references user_data(id_user),
	foreign key (id_user_2) references user_data(id_user),
	foreign key (id_user_3) references user_data(id_user),
	foreign key (id_user_4) references user_data(id_user)
);

create table users_travel_start(
	id_travel int,
	local_user_1 geometry,
	local_user_2 geometry,
	local_user_3 geometry,
	local_user_4 geometry,
	foreign key (id_travel) references users_travel(id_travel)
);

create table user_travel_end(
	id_travel int,
	local_user_end geometry,
	foreign key (id_travel) references users_travel(id_travel)
);

create table driver_local(
	id_travel int,
	driver_local geometry,
	foreign key (id_travel) references users_travel(id_travel)
);

create table travel_log(
   id_travel int,
   travel_start geometry,
   travel_end geometry,
   foreign key (id_travel) references users_travel(id_travel)
);

create table travel_log_location(
    id_travel int,
    driver_location geometry,
    location_time datetime,
	foreign key (id_travel) references users_travel(id_travel)
);

create table color(
    id_color int primary key auto_increment,
    color varchar(20)
);

create table car_data(
    id_car int primary key auto_increment,
    sign varchar(10) not null ,
    name varchar(50) not null ,
    id_color int,
    foreign key (id_color) references color(id_color)
);

create table driver_car(
    id_driver int ,
    id_car_1 int ,
    id_car_2 int ,
    id_car_3 int ,
    foreign key (id_driver) references driver_data(id_driver),
    foreign key (id_car_1) references car_data(id_car),
    foreign key (id_car_2) references car_data(id_car),
    foreign key (id_car_3) references car_data(id_car)
);