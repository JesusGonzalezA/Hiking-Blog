USE SIBW;

SELECT * FROM events;
SELECT * FROM comments;
SELECT * FROM events, comments WHERE events.id=comments.idEvent;