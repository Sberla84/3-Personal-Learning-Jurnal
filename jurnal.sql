BEGIN TRANSACTION;
CREATE TABLE IF NOT EXISTS "entries" (
	"id"	INTEGER,
	"title"	TEXT,
	"date"	TEXT,
	"time_spent"	INTEGER,
	"learned"	BLOB,
	"resources"	BLOB,
	PRIMARY KEY("id")
);
INSERT INTO "entries" VALUES (1,'The Best Day I Ever Had','2018-01-31','6 hours','One time I was the Queen of Absolutelyeverything for a whole day.  I got to do whatever I wanted all day!',NULL);
INSERT INTO "entries" VALUES (2,'The worst day I ever had','2017-07-30','25 min','One time it was my birthday and not one person remembered.  I was so very sad',NULL);
INSERT INTO "entries" VALUES (3,'The day I learned to use foreach loops correctly','2018-11-01','3 hours','I can&#39;t believe it but I actually learned to use foreach loops correctly!  This was a process but after some trial and error I did it!',NULL);
INSERT INTO "entries" VALUES (4,'The time that I needed a title to fill some space','2016-01-02','45 min','I remember this one time, when I was trying to do my PHP project, and I wanted/needed random fillers to help seed my database.  Gee wow! That was such a super day!',NULL);
COMMIT;
