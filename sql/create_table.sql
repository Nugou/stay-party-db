use u406455635_sp;

drop table user_data;
drop table user_account;

create table user_data (
  id_user int primary key,
  name varchar(50) not null,
  email varchar(50) not null unique,
  active int not null
);

create table user_account (
  id_user int,
  password varchar(50) not null
);

create table users_travel(
  id_travel int primary key,
  id_motor int,
  id_user_1 int,
  id_user_2 int,
  id_user_3 int,
  id_user_4 int
);

create table users_travel_start(
  id_travel int,
  local_user_1 geometry,
  local_user_2 geometry,
  local_user_3 geometry,
  local_user_4 geometry
);

create table user_travel_end(
  id_travel int,
  local_user_end geometry
);

create table motor_local(
  id_travel int,
  motor_local geometry
);

create table travel_log(
  id_travel int,
  travel_local geometry
);
