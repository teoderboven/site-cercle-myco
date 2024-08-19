-- SQL configuration file for CMB website database

-- CREATE DATABASE ...

create table users(
	id int auto_increment not null,
	name varchar(50) not null unique,
	-- TODO password

	primary key(id)
);

create table guides(
	id int auto_increment not null,
	name varchar(50) not null,
	phone varchar(15) not null,

	primary key(id)
);

create table meeting_points(
	id int auto_increment not null,
	name varchar(255) not null,
	municipality varchar(127) not null,
	latitude DECIMAL(9,6),
	longitude DECIMAL(9,6),

	primary key(id)
);

create table activities(
	id char(16) not null,
	title varchar(255) not null,
	guide_id int not null,
	start_date datetime not null,
	duration smallint not null,
	description text not null,
	meeting_point int not null,
	cancelled bool default false not null,
	created_time timestamp default CURRENT_TIMESTAMP,
	updated_time timestamp default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
	updated_by int not null,

	primary key(id),
	foreign key(guide_id) references guides(id),
	foreign key(meeting_point) references meeting_points(id);
	foreign key(updated_by) references users(id)
);

create table activity_links(
	id int auto_increment not null,
	activity_id char(16) not null,
	text VARCHAR(255) NOT NULL,
	url VARCHAR(255) NOT NULL,
	
	primary key(id),
	foreign key(activity_id) references activities(id) on delete cascade
);

CREATE INDEX idx_activity_start_date ON activities(start_date);
CREATE INDEX idx_activity_guide ON activities(guide);
CREATE INDEX idx_activity_meeting_point ON activities(meeting_point);
CREATE INDEX idx_links_activity_id ON activity_links(activity_id);

DELIMITER $$

CREATE TRIGGER prevent_activity_cancel_after_start
BEFORE UPDATE ON activities
FOR EACH ROW
BEGIN
	IF OLD.start_date < NOW() AND NEW.cancelled = TRUE THEN
		SIGNAL SQLSTATE '45000' 
		SET MESSAGE_TEXT = 'Cannot cancel an activity after its start date.';
	END IF;
END$$

DELIMITER ;