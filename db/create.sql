CREATE TABLE if not exists infinitives (
	id SERIAL PRIMARY KEY,
	value text
);

CREATE TABLE if not exists preterits (
	id SERIAL PRIMARY KEY,
	infinitive_id int,
	value text
);

CREATE TABLE if not exists past_participles (
	id SERIAL PRIMARY KEY,
	infinitive_id int,
	value text
);

CREATE TABLE if not exists translations (
	id SERIAL PRIMARY KEY,
	infinitive_id int,
	language_id int,
	value text
);

CREATE TABLE if not exists languages (
	id SERIAL PRIMARY KEY,
	name text
);

CREATE TABLE if not exists sets (
	id SERIAL PRIMARY KEY,
	name text
);

CREATE TABLE if not exists infinitives_sets (
	id SERIAL PRIMARY KEY,
	infinitive_id int,
	set_id int
);

INSERT INTO languages(name) VALUES('french');