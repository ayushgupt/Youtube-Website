CREATE DATABASE youtube_db;

\c youtube_db;

create table videoid_info_temp
(
	videoid varchar not null,
	videoTitle	varchar,
	channelId	varchar,
	publishedAt	timestamp,
	defaultAudioLanguage char(10),	
	duration	int,
	caption		boolean,
	viewCount	bigint,
	likeCount	int,
	dislikeCount	int,
	commentCount	int	); 

copy videoid_info_temp from '/home/ayush/My_Stuff/SEM 6/DBMS/Project-1/Tables/videoid_info.csv' DELIMITERS ',' CSV HEADER;

create table videoid_info
(
	videoid varchar PRIMARY KEY not null,
	videoTitle	varchar,
	channelId	varchar,
	publishedAt	timestamp,
	defaultAudioLanguage char(10),	
	duration	int,
	caption		boolean,
	viewCount	bigint,
	likeCount	int,
	dislikeCount	int,
	commentCount	int	); 

INSERT INTO videoid_info
SELECT *
FROM videoid_info_temp
ON CONFLICT DO NOTHING

-- Time: 127.746 ms


-- channelId, playlistID

create table channelid_playlistid
(
	channelid	varchar,
	playlistid  varchar PRIMARY KEY 
);

copy channelid_playlistid from '/home/ayush/My_Stuff/SEM 6/DBMS/Project-1/Tables/channelid_playlistid.csv' DELIMITERS ',' CSV HEADER;

-- COPY 3843
-- Time: 81.877 ms


-- channelId,channelTitle
create table channelid_channeltitle
(
	channelid varchar PRIMARY KEY,
	channeltitle varchar
);

copy channelid_channeltitle from '/home/ayush/My_Stuff/SEM 6/DBMS/Project-1/Tables/channelid_channeltitle.csv' DELIMITERS ',' CSV HEADER;


-- COPY 1661
-- Time: 30.885 ms

-- channelId,publishedAt,country,subscriberCount,videoCount,viewCount,commentCount
create table channelid_info_temp
(
	channelid varchar,
	publishedAt timestamp,
	country char(10),
	subscriberCount int,
	videoCount int,
	viewCount bigint,
	commentCount bigint
);

copy channelid_info_temp from '/home/ayush/My_Stuff/SEM 6/DBMS/Project-1/Tables/channelid_info.csv' DELIMITERS ',' CSV HEADER;

-- COPY 131
-- Time: 6.718 ms

create table channelid_info
(
	channelid varchar PRIMARY KEY,
	publishedAt timestamp,
	country char(10),
	subscriberCount int,
	videoCount int,
	viewCount bigint,
	commentCount bigint
);

INSERT INTO channelid_info
SELECT *
FROM channelid_info_temp
ON CONFLICT DO NOTHING
-- INSERT 0 129
-- Time: 20.648 ms


-- playlistId,playlistTitle,playlistChannelId,playlistVideoCount

create table playlist_info
(
	playlistid varchar PRIMARY KEY,
	playlisttitle varchar,
	channelid varchar,
	playlistvideocount bigint
);

copy playlist_info from '/home/ayush/My_Stuff/SEM 6/DBMS/Project-1/Tables/playlist_info.csv' DELIMITERS ',' CSV HEADER;

-- COPY 1148
-- Time: 36.268 ms

-- playlistId,videoId

create table playlistid_videoid_temp
(
	playlistid varchar,
	videoid varchar
);

copy playlistid_videoid_temp from '/home/ayush/My_Stuff/SEM 6/DBMS/Project-1/Tables/playlistid_videoid.csv' DELIMITERS ',' CSV HEADER;

-- COPY 9246
-- Time: 148.901 ms

create table playlistid_videoid
(
	playlistid varchar,
	videoid varchar PRIMARY KEY
);

INSERT INTO playlistid_videoid
SELECT *
FROM playlistid_videoid_temp
ON CONFLICT DO NOTHING

-- INSERT 0 4208
-- Time: 80.941 ms

drop table channelid_info_temp;
drop table playlistid_videoid_temp;
drop table videoid_info_temp ;



-- commentId,videoId,authorChannelId,likeCount,publishedAt

create table commentid_info
(
	commentid varchar PRIMARY KEY,
	videoid varchar,
	channelid varchar,
	likeCount int,
	publishedAt timestamp
);

copy commentid_info from '/home/ayush/My_Stuff/SEM 6/DBMS/Project-1/Tables/commentid_info.csv' DELIMITERS ',' CSV HEADER; 

-- COPY 1621
-- Time: 28.266 ms


create table email_password
(
	email varchar PRIMARY KEY,
	password varchar NOT NULL,
	permissions int NOT NULL
);	

create table email_videoid_comment
(
	email varchar NOT NULL,
	videoid varchar NOT NULL,
	comment text NOT NULL,
	FOREIGN KEY (videoid) REFERENCES videoid_info(videoid)
);


CREATE INDEX videoid_index
ON videoid_info (videoid);

-- youtube_db=# select count(*) from channelid_channeltitle ;
--  count 
-- -------
--   1661
-- (1 row)

-- Time: 0.547 ms
-- youtube_db=# select count(*) from channelid_info;
--  count 
-- -------
--    129
-- (1 row)

-- Time: 0.281 ms
-- youtube_db=# select count(*) from channelid_playlistid;
--  count 
-- -------
--   3843
-- (1 row)

-- Time: 2.890 ms
-- youtube_db=# select count(*) from commentid_info;
--  count 
-- -------
--   1621
-- (1 row)

-- Time: 1.193 ms
-- youtube_db=# select count(*) from playlist_info;
--  count 
-- -------
--   1148
-- (1 row)

-- Time: 0.699 ms
-- youtube_db=# select count(*) from playlistid_videoid;
--  count 
-- -------
--   4208
-- (1 row)

-- Time: 3.337 ms
-- youtube_db=# select count(*) from videoid_info;
--  count 
-- -------
--   4108
-- (1 row)

-- Time: 2.256 ms



ALTER TABLE videoid_info ADD CHECK (viewcount>0);


for every channel most likedvideo

create view max_channel as
select channelid, max(likecount)
from videoid_info
GROUP BY (channelid);


select videoid, videoid_info.channelid, max
from max_channel join videoid_info
on max_channel.max=videoid_info.likecount AND max_channel.channelid=videoid_info.channelid;


select channelid, sum(viewcount) as total_views
from videoid_info
GROUP BY (channelid)
order by total_views DESC
LIMIT 5;


for every channel
(like/dislike)


select channelid, sum(likecount) as total_views
from videoid_info
GROUP BY (channelid)
order by total_views DESC
LIMIT 5;


diff in viewcount max in channel

ELECT * FROM tmp t1, tmp t2 WHERE t2.b <> t1.a

select tablea.channelid, tableb.channelid, (tablea.viewcount-tableb.viewcount) as diff 
from channelid_info tablea , channelid_info tableb
order by diff DESC
limit 3;

