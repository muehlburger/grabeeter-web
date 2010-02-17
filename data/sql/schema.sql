CREATE TABLE tweet (id BIGINT AUTO_INCREMENT, user_id BIGINT NOT NULL, source_id BIGINT NOT NULL, geolocation_id BIGINT, in_reply_to_user_id BIGINT, in_reply_to_status_id BIGINT, tweet_created_at DATETIME NOT NULL, tweet_twitter_id BIGINT DEFAULT 0 NOT NULL, statuses_count BIGINT DEFAULT 0 NOT NULL, text VARCHAR(140) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX user_id_idx (user_id), INDEX source_id_idx (source_id), INDEX geolocation_id_idx (geolocation_id), PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE tweet_geo_location (id BIGINT AUTO_INCREMENT, latitude FLOAT(9, 6) DEFAULT 0 NOT NULL, longitude FLOAT(9, 6) DEFAULT 0 NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE tweet_source (id BIGINT AUTO_INCREMENT, label VARCHAR(255) DEFAULT 'web' NOT NULL, url VARCHAR(255), created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE tweet_user (id BIGINT AUTO_INCREMENT, name VARCHAR(255), screen_name VARCHAR(15) NOT NULL, twitter_user_id BIGINT NOT NULL, description VARCHAR(255), followers_count BIGINT DEFAULT 0 NOT NULL, statuses_count BIGINT DEFAULT 0 NOT NULL, url VARCHAR(255), friends_count BIGINT DEFAULT 0 NOT NULL, geo_enabled TINYINT(1) DEFAULT '0' NOT NULL, twitter_created_at DATETIME NOT NULL, time_zone VARCHAR(255), location VARCHAR(255), lang VARCHAR(10), utc_offset BIGINT, profile_image_url VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(id)) ENGINE = INNODB;
ALTER TABLE tweet ADD CONSTRAINT tweet_user_id_tweet_user_id FOREIGN KEY (user_id) REFERENCES tweet_user(id) ON DELETE CASCADE;
ALTER TABLE tweet ADD CONSTRAINT tweet_source_id_tweet_source_id FOREIGN KEY (source_id) REFERENCES tweet_source(id) ON DELETE CASCADE;
ALTER TABLE tweet ADD CONSTRAINT tweet_geolocation_id_tweet_geo_location_id FOREIGN KEY (geolocation_id) REFERENCES tweet_geo_location(id) ON DELETE CASCADE;
