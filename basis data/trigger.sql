-- Active: 1722388677378@@localhost@3306@triggger
CREATE DATABASE triggger;

CREATE TABLE karyawan(
    id BIGINT,
    nama VARCHAR(50),
    noHp VARCHAR(12),
    jabatan VARCHAR(50)
);
CREATE TABLE absensi(
    id BIGINT,
    tanggal DATE,
    karyawan_id BIGINT
);
CREATE TABLE rekap(
    id INT,
    karyawan_id BIGINT,
    jumlah_hari INT,
    
);
INSERT INTO karyawan( id, nama, `noHp`, jabatan)
VALUES 
(1, "Sodikin", 0812124563, "Direktur"),
(2, "Melati", 0813131452, "Manager");

INSERT INTO rekap( id, karyawan_id, jumlah_hari)
VALUES 
(1, 1, 0),
(2, 2, 0);

ALTER TABLE karyawan
ADD CONSTRAINT PRIMARY KEY (id);

ALTER TABLE rekap
ADD CONSTRAINT PRIMARY KEY (karyawan_id);

DELIMITER $$
CREATE TRIGGER tambah_hariRekap
AFTER INSERT
ON absensi
FOR EACH ROW
BEGIN
    UPDATE rekap SET jumlah_hari = jumlah_hari + 1 WHERE karyawan_id = NEW.karyawan_id;
END$$
DELIMITER;

insert INTO absensi ( id, tanggal, karyawan_id)
VALUES
( 1,'2022-01-01', 1);

SELECT * FROM rekap;

-- 2.
DELIMITER $$
CREATE TRIGGER kurang_rekap
AFTER DELETE
ON absensi
FOR EACH ROW
BEGIN 
    UPDATE rekap set jumlah_hari = jumlah_hari - 1 WHERE karyawan_id = OLD.karyawan_id;
END$$

DELIMITER;

SELECT * FROM rekap;
DELETE from absensi where id = 1;

-- 3.
DELIMITER $$
CREATE TRIGGER record
