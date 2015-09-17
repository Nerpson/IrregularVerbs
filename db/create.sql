CREATE TABLE if not exists infinitives (
	id SERIAL,
	value text
);

CREATE TABLE if not exists preterits (
	id SERIAL,
	infinitive_id int,
	value text
);

CREATE TABLE if not exists past_participles (
	id SERIAL,
	infinitive_id int,
	value text
);

CREATE TABLE if not exists translations (
	id SERIAL,
	infinitive_id int,
	language_id int,
	value text
);

CREATE TABLE if not exists languages (
	id SERIAL,
	name text
);

CREATE TABLE if not exists sets (
	id SERIAL,
	name text
);

CREATE TABLE if not exists infinitives_sets (
	id SERIAL,
	infinitive_id int,
	set_id int
);