BEGIN;
	INSERT INTO certificards (location, balance, serial, dateAdded, expiration, owner) 
	VALUES ('Kohls', 48.57, 'K0HL5C45H', now(), '2018-12-31', 3);
    INSERT INTO transactions (cardId, balanceDelta, date) 
    VALUES (last_insert_id(), 48.57, now());
COMMIT;
BEGIN;
	INSERT INTO certificards (location, balance, serial, dateAdded, expiration, owner) 
	VALUES ('Best Buy', 8.21, '1337H4X', now(), '2020-04-08', 3);
    INSERT INTO transactions (cardId, balanceDelta, date) 
    VALUES (last_insert_id(), 8.21, now());
COMMIT;
BEGIN;
	INSERT INTO certificards (location, balance, serial, dateAdded, expiration, owner) 
	VALUES ('Aldi', 20.00, '1234598765', now(), '2018-08-01', 3);
	INSERT INTO transactions (cardId, balanceDelta, date) 
    VALUES (last_insert_id(), 20.00, now());
COMMIT;
BEGIN;
	INSERT INTO certificards (location, balance, serial, dateAdded, expiration, owner) 
	VALUES ('Buffalo Wild Wings', 25.97, 'BWW192837465', now(), '2019-02-28', 3);
    INSERT INTO transactions (cardId, balanceDelta, date) 
    VALUES (last_insert_id(), 25.97, now());
COMMIT;
BEGIN;
	INSERT INTO certificards (location, balance, serial, dateAdded, expiration, owner) 
	VALUES ('Guitar Center', 185.95, 'N2GH5X98', now(),'2037-12-01', 3);
	INSERT INTO transactions (cardId, balanceDelta, date) 
    VALUES (last_insert_id(), 185.95, now());
COMMIT;
